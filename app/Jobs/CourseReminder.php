<?php

namespace App\Jobs;

use App\Models\Enrollment;
use App\Notifications\ReminderNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class CourseReminder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public int $tries = 3;

    public int $backoff = 60;

    public bool $deleteWhenMissingModels = true;

    public function __construct(public readonly int $enrollmentId) {}

    public function handle(): void
    {
        $enrollment = Enrollment::with(['user', 'course'])->find($this->enrollmentId);

        if (! $enrollment) {
            return;
        }

        if ($enrollment->progress_percentage > 0 || $enrollment->completed_at !== null) {
            Log::info('[EnrollmentReminder] Skipped — user already started.', [
                'enrollment_id' => $this->enrollmentId,
                'progress' => $enrollment->progress_percentage,
            ]);

            return;
        }

        $enrollment->user->notify(new ReminderNotification($enrollment));

        Log::info('[EnrollmentReminder] Reminder sent.', [
            'enrollment_id' => $this->enrollmentId,
            'user_id' => $enrollment->user_id,
            'course_id' => $enrollment->course_id,
        ]);
    }

    public function failed(\Throwable $exception): void
    {
        Log::error('[EnrollmentReminder] Job failed.', [
            'enrollment_id' => $this->enrollmentId,
            'error' => $exception->getMessage(),
        ]);
    }
}

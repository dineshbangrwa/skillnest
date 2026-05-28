<?php

namespace App\Notifications;

use App\Models\Enrollment;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ReminderNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Enrollment $enrollment;

    public function __construct(Enrollment $enrollment)
    {
        $this->enrollment = $enrollment->loadMissing(['user', 'course']);
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $enrollment = $this->enrollment;

        return (new MailMessage)
            ->subject('⏰ You Haven\'t Started '.$enrollment->course->title.' Yet!')
            ->view('frontend.pages.mail.reminder', [
                'user_name' => $enrollment->user->name,
                'course' => $enrollment->course,
                'enrolled_at' => $enrollment->enrolled_at
                    ? (is_string($enrollment->enrolled_at)
                        ? Carbon::parse($enrollment->enrolled_at)->format('M d, Y')
                        : $enrollment->enrolled_at->format('M d, Y'))
                    : now()->format('M d, Y'),
                'progress' => $enrollment->progress_percentage,
                'course_url' => route('courses.show', $enrollment->course->id),
                'explore_url' => route('courses.search'),
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Start Your Course!',
            'message' => 'You haven\'t started '.$this->enrollment->course->title.' yet. Jump in today!',
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'course-enrollment-reminder';
    }

    public function initialDatabaseReadAtValue(): ?Carbon
    {
        return null;
    }
}

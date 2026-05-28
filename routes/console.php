<?php

use App\Jobs\CourseReminder;
use App\Jobs\ProcessInstructorTransfers;
use App\Models\Enrollment;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::job(new ProcessInstructorTransfers)
    ->dailyAt('00:00')
    // ->everyMinute()
    ->name('process-instructor-transfers')
    ->withoutOverlapping()
    ->onFailure(function () {
        Log::error('ProcessInstructorTransfers scheduler failed!');
    });

Schedule::call(function () {

    Enrollment::query()
        ->where('progress_percentage', 0)
        ->whereNull('completed_at')
        // ->whereDate('enrolled_at', '<=', now()->subDays(3))
        ->chunkById(100, function ($enrollments) {
            foreach ($enrollments as $enrollment) {
                CourseReminder::dispatch($enrollment->id);
            }
        });

})
    // ->everyMinute()
    ->dailyAt('09:00')
    ->name('send-enrollment-reminders')
    ->withoutOverlapping();

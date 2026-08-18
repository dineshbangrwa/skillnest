<?php

namespace App\Notifications;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class CoursePurchasedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order->loadMissing([
            'user',
            'items.course.instructor',
            'items.course.sections.lessons',
            'items.course.media',
        ]);
    }

    public function via($notifiable): array
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        $order = $this->order;

        $courses = $order->items->map(fn ($item) => $item->course)->filter();

        return (new MailMessage)
            ->subject('🎉 Your Course Purchase is Confirmed!')
            ->view('frontend.pages.mail.coursePurchased', [
                'user_name' => $order->user->name,
                'order' => $order,
                'order_number' => $order->order_number,
                'paid_at' => $order->paid_at
                    ? (is_string($order->paid_at)
                        ? Carbon::parse($order->paid_at)->format('M d, Y')
                        : $order->paid_at->format('M d, Y'))
                    : now()->format('M d, Y'),
                'payment_method' => 'Online Payment',
                'subtotal' => $order->subtotal,
                'discount' => $order->discount ?? 0,
                'coupon_code' => $order->coupon_code,
                'total' => $order->total,
                'courses' => $courses,
                'explore_url' => route('courses.search'),
            ]);
    }

    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'Course Purchased!',
            'message' => 'Congratulations on purchasing a course',
        ];
    }

    public function databaseType(object $notifiable): string
    {
        return 'course-purchase';
    }

    public function initialDatabaseReadAtValue(): ?Carbon
    {
        return null;
    }
}

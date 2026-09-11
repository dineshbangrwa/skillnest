<?php

namespace App\Services;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderService
{
    public function create(Request $request)
    {
        $user = auth()->user();
        $cart = $user->cart()->with('items.course')->first();

        if (! $cart || $cart->items->isEmpty()) {
            abort(400, 'Cart is empty');
        }

        return DB::transaction(function () use ($user, $cart, $request) {
            $subtotal = $cart->items->sum(fn ($item) => $item->price);
            $discount = $cart->discount_total ?? 0;
            $total = $subtotal - $discount;

            // Order create karo
            $order = Order::create([
                'user_id' => $user->id,
                'subtotal' => $subtotal,
                'discount' => $discount,
                'coupon_code' => $cart->coupon_code,
                'total' => $total,
                'country' => $request->country,
                'state' => $request->state,
                'status' => Order::STATUS_PENDING,
            ]);

            foreach ($cart->items as $cartItem) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'course_id' => $cartItem->course_id,
                    'price' => $cartItem->price,
                ]);
            }

            $lineItems = [];
            $discountRemaining = $discount;
            $itemsCount = $cart->items->count();

            foreach ($cart->items as $index => $item) {
                if ($index === $itemsCount - 1) {
                    // Last item takes whatever discount is remaining to avoid rounding issues
                    $itemDiscount = $discountRemaining;
                } else {
                    $itemDiscount = $subtotal > 0 ? round(($item->price / $subtotal) * $discount, 2) : 0;
                    $discountRemaining -= $itemDiscount;
                }

                $finalPrice = max(0, $item->price - $itemDiscount);

                $lineItems[] = [
                    'price_data' => [
                        'currency' => 'usd',
                        'unit_amount' => (int) round($finalPrice * 100),
                        'product_data' => [
                            'name' => $item->course->title ?? 'Course',
                        ],
                    ],
                    'quantity' => 1,
                ];
            }

            $checkout = $user->checkout($lineItems, [
                'success_url' => route('checkout.success').'?session_id={CHECKOUT_SESSION_ID}',
                'cancel_url' => route('cart.index'),
                'metadata' => [
                    'order_id' => $order->id,
                    'order_number' => $order->order_number,
                ],
            ]);

            $order->update([
                'stripe_session_id' => $checkout->id,
            ]);

            return $checkout;
        });
    }
}

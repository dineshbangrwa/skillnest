<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function __construct(protected readonly CartService $cartService) {}

    public function index()
    {
        if (! auth()->check()) {
            return to_route('login');
        }

        $cart = auth()->user()->cart;

        $cartItems = $cart?->items()->with([
            'course.instructor',
            'course.reviews',
        ])->get() ?? collect();

        // Preload counts and averages to avoid N+1 queries
        $cartItems->each(function ($item) {
            $reviews = $item->course->reviews;
            $item->course->reviews_count = $reviews->count();
            $item->course->average_rating = $reviews->count() > 0
                ? $reviews->avg('rating')
                : 0;
        });

        $totalOriginalPrice = $cartItems->sum(function ($item) {
            return $item->course->original_price;
        });

        $coupon = $cart->coupon ?? 0;
        $totalPriceBeforeDiscount = $cartItems->sum('price');
        $totalSavings = $totalOriginalPrice - $totalPriceBeforeDiscount;
        $couponDiscount = $cart->discount_total ?? 0;
        $subTotal = $totalPriceBeforeDiscount - $couponDiscount;

        return view('frontend.pages.cart', compact('cartItems', 'totalOriginalPrice', 'totalPriceBeforeDiscount', 'totalSavings', 'couponDiscount', 'subTotal', 'coupon'));
    }

    public function store(Request $request)
    {
        $result = $this->cartService->addToCart((int) $request->course_id);

        return back()->with($result);
    }

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required|string',
        ]);

        $result = $this->cartService->applyCoupon($request->coupon_code);

        return response()->json($result);
    }

    public function removeCoupon(Request $request)
    {
        $cart = auth()->user()?->cart;

        if (! $cart) {
            return response()->json(['success' => false, 'message' => 'Cart not found'], 404);
        }

        $cart->coupon_id = null;
        $cart->coupon_code = null;
        $cart->discount_total = 0;
        $cart->total = $cart->subtotal;
        $cart->save();

        return response()->json([
            'success' => true,
            'message' => 'Coupon removed successfully',
            'final_total' => $cart->subtotal,
        ]);
    }

    public function destroy($courseId)
    {
        $user = auth()->user();
        $cart = $user->cart;

        if (! $cart) {
            return response()->json(['success' => false, 'message' => 'Cart not found'], 404);
        }

        $item = $cart->items()->where('course_id', $courseId)->first();

        if (! $item) {
            return response()->json(['success' => false, 'message' => 'Item not found in cart'], 404);
        }

        $result = $this->cartService->removeFromCart((int) $courseId);

        return response()->json($result);
    }
}

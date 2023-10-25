<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class OrderController extends Controller
{
    //


    public function place_order(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            // Add validation rules for other fields
        ]);

        $user = Auth::user();
        $cart = null;

        if ($user) {
            // If the user is logged in, get their active cart
            $cart = $user->cart;
        } else {
            // If it's a guest user, retrieve the guest cart
            $cartReference = Session::get('guest_cart_reference');
            if ($cartReference) {
                $cart = Cart::where('reference', $cartReference)->first();
            }
        }

        if (!$cart) {
            // Handle the case where there's no active cart for the user (e.g., show an error message)
            return redirect('/')->with('error', 'No active cart found.');
        }

        // dd($cart->id);
        // Create a new order associated with the user and the cart, setting 'cart_id' explicitly
        $reference = 'order_' . time() . '_' . mt_rand(1000, 9999);

        $order = new Order([
            'user_id' => $user ? $user->id : null,
            'cart_id' => $cart->id,
            'reference' => $reference,
            // Set 'cart_id' explicitly
            'status' => 'pending',
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'address' => $request->input('address'),
            'province' => $request->input('province'),
            // Add other order details
        ]);

        $order->save();

        // Associate cart items with the order and then delete the cart items
        $cartItems = CartItem::where('cart_id', $cart->id)->get();

        foreach ($cartItems as $cartItem) {
            $order->items()->create([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'order_id' => $order->id,
            ]);
            $cartItem->delete();
        }

        // dd($order->items);
        return redirect()->route('order.confirmation', ['reference' => $reference]);


    }

    public function getOrderWithProductDetails($orderId)
    {
        // Retrieve the order
        $order = Order::findOrFail($orderId);

        // Retrieve order items associated with the order, including product details
        $orderItems = OrderItem::where('order_id', $order->id)->with('product.images')->get();

        // Create a custom object or array to hold order and product details
        $orderDetails = [
            'order' => $order,
            'orderItems' => $orderItems,
        ];

        return $orderDetails;
    }

    public function confirmation($reference)
    {
        // Retrieve the order based on the provided reference
        $order = Order::where('reference', $reference)->first();

        if (!$order) {
            return redirect('/')->with('error', 'Order not found.');
        }

        $orderDetails = $this->getOrderWithProductDetails($order->id);
        // dd($orderDetails);
        // Render the confirmation view with order, order item details, and ordered products
        return view('home.order.confirmation', compact('orderDetails'));
    }

    public function all_orders()
    {
        $orders = Order::all();
        return view('admin.pages.orders', compact('orders'));
    }

    public function update_order_status(Request $request, Order $order)
    {
        $request->validate([
            'status' => 'required|in:dispatched,delivered,completed,shipped,processing',
        ]);

        // Update the order status
        $order->status = $request->input('status');
        $order->save();

        return back()->with('message', 'Order status updated successfully');
    }

    public function single_order($id){
        // Retrieve the order based on the provided reference
        $order = Order::where('id', $id)->first();

        if (!$order) {
            return redirect('/')->with('error', 'Order not found.');
        }

        $orderDetails = $this->getOrderWithProductDetails($order->id);
        // dd($orderDetails);
        // Render the confirmation view with order, order item details, and ordered products
        return view('admin.pages.single_order', compact('orderDetails'));
    }
}



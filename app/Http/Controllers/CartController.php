<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function getGuesCtartReference()
    {
        if (Session::has('guest_cart_reference')) {
            return Session::get('guest_cart_reference');
        }

        $guestCartReference = $this->generateUniqueCartReference();
        Session::put('guest_cart_reference', $guestCartReference);
        return $guestCartReference;
    }
    public function index()
    {
        $user = [];
        $items = [];

        if (auth()->check()) {
            // If the user is logged in, retrieve the user's cart items
            $current_user = auth()->user();
            $cart = $current_user->cart;

            $user = (object) $current_user->only(['id', 'name', 'email', 'address', 'phone', 'shop_name']);
            if ($cart) {

                $items = $cart->items->map(function ($item) {
                    return (object) [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'cart_id' => $item->cart_id,
                        'created_at' => $item->created_at,
                        'product' => (object) $item->product->only('id', 'title', 'price', 'discount_price', 'description', 'quantity', 'shop_name', 'images')
                    ];
                });
            }
        } else {
            // If it's a guest user, retrieve the guest cart items
            $cartReference = $this->getGuesCtartReference(); // You should have a method to get the guest cart reference
            $cart = Cart::where('reference', $cartReference)->first();
            if ($cart) {
                $items = $cart->items->map(function ($item) {
                    return (object) [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'cart_id' => $item->cart_id,
                        'created_at' => $item->created_at,
                        'product' => (object) $item->product->only('id', 'title', 'price', 'discount_price', 'description', 'quantity', 'shop_name', 'images')

                    ];
                });
            }
        }

        $subtotal = 0;
        $total = 200;

        foreach ($items as $item) {
            $itemSubtotal = $item->product->price * $item->quantity;
            $subtotal += $itemSubtotal;
            $total += $itemSubtotal;
        }
        // dd($items, $user);
        return view('home.pages.cart', compact('user', 'items', 'subtotal', 'total'));
    }


    public function remove($id)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // If the user is authenticated, remove the product from their cart
            $user = auth()->user();
            $cart = $user->cart;
        } else {
            // If the user is a guest, remove the product from their guest cart
            $cartReference = $this->getGuesCtartReference(); // You should have a method to get the guest cart reference
            $cart = Cart::where('reference', $cartReference)->first();
        }

        // Check if the product is in the cart
        $cartItem = $cart->items()->where('product_id', $id)->first();
        // dd($cartItem);

        if ($cartItem) {
            // If the product is in the cart, remove it
            $cartItem->delete();
        }

        if ($cart->items->isEmpty()) {
            // Redirect to the index page with a message
            return redirect('/')->with('message', 'Cart is empty.');
        } else {
            return redirect('cart')->with('message', 'Product removed from the cart successfully');
        }

        // If there are items left, you can redirect to the cart page or another appropriate page

        // Redirect the user back to the cart page with a success message
    }


    public function generateUniqueCartReference()
    {
        // Check if a guest cart reference already exists in the session
        if (Session::has('guest_cart_reference')) {
            return Session::get('guest_cart_reference');
        }

        // If not, generate a new reference and store it in the session
        $guestCartReference = 'cart_' . time() . '_' . mt_rand(1000, 9999);
        Session::put('guest_cart_reference', $guestCartReference);
        return $guestCartReference;
    }


    //
    public function add($id)
    {
        // Check if the user is authenticated
        if (auth()->check()) {
            // If the user is authenticated, add the product to their cart
            $user = auth()->user();
            $cart = $user->cart;
            if (!$cart) {
                $cart = new Cart();
                $cart->reference = $this->generateUniqueCartReference(); // Generate a unique reference
                $user->cart()->save($cart);
            }
        } else {
            // If the user is a guest, add the product to their guest cart
            $cartReference = $this->getGuesCtartReference(); // You should have a method to get the guest cart reference
            $cart = Cart::where('reference', $cartReference)->first();
            if (!$cart) {
                // Create a new guest cart if it doesn't exist
                $cart = new Cart();
                $cart->reference = $cartReference;

                $cart->save();
                // If the cart doesn't exist, you may want to create one here or handle this situation accordingly.
            }
        }

        // Check if the product is already in the cart
        $cartItem = $cart->items()->where('product_id', $id)->first();

        if ($cartItem) {
            // If the product is in the cart, increase the quantity
            $cartItem->increment('quantity');
        } else {
            // If the product is not in the cart, create a new cart item
            $cart->items()->create([
                'product_id' => $id,
                'quantity' => 1,
            ]);
        }

        // Redirect the user back to the previous page with a success message
        return redirect()->back()->with('message', 'Product added to cart successfully');
    }

    // public function checkout()
    // {
    //     // Validate and store the order
    //     $order = Order::create([
    //         'user_id' => auth()->id(),
    //         'name' => request('name'),
    //         'email' => request('email'),
    //         'address' => request('address'),
    //         'phone' => request('phone'),
    //         // ... other order details
    //     ]);

    //     // Transfer cart items to the order
    //     Cart::transferCartItems($order);

    //     // Clear the cart
    //     Cart::clear();

    //     return view('order_confirmation', compact('order'));
    // }
}
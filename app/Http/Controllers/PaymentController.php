<?php

namespace App\Http\Controllers;

use App\Models\OrderedProducts;
use App\Models\UserCart;
use Exception;
use Stripe\StripeClient;
use Stripe\Exception\CardException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Modules\Order\Models\Order;
use Modules\Product\Models\Product;


class PaymentController extends Controller
{

    public function index()
    {
        return view('frontend.payment');
    }
    public function store(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string|min:2',
            'email' => 'required|email',
            'number' => 'required|numeric',
            'address_one' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|digits:5',
            'name' => 'required|string',
            'total_price' => 'required|numeric', // Add any additional validation rules for the total_price field.
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            $stripe = new StripeClient(env('STRIPE_SECRET'));

            $stripe->paymentIntents->create([
                'amount' => $request->total_price * 100,
                'currency' => 'usd',
                'payment_method' => $request->payment_method,
                'description' => 'Kestrel Brother Supply',
                'confirm' => true,
                'receipt_email' => $request->email
            ]);


            $order = new Order();
            if (auth()->check()) {
                $userId = auth()->user()->id;
                $userCart = UserCart::where('user_id', $userId)->get();
    
                $order->user_id = $userId;
                $order->first_name = $request->first_name;
                $order->last_name = $request->last_name;
                $order->email = $request->email;
                $order->number = $request->number;
                $order->address_one = $request->address_one;
                $order->address_two = $request->address_two;
                $order->city = $request->city;
                $order->state = $request->state;
                $order->zip = $request->zip;
                $order->name = $request->name;
                $order->total_price = $request->total_price;
                $order->status = 'pending';
                $order->save();
                $orderId = $order->id;
    
                foreach ($userCart as $cart) {
                    $productId = $cart->product_id;
                    $product = Product::where('id', $cart->product_id)->first();
                    $orderedProduct = new OrderedProducts();
                    $orderedProduct->order_id = $orderId;
                    $orderedProduct->name = $request->name;
                    $orderedProduct->product_name = $product->name;
                    $orderedProduct->quantity = $cart->quantity;
                    $orderedProduct->unit_price = $product->price;
                    $orderedProduct->total_price = $product->price * $cart->quantity;
                    $orderedProduct->save();
                    $cart->delete();
                }
            } else {
                $order->first_name = $request->first_name;
                $order->last_name = $request->last_name;
                $order->email = $request->email;
                $order->number = $request->number;
                $order->address_one = $request->address_one;
                $order->address_two = $request->address_two;
                $order->city = $request->city;
                $order->state = $request->state;
                $order->zip = $request->zip;
                $order->name = $request->name;
                $order->total_price = $request->total_price;
                $order->status = 'pending';
                $order->save();
                $orderId = $order->id;
    
                $productIds = session('user.cart');
                $productIdCounts = array_count_values($productIds);
                $products = Product::whereIn('id', $productIds)
                    ->distinct()
                    ->get();
                    foreach($products as $product){
                        $count = $productIdCounts[$product->id] ?? 0;
                        $orderedProduct = new OrderedProducts();
                        $orderedProduct->order_id = $orderId;
                        $orderedProduct->product_name = $product->name;
                        $orderedProduct->quantity = $count;
                        $orderedProduct->unit_price = $product->price;
                        $orderedProduct->total_price = $product->price * $count;
                        $orderedProduct->save();
                        
                    }
            }




        } catch (CardException $th) {
            throw new Exception("There was a problem processing your payment", 1);
        }
        session()->forget('user.cart'); 
        return back()->withSuccess('Payment done.');
    }
}

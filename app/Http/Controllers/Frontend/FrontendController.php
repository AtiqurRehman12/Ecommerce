<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\OrderedProducts;
use App\Models\UserCart;
use Modules\Order\Models\Order;
use Modules\Product\Models\Product;
use GuzzleHttp\Psr7\Request;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request as FacadesRequest;

class FrontendController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('verify.email');
    }


    public function index()
    {
        $categories = DB::table('category')->get();
        $latestProducts = DB::table('products')
            ->orderBy('id', 'desc')
            ->limit(8)
            ->get();
        return view('frontend.index', compact('categories', 'latestProducts'));
    }
    public function contactUs(){
        return view('frontend.contactUs');
    }
    public function products(){
        $products = DB::table('products')->paginate(20);;
        return view('frontend.products', compact('products'));
    }

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function shop($id)
    {
        $categoryName = DB::table('category')->where('id', $id)->pluck('name')->first();
        $categoryIcon = DB::table('category')->where('id', $id)->pluck('image')->first();
        $products = DB::table('products')->where('category_id', $id)->paginate(12);
        return view('frontend.shop', compact('products', 'categoryName', 'categoryIcon'));
    }
    public function product($id)
    {

        $product = DB::table('products')->where('id', $id)->first();
        if ($product->quantity < 1) {
            return redirect()->back();
        } else {
            return view('frontend.detail', compact('product'));
        }
    }
    public function productSearch(HttpRequest $request)
    {
        $searchProduct = $request->search;
        $products = DB::table('products')
            ->where('name', 'LIKE', '%' . $searchProduct . '%')
            ->paginate(20);
        return view('frontend.searchProduct', compact('products'));
    }
    public function cart()
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $products = DB::table('products')
                ->join('user_cart', 'products.id', '=', 'user_cart.product_id')
                ->where('user_cart.user_id', $userId)
                ->select('products.id', 'user_cart.id as cartId',  'user_cart.user_id', 'user_cart.product_id', 'user_cart.quantity',  'products.image', 'products.name', 'products.price')
                ->get();
                $count = count($products);
                if($count == 0){
                return redirect()->route('frontend.index');

                }else{

                    return view('frontend.cart', compact('products'));
                }
        } else {
            if (session('user.cart')) {

                $productIds = session('user.cart');
                $productIdCounts = array_count_values($productIds);
                $products = DB::table('products')
                    ->whereIn('id', $productIds)
                    ->distinct()
                    ->get();
                return view('frontend.cart', compact('products', 'productIdCounts'));
            } else {
                return redirect()->route('frontend.index');
            }
        }
    }
    public function checkout()
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $products = DB::table('user_cart')
                ->join('products', 'user_cart.product_id', '=', 'products.id')
                ->where('user_cart.user_id', $userId)
                ->select('user_cart.*', 'products.image', 'products.name', 'products.price')
                ->get();
            return view('frontend.checkout', compact('products'));
        } else {
            if (session('user.cart')) {
                $productIds = session('user.cart');
                $productIdCounts = array_count_values($productIds);
                $products = DB::table('products')
                    ->whereIn('id', $productIds)
                    ->distinct()
                    ->get();
                return view('frontend.checkout', compact('products', 'productIdCounts'));
            } else {
                return redirect()->route('frontend.index');
            }
        }
    }
    public function cartAjax(HttpRequest $request)
    {

        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cart = UserCart::where('product_id', $request->productId)->where('user_id', $userId)->first();
            $product = Product::where('id', $request->productId)->first();
            $productId = $product->id;
            if ($product->quantity > 0) {
                if ($cart) {
                    $cart->quantity++;
                    $cart->update();
                    $product->quantity--;
                    $product->update();
                    $cartCount = UserCart::where('user_id', $userId)->sum('quantity');
                    return response()->json(["count" => $cartCount], 200);
                } else {
                    $userCart = new UserCart();
                    $userCart->user_id = $userId;
                    $userCart->product_id = $productId;
                    $userCart->quantity = 1;
                    $userCart->save();
                    $cartCount = UserCart::where('user_id', $userId)->sum('quantity');
                    $product->quantity--;
                    $product->update();
                    return response()->json(["count" => $cartCount], 200);
                }
            }
        } else {
            $productId = $request->productId;
            $product = Product::where('id', $productId)->first();
            if ($product->quantity > 0) {
                $product->quantity--;
                $product->update();
                if (session('user.cart')) {

                    session()->push('user.cart', $productId);
                    $cartCount = count(session('user.cart'));
                    $productCount = array_count_values(session('user.cart'))[$productId] ?? 0;
                    return response()->json(['count' => $cartCount, 'productCount' => $productCount]);
                } else {
                    $productId = $request->productId;
                    session()->put('user.cart', []);
                    session()->push('user.cart', $productId);
                    $cartCount = count(session('user.cart'));
                    return response()->json(['count' => $cartCount]);
                }
            } else {
                $cartCount = count(session('user.cart'));
                return response()->json(['count' => $cartCount]);
            }
        }
    }
    public function detailCartAjax(HttpRequest $request)
    {
        $productId = $request->productId;
        $product = Product::where('id', $productId)->first();
        $count = $request->count;
        if (auth()->check()) {
            $userId = auth()->user()->id;
            if ($product->quantity > 0 && $product->quantity >= $count) {

                $cartItem = UserCart::where('user_id', $userId)->where('product_id', $productId)->first();
                if ($cartItem) {
                    $cartItem->quantity += $count;
                    $cartItem->save();
                    $product->quantity -= $count;
                    $product->update();
                    $cartCount = UserCart::where('user_id', $userId)->sum('quantity');
                    $count = UserCart::where('product_id', $productId)->where('user_id', $userId)->value('quantity');
                    return response()->json(['count' => $cartCount, 'productCount' => $count]);
                } else {
                    $newCartItem = new UserCart();
                    $newCartItem->user_id = $userId;
                    $newCartItem->product_id = $productId;
                    $newCartItem->quantity = $count;
                    $newCartItem->save();
                    $product->quantity -= $count;
                    $product->update();
                    $cartCount = UserCart::where('user_id', $userId)->sum('quantity');
                    return response()->json(['count' => $cartCount, 'productCount' => $count]);
                }
            } else {
                $cartCount = UserCart::where('user_id', $userId)->sum('quantity');

                return response()->json(['count' => $cartCount]);
            }
        } else {
            $product = Product::where('id', $productId)->first();
            if($product->quantity>0 && $product->quantity >= $count){

                $product->quantity -= $count ;
                $product->update();
                if (session('user.cart')) {
                    for ($i = 0; $i < $count; $i++) {
                        session()->push('user.cart', $productId);
                    }
                    $cartCount = count(session('user.cart'));
                    $productCount = array_count_values(session('user.cart'))[$productId] ?? 0;
                    return response()->json(['count' => $cartCount, 'productCount' => $productCount]);
                } else {
                    session()->put('user.cart', []);
                    for ($i = 0; $i < $count; $i++) {
                        session()->push('user.cart', $productId);
                    }
                    $cartCount = count(session('user.cart'));
                    $productCount = array_count_values(session('user.cart'))[$productId] ?? 0;
                    return response()->json(['count' => $cartCount, 'productCount' => $productCount]);
                }
            }else{
                $cartCount = count(session('user.cart'));
                return response()->json(['count' => $cartCount]);

            }
        }
    }
    public function cartAjaxMinus(HttpRequest $request)
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cart = UserCart::where('product_id', $request->productId)->where('user_id', $userId)->first();
            $product = Product::where('id', $request->productId)->first();
            if ($cart && $cart->quantity > 0) {
                $cart->quantity--;
                $cart->update();
                $product->quantity++;
                $product->update();
                $cartCount = UserCart::where("user_id", $userId)->sum('quantity');
                $productCount = UserCart::where("user_id", $userId)->where('product_id', $product->id)->value('quantity');
                return response()->json(["count" => $cartCount, 'productCount' => $productCount], 200);
            } else {
                $cart->delete();
            }
        } else {
            $product = Product::where('id', $request->productId)->first();
            if (session('user.cart')) {
                $productId = $request->productId;
                $cartItems = session('user.cart');
                $productCount = array_count_values(session('user.cart'))[$productId] ?? 0;

                if ($productCount >= 0) {
                    $index = array_search($productId, $cartItems);

                    if ($index !== false) {
                        array_splice($cartItems, $index, 1);
                        session(['user.cart' => $cartItems]);
                    }
                    $cartCount = count($cartItems);
                    $product->quantity++;
                    $product->update();
                    return response()->json(['count' => $cartCount, 'productCount' => $productCount]);
                }
            }
        }
    }
    public function cartAjaxCancel(HttpRequest $request)
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $product = Product::where('id', $request->productId)->first();
            $cart  = UserCart::where('product_id', $product->id)->where('user_id', $userId)->first();
            $product->quantity += $cart->quantity;
            $product->update();
            $cart->delete();
            $cartCount = UserCart::where("user_id", $userId)->sum('quantity');
            return response()->json(['count' => $cartCount]);
        } else {

            if (session('user.cart')) {
                $product = Product::where('id', $request->productId)->first();

                $productId = $request->productId;
                $cartItems = session('user.cart');
                $productCount = array_count_values($cartItems)[$productId] ?? 0;
                $product->quantity += $productCount;
                $product->update();
                // Remove all occurrences of $productId from the cart
                $updatedCartItems = array_diff($cartItems, [$productId]);

                // Update the cart in the session
                session(['user.cart' => $updatedCartItems]);

                // Count the total items in the cart
                $cartCount = count($updatedCartItems);

                return response()->json(['count' => $cartCount]);
            }
        }
    }
    public function userOrders($id){
       $orderedProducts =  Order::where('user_id', $id)->get();
       if($orderedProducts){
        return view('frontend.userOrders', compact('orderedProducts'));
       }else{
        return redirect()->back();
       }
    }
}

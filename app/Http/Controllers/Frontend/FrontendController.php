<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\UserCart;
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

    /**
     * Privacy Policy Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function shop($id)
    {
        $categoryName = DB::table('category')->where('id', $id)->pluck('name')->first();
        $products = DB::table('products')->where('category_id', $id)->paginate(12);
        return view('frontend.shop', compact('products', 'categoryName'));
    }
    public function product($id)
    {

        $product = DB::table('products')->where('id', $id)->first();
        return view('frontend.detail', compact('product'));
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
            $products = DB::table('user_cart')
                ->join('products', 'user_cart.product_id', '=', 'products.id')
                ->where('user_cart.user_id', $userId)
                ->select('user_cart.*', 'products.image', 'products.name', 'products.price')
                ->get();
            return view('frontend.cart', compact('products'));
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

            $user_id = auth()->user()->id;

            $product_id = $request->productId;

            if (UserCart::where('id', $product_id)->exists() && UserCart::where('user_id', $user_id)->exists()) {

                $existing_quantity = UserCart::where("id", $product_id)->first();

                $number_of_existing_quantity = $existing_quantity->quantity;

                $cart_column_id = $existing_quantity->id;

                $user_cart_row = UserCart::find($cart_column_id);

                $incremented_number_of_existing_quantity = ++$number_of_existing_quantity;

                $user_cart_row->quantity = $incremented_number_of_existing_quantity;

                $user_cart_row->save();

                $user_existing_cart = UserCart::where("user_id", $user_id)->sum('quantity');

                return response()->json(["count" => $user_existing_cart], 200);
            } else {
                $user_cart = new UserCart();

                $user_cart->user_id = $user_id;
                $user_cart->quantity = 1;
                $user_cart->product_id = $product_id;

                $user_cart->save();

                $cart = UserCart::where("user_id", $user_id)->sum('quantity');

                return response()->json(["count" => $cart], 200);
            }
        } else {
            if (session('user.cart')) {
                $productId = $request->productId;
                session()->push('user.cart', $productId);

                $cartCount = count(session('user.cart'));
                $productCount = array_count_values(session('user.cart'))[$productId] ?? 0;
                return response()->json(['count' => $cartCount, 'productCount' => $productCount]);
            } else {
                session()->put('user.cart', []);
                $productId = $request->productId;
                session()->push('user.cart', $productId);
                $cartCount = count(session('user.cart'));
                return response()->json(['count' => $cartCount]);
            }
        }
    }
    public function detailCartAjax(HttpRequest $request)
    {
        $productId = $request->productId;
        $count = $request->count;
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $cartItem = UserCart::where('user_id', $userId)->where('product_id', $productId)->first();
            if ($cartItem) {
                $cartCount = UserCart::where('user_id', $userId)->sum('quantity');
                $cartItem->quantity += $count;
                $cartItem->save();
                return response()->json(['count' => $cartCount, 'productCount' => $count]);
            } else {
                $newCartItem = new UserCart();
                $newCartItem->user_id = $userId;
                $newCartItem->product_id = $productId;
                $newCartItem->quantity = $count;
                $newCartItem->save();
                $cartCount = UserCart::where('user_id', $userId)->sum('quantity');
                return response()->json(['count' => $cartCount, 'productCount' => $count]);
            }
        } else {
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
        }
    }
    public function cartAjaxMinus(HttpRequest $request)
    {
        if (auth()->check()) {
            $current_product_id = $request->productId;
            $user_id = auth()->user()->id;

            $passingArray = ['user_id' => $user_id, 'id' => $current_product_id];

            $result = UserCart::where($passingArray)->first();

            $id_to_change = $result->id;

            $current_quantity_in_cart = $result->quantity;

            $user_cart_find = UserCart::find($id_to_change);

            if ($current_quantity_in_cart > 0) {

                $user_cart_find->quantity = --$current_quantity_in_cart;

                $user_cart_find->save();
            }
            $productCount = UserCart::where('id', $current_product_id)->value('quantity');
            $user_existing_cart = UserCart::where("user_id", $user_id)->sum('quantity');

            return response()->json(["count" => $user_existing_cart, 'productCount' => $productCount], 200);
        } else {

            if (session('user.cart')) {
                $productId = $request->productId;
                $cartItems = session('user.cart');

                $index = array_search($productId, $cartItems);

                if ($index !== false) {
                    array_splice($cartItems, $index, 1);
                    session(['user.cart' => $cartItems]);
                }

                $cartCount = count($cartItems);
                $productCount = array_count_values(session('user.cart'))[$productId] ?? 0;


                return response()->json(['count' => $cartCount, 'productCount' => $productCount]);
            }
        }
    }
    public function cartAjaxCancel(HttpRequest $request)
    {
        if (auth()->check()) {
            $userId = auth()->user()->id;
            $productId = $request->productId;
            DB::table('user_cart')->where('id', $productId)->where('user_id', $userId)->delete();
        } else {

            if (session('user.cart')) {
                $productId = $request->productId;
                $cartItems = session('user.cart');

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


    // public function privacy()
    // {
    //     return view('frontend.privacy');
    // }

    // /**
    //  * Terms & Conditions Page.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function terms()
    // {
    //     return view('frontend.terms');
    // }
}

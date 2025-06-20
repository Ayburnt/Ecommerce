<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Product\Cart;
use App\Models\Product\Order;
use Auth;
use Redirect;
use Session;
class ProductsController extends Controller
{
    public function singleCategory($id)
    {

        $products = Product::select()->orderBy('id', 'desc')->where('category_id', $id)->get();

        return view('products.singlecategory', compact('products'));

    }

    public function singleProduct($id)
    {

        $products = Product::find($id);

        $relatedProducts = Product::select()->where('category_id', $products->category_id)->where('id', '!=', $id)->get();

        $checkInCart = Cart::where('pro_id', $id)
            ->where('user_id', Auth::user()->id)
            ->count();

        return view('products.singleproduct', compact('products', 'relatedProducts', 'checkInCart'));

    }
    public function shop()
    {

        $categories = Category::select()->orderBy('id', 'desc')->get();

        $mostWanted = Product::select()->orderBy('name', 'desc')->take(5)->get();

        $vegetables = Product::where('category_id', 6)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $meat = Product::where('category_id', 1)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $fish = Product::where('category_id', 2)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $frozenfoods = Product::where('category_id', 3)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $fruits = Product::where('category_id', 4)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        $beverage = Product::where('category_id', 5)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();




        return view('products.shop', compact('categories', 'mostWanted', 'vegetables', 'meat', 'fish', 'frozenfoods', 'fruits', 'beverage'));

    }
    public function addToCart(Request $request)
    {

        $addCart = Cart::create([
            "name" => $request->name,
            "price" => $request->price,
            "qty" => $request->qty,
            "image" => $request->image,
            "pro_id" => $request->pro_id,
            "user_id" => Auth::user()->id,
            "subtotal" => $request->qty * $request->price
        ]);

        if ($addCart) {
            return Redirect::route("single.product", $request->pro_id)->with(['Success' => 'Product added to cart successfully']);
        }



        return view('products.singleproduct', compact('products', 'relatedProducts'));


    }

    public function cart()
    {

        $cartProducts = Cart::select()->where('user_id', auth::user()->id)->get();
        $subtotal = Cart::where('user_id', auth::user()->id)->sum('subtotal');

        return view('products.cart', compact('cartProducts', 'subtotal'));

    }



    public function deleteFromCart($id)
    {
        $deleteCart = Cart::find($id);

        if ($deleteCart) {
            $deleteCart->delete();
            return Redirect::route("products.cart")->with('delete', 'Product deleted from cart successfully');
        }

        return Redirect::route("products.cart")->with('delete', 'Product not found in cart');
    }

    public function prepareCheckout(Request $request)
    {
        $price = $request->price;
        $value = Session::put('value', $price);
        $newPrice = Session::get($value);



        if ($newPrice > 0) {
            return Redirect::route("products.checkout");
        }
    }



    public function checkout()
    {

        $cartItems = Cart::select()->where('user_id', Auth::user()->id)->get();
        $checkoutSubtotal = Cart::select()->where('user_id', Auth::user()->id)
            ->sum('subtotal');

        return view("products.checkout", compact('cartItems', 'checkoutSubtotal'));
    }

    public function processCheckout(Request $request)
    {

        $checkout = Order::create([

            "name" => $request->name,
            "last_name" => $request->last_name,
            "address" => $request->address,
            "town" => $request->town,
            "state" => $request->state,
            "zip_code" => $request->zip_code,
            "email" => $request->email,
            "phone_number" => $request->phone_number,
            "price" => $request->price,
            "user_id" => $request->user_id,
            "order_notes" => $request->order_notes
        ]);

        if ($checkout) {
            return Redirect::route("products.pay");
        }



        return view('products.singleproduct', compact('products', 'relatedProducts'));


    }
    public function payWithGcash()
    {

        echo "Pay with Gcash";



        // return view("products.checkout", compact('cartItems', 'checkoutSubtotal'));
    }



}



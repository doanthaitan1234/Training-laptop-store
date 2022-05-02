<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Cart;
use App\Models\Image;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Rating;
use App\Helpers\Custom;
use App\Defines\Define;
use Auth;
use App\Http\Requests\OrderRequest;
use App\Http\Requests\ChangePasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class HomepageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        if (Auth::user() && Auth::user()->role_id == Define::ADMIN) {
            return redirect()->route('admin.index');
        }
        return view('homepage');
    }

    public function profile()
    {
        $customer = Auth::user();
        return view('my-profile', compact(['customer']));
    }

    public function productPage()
    {
        $categories = Category::get();
        $products = Product::with('category')->get();
        if (Auth::user()) {
            $list_cart = Cart::getCart();
            $count = Cart::getCountCartList();
            $total_price = Cart::getTotalPrice();

            return view('product', compact(['categories', 'products', 'list_cart' => $list_cart, 'count' => $count, 'total_price' => $total_price]));
        }
       
        return view('product', compact(['categories', 'products']));
    }

    public function getProducts(Request $request)
    {
        $query = '1=1';
        if ($request->search_product <> '') {
            $query .= ' AND (name LIKE "'.$request->search_product. '")';
        }
        if ($request->category_id <> -1) {
            $query .= ' AND (category_id = '.$request->category_id. ')';
        }
        if ($request->min_price <> -1) {
            if ($request->max_price <> -1) {
                $query .= ' AND (price between '.$request->min_price. ' AND '. $request->max_price . ')';
            } else {
                $query .= ' AND (price >= '.$request->min_price. ')';
            }
        }
        if ($request->ram <> -1) {
            $query .=' AND (ram = '.$request->ram . ')';
        }
        if ($request->min_rating <> -1 && $request->max_rating <> -1) {
            $query .= ' AND (rating between '.$request->min_rating. ' AND '. $request->max_rating . ')';
        }
       
        $products = Product::with('category')->whereRaw($query)->paginate(Define::PAGINATE);
        $html = view('product-list', compact('products'))->render();

        return response()->json(['products' => $products, 'html' => $html]);
        
    }

    public function getProductImagesAjax(Request $request)
    {
            $id = $request->id;
            // $paths =  Image::where('relation_id', $id)->where('type', 'products')->get('path')->toArray();
            $product = Product::with('images')->where('id', $id)->first();

            return response()->json(['product' => $product]);
    }

    public function error()
    {
        return view('404');
    }

    public function addToCart(Request $request)
    {
        try {
            $product = Product::findOrFail($request->product_id);
            $user_product = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->first();
            if ($user_product) {
                $total_quantity =  $request->quantity + $user_product->quantity;
                if ($total_quantity <= $product->quantity) {
                    $user_product->update(['quantity' => $total_quantity]);
                } else {
                    return response()->json(['code' => Define::ERROR]);
                }
            } else {
                $data['quantity'] = $request->quantity;
                $data['product_id'] = $product->id;
                $data['user_id'] = Auth::id();
                Cart::create($data);
            }

            $list_cart = Cart::getCart();
            $count = Cart::getCountCartList();
            $total_price = Cart::getTotalPrice();

            return response()->json(['code' => Define::SUCCESS, 'list_cart' => $list_cart, 'count' => $count, 'total_price' => $total_price]);
        } catch (\Exception $e) {
            return response()->json(['code' => Define::ERROR]);
        }
       
    }

    public function getCart(Request $request)
    {
        
        try {
            $list_cart = Cart::getCart();
            $count = Cart::getCountCartList();
            $total_price = Cart::getTotalPrice();

            return response()->json(['code' => Define::SUCCESS, 'list_cart' => $list_cart, 'count' => $count, 'total_price' => $total_price]);
        } catch (\Exception $e) {
            return response()->json(['code' => Define::ERROR]);
        }
    }

    public function sortProducts(Request $request)
    {
        $categories = Category::get();
        $products = Product::with('category')->get();
    }

    public function getProductDetail($id)
    {
        try {
            $product = Product::findOrFail($id);
            $rating_item = Rating::where('user_id', Auth::id())->where('product_id', $id)->first();
            if ($rating_item) {
                $rating = $rating_item->rating;
            } else $rating = 0;
            return view('product-detail', compact(['product', 'rating']));
        } catch (\Throwable $th) {
            return back();
        }
    }

   public function updateCart(Request $request)
   {
        try {
            $id = Auth::id();
            $data = $request->data;
            foreach($data as $item) {
                $cart = Cart::where('user_id', $id)->where('product_id', $item['id'])->first();
                if ($cart) {
                    if ($item['quantity'] == 0) {
                        $cart->delete();
                    } else {
                        $cart->update(['quantity' => $item['quantity']]);
                    }
                    
                } else {
                    Cart::create(['user_id' => $id,
                    'product_id' => $item['id'],
                    'quantity' => $item['quantity']]);
                }
            }

            $list_cart = Cart::getCart();
            $count = Cart::getCountCartList();
            $total_price = Cart::getTotalPrice();
            return response()->json(['code' => Define::SUCCESS,'data' => $data, 'list_cart' => $list_cart, 'count' => $count, 'total_price' => $total_price]);
        } catch (\Throwable $th) {
            return response()->json(['code' => Define::ERROR]);
        }
   }
/**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\OrderRequest  $request
     * @return \Illuminate\Http\Response
     */
   public function addOrder(OrderRequest $request)
   {
        try {
            $id = Auth::id();
            $data = $request->validated();
            $list_cart = Cart::getCart();
            $total_price = Cart::getTotalPrice();
    
            $data['code'] = time().$id;
            $data['user_id'] = $id;
            $data['total_price'] = $total_price;
            $data['status'] = Define::WAITING;
            $order = Order::create($data);
            foreach($list_cart as $item) {
                $order_detail['order_id'] = $order->id;
                $order_detail['product_id'] = $item->product_id;
                $order_detail['quantity'] = $item->quantity;
                $order_detail['price'] = $item->product->price;
                OrderProduct::create($order_detail);
            }
            Cart::where('user_id', $id)->delete();
            // Session::flash('code', '1');
            // Session::flash('message', __('Add success!'));
        } catch (\Throwable $th) {
            // Session::flash('code', '0');
            // Session::flash('message', __('Add fail!'));
            return redirect()->back();
        }
        return redirect()->route('product');
   }

    public function changePassword(ChangePasswordRequest $request)
    {
        try {
            if (!(Hash::check($request->current_password, Auth::user()->password))) {
                Session::flash('error', __('Your current password does not matches with the password.'));

                return redirect()->back();
            }
            if (strcmp($request->current_password, $request->password) == 0 ) {
                Session::flash('error', __('New Password cannot be same as your current password.'));

                return redirect()->back();
            }

            $data = $request->validated();
            $user = Auth::user();
            $user->password = Hash::make($data['password']);
            $user->save();

            return redirect()->back()->with("success","Password successfully changed!");
        } catch (\Throwable $th) {
            //throw $th;
        }
        return redirect()->back();
    }

    public function voteProduct(Request $request, $id)
    {
        try {
            $rating_item = Rating::where('user_id', Auth::id())->where('product_id', $id)->first();
            if ($rating_item) {
                $rating_item->update(['rating' => $request->rating]);
            } else {
                $data['user_id'] = Auth::id();
                $data['product_id'] = $id;
                $data['rating'] = $request->rating;
                Rating::create($data);
            }
            $rating = Product::setRating($id);

            return response()->json(['code' => Define::SUCCESS, 'rating' => $rating]);
        } catch (\Throwable $th) {
            return response()->json(['code' => Define::ERROR]);
        }

    }
}

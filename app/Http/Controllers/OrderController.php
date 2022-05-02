<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Order;
use App\Models\User;
use App\Models\Product;
use App\Models\OrderProduct;
use App\Defines\Define;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.order.index');
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $order = Order::with('user')->findOrFail($id);
            $order_products = OrderProduct::with('product')->where('order_id', $order->id)->get();

            return view('admin.order.show', compact(['order', 'order_products']));
        } catch (\Throwable $th) {
            return view('404');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getOrders(Request $request)
    {
       $data = Order::with('user')->get();
        return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('user', function(Order $order) {
                        $user = User::findOrFail($order->user_id);
                        if ($user) {
                            return $user->name;
                        }
                        return '';
                    })
                    ->addColumn('status', function(Order $order) {
                        switch($order->status) {
                            case Define::WAITING: {
                                $btn = '<button class="btn btn-outline-warning btn-sm" data-id="'.$order->id.'">'.__('Waiting').'</button>';
                                break;
                            }
                            case Define::CONFIRM: {
                                $btn = '<button class="btn btn-outline-primary btn-sm" data-id="'.$order->id.'">'.__('Confirmed').'</button>';
                                break;
                            }
                            case Define::SHIPPING: {
                                $btn = '<button class="btn btn-outline-primary btn-sm" data-id="'.$order->id.'">'.__('Shipping').'</button>';
                                break;
                            }
                            case Define::FINISH: {
                                $btn = '<button class="btn btn-outline-success btn-sm" data-id="'.$order->id.'">'.__('Finish').'</button>';
                                break;
                            }
                            case Define::CANCEL: {
                                $btn = '<button class="btn btn-outline-danger btn-sm" data-id="'.$order->id.'">'.__('Cancel').'</button>';
                                break;
                            }
                        }
                         return $btn;
                    })
                    ->addColumn('action', function(Order $order){
     
                           $btn = ' <div class="d-flex justify-content-around"><a href="'. route('orders.show', $order->id) .'" class="icon-container icon-cover w-25" data-toggle="tooltip" data-placement="top" title="'.__('Show').'"><div class="">
                                <span class="ti-pencil-alt font-size-20"></span><span class="icon-name"></span>
                                </div></a>
                                <a href="javascript:void(0)" class="icon-container icon-cover w-25 btn-delete" id="btnCancel" data-id="'.$order->id.'" data-toggle="tooltip" data-placement="top" title="'.__('Cancel').'"><div class="">
                                <span class="ti-close text-danger font-size-20"></span><span class="icon-name"></span>
                                </div></a></div>';
    
                            return $btn;
                    })
                    ->rawColumns(['user','status','action'])
                    ->make(true);
    }

    public function updateOrderQuantity(Request $request)
    {
        try {
            $order_product = OrderProduct::find($request->id);
            $quantity_change = $request->quantity_change;
            $updated = $order_product->update(['quantity' => $quantity_change]);

            return response()->json(['code' => 1, 'q' => $quantity_change]);
        } catch (\Throwable $th) {
            return response()->json(['code' => 0, 'q' => $quantity_change]);
        }
    }

    public function confirmOrder(Request $request, $id)
    {
        try {
            $order = Order::with('orders_products')->findOrFail($id);
            foreach ($order->orders_products as $order_product) {
                $product = Product::find($order_product->product_id);
                if ($product->quantity >= $order_product->quantity) {
                    $quantity_in_stock = $product->quantity - $order_product->quantity;
                    $product->update(['quantity' => $quantity_in_stock]);
                }
            }
            $order->update(['status' => Define::CONFIRM]);
            Session::flash('code', '1');
            Session::flash('message', __('Order confirmed!'));
            return redirect()->route('orders.index');
        } catch (\Throwable $th) {
            return back();
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $order = Order::findOrFail($request->id);
            $order->update(['status' => $request->status]);

            return response()->json(['message' => __('Change status success!')]);
        } catch (\Throwable $th) {
            return response()->json(['message' => __('Change status fail!')]);
        }
    }

    public function cancelOrder(Request $request, $id)
    {
        try {
            $order = Order::findOrFail($id);
            $order->update(['status' => Define::CANCEL]);

            return response()->json(['message' => __('Change status success!')]);
        } catch (\Throwable $th) {
            return response()->json(['message' => __('Change status fail!')]);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Product;
use App\Models\Image;
use App\Defines\Define;
use App\Helpers\UploadImage;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.product.index');
    }

    public function getProductList(Request $request)
    {
        $data = Product::with('category')->get();
        return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function(Product $product) {
                        if ($product->status == Define::ACTIVE) {
                            $btn = '<button class="btn btn-success btn-sm btn-active" id="btnActive" data-id="'.$product->id.'">'.__('Actived').'</button>';
                        } else {
                            $btn = '<button class="btn btn-danger btn-sm btn-active" id="btnActive" data-id="'.$product->id.'">'.__('Deactived').'</button>';
                        }

                         return $btn;
                    })
                    ->addColumn('action', function(Product $product){
     
                        $btn = '
                            <div class="d-flex justify-content-around">
                                <button class="icon-container icon-cover w-25 border-0 bg-transparent btn-show" id="btnShow" data-id="'.$product->id.'" title="'.__('Show').'" data-toggle="modal" data-target="#showProductModal">
                                    <div class="">
                                        <span class="ti-eye font-size-20"></span><span class="icon-name"></span>
                                    </div>
                                </button>
                                <a href="' . route('products.edit', $product->id) .'" class="icon-container icon-cover w-25" title="'.__('Edit').'">
                                    <div class="">
                                        <span class="ti-pencil-alt font-size-20"></span><span class="icon-name"></span>
                                    </div>
                                </a>
                                <a href="javascript:void(0)" class="icon-container icon-cover w-25 btn-delete" id="btnDelete" data-id="'.$product->id.'" title="'.__('Delete').'">
                                    <div class="">
                                        <span class="ti-trash text-danger font-size-20"></span><span class="icon-name"></span>
                                    </div>
                                </a>
                            </div>';
    
                            return $btn;
                    })
                    ->rawColumns(['status','action'])
                    ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.product.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // dd($request->all());
        try {
            $data = $request->validated();
            $data['slug'] = Str::slug($data['name'], '-');
            $data['status'] = Define::ACTIVE;
            Product::create($data);

            $product = Product::latest()->first();
           
            if ($request->file('image'))
            {
                
               foreach($request->file('image') as $file)
               {
                   $file_data = UploadImage::uploads($file, $product->id);
                Image::create($file_data);
               }
            }

            Session::flash('code', '1');
            Session::flash('message', __('Add success!'));
        } catch (\Exception $e) {
            Session::flash('code', '0');
            Session::flash('message', __('Add fail!'));
        }

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $product = Product::findOrFail($id);
            $images = Image::getImages($id);
            if ($images) {
                return view('admin.product.edit', compact(['product', 'images']));
            }

            return view('admin.product.edit', compact(['product']));
       } catch (\Exception $e) {
           return redirect()->back();
       }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $data = $request->validated();
            if ($data['name']) {
                $data['slug'] = Str::slug($data['name'], '-');
            }
            $product->update($data);

            $product = Product::latest()->first();
           
            if ($request->file('image'))
            {
               foreach($request->file('image') as $file)
               {
                   $file_data = UploadImage::uploads($file, $product->id);
                Image::create($file_data);
               }
            }

            Session::flash('code', '1');
            Session::flash('message', __('Add success!'));

            return view('admin.product.edit', compact(['product']));
        } catch (\Exception $e) {
            Session::flash('code', '0');
            Session::flash('message', __('Add fail!'));
            
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        try {
            $user = Product::findOrFail($id);
            $user->delete();
            // $images = Image::getImages($id, $this->table);
            // $images->delete();
            return response()->json(['code' => 1, 'msg' => __('Product has been deleted!')]);
        } catch (\Exception $e) {
            return response()->json(['code' => 0, 'msg' => __('Something went wrong')]);
        }
    }

    public function getProductAjax(Request $request)
    {
        try {
            $id = $request->id;
            $product =  Product::with('category', 'images')->findOrFail($id);
            $count_rating = Product::countRatingByProductId($id);
            return response()->json(['product' => $product, 'count_rating' => $count_rating]);
        } catch (\Exception $e) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $id = $request->id;
            $product =  Product::findOrFail($id);
            if ($product->status == Define::ACTIVE) {
                $product->status = Define::DEACTIVE;
            } else {
                $product->status = Define::ACTIVE;
            }
            $product->update();

            return response()->json(['code' => 1, 'msg' => 'Product has been change status']);
        } catch (\Exception $e) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use Yajra\DataTables\DataTables;
use App\Defines\Define;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.category.index');
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
       
        try {
            // $category = Category::
            $data = $request->validated();
            $data['slug'] = Str::slug($data['name']);
            Category::create($data);

            return response()->json(['code'=> Define::SUCCESS, 'msg' => __('Category has been created!')]);
        } catch (\Exception $e) {
            return response()->json(['code'=> Define::ERROR, 'msg' => __('Something went wrong')]);
        }
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
    public function edit(Request $request, $id)
    {
        try {
            $category = Category::findOrFail($id);

            return response()->json(['category' => $category]);
        } catch (\Exception $e) {
            return response()->json(['code'=> Define::ERROR, 'msg' => __('Something went wrong')]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try {
            $category = Category::findOrFail($id);
            if ($category->name != $request->name) {
                
                $data = $request->validated();
                $data['slug'] = Str::slug($data['name']);
                $category->update($data);

                return response()->json(['code'=> Define::SUCCESS, 'msg' => __('Category has been updated!')]);
            } else {
                return response()->json(['code'=> Define::INFO, 'msg' => __('Nothing to update!')]);
            }
           
        } catch (\Exception $e) {
            return response()->json(['code'=> Define::ERROR, 'msg' => __('Something went wrong')]);
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
            $count_product = Product::countProductsByCategory($id);
            if ($count_product == 0) {
                $data = Category::findOrFail($id);
                $data->delete();

                return response()->json(['code' => Define::SUCCESS, 'msg' => __('Category has been deleted!')]);
            } else {
                return response()->json(['code' => Define::WARRNING, 'msg' => __('Please delete all products of this category first!')]);
            }
        } catch (\Exception $e) {
            return response()->json(['code' => Define::ERROR, 'msg' => __('Something went wrong')]);
        }
    }

    public function getCategoryList(Request $request)
    {
        $data = Category::get();
        // $data->updated_at = Carbon::createFromFormat('m/d/Y', $data->updated_at);
        return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('updated_at', function(Category $category){
                        $updated_at = new Carbon($category->updated_at);
                        if (Session::get('website_language') == 'vi') {
                            $date = $updated_at->format('d-m-Y');
                        } else {
                            $date = $updated_at->format('Y-m-d');
                        }

                         return $date;
                 })
                    ->addColumn('action', function(Category $category){
                           $btn = ' <div class="d-flex justify-content-center"><a href="#" class="icon-container icon-cover w-25" id="btnEdit" title="'.__('Edit').'" data-id="'.$category->id.'" data-name="'.$category->name.'" data-toggle="modal" data-target="#editCategoryModal"><div class="">
                                <span class="ti-pencil-alt font-size-20"></span><span class="icon-name"></span>
                                </div></a>
                                <a href="javascript:void(0)" class="icon-container icon-cover w-25 btn-delete" id="btnDelete" data-id="'.$category->id.'"  title="'.__('Delete').'"><div class="">
                                <span class="ti-trash text-danger font-size-20"></span><span class="icon-name"></span>
                                </div></a></div>';
    
                            return $btn;
                    })
                    ->rawColumns(['updated_at','action'])
                    ->make(true);

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Yajra\DataTables\DataTables;
use App\Defines\Define;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin.user.index');
    }

    public function getUserList(Request $request)
    {
        $data = User::where('id', '<>', Auth::user()->id)->with('role')->get();
        return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('status', function(User $user) {
                        if ($user->status == Define::ACTIVE) {
                            $btn = '<button class="btn btn-success btn-sm btn-active" id="btnActive" data-id="'.$user->id.'">'.__('Actived').'</button>';
                        } else {
                            $btn = '<button class="btn btn-danger btn-sm btn-active" id="btnActive" data-id="'.$user->id.'">'.__('Deactived').'</button>';
                        }

                         return $btn;
                    })
                    ->addColumn('action', function(User $user){
     
                           $btn = ' <div class="d-flex justify-content-around"><a href="' . route('users.edit', $user->id) .'" class="icon-container icon-cover w-25" data-toggle="tooltip" data-placement="top" title="'.__('Edit').'"><div class="">
                                <span class="ti-pencil-alt font-size-20"></span><span class="icon-name"></span>
                                </div></a>
                                <a href="javascript:void(0)" class="icon-container icon-cover w-25 btn-delete" id="btnDelete" data-id="'.$user->id.'" data-toggle="tooltip" data-placement="top" title="'.__('Delete').'"><div class="">
                                <span class="ti-trash text-danger font-size-20"></span><span class="icon-name"></span>
                                </div></a></div>';
    
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
        return view('admin.user.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        try {
            $data = $request->validated();
            $data['password'] = Hash::make($data['password']);
            $data['status'] = Define::ACTIVE;
            $data['role_id'] = $request->role_id;
            User::create($data);
            Session::flash('code', '1');
            Session::flash('message', __('Add success!'));
        } catch (\Exception $e) {
            Session::flash('code', '0');
            Session::flash('message', __('Add fail!'));
        }

        return redirect()->route('users.index');
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
            $user =  User::findOrFail($id);

            return view('admin.user.edit', compact('user'));
        } catch (\Exception $e) {
            return redirect()->back();
        }
    }

    public function update(UserRequest $request, $id)
    {
        dd($request->all());
        try {
            $user =  User::findOrFail($id);
            $data = $request->validated();
            $user->update($data);
            Session::flash('code', Define::SUCCESS);
            Session::flash('message', __('Update success!'));

            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Session::flash('code', Define::ERROR);
            Session::flash('message', __('Update fail!'));

            return redirect()->back();
        }
    }

    public function updateUser(UserRequest $request, $id)
    {
        dd($request->all());
        try {
            $user =  User::findOrFail($id);
            $data = $request->validated();
            $user->update($data);
            Session::flash('code', Define::SUCCESS);
            Session::flash('message', __('Update success!'));

            return redirect()->route('users.index');
        } catch (\Exception $e) {
            Session::flash('code', Define::ERROR);
            Session::flash('message', __('Update fail!'));

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
            $user = User::findOrFail($id);
            $user->delete();

            return response()->json(['code' => Define::SUCCESS, 'msg' => __('User has been deleted!')]);
        } catch (\Exception $e) {
            return response()->json(['code' => Define::ERROR, 'msg' => __('Something went wrong')]);
        }
    }

    public function changeStatus(Request $request)
    {
        try {
            $user_id = $request->user_id;
            $user =  User::findOrFail($user_id);
            if ($user->status == Define::ACTIVE) {
                $user->status = Define::DEACTIVE;
            } else {
                $user->status = Define::ACTIVE;
            }
            $user->update();

            return response()->json(['code' => Define::SUCCESS, 'msg' => 'User has been change status']);
        } catch (\Exception $e) {
            return response()->json(['code' => Define::ERROR, 'msg' => 'Something went wrong']);
        }
    }
}

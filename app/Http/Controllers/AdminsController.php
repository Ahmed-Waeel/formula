<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use App\Http\Requests\PasswordRequest;
use App\Http\Requests\ProfileRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($pagination = PAGINATION)
    {
        $admins = Admin::where('deleted_at', null)->where('id', '!=', Auth::id())->paginate($pagination);
        return view('admins/show', compact('admins'));
    }

    public function add()
    {
        return view('admins/add');
    }

    public function store(AdminRequest $request)
    {
        Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return redirect(route('admin.showAll'))->with('success', 'New Admin Added Successfully');
    }

    public function edit()
    {
        $admin = Admin::where('deleted_at', null)->where('id', Auth::id())->first();
        if (!$admin) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

        return view('admins/edit', compact('admin'));
    }

    public function update(ProfileRequest $request)
    {
        $admin = Admin::where('deleted_at', null)->where('id', Auth::id());
        if (!$admin->first()) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }

        if($request->file('photo')){
            $photo = $request->file('photo');
            $photoName = time() . '.' . $photo->getClientOriginalExtension();
            $photo-> move(public_path('uploads/admins'), $photoName);
            $admin->update([
                'photo' => $photoName
            ]);
        }

        $admin->update([
            'name' => $request->name ?? $admin->first()->name,
            'email' => $request->email ?? $admin->first()->email,
        ]);
        return redirect()->back()->with('success', __('view.ChangedSuccessfully', ['attribute' => __('view.data')]));
    }

    public function changePasswordPage(){
        return view('admins/change_password');
    }

    public function changePassword(PasswordRequest $request)
    {
        $admin = Admin::where('id', $request->id);
        if (!$admin->first()) return redirect()->back()->with('error', 'Some thing went wrong');

        $admin->update([
            'password' => Hash::make($request->password)
        ]);
        return redirect()->back()->with('success', __('view.passwordChangedSuccessfully'));
    }

    public function delete($adminId)
    {
        $admin = Admin::where('id', $adminId);
        if (!$admin) {
            return redirect()->back()->with('error', 'Something Went Wrong');
        }
        $name = $admin->name;
        $admin->update(['deleted_at' => now()]);
        return redirect(route('admin.showAll'))->with('success', $name . ' Deleted Successfully');
    }

    public function filter(Request $request)
    {
        $pagination = $request->pagination ?? PAGINATION;
        if (!$request->data) { // if There is no searching data return all hotels
            $admins = Admin::where('deleted_at', null)->paginate($pagination, ['*'], 'page', $request->page ?? 1);
            $data = '';
        } else {
            $data = $request->data;

            $admins = Admin::where('name', 'like', '%' . $request->data . '%')
                ->orWhere('email', 'like', '%' . $request->data . '%')
                ->paginate($pagination, ['*'], 'page', $request->page ?? 1);
        }
        return view('admins/show', compact('admins', 'data', 'pagination'));
    }
}

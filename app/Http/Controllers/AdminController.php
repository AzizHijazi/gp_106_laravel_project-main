<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admins = Admin::get();
        return response()->view('dashboard.admins.index', ['admins' => $admins]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        // $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('dashboard.admins.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:admins,email',
            'mobile' => 'required|string|numeric|unique:admins,mobile',
            'gender' => 'required|string|in:M,F',
            'status' => 'nullable|string|in:on',
        ]);

        $admin = new Admin();
        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->mobile = $request->get('mobile');
        $admin->gender = $request->get('gender');
        $admin->status = $request->has('status');
        $admin->password = Hash::make(12345);
        // $admin->assignRole(Role::findById($request->get('role_id')));
        $isSaved = $admin->save();
        return redirect()->route('admins.index')->with('success', 'Admin created successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function edit(Admin $admin)
    {
        //
        // $roles = Role::where('guard_name', 'admin')->get();
        return response()->view('dashboard.admins.edit', ['admin' => $admin]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Admin $admin)
    {
        //
        $request->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|string|email|unique:admins,email,' . $admin->id,
            'mobile' => 'required|numeric|unique:admins,mobile,' . $admin->id,
            'gender' => 'required|string|in:M,F',
            'status' => 'nullable|string|in:on',
        ]);

        $admin->name = $request->get('name');
        $admin->email = $request->get('email');
        $admin->mobile = $request->get('mobile');
        $admin->gender = $request->get('gender');
        $admin->status = $request->has('status');
        // $admin->assignRole(Role::findById($request->get('role_id')));
        $isSaved = $admin->save();
        return redirect()->route('admins.index')->with('success', 'Admin updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy(Admin $admin)
    {
        //
        $isDeleted = $admin->delete();
        return redirect()->back();
    }
}

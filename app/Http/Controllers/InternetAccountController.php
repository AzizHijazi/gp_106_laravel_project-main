<?php

namespace App\Http\Controllers;

use App\Models\InternetAccount;
use App\Models\User;
use Faker\Provider\ar_EG\Internet;
use Illuminate\Http\Request;

class InternetAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $hubId = auth()->guard('hub')->id();
        $data = InternetAccount::where('hub_id', $hubId)->with('user')->get();
        return response()->view('dashboard.internet_account.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $users = User::all();
        return response()->view('dashboard.internet_account.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'speed' => 'required|string|max:45',
            'username' => 'required|string|max:45',
            'password' => 'required|string',
            'expired' => 'required|date',
            'is_active' => 'nullable|string|in:on',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $store = new InternetAccount();
        $store->speed = $request->input('speed');
        $store->username = $request->input('username');
        $store->password = $request->input('password');
        $store->expired = $request->input('expired');
        $store->status = $request->has('status');
        $store->user_id = $request->input('user_id');
        $hubId = auth()->guard('hub')->id();
        $store->hub_id = $hubId;
        $saved = $store->save();
        return redirect()->route('internet_accounts.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $hubId = auth()->guard('hub')->id();
        $internetAccountEdit = InternetAccount::where('hub_id', $hubId)->findOrFail($id);
        $itemUser = User::all();
        return response()->view('dashboard.internet_account.edit', ['internetAccountEdit' => $internetAccountEdit, 'itemUser' => $itemUser]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $request->validate([
            'speed' => 'required|string|max:45',
            'username' => 'required|string|max:45',
            'password' => 'required|string|max:45',
            'expired' => 'required|string|max:45',
            'status' => 'nullable|string|in:on',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $hubId = auth()->guard('hub')->id();
        $update = InternetAccount::where('hub_id', $hubId)->findOrFail($id);
        $update->speed = $request->input('speed');
        $update->username = $request->input('username');
        $update->password = $request->input('password');
        $update->expired = $request->input('expired');
        $update->status = $request->has('status');
        $update->user_id = $request->input('user_id');
        $update->hub_id = $hubId;
        $saved = $update->save();
        return redirect()->route('internet_accounts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hubId = auth()->guard('hub')->id();
        InternetAccount::where('hub_id', $hubId)->destroy($id);
        return redirect()->back();
        //
    }
}

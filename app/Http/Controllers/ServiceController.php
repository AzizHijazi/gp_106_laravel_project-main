<?php

namespace App\Http\Controllers;


use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Dotenv\Validator;

class ServiceController extends Controller
{
        /**
         * Display a listing of the resource.
         */
        public function index()
        {
                //
                $data = Service::where('hub_id', auth()->guard('hub')->id())->get();
                return response()->view('dashboard.services.index', ['data' => $data]);
        }

        /**
         * Show the form for creating a new resource.
         */
        public function create()
        {

                return response()->view('dashboard.services.create');
        }

        /**
         * Store a newly created resource in storage.
         */
        public function store(Request $request)
        {
                //
                $request->validate([
                        'name' => 'required|string|max:45',
                        'info' => 'required|string|max:350',
                        'status' => 'nullable|string|in:on',
                        'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);

                $storeData = new Service();
                $storeData->name = $request->input('name');
                $storeData->info = $request->input('info');
                $storeData->status = $request->has('status');
                if ($request->hasFile('image')) {
                        $imagePath = $request->file('image')->store('public/images');
                        $storeData->image = Storage::url($imagePath);
                    }
                $storeData->hub_id = auth()->guard('hub')->id();
                $saved = $storeData->save();
                return redirect()->route('services.index')->with('success', 'Success! Service Added');
        }

        /**
         * Display the specified resource.
         */
        public function show(string $id)
        {
                //
                $services = Service::where('hub_id',  auth()->guard('hub')->id())->findOrFail($id);
                return response()->view('dashboard.services.show', ['services' => $services]);
        }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit(string $id)
        {
                //
                $editData = Service::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
                return response()->view('dashboard.services.edit', ['editData' => $editData]);
        }

        /**
         * Update the specified resource in storage.
         */
        public function update(Request $request, string $id)
        {

                $request->validate([
                        'name' => 'required|string|max:45',
                        'info' => 'required|string',
                        'status' => 'nullable|string|in:on',
                        'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
                ]);

                $updateData = Service::where('hub_id', auth()->guard('hub')->id())->findOrFail($id);
                $updateData->name = $request->input('name');
                $updateData->info = $request->input('info');
                $updateData->status = $request->has('status');
                $oldImagePath = $updateData->image;
                if ($request->hasFile('image')) {
                    if ($oldImagePath) {
                        Storage::delete($oldImagePath);
                    }
                    $imagePath = $request->file('image')->store('public/images');
                    $updateData->image = Storage::url($imagePath);
                }
                $updateData->hub_id = auth()->guard('hub')->id();
                $saved = $updateData->save();
                return redirect()->route('services.index');
        }

        /**
         * Remove the specified resource from storage.
         */
        public function destroy(string $id)
        {
                //
                Service::where('hub_id', auth()->guard('hub')->id())->findOrFail($id)->delete();
                return redirect()->back();
        }
}

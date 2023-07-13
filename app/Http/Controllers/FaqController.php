<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $data = Faq::all();
        
        if ($request->expectsJson()) {

            return response()->json(['status' => true, 'message' => 'success', 'data' => $data], Response::HTTP_OK);
        } else {

            return response()->view('dashboard.faq.index', ['data' => $data]);
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return response()->view('dashboard.faq.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'question' => 'required|string|max:45',
            'answer' => 'required|string|max:45',
        ]);
        
        $storeData = new Faq();
        $storeData->question = $request->input('question');
        $storeData->answer = $request->input('answer');
        $saved = $storeData->save();
        return redirect()->route('faq.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $editData = Faq::findOrFail($id);
        return response()->view('dashboard.faq.edit', ['editData' => $editData]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request->validate([
            'question' => 'required|string|max:45',
            'answer' => 'required|string|max:45',
        ]);

        $storeData = Faq::findOrFail($id);
        $storeData->question = $request->input('question');
        $storeData->answer = $request->input('answer');
        $saved = $storeData->save();
        return redirect()->route('faq.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        Faq::destroy($id);
        return redirect()->back();
    }
}

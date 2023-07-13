<?php

namespace App\Http\Controllers;

use App\Models\ContactRequest;
use App\Models\User;
use App\Models\Hub;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = ContactRequest::all();
        return response()->view('dashboard.contact_request.index', ['data' => $data]);
    }
  
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator($request->all(),[
            'name' => 'required|string|max:100',
            'email' => 'required|string',
            'mobile' => 'required|string',
            'subject' => 'nullable|string|max:255',
            'content' => 'nullable|string|max:255',
        ]);

        if (!$validator->fails()) {

            $contact_request = new ContactRequest();
            $contact_request->name = $request->input('name');
            $contact_request->email = $request->input('email');
            $contact_request->mobile = $request->input('mobile');
            $contact_request->subject = $request->input('subject');
            $contact_request->content = $request->input('content');
            $saved = $contact_request->save();
            
            return response()->json(['status'=> ! is_null($saved),'massage'=>$saved ? "success" : "Failed"], $saved ? Response::HTTP_OK : Response::HTTP_NOT_FOUND);
        }else {
            
            return response()->json(['status'=>false,'massage'=>$validator->getMessageBag()->first()],Response::HTTP_BAD_REQUEST);
            
        }


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        ContactRequest::destroy($id);
        return redirect()->back();
    }
}

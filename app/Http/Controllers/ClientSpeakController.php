<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClientSpeak;

class ClientSpeakController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.client-speak');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    public function showAll()
    {
        
        return ClientSpeak::orderBy('id', 'DESC')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'designation' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);
        // dd($request->designation);
        $client_speak = new ClientSpeak();
        $client_speak->name = $request->name;
        $client_speak->designation = $request->designation;
        $client_speak->description = $request->description;
        $app_url = env('APP_URL');

        if ($request->image) {

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/img/client-speak'), $fileName);
            $file_path = $app_url . ":8000/assets/img/client-speak/" . $fileName;
            $client_speak->image = $file_path;
        }


        $save = $client_speak->save();

        if ($save) {
            return response()->json(['success' => 'created']);
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
        return $client = ClientSpeak::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return ClientSpeak::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $client_speak = ClientSpeak::find($request->id);
        // dd($request);
        $client_speak->name = $request->name;
        $client_speak->designation = $request->designation;
        $client_speak->description = $request->description;
        $app_url = env('APP_URL');

        if ($request->image) {

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/img/client-speak'), $fileName);
            $file_path = $app_url . ":8000/assets/img/client-speak/" . $fileName;
            $client_speak->image = $file_path;
        }


        $save = $client_speak->save();

        if ($save) {
            return response()->json(['success' => 'updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $client_speak=ClientSpeak::find($request->id);
        $client_speak->delete();

    }
}

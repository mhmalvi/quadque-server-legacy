<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class Clients extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Client::all();
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
    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'client_images' => 'required'
        ]);
        $app_url = env('APP_URL');
        $clients = new Client();
        $file_path = array();
        if ($request->hasFile('client_images')) {
            $imageName = time() . '.' . $request->client_images->getClientOriginalExtension();
            $request->client_images->move(public_path('assets/img/clients'), $imageName);
            $file_path = $app_url . ":8000/assets/img/clients/" . $imageName;
            // $case_study->agency = $file_path;

            $clients->client_images = $file_path;

            $save = $clients->save();
            if ($save) {
                return response()->json([
                    'message' => 'created'
                ]);
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function client_page_view()
    {
        return view('admin.create-clients');
    }
    public function show($id)
    {
        return Client::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        return Client::find($request->id);
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
        $app_url = env('APP_URL');
        // dd($request->all());
        $clients = Client::find($request->id);
        $file_path = array();
        if ($request->hasFile('client_images')) {
            $imageName = time() . '.' . $request->client_images->getClientOriginalExtension();
            $request->client_images->move(public_path('assets/img/clients'), $imageName);
            $file_path = $app_url . ":8000/assets/img/clients/" . $imageName;
            // $case_study->agency = $file_path;

            $clients->client_images = $file_path;

            $save = $clients->save();
            if ($save) {
                return response()->json([
                    'message' => 'updated'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $clients = Client::find($id);
        $clients->delete();
    }
}

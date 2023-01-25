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
        $clients=Client::orderBy('id', 'DESC')->get();
        if (!$clients->isEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $clients
            ]);
        } else {
            return response()->json([
                'status' => 424,
                'message' => 'failed',
            ]);
        }
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
        $clients->meta_keyword = $request->meta_keyword;
        // $file_path = array();
        if ($request->hasFile('client_images')) {
            $imageName = time() . '.' . $request->client_images->getClientOriginalExtension();
            $request->client_images->move(public_path('assets/img/clients'), $imageName);
            $file_path = "assets/img/clients/" . $imageName;
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
        $clients = Client::find($id);
        if ($clients) {
            return response()->json([
                'message' => 'success',
                'status' => 200,
                'data' => $clients
            ]);
        }else{
            return response()->json([
                'message' => 'failed',
                'status' => 424,
            ]);
        }
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
        $clients->meta_keyword = $request->meta_keyword;
        // $file_path = array();
        if ($request->hasFile('client_images')) {
            unlink($clients->client_images);
            $imageName = time() . '.' . $request->file('client_images')->getClientOriginalExtension();
            $request->file('client_images')->move(public_path('assets/img/clients'), $imageName);
            $file_path = "assets/img/clients/" . $imageName;
            // $case_study->agency = $file_path;

            $clients->client_images = $file_path;
        }
            // dd("hello");
            $save = $clients->save();
            if ($save) {
                return response()->json([
                    'message' => 'updated'
                ]);
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
        unlink($clients->client_images);
    }
}

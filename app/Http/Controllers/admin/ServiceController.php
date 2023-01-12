<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.service');
    }

    public function showAll()
    {
        $services = Service::all();
        if (!$services->isEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $services
            ], 200);
        } else {
            return response()->json([
                'status' => 424,
                'message' => 'Not found',
            ], 424);
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
        $app_url = env('APP_URL');
        $service = new Service();
        $service->service_name = $request->service_name;
        $service->service_title = $request->service_title;
        $service->description = $request->description;

        // $service->identity_design_title = $request->identity_design_title; identity_design_services_list
        $service->identity_design_des = $request->identity_design_des;
        $service->content = $request->content;

        $service->project_count = $request->project_count;
        $service->happy_clients = $request->happy_clients;

        $service->services_capabilities_menu = $request->service_capability_menus;

        $service->service_deliver_title = $request->service_deliver_title;
        $service->service_deliver_des = $request->service_deliver_description;

        if ($request->file) {

            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->file = $file_path;
        }

        $slug = Str::slug($request->service_name, '-');
        $service->slug = $slug;
        $save = $service->save();

        if ($save) {
            return response()->json(['success' => 'created'],200);
        }else{
            return response()->json(['message' => 'failed'], 402);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $service = Service::where('slug', $slug)->first();
        if ($service) {
            return response()->json([
                'message' => 'success',
                'status' => 200,
                'data' => $service
            ],200);
        } else {
            return response()->json([
                'message' => 'Not found',
                'status' => 424,
            ],424);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return Service::find($id);
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
        // dd("hello");
        $request->validate([
            'service_name' => 'required',
            'description' => 'required',
            // 'file' => 'required'
        ]);
        $app_url = env('APP_URL');
        $service = Service::find($request->id);
        // dd("hello");
        $service->service_name = $request->service_name;
        $service->description = $request->description;
        $service->service_title = $request->service_title;
        // $service->identity_design_title = $request->identity_design_title;
        $service->identity_design_des = $request->identity_design_des;

        $service->content = $request->content;

        $service->project_count = $request->project_count;
        $service->happy_clients = $request->happy_clients;

        $service->services_capabilities_menu = $request->service_capability_menus;

        $service->service_deliver_title = $request->service_deliver_title;
        $service->service_deliver_des = $request->service_deliver_description;

        if ($request->file) {

            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->file = $file_path;
        }
        // dd("hello");
        $service->slug = $request->slug;
        $update = $service->save();

        if ($update) {
            return response()->json(['success' => 'updated'],200);
        }else{
            return response()->json(['message' => 'failed'], 402);
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
        $service = Service::find($id);
        $service->delete();
        return response()->json(['success' => 'You have successfully deleted file.']);
    }
}

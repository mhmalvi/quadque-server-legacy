<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;

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
        return Service::orderBy('id','DESC')->get();
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
        // dd($request->identity_menus);
        // for($i=0;$i<count($request->identity_menus);$i++){
        //     echo $request->identity_menus[$i];
        // }
        // die;
        // $request->validate([
        //     'service_name' => 'required',
        //     'file' => 'required',
        //     'description' => 'required'
        // ]);
        $app_url = env('APP_URL');
        $service = new Service();
        $service->service_name = $request->service_name;
        $service->description = $request->description;

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

        $save = $service->save();

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
        return $service = Service::find($id);
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

        $update = $service->save();

        if ($update) {
            return response()->json(['success' => 'updated']);
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

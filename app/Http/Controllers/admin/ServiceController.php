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
        return Service::all();
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
        dd($request->all());
        // $request->validate([
        //     'service_name' => 'required',
        //     'file' => 'required',
        //     'description' => 'required'
        // ]);
        $app_url = env('APP_URL');
        $service = new Service();
        $service->service_name = $request->service_name;
        $service->description = $request->description;

        $service->identity_design_title = $request->identity_design_title;
        $service->identity_design_des = $request->identity_design_des;
        $service->identity_design_menus_1 = $request->identity_design_menus_1;
        $service->identity_design_menus_2 = $request->identity_design_menus_2;
        $service->identity_design_menus_3 = $request->identity_design_menus_3;
        $service->identity_design_menus_4 = $request->identity_design_menus_4;
        $service->identity_design_menus_5 = $request->identity_design_menus_5;
        $service->identity_design_menus_6 = $request->identity_design_menus_6;

        $service->project_count = $request->project_count;
        $service->happy_clients = $request->happy_clients;

        $service->best_service_title = $request->best_service_title;
        $service->best_service_header = $request->best_service_header;
        $service->best_service_des = $request->best_service_des;

        $service->why_choose_us_title = $request->why_choose_us_title;
        $service->why_choose_us_des = $request->why_choose_us_des;

        $service->services_capabilities_title = $request->services_capabilities_title;
        $service->services_capabilities_des = $request->services_capabilities_des;
        $service->services_capabilities_menus_1 = $request->services_capabilities_menus_1;
        $service->services_capabilities_menus_2 = $request->services_capabilities_menus_2;
        $service->services_capabilities_menus_3 = $request->services_capabilities_menus_3;
        $service->services_capabilities_menus_4 = $request->services_capabilities_menus_4;
        $service->services_capabilities_menus_5 = $request->services_capabilities_menus_5;
        $service->services_capabilities_menus_6 = $request->services_capabilities_menus_6;
        $service->services_capabilities_menus_7 = $request->services_capabilities_menus_7;

        $service->service_deliver_title = $request->service_deliver_title;
        $service->service_deliver_des = $request->service_deliver_des;

        $service->our_latest_work_title = $request->our_latest_work_title;

        $service->about_us_title = $request->about_us_title;
        $service->about_us_name = $request->about_us_name;
        $service->about_us_des = $request->about_us_des;

        if ($request->file) {

            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->file = $file_path;
        }

        if ($request->best_service_img) {

            $fileName = time() . '.' . $request->best_service_img->getClientOriginalExtension();
            $request->best_service_img->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->best_service_img = $file_path;
        }

        if ($request->why_choose_us_img) {

            $fileName = time() . '.' . $request->why_choose_us_img->getClientOriginalExtension();
            $request->why_choose_us_img->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->why_choose_us_img = $file_path;
        }

        if ($request->our_latest_work_img) {

            $fileName = time() . '.' . $request->our_latest_work_img->getClientOriginalExtension();
            $request->our_latest_work_img->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->our_latest_work_image = $file_path;
        }

        if ($request->about_us_img) {

            $fileName = time() . '.' . $request->about_us_img->getClientOriginalExtension();
            $request->about_us_img->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->about_us_img = $file_path;
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

        $service->identity_design_title = $request->identity_design_title;
        $service->identity_design_des = $request->identity_design_des;
        $service->identity_design_menus_1 = $request->identity_design_menus_1;
        $service->identity_design_menus_2 = $request->identity_design_menus_2;
        $service->identity_design_menus_3 = $request->identity_design_menus_3;
        $service->identity_design_menus_4 = $request->identity_design_menus_4;
        $service->identity_design_menus_5 = $request->identity_design_menus_5;
        $service->identity_design_menus_6 = $request->identity_design_menus_6;

        $service->project_count = $request->project_count;
        $service->happy_clients = $request->happy_clients;

        $service->best_service_title = $request->best_service_title;
        $service->best_service_header = $request->best_service_header;
        $service->best_service_des = $request->best_service_des;

        $service->why_choose_us_title = $request->why_choose_us_title;
        $service->why_choose_us_des = $request->why_choose_us_des;

        $service->services_capabilities_title = $request->services_capabilities_title;
        $service->services_capabilities_des = $request->services_capabilities_des;
        $service->services_capabilities_menus_1 = $request->services_capabilities_menus_1;
        $service->services_capabilities_menus_2 = $request->services_capabilities_menus_2;
        $service->services_capabilities_menus_3 = $request->services_capabilities_menus_3;
        $service->services_capabilities_menus_4 = $request->services_capabilities_menus_4;
        $service->services_capabilities_menus_5 = $request->services_capabilities_menus_5;
        $service->services_capabilities_menus_6 = $request->services_capabilities_menus_6;
        $service->services_capabilities_menus_7 = $request->services_capabilities_menus_7;

        $service->service_deliver_title = $request->service_deliver_title;
        $service->service_deliver_des = $request->service_deliver_des;

        $service->our_latest_work_title = $request->our_latest_work_title;

        $service->about_us_title = $request->about_us_title;
        $service->about_us_name = $request->about_us_name;
        $service->about_us_des = $request->about_us_des;

        if ($request->file) {

            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->file = $file_path;
        }

        if ($request->best_service_img) {

            $fileName = time() . '.' . $request->best_service_img->getClientOriginalExtension();
            $request->best_service_img->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->best_service_img = $file_path;
        }

        if ($request->why_choose_us_img) {

            $fileName = time() . '.' . $request->why_choose_us_img->getClientOriginalExtension();
            $request->why_choose_us_img->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->why_choose_us_img = $file_path;
        }

        if ($request->our_latest_work_img) {

            $fileName = time() . '.' . $request->our_latest_work_img->getClientOriginalExtension();
            $request->our_latest_work_img->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->our_latest_work_image = $file_path;
        }

        if ($request->about_us_img) {

            $fileName = time() . '.' . $request->about_us_img->getClientOriginalExtension();
            $request->about_us_img->move(public_path('assets/services'), $fileName);
            $file_path = $app_url . ":8000/assets/services/" . $fileName;
            $service->about_us_img = $file_path;
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

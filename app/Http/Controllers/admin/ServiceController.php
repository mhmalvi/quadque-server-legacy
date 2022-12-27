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
        $request->validate([
            'service_name' => 'required',
            'file' => 'required',
            'description' => 'required'
        ]);

        $service = new Service();
        $service->service_name = $request->service_name;
        $service->description = $request->description;

        if ($request->file) {

            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('assets/services'), $fileName);
            $service->file = $fileName;
        }


        $save = $service->save();

        if ($save) {
            return response()->json(['success' => 'You have successfully created services.']);
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

        $service = Service::find($request->id);
        // dd("hello");
        $service->service_name = $request->service_name;
        $service->description = $request->description;

        // if ($request->file) {
        //     $fileName = time() . '.' . $request->file->getClientOriginalExtension();
        //     $request->file->move(public_path('assets/services'), $fileName);
        //     $exist_image = $service['file'];
        //     $service->file = $fileName;
        // }

        if ($request->file) {

            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('assets/services'), $fileName);
            $service->file = $fileName;
        }
        // dd("hello");

        $update = $service->save();
        // $service->update([
        //     'service_name' => $request->service_name,
        //     'description' => $request->description,
        //     'file' => $name
        // ]);

        // if (isset($exist_image) && file_exists($exist_image)) {
        //     unlink($exist_image);
        // }

        if ($update) {
            return response()->json(['success' => 'You have successfully updated.']);
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

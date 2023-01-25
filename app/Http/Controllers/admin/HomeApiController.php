<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomeVideo;

class HomeApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view_home()
    {
        return view('admin.home');
    }
    public function index()
    {
        return $videos = HomeVideo::all();
        // dd($videos);
        return view('user.components.desktop', ['video' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'file' => 'required'
        ]);
        $app_url = env('APP_URL');
        // dd($app_url);
        $home_video = new HomeVideo();
        $home_video->name = $request->name;
        $home_video->meta_keyword = $request->meta_keyword;

        if ($request->file) {
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('assets/home_video'), $fileName);
            
            $file_path = "assets/home_video/" . $fileName;
            $home_video->file = $file_path;
        }
        

        $save = $home_video->save();

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
        return HomeVideo::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return HomeVideo::find($id);
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
        // dd($request->id);
        $request->validate([
            'name' => 'required',
            'file' => 'required'
        ]);
        $app_url = env('APP_URL');
        $home_video = HomeVideo::find($request->id);
        $home_video->meta_keyword = $request->meta_keyword;
        $home_video->name = $request->name;

        if ($request->file) {
            unlink($home_video->file);
            $fileName = time() . '.' . $request->file->getClientOriginalExtension();
            $request->file->move(public_path('assets/home_video'), $fileName);
            $file_path = "assets/home_video/" . $fileName;
            $home_video->file = $file_path;
        }


        $save = $home_video->save();

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
    public function destroy($id)
    {
        $video = HomeVideo::find($id);
        $video->delete();
        unlink($home_video->file);
        return response()->json(['success' => 'You have successfully deleted file.']);
    }
}

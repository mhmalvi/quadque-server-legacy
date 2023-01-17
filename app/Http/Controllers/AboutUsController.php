<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.about-us');
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
        $about_us = AboutUs::all();
        
            $request->validate([
                'our_vision' => 'required',
                'our_mission' => 'required',
                'our_goal' => 'required',
                'our_objective' => 'required',
                'who_we_are' => 'required',
                'why_choose_us' => 'required'
            ]);

            // if ($request->thumbnail) {

            //     $fileName = time() . '.' . $request->thumbnail->getClientOriginalExtension();
            //     $request->thumbnail->move(public_path('assets/img/blogs'), $fileName);
            // }
            $save = new AboutUs();
            $save->our_vision = $request->our_vision;
            $save->our_mission = $request->our_mission;
            $save->our_goal = $request->our_goal;
            $save->our_objective = $request->our_objective;
            $save->who_we_are = $request->who_we_are;
            $save->why_choose_us = $request->why_choose_us;
            $save->meta_keyword = $request->meta_keyword;
        if ($about_us->isEmpty()) {
            $save = $save->save();
        } else {
            return response()->json([

                'data' => 'exist'

            ], 424);
        }

            if ($save) {
                return response()->json([

                    'success' => 'created'

                ], 200);
            } else {
                return response()->json([

                    'message' => 'failed'

                ], 424);
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
        $about_us = AboutUs::find($id);
        if ($about_us) {
            return response()->json([
                'message' => 'success',
                'status' => 200,
                'data' => $about_us
            ]);
        } else {
            return response()->json([
                'message' => 'failed',
                'status' => 424,
            ]);
        }
    }

    public function showAll()
    {
        $about_us = AboutUs::orderBy('id', 'DESC')->get();
        // dd($about_us);
        if (!$about_us->isEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $about_us
            ], 200);
        } else {
            return response()->json([
                'status' => 424,
                'message' => 'failed',
            ], 424);
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
        return AboutUs::find($request->id);
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
        // dd($request->$request->id);
        $about_us = AboutUs::find($request->id);
        $about_us->our_vision = $request->our_vision;
        $about_us->our_mission = $request->our_mission;
        $about_us->our_goal = $request->our_goal;
        $about_us->our_objective = $request->our_objective;
        $about_us->who_we_are = $request->who_we_are;
        $about_us->why_choose_us = $request->why_choose_us;
        $about_us->meta_keyword = $request->meta_keyword;
        // $app_url = env('APP_URL');


        $save = $about_us->save();

        if ($save) {
            return response()->json(['success' => 'updated']);
        } else {
            return response()->json(['success' => 'not updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $request)
    {
        // dd($request->id);
        $about_us = AboutUs::find($request->id);
        $about_us->delete();
        return response()->json(['success' => 'deleted']);
    }
}

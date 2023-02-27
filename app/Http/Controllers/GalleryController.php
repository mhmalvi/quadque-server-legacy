<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gallery;
use App\Models\GalleryImages;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // dd($gallery);
        return view('admin.gallery');
    }

    public function showAll()
    {
        $gallery = Gallery::with('galleryImages')->get();
        return response()->json($gallery);
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
            'title' => 'required',
            'album_caption' => 'required',
            'images' => 'required'
        ]);
        $gallery = new Gallery();
        $gallery->album_title = $request->title;
        $gallery->album_caption = $request->album_caption;
        $gallery->created_at = Carbon::now();
        $gallery->save();
        // dd($gallery->id);
        // $gallery_images = new GalleryImages();
        // dd($request->images);
        $data = array();
        foreach ($request->images as $image) {
            $data[] = $image;
            $image = [];
        }
        // dd($data);
        if (isset($gallery->id)) {
            if ($data) {
                for ($i = 0; $i < count($data); $i++) {
                    // echo $request->images[$i];
                    // $fileName = time() . '.' . $data[$i]->getClientOriginalExtension();
                    $path = $data[$i]->store('assets/img/gallery', ['disk' =>   'my_files']);
                    // $file_path = "assets/img/gallery/" . $fileName;
                    $save = GalleryImages::create([
                        'images' => $path,
                        'gallery_id' => $gallery->id,
                        'created_at' => Carbon::now()
                    ]);
                    $path = "";
                }

                // die;
            }
            if ($save) {
                return response()->json([
                    'message' => 'created',
                    'status' => 200
                ], 200);
            } else {
                return response()->json([
                    'message' => 'failed to save',
                    'status' => 424
                ], 424);
            }
        } else {
            return response()->json([
                'message' => 'foreign key not found',
                'status' => 424
            ], 424);
        }
        $data = [];
        // if()
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Gallery::find($id);
        $images = GalleryImages::where('gallery_id', $id)->get();
        // dd($data);
        return response()->json([
            'message' => 'success',
            'data' => [
                'album' => $data,
                'images' => $images
            ],
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update_image(Request $request)
    {
        // dd($request->all());
        $image = GalleryImages::find($request->id);
        if ($request->file('images')) {
            $data = $request->images;
            $path = $data->store('assets/img/gallery', ['disk' =>   'my_files']);
            $image->images = $path;
            $update = $image->save();
            if ($update) {
                return response()->json([
                    'message' => 'updated'
                ]);
                $path = "";
            }
        }
    }
    public function update(Request $request)
    {
        // dd($request->all());
        $gallery = Gallery::find($request->id);
        $gallery->album_title = $request->title;
        $gallery->album_caption = $request->album_caption;
        $gallery->created_at = Carbon::now();
        $save = $gallery->save();
        // dd($gallery->id);
        // $images = GalleryImages::where('gallery_id', $request->id)->get();
        // dd($images);
        $data = array();
        if ($request->file('images')) {
            foreach ($request->images as $image) {

                $data[] = $image;
            }
            // dd($data);
            if ($data) {
                for ($i = 0; $i < count($data); $i++) {
                    $path = $data[$i]->store('assets/img/gallery', ['disk' =>   'my_files']);
                    $update = GalleryImages::create([
                        'images' => $path,
                        'gallery_id' => $request->id,
                        'created_at' => Carbon::now()
                    ]);
                    $path = "";
                }
            }
        }
        $data = [];
        if ($save) {
            return response()->json([
                'message' => 'updated',
                'status' => 200
            ], 200);
        } else {
            return response()->json([
                'message' => 'failed to update',
                'status' => 424
            ], 424);
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
        $gallery = Gallery::find($id);
        $gallery->delete();
    }

    public function destroy_image($id)
    {
        $image = GalleryImages::where('id', $id)->first();
        $delete_image = $image->delete();
        if ($delete_image) {
            return response()->json([
                'status' => 'success',
                'message' => 'deleted'
            ]);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'not deleted'
            ]);
        }
    }
}

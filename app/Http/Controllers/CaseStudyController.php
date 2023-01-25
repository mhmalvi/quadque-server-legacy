<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CaseStudy;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CaseStudyController extends Controller
{

    public function desktopMoreCaseStudy()
    {

        $blogs = Blog::limit(2)->get();

        return view('user.components.caseStudyDetailsDesktop', compact('blogs'));
    }


    public function getMore($num)
    {
        $caseStudyFirstRows = CaseStudy::orderBy('id', 'asc')->skip(4 * $num)->take(4)->get();
        $caseStudySecondRows = CaseStudy::orderBy('id', 'asc')->skip(4 * $num + 1)->take(4)->get();




        $firstRows = '';
        if (isset($caseStudyFirstRows)) {
            foreach ($caseStudyFirstRows as $caseStudyFirstRow) {

                $firstRows .= '<li> <div class="case-study-box dji">';
                $firstRows .= '<div class="case-study-img">';
                $firstRows .= '<a href="' . url('desktop/casestudy/details') . '">';
                $firstRows .= '<img src="' . asset('/assets/img/case_study/' . $caseStudyFirstRow->com_image) . '" />';
                $firstRows .= '</a></div><div class="case-study-text">';
                $firstRows .= $caseStudyFirstRow->com_name;
                $firstRows .= ' </div></div></li>';
            }
        }

        // second rows 
        $secondRows = '';
        if (isset($caseStudySecondRows)) {
            foreach ($caseStudySecondRows as $caseStudySecondRow) {
                $secondRows .= ` <li>
                                                        <div class="case-study-box dji">
                                                            <div class="case-study-img">
                                                             <a href="{{ url('desktop/casestudy/details') }}">
 
                                                                     <img src="{{ asset('/assets/img/case_study/'.$caseStudySecondRow->com_image) }} " />

                                                             </a>
                                                              
                                                            </div>
                                                            <div class="case-study-text">
                                                                {{ $caseStudySecondRow->com_name }}
                                                            </div>
                                                        </div>
                                                    </li>`;
            }
        }



        return response()->json([

            'caseStudyFirstRows' => $firstRows,
            'caseStudySecondRows' => $secondRows,

        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAll()
    {
        $case_studies = CaseStudy::orderBy('id', 'DESC')->get();
        if (!$case_studies->isEmpty()) {
            return response()->json([
                'status' => 200,
                'message' => 'success',
                'data' => $case_studies
            ]);
        } else {
            return response()->json([
                'status' => 424,
                'message' => 'failed',
            ]);
        }
        // return response()->json($case_studies);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $case_studies = CaseStudy::all();

        return response()->json($case_studies);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $case_study = CaseStudy::find($id);

        return response()->json($case_study);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate the input
        // $path = 
        $request->validate([
            'name' => 'required|unique:case_studies',
            'slug'=>'required|unique:case_studies',
            'summary1' => 'required',
            'summary2' => 'required',
            'image'=>'required'
        ]);
        $case_study = new CaseStudy();
        $case_study->com_name = $request->name;
        $case_study->summary1 = $request->summary1;
        $case_study->summary2 = $request->summary2;
        $case_study->content = $request->content;
        $case_study->meta_keyword = $request->meta_keyword;
        // $case_study->description = $request->description;
        $case_study->our_content_header = $request->our_content_header;
        $case_study->slug = $request->slug;
        $case_study->title_1 = $request->title_1;
        $case_study->description_1 = $request->description_1;
        $case_study->title_2 = $request->title_2;
        $case_study->description_2 = $request->description_2;
        $case_study->title_3 = $request->title_3;
        $case_study->description_3 = $request->description_3;
        // $case_study->service_id = $ser_id;
        // $app_url = env('APP_URL');


        if ($request->image) {

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/img/case_study'), $fileName);
            $file_path = "assets/img/case_study/" . $fileName;
            $case_study->com_image = $file_path;
        }

        if ($request->long_banner) {

            $fileName = time() . '.' . $request->long_banner->getClientOriginalExtension();
            $request->long_banner->move(public_path('assets/img/case_study/long_banner'), $fileName);
            $file_path = "assets/img/case_study/long_banner/" . $fileName;
            $case_study->long_banner = $file_path;
        }

        if ($request->short_banner) {

            $fileName = time() . '.' . $request->short_banner->getClientOriginalExtension();
            $request->short_banner->move(public_path('assets/img/case_study/short_banner'), $fileName);
            $file_path = "assets/img/case_study/short_banner/" . $fileName;
            $case_study->short_banner = $file_path;
        }

        if ($request->image_1) {

            $fileName = time() . '.' . $request->image_1->getClientOriginalExtension();
            $request->image_1->move(public_path('assets/img/case_study/image_1'), $fileName);
            $file_path = "assets/img/case_study/image_1/" . $fileName;
            $case_study->image_1 = $file_path;
        }

        if ($request->image_2) {

            $fileName = time() . '.' . $request->image_2->getClientOriginalExtension();
            $request->image_2->move(public_path('assets/img/case_study/image_2'), $fileName);
            $file_path = "assets/img/case_study/image_2/" . $fileName;
            $case_study->image_2 = $file_path;
        }

        if ($request->image_3) {

            $fileName = time() . '.' . $request->image_3->getClientOriginalExtension();
            $request->image_3->move(public_path('assets/img/case_study/image_3'), $fileName);
            $file_path = "assets/img/case_study/image_3/" . $fileName;
            $case_study->image_3 = $file_path;
        }

        if ($request->group_images) {

            $fileName = time() . '.' . $request->group_images->getClientOriginalExtension();
            $request->group_images->move(public_path('assets/img/case_study/group_images'), $fileName);
            $file_path = "assets/img/case_study/group_images/" . $fileName;
            $case_study->group_images = $file_path;
        }
        if ($request->agency) {
            $fileName = time() . '.' . $request->agency->getClientOriginalExtension();
            $request->agency->move(public_path('assets/case_study/agency'), $fileName);
            $file_path = "assets/case_study/agency/" . $fileName;
            $case_study->agency = $file_path;
        }
        

        $save = $case_study->save();
        if ($save) {
            return response()->json(['success' => 'created']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CaseStudy  $caseStudy
     * @return \Illuminate\Http\Response
     */
    public function show(CaseStudy $caseStudy)
    {
        return view('admin.case-study');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CaseStudy  $caseStudy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:case_studies',
            'slug' => 'required|unique:case_studies',
            'summary1'=>'required',
            'summary2' => 'required',
            'image'=>'required'
        ]);
        // dd($request->all());
        $case_study = CaseStudy::find($request->id);
        $case_study->com_name = $request->name;
        $case_study->summary1 = $request->summary1;
        $case_study->summary2 = $request->summary2;
        $case_study->content = $request->content;
        // $case_study->description = $request->description;
        $case_study->meta_keyword = $request->meta_keyword;
        $case_study->our_content_header = $request->our_content_header;
        $case_study->slug = $request->slug;
        $case_study->title_1 = $request->title_1;
        $case_study->description_1 = $request->description_1;
        $case_study->title_2 = $request->title_2;
        $case_study->description_2 = $request->description_2;
        $case_study->title_3 = $request->title_3;
        $case_study->description_3 = $request->description_3;
        // $case_study->service_id = $ser_id;
        $app_url = env('APP_URL');

        
        if ($request->image) {
            unlink($case_study->com_image);
            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/img/case_study'), $fileName);
            $file_path = "assets/img/case_study/" . $fileName;
            $case_study->com_image = $file_path;
        }

        if ($request->long_banner) {
            unlink($case_study->long_banner);
            $fileName = time() . '.' . $request->long_banner->getClientOriginalExtension();
            $request->long_banner->move(public_path('assets/img/case_study/long_banner'), $fileName);
            $file_path = "assets/img/case_study/long_banner/" . $fileName;
            $case_study->long_banner = $file_path;
        }

        if ($request->short_banner) {
            unlink($case_study->short_banner);
            $fileName = time() . '.' . $request->short_banner->getClientOriginalExtension();
            $request->short_banner->move(public_path('assets/img/case_study/short_banner'), $fileName);
            $file_path = "assets/img/case_study/short_banner/" . $fileName;
            $case_study->short_banner = $file_path;
        }

        if ($request->image_1) {
            unlink($case_study->image_1);
            $fileName = time() . '.' . $request->image_1->getClientOriginalExtension();
            $request->image_1->move(public_path('assets/img/case_study/image_1'), $fileName);
            $file_path = "assets/img/case_study/image_1/" . $fileName;
            $case_study->image_1 = $file_path;
        }

        if ($request->image_2) {
            unlink($case_study->image_2);
            $fileName = time() . '.' . $request->image_2->getClientOriginalExtension();
            $request->image_2->move(public_path('assets/img/case_study/image_2'), $fileName);
            $file_path = "assets/img/case_study/image_2/" . $fileName;
            $case_study->image_2 = $file_path;
        }

        if ($request->image_3) {
            unlink($case_study->image_3);
            $fileName = time() . '.' . $request->image_3->getClientOriginalExtension();
            $request->image_3->move(public_path('assets/img/case_study/image_3'), $fileName);
            $file_path = "assets/img/case_study/image_3/" . $fileName;
            $case_study->image_3 = $file_path;
        }

        if ($request->group_images) {
            unlink($case_study->group_images);
            $fileName = time() . '.' . $request->group_images->getClientOriginalExtension();
            $request->group_images->move(public_path('assets/img/case_study/group_images'), $fileName);
            $file_path = "assets/img/case_study/group_images/" . $fileName;
            $case_study->group_images = $file_path;
        }
        if ($request->agency) {
            unlink($case_study->agency);
            $fileName = time() . '.' . $request->agency->getClientOriginalExtension();
            $request->agency->move(public_path('assets/case_study/agency'), $fileName);
            $file_path = "assets/case_study/agency/" . $fileName;
            $case_study->agency = $file_path;
        }

        // dd("hello");
        $save = $case_study->save();

        if ($save) {
            return response()->json(['success' => 'updated']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CaseStudy  $caseStudy
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, CaseStudy $caseStudy)
    {
        $caseStudy = CaseStudy::find($id);
        
        $delete = $caseStudy->delete();
        unlink($caseStudy->agency);
        unlink($caseStudy->group_images);
        unlink($caseStudy->image_3);
        unlink($caseStudy->image_2);
        unlink($caseStudy->image_1);
        unlink($caseStudy->short_banner);
        unlink($caseStudy->long_banner);
        unlink($caseStudy->com_image);
        if ($delete) {
            return response()->json(['success' => 'You have successfully delete Case Study.']);
        }
    }
}

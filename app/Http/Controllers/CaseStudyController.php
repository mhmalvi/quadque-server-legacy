<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CaseStudy;
use Illuminate\Http\Request;

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
        $case_studies = CaseStudy::all();

        return response()->json($case_studies);
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
            'name' => 'required',
            // 'image' => 'required|image'
        ]);
        // dd($request->all());
        $case_study = new CaseStudy();
        $case_study->com_name = $request->name;
        $case_study->summary1 = $request->summary1;
        $case_study->summary2 = $request->summary2;
        $case_study->first_content = $request->first_content;
        $case_study->case_con_2_title_1 = $request->case_con_2_title_1;
        $case_study->case_con_2_des_1 = $request->case_con_2_des_1;
        $case_study->case_con_2_title_2 = $request->case_con_2_title_2;
        $case_study->case_con_2_des_2 = $request->case_con_2_des_2;
        $case_study->case_con_2_title_3 = $request->case_con_2_title_3;
        $case_study->case_con_2_des_3 = $request->case_con_2_des_3;
        $app_url = env('APP_URL');

        // $group_images=$request->file('group_images');
        // $imageName = '';
        // foreach ($group_images as $images) {
        //     $new_name = rand() . '.' . $images->getClientOriginalExtension();
        //     $images->move(public_path('uploads/images/case_study_group_images'), $new_name);
        //     $imageName = $imageName . $new_name . ',';
        //     $case_study->group_images = $imageName;
        // }

        if ($request->image) {

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->com_image = $file_path;
        }

        if ($request->img1) {

            $first_content_img_name = time() . '.' . $request->img1->getClientOriginalExtension();
            $request->img1->move(public_path('assets/img/case_study/img1'), $first_content_img_name);
            $file_path = $app_url . ":8000/assets/img/case_study/img1/" . $first_content_img_name;
            $case_study->img1 = $file_path;
        }

        if ($request->con_2_img_1) {

            $con_2_img_1 = time() . '.' . $request->con_2_img_1->getClientOriginalExtension();
            $request->con_2_img_1->move(public_path('assets/img/case_study/second_content_img_1'), $con_2_img_1);
            $file_path = $app_url . ":8000/assets/img/case_study/second_content_img_1/" . $con_2_img_1;
            $case_study->case_con_2_img_1 = $file_path;
        }

        if ($request->con_2_img_2) {

            $con_2_img_2 = time() . '.' . $request->con_2_img_2->getClientOriginalExtension();
            $request->con_2_img_2->move(public_path('assets/img/case_study/second_content_img_2'), $con_2_img_2);
            $file_path = $app_url . ":8000/assets/img/case_study/second_content_img_2/" . $con_2_img_2;
            $case_study->case_con_2_img_2 = $file_path;
        }

        if ($request->con_2_img_3) {

            $con_2_img_3 = time() . '.' . $request->con_2_img_3->getClientOriginalExtension();
            $request->con_2_img_3->move(public_path('assets/img/case_study/third_content_img_3'), $con_2_img_3);
            $file_path = $app_url . ":8000/assets/img/case_study/third_content_img_3/" . $con_2_img_3;
            $case_study->case_con_2_img_3 = $file_path;
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
            'name' => 'required',
            // 'image' => 'required|image'
        ]);
        // dd($request->all());
        $case_study = CaseStudy::find($request->id);
        $case_study->com_name = $request->name;
        $case_study->summary1 = $request->summary1;
        $case_study->summary2 = $request->summary2;
        $case_study->first_content = $request->first_content;
        $case_study->case_con_2_title_1 = $request->case_con_2_title_1;
        $case_study->case_con_2_des_1 = $request->case_con_2_des_1;
        $case_study->case_con_2_title_2 = $request->case_con_2_title_2;
        $case_study->case_con_2_des_2 = $request->case_con_2_des_2;
        $case_study->case_con_2_title_3 = $request->case_con_2_title_3;
        $case_study->case_con_2_des_3 = $request->case_con_2_des_3;
        $app_url = env('APP_URL');

        // $group_images=$request->file('group_images');
        // $imageName = '';
        // foreach ($group_images as $images) {
        //     $new_name = rand() . '.' . $images->getClientOriginalExtension();
        //     $images->move(public_path('uploads/images/case_study_group_images'), $new_name);
        //     $imageName = $imageName . $new_name . ',';
        //     $case_study->group_images = $imageName;
        // }

        if ($request->image) {

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->com_image = $file_path;
        }

        if ($request->img1) {

            $first_content_img_name = time() . '.' . $request->img1->getClientOriginalExtension();
            $request->img1->move(public_path('assets/img/case_study/img1'), $first_content_img_name);
            $file_path = $app_url . ":8000/assets/img/case_study/img1/" . $first_content_img_name;
            $case_study->img1 = $file_path;
        }

        if ($request->con_2_img_1) {

            $con_2_img_1 = time() . '.' . $request->con_2_img_1->getClientOriginalExtension();
            $request->con_2_img_1->move(public_path('assets/img/case_study/second_content_img_1'), $con_2_img_1);
            $file_path = $app_url . ":8000/assets/img/case_study/second_content_img_1/" . $con_2_img_1;
            $case_study->case_con_2_img_1 = $file_path;
        }

        if ($request->con_2_img_2) {

            $con_2_img_2 = time() . '.' . $request->con_2_img_2->getClientOriginalExtension();
            $request->con_2_img_2->move(public_path('assets/img/case_study/second_content_img_2'), $con_2_img_2);
            $file_path = $app_url . ":8000/assets/img/case_study/second_content_img_2/" . $con_2_img_2;
            $case_study->case_con_2_img_2 = $file_path;
        }

        if ($request->con_2_img_3) {

            $con_2_img_3 = time() . '.' . $request->con_2_img_3->getClientOriginalExtension();
            $request->con_2_img_3->move(public_path('assets/img/case_study/third_content_img_3'), $con_2_img_3);
            $file_path = $app_url . ":8000/assets/img/case_study/third_content_img_3/" . $con_2_img_3;
            $case_study->case_con_2_img_3 = $file_path;
        }


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

        if ($delete) {
            return response()->json(['success' => 'You have successfully delete Case Study.']);
        }
    }
}

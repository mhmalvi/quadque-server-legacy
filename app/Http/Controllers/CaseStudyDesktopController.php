<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\CaseStudyDesktop;

class CaseStudyDesktopController extends Controller
{
    public function desktopMoreCaseStudy()
    {

        $blogs = Blog::limit(2)->get();

        return view('user.components.caseStudyDetailsDesktop', compact('blogs'));
    }

    public function get_by_id(Request $request){
        return CaseStudyDesktop::find($request->id);
    }


    public function getMore($num)
    {
        $caseStudyFirstRows = CaseStudyDesktop::orderBy('id', 'asc')->skip(4 * $num)->take(4)->get();
        $caseStudySecondRows = CaseStudyDesktop::orderBy('id', 'asc')->skip(4 * $num + 1)->take(4)->get();




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
        $case_studies = CaseStudyDesktop::all()->so;

        return response()->json($case_studies);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $case_studies = CaseStudyDesktop::all();

        return response()->json($case_studies);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $case_study = CaseStudyDesktop::find($id);

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
        // $service_id=array();
        // foreach($request->selected_services as $services_id){
        //     $service_id[] = $services_id;
        // }
        // $ser_id=implode(',',$service_id);
        // die;
        $case_study = new CaseStudyDesktop();
        $case_study->com_name = $request->name;
        $case_study->summary1 = $request->summary1;
        $case_study->summary2 = $request->summary2;
        $case_study->content = $request->content;
        // $case_study->service_id = $ser_id;
        $app_url = env('APP_URL');


        if ($request->image) {

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->com_image = $file_path;
        }

        if ($request->group_images_1) {

            $fileName = time() . '.' . $request->group_images_1->getClientOriginalExtension();
            $request->group_images_1->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_1 = $file_path;
        }
        if ($request->group_images_2) {

            $fileName = time() . '.' . $request->group_images_2->getClientOriginalExtension();
            $request->group_images_2->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_2 = $file_path;
        }
        if ($request->group_images_3) {

            $fileName = time() . '.' . $request->group_images_3->getClientOriginalExtension();
            $request->group_images_3->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_3 = $file_path;
        }
        if ($request->group_images_4) {

            $fileName = time() . '.' . $request->group_images_4->getClientOriginalExtension();
            $request->group_images_4->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_4 = $file_path;
        }
        if ($request->group_images_5) {

            $fileName = time() . '.' . $request->group_images_5->getClientOriginalExtension();
            $request->group_images_5->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_5 = $file_path;
        }
        if ($request->group_images_6) {

            $fileName = time() . '.' . $request->group_images_6->getClientOriginalExtension();
            $request->group_images_6->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_6 = $file_path;
        }
        if ($request->group_images_7) {

            $fileName = time() . '.' . $request->group_images_7->getClientOriginalExtension();
            $request->group_images_7->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_7 = $file_path;
        }



        $file_path = array();
        if ($request->hasFile('agency_images')) {
            foreach ($request->file('agency_images') as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/img/case_study/agency_images'), $imageName);
                $file_path[] = $app_url . ":8000/assets/img/case_study/agency_images/" . $imageName;
                // $case_study->agency = $file_path;
            }
            $agency_files = implode('|', $file_path);
            $case_study->agency = $agency_files;
        }

        $save = $case_study->save();
        // $file_path=[];        



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
    public function show(CaseStudyDesktop $caseStudy)
    {
        return view('admin.case-study-desktop');
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
        $case_study = CaseStudyDesktop::find($request->id);
        $case_study->com_name = $request->name;
        $case_study->summary1 = $request->summary1;
        $case_study->summary2 = $request->summary2;
        $case_study->content = $request->content;
        // $case_study->service_id = $ser_id;
        $app_url = env('APP_URL');


        if ($request->image) {

            $fileName = time() . '.' . $request->image->getClientOriginalExtension();
            $request->image->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->com_image = $file_path;
        }

        if ($request->group_images_1) {

            $fileName = time() . '.' . $request->group_images_1->getClientOriginalExtension();
            $request->group_images_1->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_1 = $file_path;
        }
        if ($request->group_images_2) {

            $fileName = time() . '.' . $request->group_images_2->getClientOriginalExtension();
            $request->group_images_2->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_2 = $file_path;
        }
        if ($request->group_images_3) {

            $fileName = time() . '.' . $request->group_images_3->getClientOriginalExtension();
            $request->group_images_3->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_3 = $file_path;
        }
        if ($request->group_images_4) {

            $fileName = time() . '.' . $request->group_images_4->getClientOriginalExtension();
            $request->group_images_4->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_4 = $file_path;
        }
        if ($request->group_images_5) {

            $fileName = time() . '.' . $request->group_images_5->getClientOriginalExtension();
            $request->group_images_5->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_5 = $file_path;
        }
        if ($request->group_images_6) {

            $fileName = time() . '.' . $request->group_images_6->getClientOriginalExtension();
            $request->group_images_6->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_6 = $file_path;
        }
        if ($request->group_images_7) {

            $fileName = time() . '.' . $request->group_images_7->getClientOriginalExtension();
            $request->group_images_7->move(public_path('assets/img/case_study'), $fileName);
            $file_path = $app_url . ":8000/assets/img/case_study/" . $fileName;
            $case_study->group_images_7 = $file_path;
        }



        $file_path = array();
        if ($request->hasFile('agency_images')) {
            foreach ($request->file('agency_images') as $image) {
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('assets/img/case_study/agency_images'), $imageName);
                $file_path[] = $app_url . ":8000/assets/img/case_study/agency_images/" . $imageName;
                // $case_study->agency = $file_path;
            }
            $agency_files = implode('|', $file_path);
            $case_study->agency = $agency_files;
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
    public function destroy($id, CaseStudyDesktop $caseStudy)
    {
        $caseStudy = CaseStudyDesktop::find($id);

        $delete = $caseStudy->delete();

        if ($delete) {
            return response()->json(['success' => 'You have successfully delete Case Study.']);
        }
    }
}

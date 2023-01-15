<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\StartProject;
use Illuminate\Support\Facades\Mail;


class StartProjectController extends Controller
{
    public function index(Request $request)
    {

        return view('emails.startProject');
    }
    public function store(Request $request)
    {
        // dd($request->all());
        // $data=[]
        $company_email = env('MAIL_FROM_ADDRESS');
        $email = $request->email;
        $emails = [$email, $company_email];
        // dd($email);
        // $data = [
        //     
        //     // foreach($request->sub_category as $key=>$subCategory){
        //     //     // print_r($subCategory);
        //     //     // $sub_categories = $subCategory;
        //     //     echo 'Key:'.$key,'Value:'.$subCategory;
        //     // }
        //     // echo $sub_categories;
        // dd($request->sub_category);
        $name = $request->name;
        $phone = $request->phone;
        $category = $request->category;
        $sub_categories = $request->sub_category;
        // dd($sub_categories);
        //     'email' => $request->email,
        $help = $request->help;
        //     // 'title' => "Title";
        // ];
        // Mail::send('emails.startProject', ['data1' => $data], function ($message) use ($data) {
        //     $message->to($data['email']);
        //     //->attachData($pdf->output(), "ApplyOnline.pdf");
        // });
        try {
            Mail::to($emails)->send(new StartProject($email, $name, $phone, $category, $sub_categories, $help));
            return response()->json([
                "message" => "Mail sent"
            ]);
        } catch (Throwable $e) {
            report($e);

            return response()->json([
                'message' => "failsed to send mail"
            ]);
        }

        // die;
        // return view('emails.startProject',compact('category', 'sub_categories', 'name', 'phone', 'email', 'help'));
    }
    public function email(Request $request)
    {
        // Mail::to('megatanjib@gmail.com')->send(new StartProject());



        // if (Mail::failures()) {
        //     return response()->Fail('Sorry! Please try again latter');
        // } else {
        //     return response()->success('Great! Successfully send in your mail');
        // }
    }
}

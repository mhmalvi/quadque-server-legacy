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
        $email = $request->email;
        // dd($email);
        // $data = [
        //     
        //     // foreach($request->sub_category as $key=>$subCategory){
        //     //     // print_r($subCategory);
        //     //     // $sub_categories = $subCategory;
        //     //     echo 'Key:'.$key,'Value:'.$subCategory;
        //     // }
        //     // echo $sub_categories;
            $name = $request->name;
            $phone = $request->phone;
            $category = $request->category;
            $sub_categories = $request->sub_category;
        //     'email' => $request->email,
            $help = $request->help;
        //     // 'title' => "Title";
        // ];
        // Mail::send('emails.startProject', ['data1' => $data], function ($message) use ($data) {
        //     $message->to($data['email']);
        //     //->attachData($pdf->output(), "ApplyOnline.pdf");
        // });
        Mail::to($email)->send(new StartProject($email));
        
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

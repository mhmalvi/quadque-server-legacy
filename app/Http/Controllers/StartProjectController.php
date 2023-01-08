<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\StartProject;
use Illuminate\Support\Facades\Mail;


class StartProjectController extends Controller
{
    public function index(){
        return view('emails.startProject')->with('order ');
    }
    public function store(Request $request){
        Mail::to("megatanjib@gmail.com")->send(new StartProject($order));
    }
}

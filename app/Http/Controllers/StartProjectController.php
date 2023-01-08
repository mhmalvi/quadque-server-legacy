<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\StartProject;
use Illuminate\Support\Facades\Mail;


class StartProjectController extends Controller
{
    public function index(){
        return view('emails.startProject');
    }
    public function store(Request $request, StartProject $order){
        Mail::to("megatanjib@gmail.com")->send(new StartProject($order));
    }
}

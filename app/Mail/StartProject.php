<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StartProject extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $name;
    public $phone;
    public $category;
    public $sub_categories;
    public $help;
    // public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $phone, $category, $sub_categories, $help)
    {
        // echo $email;
        $this->email = $email;
        $this->name = $name;
        $this->phone = $phone;
        $this->category = $category;
        $this->sub_categories = $sub_categories;
        // ddd($this->sub_categories);
        $this->help = $help;
        // return $data=[
        //     'email'=> $email,
        //     'name' => $name,
        //     'phone' => $phone,
        //     'category' => $category,
        //     'sub_categories' => $sub_categories,
        //     'help' => $help,
        // ];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this
            ->subject('Thank you for subscribing')
            ->markdown('emails.startProject');
    }
}

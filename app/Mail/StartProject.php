<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StartProject extends Mailable
{
    use Queueable, SerializesModels;

    public $order = "first order";
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->from('tanjibrubyat@gmail.com', 'Tanjib')
            ->view('emails.startProject');
    }
}

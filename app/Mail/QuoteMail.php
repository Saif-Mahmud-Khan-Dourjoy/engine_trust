<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuoteMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $mainArr;
    public function __construct($mainArr)
    {
        $this->mainArr= $mainArr;
        
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        return $this->attachData($this->mainArr["pdf"]->output(), "quote.pdf")->view("user.test2")->subject('Quotation of your Query');
        // return $this->view("user.test2")->subject('Quotation of your Query');
        // dd($this->data);
    }
}

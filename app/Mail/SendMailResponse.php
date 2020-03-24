<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailResponse extends Mailable
{
    use Queueable, SerializesModels;
    public $data;

    public function __construct($data){
        $this->data = $data;
    }

    public function build(){
        return $this->from('pedroaal04@gmail.com', 'ServiGraf')->subject('Carta de presentación')->view('templates/contactResponse')->with('data', $this->data);
    }
}
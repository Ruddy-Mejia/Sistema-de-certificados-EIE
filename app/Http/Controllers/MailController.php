<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\Manager;
use App\Mail\Notice;
use App\Mail\Observed;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function notice($destinatario, $asunto, $mensaje){
        Mail::to($destinatario)->send(new Notice($mensaje, $asunto));
    }
    public function observed($destinatario, $asunto, $mensaje){
        Mail::to($destinatario)->send(new Observed($mensaje, $asunto));
    }
    public function manager($destinatario, $asunto, $mensaje){
        Mail::to($destinatario)->send(new Manager($mensaje, $asunto));
    }
}

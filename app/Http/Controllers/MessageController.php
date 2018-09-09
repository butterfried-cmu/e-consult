<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    //
    public function getMessageHistory($consult_id){

    }

    public function postSendMessage($consult_id){

    }

    public function getAttachmentList($consult_id){
        echo 'wow';
        return response()->json([
            'consult' => 'test'
        ], 200);
    }

    public function postSendAttachment($consult_id){

    }

    public function getDownloadAttachment($attachment_id){

    }
}

<?php

namespace App\Http\Controllers;

use App\Attachment;
use App\Message;
use Illuminate\Http\Request;
use Validator;
use JWTAuth;
use File;

class MessageController extends Controller
{
    //
    public function getMessageHistory($consult_id){
        $messages = [
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['consult_id' => $consult_id]), [
            'consult_id' => 'exists:consults',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $messages = Message::with('user')->where('consult_id', $consult_id)->get();

        return response()->json([
            'messages' => $messages,
        ], 200);
    }

    public function postSendMessage($consult_id){
        $request = request();

        $currentUser = JWTAuth::parseToken()->toUser();

        if (!$currentUser) return response()->json([
            'authentication' => 'fail',
        ], 200);

        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['consult_id' => $consult_id],$request->all()), [
            'consult_id' => 'exists:consults',
            'message' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $message_id = $this->generateMessageID();

        $message = new Message([
            'message_id' => $message_id,
            'consult_id' => $consult_id,
            'user_id' => $currentUser->user_id,
            'message' => $request->message
        ]);
        $message->save();

        return response()->json([
            'message' => 'success',
        ], 200);
    }

    public function getAttachmentList($consult_id){
        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['consult_id' => $consult_id]), [
            'consult_id' => 'exists:consults',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $attachments = Attachment::where('consult_id', $consult_id)->get();

        return response()->json([
            'attachments' => $attachments
        ], 200);
    }

    public function postSendAttachment($consult_id){
        $request = request();

        $messages = [
            'required' => 'required',
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['consult_id' => $consult_id],$request->all()), [
            'consult_id' => 'exists:consults',
            'attachments' => 'required',
//            'attachments_type' => 'required'
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $path = public_path().'/storage/attachments/' . $consult_id;
        if(!File::exists($path)) {
            // path does not exist
            File::makeDirectory($path, $mode = 0777, true, true);
        }

        $attachments = $request->attachments;
        $attachments_type = $request->attachments_type;

        foreach ($attachments as $key=>$attachment){

            if (strpos($attachment, 'data:image/png;base64,') !== false ||
                strpos($attachment, 'data:image/jpeg;base64,') !== false ){
                $type = 'image';
            }else{
                $type = 'file';
            }

            $attachment_id = $this->generateAttachmentID();

//            $data = 'data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAA.';
//            $data = $attachment;
//            $pos  = strpos($data, ';');
//            $file_type = explode(':', substr($data, 0, $pos))[1];

            $file_type = $request->attachments_type;

            $file_name = $attachment_id . '.' . $attachments_type[$key];
            \File::put(public_path(''). '/storage/attachments/' . $consult_id . '/' . $file_name, base64_decode($attachment));

            $new_attachment = new Attachment([
                'attachment_id' => $attachment_id,
                'consult_id' => $consult_id,
                'type' => $type,
                'file_name' => $file_name

            ]);
            $new_attachment->save();

        }

        return response()->json([
            'message' => 'success',
        ], 200);
    }

    public function getDownloadAttachment($attachment_id){
        $messages = [
            'exists' => 'not_exist',
        ];

        $validator = Validator::make(array_merge(['attachment_id' => $attachment_id]), [
            'attachment_id' => 'exists:attachments',
        ], $messages);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        $attachment = Attachment::where('attachment_id', $attachment_id)->first();

        return response()->download(public_path().'\storage\attachments\\' . $attachment->consult_id . '\\'.$attachment->file_name);
    }

    /**
     * Generate unique 'User' id
     *
     * @return int id
     */
    public function generateMessageID()
    {
        $id = uniqid();

        // call the same function if the barcode exists already
        if ($this->messageIDExists($id)) {
            return $this->generateMessageID();
        }

        // otherwise, it's valid and can be used
        return $id;
    }

    /**
     * Check if the generated 'User' id is existed in database
     *
     * @return boolean
     */
    public function messageIDExists($id)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Message::where('message_id', $id)->exists();
    }

    /**
     * Generate unique 'User' id
     *
     * @return int id
     */
    public function generateAttachmentID()
    {
        $id = uniqid();

        // call the same function if the barcode exists already
        if ($this->attachmentIDExists($id)) {
            return $this->generateAttachmentID();
        }

        // otherwise, it's valid and can be used
        return $id;
    }

    /**
     * Check if the generated 'User' id is existed in database
     *
     * @return boolean
     */
    public function attachmentIDExists($id)
    {
        // query the database and return a boolean
        // for instance, it might look like this in Laravel
        return Attachment::where('attachment_id', $id)->exists();
    }
}

<?php

namespace Modules\MessageCenter\Http\Controllers;

use App\Services\EmailService;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\MessageCenter\Entities\ContactUs;

class MessageCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('messagecenter::index');
    }

    public function send_message(Request $request)
    {
        //dd('nn');
        $name = ucwords($request->input('name'));
        $email = $request->input('email');
        $subject = ucwords($request->input('subject'));
        //$to_email = $request->input('to_email');
        $to_email = 'fredrick.owuor2014@gmail.com';
        $message = $request->input('message');

        $contact_us = new ContactUs();
        $contact_us->name = $name;
        $contact_us->email = $email;
        $contact_us->subject = $subject;
        $contact_us->message = $message;
        $contact_us->to_email = $to_email;

        $contact_us->save();

        $from = $email;
        $from_name = $name;
        $to = $to_email;

        $headers = 'From: ' . $from_name . '<' . $from . '>' . "\r\n";
        mail($to, $subject, $message, $headers);

        $data = [
            'subject' => $subject,
            'name' => $name,
            'email' => $email,
            'message_content' => $message
        ];

        $email = EmailService::sendEmail($to,  'New Inquiry From Website', 'emails.contact', $data);

        return response()->json(['message' => 'Message sent successfully.'], 200);
    }

    public function send_message_client(Request $request)
    {
        //dd('nn');
        $name = ucwords($request->input('name'));
        $email = $request->input('email');
        $phone = $request->input('phone');
        $subject = ucwords($request->input('subject'));
        $to_email = 'fredrick.owuor2014@gmail.com';
        $message = $request->input('message');

//        $contact_us = new ContactUs();
//        $contact_us->name = $name;
//        $contact_us->email = $email;
//        $contact_us->subject = $subject;
//        $contact_us->message = $message;
//        $contact_us->to_email = $to_email;
//
//        $contact_us->save();

        $from = $email;
        $from_name = $name;
        $to = $to_email;

        $headers = 'From: ' . $from_name . '<' . $from . '>' . "\r\n";
        mail($to, $subject, $message, $headers);

        $data = [
            'subject' => $subject,
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'message_content' => $message
        ];

        $email = EmailService::sendEmail($to,  'New Inquiry From Main Website', 'emails.contact-client', $data);

        return response()->json(['message' => 'Message sent successfully.'], 200);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('messagecenter::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('messagecenter::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('messagecenter::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}

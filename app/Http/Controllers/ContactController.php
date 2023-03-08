<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Contact;
use App\Models\meal;
use App\Notifications\NewMessageNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
        public function index(Request $request)
        {
            // $this->authorize('viewAny' ,Contact::class);
            $contacts=Contact::all();
            Auth()->user()->notifications()->where('type','=','App\Notifications\NewMessageNotification')->get()->markAsRead();
            if($request->has('contact_id'))
            $contacts=Contact::where('id','=',$request->input('contact_id'))->get();
    
            return response()->view('cms.contact.index',['contacts'=>$contacts]);
        }
    







        // $meals=Meal::all();
        // $highestratings = $meals->filter(function($meal){
        //     return $meal->reviewmeals->avg('rate') == 3 || $meal->reviewmeals->avg('rate') == 4;
        // });
        // $latestmeals=meal::orderby('created_at','DESC')->take(6)->get();


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('front.contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email',
            'subject' => 'required|string|min:3',
            'message' => 'required|string|min:3',
   
        ]);

        if (!$validator->fails()) {
            $contact = new Contact();
            $contact->name = $request->input('name');
            $contact->email = $request->input('email');
            $contact->subject =  $request->input('subject');
            $contact->message = $request->input('message');

            $isSaved = $contact->save();
            if ($isSaved)
                // Mail::to('saw@gmail.com')->send(new ContactEmail($contact));
               
                $admins=Admin::all();
                foreach ($admins as $admin) {
                    $admin->notify(new NewMessageNotification($contact));
                }
                // dd($admin);
                 return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
       } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        //
    }
}

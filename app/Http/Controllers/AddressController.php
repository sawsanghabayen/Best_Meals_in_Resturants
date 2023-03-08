<?php

namespace App\Http\Controllers;

use App\Models\address;
use App\Models\Cart;
use App\Models\meal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $addresses =$request->user()->addresses()->get();
     
        
        if(auth('user')->check()) 
        $meals=meal::all();
        $highestratings = $meals->filter(function($meal){
            return $meal->reviewmeals->avg('rate') == 5 || $meal->reviewmeals->avg('rate') == 4;
        });

            $carts=Cart::with('meal')->where('user_id' ,'=' ,$request->user()->id)->get();
        // $carts=$request->user()->cartmeals()->
        $latestmeals=meal::orderby('created_at','DESC')->take(6)->get();

        return response()->view('front.address',['addresses'=>$addresses ,'highestratings'=>$highestratings ,'carts'=>$carts ,'latestmeals'=>$latestmeals]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'area' => 'required|string|min:3',
            'street' => 'required|string|min:3',
            'building' => 'required|string|min:3',
            'flate_num' => 'required|string|min:3',
        ]);

        if (!$validator->fails()) {
            $address = new Address();
            // $address->name = $request->input('name');
            $address->name = $request->input('name');
            $address->area = $request->input('area');
            $address->street = $request->input('street');
            $address->building = $request->input('building');
            $address->flate_num = $request->input('flate_num');
            $isSaved = $request->user()->addresses()->save($address);
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
     * @param  \App\Models\address  $address
     * @return \Illuminate\Http\Response
     */
    public function show(address $address)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\address  $address
     * @return \Illuminate\Http\Response
     */
    public function edit(address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\address  $address
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, address $address)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\address  $address
     * @return \Illuminate\Http\Response
     */
    public function destroy(address $address)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;


use App\Models\Meal;
use App\Models\Order_Review;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OrderReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $order_reviews= order_Review::with('meal','user')->get();
        // dd($order_reviews);
      
        if($request->has('meal_id')){
            $meals= Meal::where('id' ,'=' , $request->input('meal_id'))->get();
            // $order= Order_Review::all();
            //  $order_reviews= order_Review::with('meal')->with('user')->
            //     where('meal_id' ,'=' , $request->input('meal_id'))->get();
    
          
          

            return response()->view('front.detail', ['meals' => $meals /* ,'order_reviews' =>$order_reviews */ ]);

        }
    
      
      

         
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
        // $validator = Validator($request->all(), [
        //     'meal_id' =>'required|numeric|exists:meals,id',
        //     'message' => 'required',
      
        // ]);

        // if (!$validator->fails()) {
        //     $meal = Meal::find($request->meal_id);
        //     dd($meal);
        //     if (!is_null($meal)) {
        //         if (!$request->user()->orderreviews()->where('meal_id', $meal->id)->exists()) {
        //             $order_review = new order_Review();
        //             $order_review->comment = $request->input('message');
        //             $order_review->rate = $request->rate;
        //             $order_review->meal_id= $request->meal_id;
        //             $order_review->user_id= $request->user()->id;
               
        //             $isSaved = $order_review->save();
        //             if ($isSaved)
        //             return response()->json(['message' => 'review  your added']);
        //         // } else {

        //         //     // $isSaved = $request->user()->mealscart()->detach($meal);
        //         //     if ($isSaved)
        //         //     return response()->json(['message' => 'Meal cart deleted']);
        //         // }
        //     } else {
        //         return response()->json(['message' => 'review Not Found']);
        // }}
        // else {
        //     return response()->json(
        //         ['message' => $validator->getMessageBag()->first()],
        //         Response::HTTP_BAD_REQUEST,
        //     );
        // }
        // }}

        if(auth('user')->check()){

     
        $validator = Validator($request->all(), [
            'message' => 'required|string|min:3',

        ]);

        if (!$validator->fails()) {

            $orderreview = new Order_Review();
        
            $orderreview->comment = $request->input('message');
            $orderreview->rate = $request->rate;
            $orderreview->meal_id = $request->meal_id;
            $orderreview->user_id = $request->user_id;

            $isSaved = $orderreview->save();
            
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
    }}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order_review  $order_review
     * @return \Illuminate\Http\Response
     */
    public function show(order_review $order_review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order_review  $order_review
     * @return \Illuminate\Http\Response
     */
    public function edit(order_review $order_review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order_review  $order_review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order_review $order_review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order_review  $order_review
     * @return \Illuminate\Http\Response
     */
    public function destroy(order_review $order_review)
    {
        //
    }
}

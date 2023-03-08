<?php

namespace App\Http\Controllers;

use App\Models\ReviewMeals;
use App\Models\Meal;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewMealsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // dd(111);
        if($request->has('meal_id')){
            $allmeals=Meal::all();
            $meals= Meal::where('id' ,'=' , $request->input('meal_id'))->get();
        
            $highestratings = $allmeals->filter(function($meal){
                return $meal->reviewmeals->avg('rate') == 5 || $meal->reviewmeals->avg('rate') == 4;
            });
           

            $reviewMeals= ReviewMeals::with('Meal','User')->where('meal_id' ,'=' , $request->input('meal_id'))->get();
            
      
            

            return response()->view('front.detail', ['highestratings' =>$highestratings ,'meals' => $meals ,'reviewMeals' =>$reviewMeals  ]);

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
        //
        if(auth('user')->check()){

     
            $validator = Validator($request->all(), [
                'message' => 'required|string|min:3',
    
            ]);
    
            if (!$validator->fails()) {
    
                $review = new ReviewMeals();
            
                $review->comment = $request->input('message');
                $review->rate = $request->rate;
                $review->meal_id = $request->meal_id;
                $review->user_id = $request->user_id;
    
                $isSaved = $review->save();
                
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
     * @param  \App\Models\ReviewMeals  $reviewMeals
     * @return \Illuminate\Http\Response
     */
    public function show(ReviewMeals $reviewMeals)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReviewMeals  $reviewMeals
     * @return \Illuminate\Http\Response
     */
    public function edit(ReviewMeals $reviewMeals)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReviewMeals  $reviewMeals
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReviewMeals $reviewMeals)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReviewMeals  $reviewMeals
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReviewMeals $reviewMeals)
    {
        //
    }
}

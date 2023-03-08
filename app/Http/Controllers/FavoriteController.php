<?php

namespace App\Http\Controllers;

use App\Models\favorite;
use App\Models\meal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FavoriteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $favorites=$request->user()->meals;
        $latestmeals=Meal::orderby('created_at','DESC')->take(6)->get();
     
        return response()->view('front.favorite',['favorites'=>$favorites,'latestmeals'=>$latestmeals]);
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
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
            'meal_id' =>'required|numeric|exists:meals,id'

        ]);

        if (!$validator->fails()) {
            $meal = Meal::find($request->meal_id);
            if (!is_null($meal)) {
                if (!$request->user()->favorites()->where('meal_id', $meal->id)->exists()) {
                    $isSaved = $request->user()->meals()->save($meal);
                    if ($isSaved)
                    return response()->json(['message' => 'Meal favorite added']);
                } else {

                    $isSaved = $request->user()->meals()->detach($meal);
                    if ($isSaved)
                    return response()->json(['message' => 'Meal favorite deleted']);
                }
            } else {
                return response()->json(['message' => 'Meal Not Found']);
        }}
        else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function show(favorite $favorite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function edit(favorite $favorite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, favorite $favorite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\favorite  $favorite
     * @return \Illuminate\Http\Response
     */
    public function destroy(favorite $favorite)
    {
        //
    }
}

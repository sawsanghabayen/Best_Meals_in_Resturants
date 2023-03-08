<?php

namespace App\Http\Controllers;

use App\Models\meal;
use App\Models\order;
use App\Models\OrderMeal;
use App\Models\User;
use Illuminate\Http\Request;

class OrderMealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if(auth('user')->check()){
            $meals = Meal::all();
            $highestratings = $meals->filter(function($meal){
                return $meal->reviewmeals->avg('rate') == 5 || $meal->reviewmeals->avg('rate') == 4;
            });
            $detailsorders = OrderMeal::where('order_id','=', $request->input('order_id'))->get();
            $latestmeals=Meal::orderby('created_at','DESC')->take(6)->get();

        // dd($detailsorders);
        return response()->view('front.detailsorder',['detailsorders'=>$detailsorders ,'highestratings'=>$highestratings ,'latestmeals'=>$latestmeals]);
    }

        elseif(auth('resturant')->check())
            // $detailsorders = OrderMeal::with(['order' ,'meal'])->where('order_id','=',$request->input('order_id'))->get();
            $detailsorders = OrderMeal::whereHas('meal' , function ($query) use($request) {
                    $query->where('resturant_id', '=', $request->user()->id);
                })->where('order_id','=',$request->input('order_id'))->get();
        else
        $detailsorders = OrderMeal::where('order_id','=',$request->input('order_id'))->get();
        return response()->view('cms.ordermeals',['detailsorders'=>$detailsorders]);
    

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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderMeal  $OrderMeal
     * @return \Illuminate\Http\Response
     */
    public function show(OrderMeal $OrderMeal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderMeal  $OrderMeal
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderMeal $OrderMeal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OrderMeal  $OrderMeal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, OrderMeal $OrderMeal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderMeal  $OrderMeal
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderMeal $OrderMeal)
    {
        //
    }
}

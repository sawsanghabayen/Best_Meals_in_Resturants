<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\order;
use App\Models\Resturant;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth('admin')->check()){
            $orders = order::all();
            $resturants = Resturant::all();
            $users = User::all();
            $admins = Admin::all();
            return response()->view('cms.index', ['orders' => $orders,'resturants' => $resturants,'users' => $users,'admins' => $admins]);

            
        }
        elseif(auth('resturant')->check()){
            $orders=order::whereHas('meals', function ($query) use($request) {
                $query->where('resturant_id', '=', $request->user()->id);
            })->get();
            $resturants = Resturant::all();
            $users = User::all();
            // $meals=Meal::where('resturant_id' ,'=' ,$request->user()->id)->get();
            // return response()->view('cms.meals.index', ['meals' => $meals]);
            
            return response()->view('cms.index', ['orders' => $orders,'resturants' => $resturants,'users' => $users]);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

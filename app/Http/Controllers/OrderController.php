<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Cart;
use App\Models\order;
use App\Models\OrderMeal;
use App\Models\Resturant;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewOrderNotification;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if(auth('user')->check()){
            // $meals=$request->user()->meals->get();
            $orders=order::where('user_id' ,'=' ,$request->user()->id)->get();
            return response()->view('front.order',['orders'=>$orders]);
    }
    if(auth('resturant')->check())
        $orders=order::whereHas('meals', function ($query) use($request) {
        $query->where('resturant_id', '=', $request->user()->id);
    })->get();
    // return response()->view('front.order',['orders'=>$orders]);


    else
    $orders=order::all();
    Auth()->user()->notifications()->where('type','=','App\Notifications\NewOrderNotification')->get()->markAsRead();
            // dd($orders);
            return response()->view('cms.orders.index2',['orders'=>$orders]);
         
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
            'total' => 'required',
             'address_id' => 'required|numeric|exists:addresses,id',
        ]);

        if (!$validator->fails()) {
            $order = new Order();
            $order->total = $request->total;
            $order->address_id = $request->input('address_id');
            $order->date = Carbon::now()->format('Y-m-d H:i:s');
            $isSaved = $request->user()->orders()->save($order);
            if($isSaved){
            $admins=Admin::all();
            
            foreach ($admins as $admin) {
                $admin->notify(new NewOrderNotification($order));
            }
            // $orderRest= order::whereHas('meals', function ($query) use($request) {
            //     $query->where('resturant_id', '=', $request->user()->id);
            // })->get();
            // $resturants=Resturant::all();
            // foreach ($resturants as $resturant) {
            //     $resturant->notify(new NewOrderNotification($order));
            // }
        }
            $cartmeals=Cart::where('user_id' ,'=' , $request->user()->id)->get();
            // dd($cartmeals);
            foreach($cartmeals as $cartmeal){
                $order_meal = new OrderMeal();

                    $order_meal->order_id = $order->id;
                    $order_meal->meal_id = $cartmeal->meal_id;
                    $order_meal->quantity = $cartmeal->quantity;
                    $isSaved = $order_meal->save();
            }

            Cart::destroy($cartmeals);
            return response()->json(
                ['message' => $isSaved ? 'Order Saved successfully' : 'Order Save failed!'],
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
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(order $order)
    {
        return response()->view('cms.orders.edit', ['order' => $order]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
            $this->authorize('update' ,$order);
        $validator = Validator($request->all(), [
            'status'=>'required|in:Waitting,Processing,Delivered',

        ]);

        if (!$validator->fails()) {
            $order->status = $request->input('status');
         
            $isSaved = $order->save();
            return response()->json(
                ['message' => $isSaved ? 'Saved successfully' : 'Save failed!'],
                $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST,
            );
        }    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        $deleted = $order->delete();
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'Order deleted successfully' : 'Order deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        ); 
       }
       public function updateOrderStatus($order_id,$status)
{
	$order = Order::find($order_id);
	$order->status = $status;
	if($status == "delivered")
	{
		$order->status = 'delivered';
	}
	else if($status == "canceled")
	{
		$order->status = 'canceled';
	}
	$order->save();
	session()->flash('order_message','Order status has been updated successfully!');
}
}

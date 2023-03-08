<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\ReviewMeals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function showproduct(Request $request)
    {
        $latestmeals=Meal::orderby('created_at','DESC')->take(6)->get();
        $meals=Meal::all();
        $highestratings =$meals->filter(function($meal){
            return $meal->reviewmeals->avg('rate') == 5 || $meal->reviewmeals->avg('rate') == 4;
        }); 
         return response()->view('front.index', ['highestratings' => $highestratings ,'latestmeals' => $latestmeals  ]);
            // dd($productsFiltered);


    //     $meals = Meal::with( 'reviewmeals')
    // ->leftJoin('review_meals', 'review_meals.meal_id', '=', 'meals.id')
    // ->select(['meals.*',
    //     DB::raw('AVG(review_meals.rate) as ratings_average')
    //     ])
    // ->where('ratings_average', 5)
    // ->get();
    
    
        // $avgRating= meal::with('reviewmeals')->avg('rating');
        // // dd($avgRating);
        //    $latestmeals=Meal::orderby('created_at','DESC')->take(6)->get();
            // return response()->view('front.index', ['latestmeals' => $latestmeals ]);    

        //  $meals=Meal::where('avg_rating' ,'=','3')->get();
        //    $highestrating=ReviewMeals::with('meal')->( );
        //    $highestrating=Meal::with('reviewmeals',function ($query) {
        //         $query->avg('rate');
        //     })->take(6)->get();
            // dd($highestrating);

        // $meals = Meal::all();
        // $avg = $meals[0]->avg_rating; 
        // dd($avg);

//         SELECT p.*, AVG(r.rating) as average_rating
// FROM products as p
// INNER JOIN reviews as r ON r.product_id = p.id
// GROUP BY p.id
// ORDER BY average_rating DESC
// LIMIT 5
            // return response()->view('front.index', ['highestrating' => $highestrating ]);    

    }
}

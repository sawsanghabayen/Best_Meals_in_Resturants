<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class MealController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {

        $this->authorizeResource(Meal::class, 'meal'
        , ['except' => [ 'index']]);
    }

    public function index(Request $request)
    {
        if(auth('admin')->check()){
            $meals = Meal::all();
            return response()->view('cms.meals.index', ['meals' => $meals]);

        }
        elseif(auth('resturant')->check()){
            // $meals=$request->user()->meals->get();
            
            $meals=Meal::where('resturant_id' ,'=' ,$request->user()->id)->get();
            return response()->view('cms.meals.index', ['meals' => $meals]);

        }


         else{
                    // $meals=meal::all();
                    $model = Meal::with('category' ,'resturant');
                    $title=$request->input('title');
                    $title1=$request->input('title1');
                    $price_from=$request->input('price_from');
                    $price_to=$request->input('price_to');
                    $category_id=$request->input('category');

                    if($title){
                        $model->where('title' ,'LIKE', "%$title%");
                    }
                    if($title1){
                        $model->where('title' ,'LIKE', "%$title1%");
                    }
                    if($price_from){
                        $model->where('price' ,'>=', $price_from);
                    }
                    if($price_to){
                        $model->where('price' ,'<=', $price_to);
                    }
                    if($category_id){
                        $model->where('category_id' ,'=', $category_id);
                    }
                
                    $categories=Category::all();
                    $latestmeals=Meal::orderby('created_at','DESC')->take(6)->get();
                    $allmeals=Meal::all();
                    $meals =$model->get();
                    // dd($meals);

                    $highestratings = $allmeals->filter(function($meal){
                        return $meal->reviewmeals->avg('rate') == 3 || $meal->reviewmeals->avg('rate') == 4;
                    });
                    if($request->has('category_id')){
                        $meals =Meal::where('category_id','=',$request->input('category_id'))->get();
                    }
                    elseif($request->has('rest_id')){
                        $meals =Meal::where('resturant_id','=',$request->input('rest_id'))->get();
                    }

                    return response()->view('front.meal', ['categories' => $categories,'meals' => $meals,'highestratings' => $highestratings,'latestmeals' => $latestmeals]);
                }

       
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();

        return response()->view('cms.meals.create',['categories'=>$categories]);    
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
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'price' => 'required',
            'image' => 'required|image|mimes:png,jpg,jpeg',

        ]);

        if (!$validator->fails()) {
            $meal = new Meal();
            $meal->category_id= $request->input('category_id');
            $meal->title = $request->input('title');
            $meal->description = $request->input('description');
            $meal->price = $request->input('price');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imagetitle =  time().'_meal_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/meals', $imagetitle);
                $imagePath = 'images/meals/' . $imagetitle;
                $meal->image = $imagePath;
            }
            $isSaved = $request->user()->meals()->save($meal);
            if ($isSaved) return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_CREATED : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }  
      }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function show(Meal $meal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function edit(meal $meal)
    {

        $categories=Category::all();

        return response()->view('cms.meals.edit',['categories'=>$categories ,'meal'=>$meal]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Meal $meal)
    {
        $validator = Validator($request->all(), [
            'category_id' => 'required|numeric|exists:categories,id',
            'title' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'price' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',

        ]);

        if (!$validator->fails()) {
            $meal->category_id= $request->input('category_id');
            $meal->title = $request->input('title');
            $meal->description = $request->input('description');
            $meal->price = $request->input('price');
            if ($request->hasFile('image')) {
                //Delete category previous image.
                Storage::delete($meal->image);
                //Save new image.
                $file = $request->file('image');
                $imageName = time(). '_category_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/categories', $imageName);
                $imagePath = 'images/categories/' . $imageName;
                $meal->image = $imagePath;
            }
            $isSaved = $request->user()->meals()->save($meal);
            if ($isSaved) return response()->json([
                'message' => $isSaved ? 'Saved successfully' : 'Save failed!'
            ], $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST);
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\meal  $meal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Meal $meal)
    {
        $deleted = $meal->delete();
        if ($deleted) {
            Storage::delete($meal->image);
        }
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'User deleted successfully' : 'User deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}

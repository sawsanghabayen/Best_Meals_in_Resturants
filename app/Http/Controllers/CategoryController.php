<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\meal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->authorizeResource(Category::class, 'category'
        , ['except' => [ 'index' ,'show']]);
    }

    public function index(Request $request)
     {
        $meals=Meal::all();
        $highestratings = $meals->filter(function($meal){
            return $meal->reviewmeals->avg('rate') == 3 || $meal->reviewmeals->avg('rate') == 4;
        });
        $latestmeals=meal::orderby('created_at','DESC')->take(6)->get();
        $categories = Category::all();
        if (Auth::guard('admin')->check()){
         return response()->view('cms.categories.index', ['categories' => $categories]);
        }

        else{
            // $categories = Category::all();
           
            // $meals=Meal::all();
            // $category_id=$request->input('category');
           


            // if($category_id){
            //     $categories =Category::where('id' ,'=', $category_id)->first();

        
            // }
            // dd($categories);
        
        return response()->view('front.category', ['categories' => $categories ,'highestratings' => $highestratings ,'latestmeals' => $latestmeals]);
}}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response()->view('cms.categories.create');
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
            'description' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        

        if (!$validator->fails()) {
            $category = new Category();
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName =  time().'_category_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/categories', $imageName);
                $imagePath = 'images/categories/' . $imageName;
                $category->image = $imagePath;
            }
            
            $isSaved = $category->save();
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
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        $meals = Meal::all();
        $highestratings = $meals->filter(function($meal){
            return $meal->reviewmeals->avg('rate') == 5 || $meal->reviewmeals->avg('rate') == 4;
        });
        //  $categories = Category::all();
         $latestmeals=meal::orderby('created_at','DESC')->take(6)->get();
        $categories=Category::where('id','=',$category)->get();
        // dd($categories);
       return response()->view('front.category', ['categories' => $categories ,'highestratings' => $highestratings ,'latestmeals' => $latestmeals]);


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return response()->view('cms.categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'description' => 'required|string|min:3',
            'image' => 'required|image|mimes:png,jpg,jpeg',
        ]);
        if (!$validator->fails()) {
            $category->name = $request->input('name');
            $category->description = $request->input('description');
            if ($request->hasFile('image')) {
                //Delete category previous image.
                Storage::delete($category->image);
                //Save new image.
                $file = $request->file('image');
                $imageName = time() . '_category_image.' . $file->getClientOriginalExtension();
                $request->file('image')->storePubliclyAs('images/categories', $imageName);
                $imagePath = 'images/categories/' . $imageName;
                $category->image = $imagePath;
            }
            $isSaved = $category->save();
            return response()->json(
                ['message' => $isSaved ? 'Updated Successfully' : 'Update failed!'],
                $isSaved ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
            );
        } else {
            return response()->json(['message' => $validator->getMessageBag()->first()], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $deleted = $category->delete();
        if ($deleted) {
            Storage::delete($category->image);
        }
        return response()->json(
            [
                'title' => $deleted ? 'Deleted!' : 'Delete Failed!',
                'text' => $deleted ? 'Category deleted successfully' : 'Category deleting failed!',
                'icon' => $deleted ? 'success' : 'error'
            ],
            $deleted ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
    }


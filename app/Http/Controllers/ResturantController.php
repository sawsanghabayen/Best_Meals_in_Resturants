<?php

namespace App\Http\Controllers;

use App\Models\Resturant;
use App\Models\City;
use App\Models\meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Permission\Models\Permission;
use Illuminate\Validation\Rules\Password as RulesPassword;

use Illuminate\Support\Facades\Storage;


class ResturantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->authorizeResource(Resturant::class, 'resturant'
        // , ['except' => [ 'index']]);    
    }

    public function index()
    {
       

        if (Auth::guard('admin')->check()){
        $restaurants=Resturant::withcount('permissions')->get();
        
        return response()->view('cms.restaurants.index', ['restaurants' => $restaurants]);
    }
    else{
        $meals=meal::all();
        $highestratings = $meals->filter(function($meal){
            return $meal->reviewmeals->avg('rate') == 3 || $meal->reviewmeals->avg('rate') == 4;
        });
        $latestmeals=meal::orderby('created_at','DESC')->take(6)->get();
        $resturants=Resturant::all();
        return response()->view('front.about', ['resturants' => $resturants, 'highestratings' => $highestratings,'latestmeals' => $latestmeals]);

    }
    // $avgRating= ReviewMeals::where('meal_id' ,'=' , $request->input('meal_id'))->avg('rate');


}

    public function editRestPermissions(Request $request, Resturant $resturant)
    {
        $permissions = Permission::where('guard_name', '=', 'resturant')->get();
        $resturantPermissions = $resturant->permissions;
        if (count($resturantPermissions) > 0) {
            foreach ($permissions as $permission) {
                $permission->setAttribute('assigned', false);
                foreach ($resturantPermissions as $resturantPermission) {
                    if ($permission->id == $resturantPermission->id) {
                        $permission->setAttribute('assigned', true);
                    }
                }
            }
        }
        return response()->view('cms.restaurants.rest-permissions', ['resturant' => $resturant, 'permissions' => $permissions]);
    }

    /**
     * Update resturant permissions.
     *
     * @return \Illuminate\Http\Response
     */
    public function updateRestPermissions(Request $request, Resturant $resturant)
    {
        $validator = Validator($request->all(), [
            'permission_id' => 'required|numeric|exists:permissions,id',
        ]);

        if (!$validator->fails()) {
            $permission = Permission::findOrFail($request->input('permission_id'));
            if ($resturant->hasPermissionTo($permission)) {
                $resturant->revokePermissionTo($permission);
            } else {
                $resturant->givePermissionTo($permission);
            }
            return response()->json(
                ['message' => 'resturant updated successfully'],
                Response::HTTP_OK
            );
        } else {
            return response()->json(
                ['message' => $validator->getMessageBag()->first()],
                Response::HTTP_BAD_REQUEST
            );
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::where('active', '=', true)->get();
        return response()->view('cms.restaurants.create', ['cities' => $cities]);

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
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:resturants',
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'city_id' => 'required|numeric|exists:cities,id',
            'address'=>'required|string|min:3',
            'password'   =>         [
                'required',
                RulesPassword::min(8)
                    ->symbols()
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->uncompromised(),
            ],

        ]);

        if (!$validator->fails()) {
            $restaurant = new Resturant();
            $restaurant->name = $request->input('name');
            $restaurant->email = $request->input('email');
            if (Auth::guard('admin')->check())
            $restaurant->password = Hash::make('Admin1234$');
            else
            $restaurant->password = Hash::make($request->input('password'));

            $restaurant->mobile = $request->input('mobile');
            $restaurant->telephone = $request->input('telephone');
            $restaurant->city_id = $request->input('city_id');
            $restaurant->address = $request->input('address');
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imagetitle =  time().'_resturant_image.' . $file->getClientOriginalExtension();
                $status = $request->file('image')->storePubliclyAs('images/resturants', $imagetitle);
                $imagePath = 'images/resturants/' . $imagetitle;
                $restaurant->image = $imagePath;
            }
            $isSaved = $restaurant->save();
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
     * @param  \App\Models\resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function show(resturant $resturant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function edit(resturant $resturant)
    {
        $cities = City::where('active', '=', true)->get();
        return response()->view('cms.restaurants.edit',['resturant' => $resturant ,'cities' => $cities]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, resturant $resturant)
    {
        $validator = Validator($request->all(), [
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:resturants,email,' . $resturant->id,
            'mobile' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'telephone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:7',
            'city_id' => 'required|numeric|exists:cities,id',
            'address'=>'required|string|min:3',

        ]);

        if (!$validator->fails()) {
            $resturant->name = $request->input('name');
            $resturant->email = $request->input('email');
            $resturant->password = Hash::make('password');
            $resturant->mobile = $request->input('mobile');
            $resturant->telephone = $request->input('telephone');
            $resturant->city_id = $request->input('city_id');
            $resturant->address = $request->input('address');
            $isSaved = $resturant->save();
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\resturant  $resturant
     * @return \Illuminate\Http\Response
     */
    public function destroy(resturant $resturant)
    {
        $deleted = $resturant->delete();
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

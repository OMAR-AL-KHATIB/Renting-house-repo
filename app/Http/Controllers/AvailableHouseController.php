<?php

namespace App\Http\Controllers;

use App\Models\Available_Houses;
use App\Models\House_State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailableHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    $available_houses=Available_Houses::all();
    return response()->json($available_houses,200);
    }
public function filtered_houses(Request $request)
    {
    $available_houses=Available_Houses::all();
    return response()->json($available_houses,200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id = Auth::user()->id;
        $validatedata = $request->validate([
            'city' => 'string|required',
            'price' => 'integer|required',
            'is_available' => 'required|boolean',
            'expire_at' => 'nullable|required_if:is_available,true|date',
            'government' => 'string|required',
            'details' => 'string|nullable',
            'image' => 'image|required|mimes:png,jpeg,jpg,gif',
            'admin_acception' => 'required|boolean'
        ]);
        $validatedata['user_id'] = $user_id;
        if ($request->hasFile('image'))
            $path = $request->File('image')->getClientOriginalName();
        request()->File('image')->storeAs('avatars', $path, 'public');
        $validatedata['image'] = $path;
        if ($validatedata['admin_acception'] == true) {
            $house = Available_Houses::create($validatedata);
            return response()->json($house, 201);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

   $house=Available_Houses::findOrFail($id);
        return response()->json($house,200);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request)
    {
        }

    /**
     * Remove the specified resource from storage.
     */

    public function filterHouses(Request $request){
$price=$request->input('price');
$government=$request->input('government');
$city=$request->input('city');
$details=$request->input('details');

        $houses=Available_Houses::query()
            ->when($government,function($query) use ($government) {
                return $query->where(function ($q) use ($government){
                    $q->where('government','like',"%{$government}%");
                });
        })->when($price,function($query) use ($price) {
                return $query->where(function ($q) use ($price){
                    $q->where('price','==',$price);
                });
        })->when($government,function($query) use ($city) {
                return $query->where(function ($q) use ($city){
                    $q->where('city','like',"%{$city}%");
                });
        })->when($government,function($query) use ($details) {
                return $query->where(function ($q) use ($details){
                    $q->where('details','like',"%{$details}%");
                });
        })->get();

        return response()->json($houses,200);

    }


    public function destroy(string $id)
    {

    }

}

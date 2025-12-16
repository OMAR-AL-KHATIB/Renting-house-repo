<?php

namespace App\Http\Controllers;

use App\Models\Available_Houses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailableHouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user_id=Auth::user()->id;
        $validatedata=$request->validate([
            'is_available'=>'required|boolean',
            'expire_at'=>'nullable|required_if:is_available,true|date',
            'address'=>'string|required',
            'details'=>'string|nullable',
            'image'=>'image|required|mimes:png,jpeg,jpg,gif'
        ]);
$validatedata['user_id']=$user_id;
if($request->hasFile('image'))
    $path=$request->File('image')->getClientOriginalName();
request()->File('image')->storeAs('avatars',$path,'public');
$validatedata['image']=$path;
$house = Available_Houses::create($validatedata);
    return response()->json($house,201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $vlaidatedata=$request->validate([
        'is_available'=>'required|boolean',
        'expire_at'=>'nullable|required_if:is_available,true|date'
        ]);
        $user_id=Auth::user()->id;
        $validatedata['user_id']=$user_id;
        $new_house_state=Available_Houses::update($vlaidatedata);
        return response()->json($new_house_state,201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

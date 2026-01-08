<?php

namespace App\Http\Controllers;

use App\Models\House_State;
use Illuminate\Http\Request;

class HouseStateController extends Controller
{

    public function store(Request $request){
        $house_id=Auth::Available_Houses()->id;
        $validation=$request->validate([
                'state=>boolean|required',
                'start=>date|required',
                'end=>date|required',
                ] );
                    $validation['available_houses_id']=$house_id;


            $state=House_State::create($validation);
            return response()->json($state,200);
    }

    public function update(Request $request){
        $house_id=Auth::Available_Houses()->id;
        $validation=$request->validate([
            'state=>boolean',
            'start_time=>date',
            'end_time=>date',
            ]);
        $validation['available_houses_id']=$house_id;
        $new_state=House_State::update($validation);
        return response()->json($new_state,201);
    }

    public function getHouseStates($id){
        $states=House_State::findOrFail($id)->states;
        return response()->json($states,201);
    }

    public function destroy(){

        }
    }

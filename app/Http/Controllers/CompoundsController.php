<?php

namespace App\Http\Controllers;

use App\Compound;
use App\District;
use Illuminate\Http\Request;
use Validator;

class CompoundsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'a_name' => 'required',
            'district_id' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter name in English',
            'a_name.required' => 'Please enter name in Arabic',
            'district_id.required' => 'Please select district from dropdown'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['data' => '', 'message' => $validator, 'success' => 0], 200);
        }

        $compound = new Compound;
        $compound->name = $request->name;
        $compound->a_name = $request->a_name;
        $compound->district_id = $request->district_id;
        if($compound->save()) {
            return response()->json(['data' => '', 'message' => 'Compound created successfully.', 'success' => 1], 201);
        } else {
            return response()->json(['data' => '', 'message' => 'Something went wrong.', 'success' => 0], 200);
        }
    }
}

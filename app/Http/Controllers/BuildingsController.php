<?php

namespace App\Http\Controllers;

use App\Building;
use Illuminate\Http\Request;
use Validator;
use App\Compound;
use App\District;

class BuildingsController extends Controller
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
            'district_id' => 'required|exists:districts,district_id',
            'compound_id' => 'required|exists:compounds,compound_id'
        ];

        $messages = [
            'name.required' => 'Please enter name in English',
            'a_name.required' => 'Please enter name in Arabic',
            'district_id.required' => 'Please select district from dropdown',
            'compound_id.required' => 'Please select compound from dropdown',
            'district_id.exists' => 'Please create district before creating building',
            'compound_id.exists' => 'Please create compound before creating building'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['data' => '', 'message' => $validator, 'success' => 0], 200);
        }

        $building = new Building;
        $building->name = $request->name;
        $building->a_name = $request->a_name;
        $building->district_id = $request->district_id;
        $building->compound_id = $request->compound_id;
        if($building->save()) {
            return response()->json(['data' => '', 'message' => 'Building created successfully.', 'success' => 1], 201);
        } else {
            return response()->json(['data' => '', 'message' => 'Something went wrong.', 'success' => 0], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function edit($building)
    {
        $building = Building::where('building_id', $building)->first();
        $building['district'] = District::where('district_id', $building->district_id)->first();
        $building['compound'] = Compound::where('compound_id', $building->compound_id)->first();
        return response()->json(['data' => $building, 'message' => '', 'success' => 1], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $building_id)
    {
        $rules = [
            'name' => 'required',
            'a_name' => 'required',
            'district_id' => 'required',
            'compound_id' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter name in English',
            'a_name.required' => 'Please enter name in Arabic',
            'district_id.required' => 'Please select district from dropdown',
            'compound_id.required' => 'Please select compound from dropdown'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['data' => '', 'message' => $validator, 'success' => 0], 200);
        }

        $building['name'] = $request->name;
        $building['a_name'] = $request->a_name;
        $building['district_id'] = $request->district_id;
        $building['compound_id'] = $request->compound_id;

        $update = Building::where('building_id', $building_id)->update($building);

        if($update) {
            return response()->json(['data' => '', 'message' => 'Building updated successfully.', 'success' => 1], 200);
        } else {
            return response()->json(['data' => '', 'message' => 'Something went wrong.', 'success' => 0], 200);
        }
    }

}

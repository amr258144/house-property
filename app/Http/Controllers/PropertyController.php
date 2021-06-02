<?php

namespace App\Http\Controllers;

use App\Property;
use App\Promotion;
use App\Compound;
use App\District;
use App\Building;
use Illuminate\Http\Request;
use Validator;

class PropertyController extends Controller
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
            'compound_id' => 'required|exists:compounds,compound_id',
            'building_id' => 'required|exists:buildings,building_id',
            'promotion_id' => 'required|exists:promotions,promotion_id'
        ];

        $messages = [
            'name.required' => 'Please enter name in English',
            'a_name.required' => 'Please enter name in Arabic',
            'district_id.required' => 'Please select district from dropdown',
            'compound_id.required' => 'Please select compound from dropdown',
            'building_id.required' => 'Please select building from dropdown',
            'promotion_id.required' => 'Please select promotion from dropdown',
            'district_id.exists' => 'Please create district before creating property',
            'compound_id.exists' => 'Please create compound before creating property',
            'building_id.exists' => 'Please create building before creating property',
            'promotion_id.exists' => 'Please create building before creating property'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['data' => '', 'message' => $validator, 'success' => 0], 200);
        }

        $property = new Property;
        $property->name = $request->name;
        $property->a_name = $request->a_name;
        $property->district_id = $request->district_id;
        $property->compound_id = $request->compound_id;
        $property->building_id = $request->building_id;
        $property->promotion_id = $request->promotion_id;
        $property->no_bathrooms = $request->no_bathrooms;
        $property->no_bedrooms = $request->no_bedrooms;
        $property->no_guest_rooms = $request->no_guestrooms;

        if($property->save()) {
            return response()->json(['data' => '', 'message' => 'Property created successfully.', 'success' => 1], 200);
        } else {
            return response()->json(['data' => '', 'message' => 'Something went wrong.', 'success' => 0], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function edit($property_id)
    {
        $property = Property::where('property_id', $property_id)->first();
        if($property) {
            $property['district'] = District::where('district_id', $property->district_id)->first();
            $property['compound'] = Compound::where('compound_id', $property->compound_id)->first();
            $property['building'] = Building::where('building_id', $property->building_id)->first();
            $property['promotion'] = Promotion::where('promotion_id', $property->promotion_id)->first();
        }
        return response()->json(['data' => $property, 'message' => '', 'success' => 1], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Property  $property
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $property_id)
    {
        $rules = [
            'name' => 'required',
            'a_name' => 'required',
            'district_id' => 'required',
            'compound_id' => 'required',
            'building_id' => 'required',
            'promotion_id' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter name in English',
            'a_name.required' => 'Please enter name in Arabic',
            'district_id.required' => 'Please select district from dropdown',
            'compound_id.required' => 'Please select compound from dropdown',
            'building_id.required' => 'Please select building from dropdown',
            'promotion_id.required' => 'Please select promotion from dropdown'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['data' => '', 'message' => $validator, 'success' => 0], 200);
        }

        $property['name'] = $request->name;
        $property['a_name'] = $request->a_name;
        $property['district_id'] = $request->district_id;
        $property['compound_id'] = $request->compound_id;
        $property['building_id'] = $request->building_id;
        $property['promotion_id'] = $request->promotion_id;
        $property['no_bathrooms'] = $request->no_bathrooms;
        $property['no_bedrooms'] = $request->no_bedrooms;
        $property['no_guest_rooms'] = $request->no_guestrooms;

        $update = Property::where('property_id', $property_id)->update($property);

        if($update) {
            return response()->json(['data' => '', 'message' => 'Property updated successfully.', 'success' => 1], 200);
        } else {
            return response()->json(['data' => '', 'message' => 'Something went wrong.', 'success' => 0], 200);
        }
    }
}

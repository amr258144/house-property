<?php

namespace App\Http\Controllers;

use App\Promotion;
use App\Property;
use App\Compound;
use App\District;
use App\Building;
use Illuminate\Http\Request;
use Validator;

class PromotionsController extends Controller
{
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'a_name' => 'required'
        ];

        $messages = [
            'name.required' => 'Please enter name in English',
            'a_name.required' => 'Please enter name in Arabic'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if($validator->fails()) {
            return response()->json(['data' => '', 'message' => $validator, 'success' => 0], 200);
        }

        $promotion = new Promotion;
        $promotion->name = $request->name;
        $promotion->a_name = $request->a_name;
        if($promotion->save()) {
            return response()->json(['data' => '', 'message' => 'Promotion created successfully.', 'success' => 1], 201);
        } else {
            return response()->json(['data' => '', 'message' => 'Something went wrong.', 'success' => 0], 200);
        }
    }

    public function list() {
        $data = array();
        $promotion = Promotion::paginate(10);
        foreach($promotion as $key => $value) {
            $property = Property::where('promotion_id', $value['promotion_id'])->orderBy('property_id', 'DESC')->limit(30)->get();
            array_push($data, ['promotion' => $value, 'property' => $property]);
        }
        return response()->json(['data' => $data, 'message' => 'List all promotions with latest 30 properties', 'success' => 1], 200);
    }
}

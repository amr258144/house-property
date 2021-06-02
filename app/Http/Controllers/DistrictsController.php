<?php

namespace App\Http\Controllers;

use App\District;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $districts = District::orderBy('district_id', 'DESC')->get();
        return response()->json(['data' => $districts, 'message' => 'District List', 'success' => 1], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $district = new District;
        $district->name = $request->name;
        $district->a_name = $request->a_name;
        $district->created_at = date('Y-m-d H:i:s');
        $district->updated_at = date('Y-m-d H:i:s');
        if($district->save()) {
            return response()->json(['data' => '', 'message' => 'District created successfully.', 'success' => 1], 201);
        } else {
            return response()->json(['data' => '', 'message' => 'Something went wrong.', 'success' => 0], 200);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function show($district)
    {
        $district = District::where('district_id', $district)->first();
        return response()->json(['data' => $district, 'message' => '', 'success' => 1], 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function edit(District $district)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, District $district)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\District  $district
     * @return \Illuminate\Http\Response
     */
    public function destroy(District $district)
    {
        //
    }
}

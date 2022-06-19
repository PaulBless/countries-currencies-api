<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        // $countries = Country::all();
        $countries = Country::paginate(25);

        if(!empty($countries)){
            return response()->json($countries, 200);
        } else {
            return response()->json(["status"=> 404, "message"=> "No records found!!"]);
        }

    }

    /**
     * Method to return
     * country list with sorting, filtering parameters
     */
    public function countries(Request $request)
    {

       $query = Country::query();

       // filter by country name
        if ($s = $request->input('name')) {
            $query->whereRaw("common_name LIKE '%" . $s . "%'")
                ->orWhereRaw("official_name LIKE '%" . $s . "%'");
        }

        // filter by continent
        if($c = $request->input('continent')){
            $query->whereRaw("continent_code = '". $c . "'");
        }

        //filter by dialing code
        if($c = $request->input('dial_code')) {
            $query->whereRaw("calling_code LIKE '%" .$c. "%'" );
        }

        // sort by ascending or descending order
        if ($sort = $request->input('sort')) {
            $query->orderBy('continent_code', $sort);
        }

        $perPage = 25;
        $page = $request->input('page', 1);
        $total = $query->count();

        $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

        return response()->json([
            "message" => "Country List",
            "data" => $result,
            "total" => $total,
            "last_page" => ceil($total / $perPage)
        ], 200);

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
}

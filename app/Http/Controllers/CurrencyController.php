<?php

namespace App\Http\Controllers;

use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $currencies = Currency::paginate(20);
        // if($currencies){
        //     return response()->json($currencies, 200);
        // } else {
        //     return response()->json(["status"=> 404, "message"=> "No records found!!"]);
        // }

        $query = Currency::query();

        if ($s = $request->input('name')) {
            $query->whereRaw("common_name LIKE '%" . $s . "%'")
                ->orWhereRaw("official_name LIKE '%" . $s . "%'");
        }

        if($c = $request->input('symbol')){
            $query->whereRaw("symbol = '" .$c. "'");
        }

        if ($sort = $request->input('sort')) {
            $query->orderBy('continent_code', $sort);
        }

        $perPage = 25;
        $page = $request->input('page', 1);
        $total = $query->count();

        $currencies = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

        return response()->json([
            "message" => "Currency List",
            "data" => $currencies,
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
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function show(Currency $currency)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function edit(Currency $currency)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Currency $currency)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Currency  $currency
     * @return \Illuminate\Http\Response
     */
    public function destroy(Currency $currency)
    {
        //
    }
}

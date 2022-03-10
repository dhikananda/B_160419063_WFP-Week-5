<?php

namespace App\Http\Controllers;

use App\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 1-2
        // $alldata_medicine = DB::table('medicines')
        // ->select('generic_name','form','price')
        // ->get();
        $alldata_medicine = Medicine::select('generic_name','form','price')
        ->get();

        // return view('medicine.show_name_form_price', compact('alldata_medicine'));

        // 2-1
        // $data_nfc = DB::table('medicines as m')
        // ->join('categories as c','m.category_id','=','c.id')
        // ->select('m.generic_name','m.form','c.name')
        // ->get();
        $data_nfc = Medicine::join('categories','medicines.category_id','=','categories.id')
        ->select('medicines.generic_name','medicines.form','categories.name')
        ->get();

        // return view('medicine.show_name_form_cname', compact('data_nfc'));
    
        // 3-1
        $count_category = DB::table('medicines')
        ->distinct()
        ->count('category_id');
        // $count_category = Medicine::distinct()->count('category_id');

        // return view('medicine.show_count_category', compact('count_category'));

        // 3-5
        // $medicine_have_one_form = DB::table('medicines')
        // ->select('generic_name')
        // ->groupBy('generic_name')
        // ->having(DB::raw('count(form)'),'=',1)
        // ->get();
        $medicine_have_one_form = Medicine::select('generic_name')
        ->groupBy('generic_name')
        ->having(DB::raw('count(form)'),'=',1)
        ->get();

        // return view('medicine.show_medicine_have_one_form', compact('medicine_have_one_form'));

        // 3-6
        // $medicine_category_maxprice = DB::table('medicines as m')
        // ->join('categories as c','m.category_id','=','c.id')
        // ->select('m.generic_name','c.name')
        // ->orderBy('m.price','desc')
        // ->limit(1)
        // ->get();

        $medicine_category_maxprice = Medicine::join('categories','medicines.category_id','=','categories.id')
        ->select('medicines.generic_name','categories.name')
        ->orderBy('medicines.price','desc')
        ->limit(1)
        ->get();

        return view('medicine.show_medicine_category_maxprice', compact('medicine_category_maxprice'));
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
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function show($medicine)
    {
        // select * from medicine where id=$medicine
        $res = Medicine::find($medicine);
        $message = "";
        if($res)
        {
            // apabila ditemukan
            $message = $res;
        }
        else 
        {
            // apabila tidak ditemukan
            $message = NULL;
        }
        // parsing
        return view('medicine.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function edit(Medicine $medicine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medicine $medicine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        //
    }
}

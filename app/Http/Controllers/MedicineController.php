<?php

namespace App\Http\Controllers;

use App\Medicine;
use App\Category;
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
        //
    }

    public function showAllDataNFP()
    {
        // 1-2
        // $alldata_medicine = DB::table('medicines')
        // ->select('generic_name','form','price')
        // ->get();

        $alldata_medicine = Medicine::all();

        return view('medicine.show_name_form_price', compact('alldata_medicine'));
    }

    public function showAllDataNFC()
    {
        // 2-1
        // $data_nfc = DB::table('medicines as m')
        // ->join('categories as c','m.category_id','=','c.id')
        // ->select('m.generic_name','m.form','c.name')
        // ->get();

        $data_nfc = Medicine::join('categories','medicines.category_id','=','categories.id')
        ->select('medicines.generic_name','medicines.form','categories.name', 'medicines.id')
        ->get();

        return view('medicine.show_name_form_cname', compact('data_nfc'));
    }

    public function countCategory()
    {
        // 3-1
        // $count_category = DB::table('medicines')
        // ->distinct()
        // ->count('category_id');

        $count_category = Medicine::distinct()->count('category_id');

        return view('medicine.show_count_category', compact('count_category'));
    }

    public function haveOneForm()
    {
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

        return view('medicine.show_medicine_have_one_form', compact('medicine_have_one_form'));
    }

    public function medicineHighestPrice()
    {
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

    public function showInfo()
    {
        return response()->json(array(
            'status'=>'oke',
            'msg'=>"<div class='alert alert-info'>
                    Did you know? <br>This message is sent by a Controller.'</div>"
        ),200);
    }

    public function showHighPrice()
    {
        $result=Medicine::orderBy('price','DESC')->first();
        return response()->json(array(
            'status'=>'oke',
            'msg'=>"<div class='alert alert-info'>
            Did you know? <br>The most expensive product is ". $result->generic_name . "</div>"
        ),200);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();

        return view('medicine.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Medicine();

        $data->generic_name = $request->get('generic_name');
        $data->form = $request->get('form');
        $data->restriction_formula = $request->get('restriction_form');
        $data->price = $request->get('price');
        $data->description = $request->get('description');
        $data->category_id = $request->get('category_id');
        $data->faskes1 = $request->get('faskes1');
        $data->faskes2 = $request->get('faskes2');
        $data->faskes3 = $request->get('faskes3');

        $data->save();

        return redirect()->route('reportShowAllDataNFP')->with('status','Medicine is added');
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
        $data = $medicine;
        $category = $data->category;
        $allcat = Category::all();
        return view('medicine.edit', compact('data', 'category','allcat'));
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
        $medicine->generic_name = $request->get('generic_name');
        $medicine->form = $request->get('form');
        $medicine->restriction_formula = $request->get('restriction_form');
        $medicine->price = $request->get('price');
        $medicine->description = $request->get('description');
        $medicine->category_id = $request->get('category_id');
        $medicine->faskes1 = $request->get('faskes1');
        $medicine->faskes2 = $request->get('faskes2');
        $medicine->faskes3 = $request->get('faskes3');
        $medicine->save();

        return redirect()->route('reportShowAllDataNFP')->with('status','Medicine data is changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Medicine  $medicine
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medicine $medicine)
    {
        try {
            $medicine->delete();
            return redirect()->route('reportShowAllDataNFP')->with('status','Success delete data medicine');
        } catch (\PDOException $e) {
            $msg = "Data failed to delete. Please make sure that child data already deleted too";
            return redirect()->route('reportShowAllDataNFP')->with('error',$msg);
        }
    }
}

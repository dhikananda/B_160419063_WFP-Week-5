<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
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

    public function showAllData()
    {
        // 1-1
        // $alldata = DB::table('categories')->get();
        $alldata = Category::all();

        return view('category.show_all_data', compact('alldata'));
    }

    public function showCategoryNoMedicines()
    {
        // 3-2
        $category_havent_medicines = DB::table('categories as c')
        ->leftJoin('medicines as m','c.id','=','m.category_id')
        ->select('c.name')
        ->whereNull('m.category_id')
        ->get();
        // $category_havent_medicines = Category::leftJoin('medicines','categories.id','=','medicines.category_id')
        // ->select('categories.name')
        // ->whereNull('medicines.category_id')
        // ->get();
        
        return view('category.show_count_havent_medicine', compact('category_havent_medicines'));
        
    }

    public function averageCategoryHaveMedicines()
    {
        // 3-3
        // $average_category_have_medicines = DB::table('categories')
        // ->leftJoin('medicines','categories.id','=','medicines.category_id')
        // ->select('categories.name',DB::raw('ifnull(avg(medicines.price),0) as average'))
        // ->groupBy('categories.name')
        // ->get();
        $average_category_have_medicines = Category::leftJoin('medicines','categories.id','=','medicines.category_id')
        ->select('categories.name', DB::raw('ifnull(avg(medicines.price),0) as average'))
        ->groupBy('categories.name')
        ->get();

        return view('category.show_average_category_have_medicines', compact('average_category_have_medicines'));

    }

    public function showCategoryHaveOneMedicine()
    {
        // 3-4
        // $category_have_one_medicine = DB::table('categories as c')
        // ->join('medicines as m','c.id','=','m.category_id')
        // ->select('c.name')
        // ->groupBy('c.name')
        // ->having(DB::raw('count(m.category_id)'),'=',1)
        // ->get();
        $category_have_one_medicine = Category::join('medicines','categories.id','=','medicines.category_id')
        ->select('categories.name')
        ->groupBy('categories.name')
        ->having(DB::raw('count(medicines.category_id)'),'=',1)
        ->get();

        return view('category.show_category_have_one_medicine', compact('category_have_one_medicine'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new Category();

        $data->name = $request->get('name_category');
        $data->description = $request->get('description');

        $data->save();

        return redirect()->route('reportShowCategory')->with('status','Category is added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }

    public function showlist($id_category)
    {
        $data = Category::find($id_category);
        
        $namecategory = $data->name;
        $result = $data->medicines;

        if($result)
        {
            $getTotalData = $result->count();
        } 
        else 
        {
            $getTotalData = 0;
        }

        // parsing
        return view('report.list_medicines_by_category', compact('id_category','namecategory','result','getTotalData'));
    }
}

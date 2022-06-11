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

        $file= $request->file('logo');
        $imgFolder = 'images';
        $imgFile = time()."_".$file->getClientOriginalName();
        $file->move($imgFolder,$imgFile);
        $data->logo = $imgFile;

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
        $data = $category;
        return view('category.edit', compact('data'));
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
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->save();

        return redirect()->route('reportShowCategory')->with('status','Category data is changed');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $this->authorize('delete-permission', $category);
        
        try {
            $category->delete();
            return redirect()->route('reportShowCategory')->with('status','Success delete data category');
        } catch (\PDOException $e) {
            $msg = "Data failed to delete. Please make sure that child data already deleted too";
            return redirect()->route('reportShowCategory')->with('error',$msg);
        }
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

    public function getEditForm(Request $request)
    {
        $id = $request->post('id');
        $data = Category::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('category.getEditForm',compact('data'))->render()
        ), 200);
    }

    public function getEditForm2(Request $request)
    {
        $id = $request->post('id');
        $data = Category::find($id);
        return response()->json(array(
            'status' => 'oke',
            'msg' => view('category.getEditForm2',compact('data'))->render()
        ), 200);
    }

    public function saveData(Request $request)
    {
        $id = $request->get('id');
        $category = Category::find($id);
        $category->name = $request->get('name');
        $category->description = $request->get('description');
        $category->save();

        return response()->json(array(
            'status' => 'oke',
            'msg' => 'Success to change data category'
        ), 200);
    }

    public function deleteData(Request $request)
    {
        try {
            $id = $request->get('id');
            $category = Category::find($id);
            $category->delete();

            return response()->json(array(
                'status' => 'oke',
                'msg' => 'Success to delete data category'
            ), 200);
        } catch (\PDOException $e) {
            return response()->json(array(
                'status' => 'gagal',
                'msg' => 'Failed to delete data category'
            ), 200);
        }
    }

    public function saveDataField(Request $request)
    {
        $id = $request->get('id');
        $fname = $request->get('fname');
        $value = $request->get('value');

        // dd($id);

        $category = Category::find($id);
        $category->$fname = $value;
        $category->save();

        return response()->json(array(
            'status' => 'oke',
            'msg' => 'Supplier data updated'
        ), 200);
    }

    public function changeLogo(Request $request)
    {
        $id = $request->get('id');
        $file = $request->file('logo');
        $imgFolder = 'images';
        $imgFile = time().'_'.$file->getClientOriginalName();
        $file->move($imgFolder,$imgFile);
        $category = Category::find($id);
        $category->logo = $imgFile;
        $category->save();

        return redirect()->route('reportShowCategory')->with('status','Category logo is changed');
    }
}

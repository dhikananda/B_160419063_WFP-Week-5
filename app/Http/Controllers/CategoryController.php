<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Tampilkan seluruh data kategori obat
        // select * from categories

        //Tampilkan seluruh nama medecines, formula dan harga
        // select generic_name, form, price from medicines 

        //Tampilkan seluruh nama medecines, formula dan nama kategori
        // select m.generic_name, m.form, c.name from medicines m inner join categories c on m.category_id = c.id

        //Tampilkan jumlah kategori yang memiliki data medicines
        // select count(distinct(category_id)) from medicines

        //Tampilkan nama kategori yang tidak memiliki data medicines satupun
        // Select c.name from categories c left join medicines m on m.category_id = c.id where m.category_id is null

        //Tampilkan rata-rata harga setiap kategori obat. Bila tidak ada obat maka berikan 0
        // select c.name, ifnull(avg(m.price),0) from categories c left join medicines m on c.id = m.category_id group by c.id

        //Tampilkan kategori obat yang memiliki 1 produk medicine saja
        // select c.name from medicines m inner join categories c on m.category_id = c.id group by c.id having count(m.category_id) = 1

        //Tampilkan obat yang memiliki satu form
        // select generic_name from medicines group by generic_name having count(form) = 1

        //Tampilkan kategori dan nama obat yang memiliki harga termahal
        // select c.name, m.generic_name from medicines m inner join categories c on m.category_id = c.id order by m.price LIMIT 1
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

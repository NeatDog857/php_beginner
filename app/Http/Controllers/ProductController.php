<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        // $data = $this->getData();
        $data = DB::table("products")->get();
        // dump($data);
        return response($data);
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
        $data = $this->getData();
        $newData = $request->all();
        $data->push(collect($newData));
        dump($data);
        return response($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $form = $request->all();
        $data = $this->getData();
        $selectedData = $data->where("id",$id)->first();
        $selectedData = $selectedData->merge(collect($form));

        return response($selectedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $data = $this->getData();
        $data = $data->filter(function($product) use ($id){
            return $product["id"] != $id;
        });
        return response($data->values());
    }

    public function getData(){
        return collect([
            collect([
                "id" => 0,
                "title" => "test product 1",
                "content" => "this is a great product",
                "price" => 100
            ]),
            collect([
                "id" => 1,
                "title" => "test product 2",
                "content" => "this is a good product",
                "price" => 80
            ])
        ]);
    }
}

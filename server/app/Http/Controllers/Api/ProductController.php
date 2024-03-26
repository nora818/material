<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends ApiController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $list = Product::query()->with(['user'])->paginate();
        return $this->success($list);
    }

    public function search(Request $request)
    {
        $name = $request->get('name');
        $list = Product::query()->with(['user'])->where('name', 'like', "%$name%")->get();
        return $this->success($list);
    }

    public function list()
    {
        $list = Product::query()->get();
        $data = [];
        foreach ($list as $key => $value) {
            $tmp['value'] = $value['id'];
            $tmp['label'] = $value['name'];
            $data[] = $tmp;
        }
        return $this->success($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

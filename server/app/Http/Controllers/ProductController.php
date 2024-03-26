<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    protected $fieldList = [
        'name' => '',
        'content' => '',
        'score' => '',
        'grade' => '',
        'grade_url' => '',
        'product_url' => ''
    ];

    public function __construct()
    {
        // $this->authorizeResource(Product::class);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        if ($user->is_admin) {
            $data = Product::query()->with('user')->get();
        } else {
            $data = Product::with('user')->where('user_id', $user->id)->get();
        }
        return view('product/index', ['products' => $data]);
    }

    public function create(Request $request)
    {
        $data = $this->fieldList;
        return view('product/add', $data);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required'],
            'score' => ['required'],
            'content' => ['required'],
        ]);

        $data = array_merge($data, [
            'product_url' => $request->input('product_url', ""),
            'grade_url' => $request->input('grade_url', ""),
            'grade' => $request->input('grade', 0)
        ]);
        $data['user_id'] = Auth::user()->id;
        Product::create($data);
        return redirect()
            ->route('product.index')
            ->with('success', 'Create successful');
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
        // $this->authorize('edit', $product);

        $fieldNames = array_keys($this->fieldList);
        $fields = ['id' => $id];
        foreach ($fieldNames as $field) {
            $fields[$field] = $product->{$field};
        }
        foreach ($fields as $fieldName => $fieldValue) {
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }
        return view('product.edit', $fields);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        // $this->authorize('edit', $product);

        $data = $request->validate([
            'name' => ['required'],
            'score' => ['required'],
            'content' => ['required'],
        ]);

        $data = array_merge($data, [
            'product_url' => $request->input('product_url', ""),
            'grade_url' => $request->input('grade_url', ""),
            'grade' => $request->input('grade', 0)
        ]);
        $product->fill($data);
        $product->save();
        return redirect()
            ->route('product.index')
            ->with('success', '编辑成功');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        // $this->authorize('edit', $product);
        $product->delete();

        return redirect()
            ->route('product.index')
            ->with('success', '删除成功');
    }
}

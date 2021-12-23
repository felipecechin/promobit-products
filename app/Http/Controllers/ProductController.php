<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tags = Tag::all();
        $products = Product::paginate(5);
        return view('product.index', ['tags' => $tags, 'products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'name' => 'required|unique:product,name',
            'tags' => 'required|array',
            'tags.*' => 'exists:tag,id'
        ];
        $feedback = [
            'name.required' => 'Preencha o nome do produto.',
            'name.unique' => 'Produto já existe.',
            'tags.required' => 'Preencha com alguma tag.',
            'tags.*.exists' => 'Informe tags válidas.'
        ];

        $request->validate($rules, $feedback);
        $tags = $request->get('tags');
        $newProduct = new Product();
        $newProduct->name = $request->get('name');
        $newProduct->save();
        $newProduct->tags()->attach($tags);
        $newProduct->push();
        return redirect()->route('product.index')->with('success', 'Produto cadastrado com sucesso.');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product) {
        $tags = Tag::all();
        $productTags = $product->tags()->pluck('tag.id')->toArray();
        return view('product.edit', ['product' => $product, 'tags' => $tags, 'productTags' => $productTags]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product) {
        $rules = [
            'name' => 'required|unique:product,name,' . $product->id,
            'tags' => 'required|array',
            'tags.*' => 'exists:tag,id'
        ];
        $feedback = [
            'name.required' => 'Preencha o nome do produto.',
            'name.unique' => 'Produto já existe.',
            'tags.required' => 'Preencha com alguma tag.',
            'tags.*.exists' => 'Informe tags válidas.'
        ];

        $request->validate($rules, $feedback);
        $tags = $request->get('tags');
        $product->name = $request->get('name');
        $product->tags()->sync($tags);
        $product->save();
        return redirect()->back()->with('success', 'Produto salvo com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product) {
        $product->tags()->detach();
        $product->delete();
        return redirect()->route('product.index')->with('delete_success', 'Produto excluído com sucesso.');
    }
}

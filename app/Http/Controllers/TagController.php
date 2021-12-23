<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tags = Tag::paginate(5);
        return view('tag.index', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $rules = [
            'name' => 'required|unique:tag,name'
        ];
        $feedback = [
            'name.required' => 'Preencha o nome da tag.',
            'name.unique' => 'Tag já existe.'
        ];

        $request->validate($rules, $feedback);

        Tag::create([
            'name' => $request->name
        ]);

        return redirect()->route('tag.index')->with('success', 'Tag cadastrada com sucesso.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag) {
        return view('tag.edit', ['tag' => $tag]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $tag) {
        $rules = [
            'name' => 'required|unique:tag,name,' . $tag->id
        ];
        $feedback = [
            'name.required' => 'Preencha o nome da tag.',
            'name.unique' => 'Tag já existe.'
        ];

        $request->validate($rules, $feedback);
        $tag->update($request->all());
        return redirect()->back()->with('success', 'Tag salva com sucesso.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Tag $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag) {
        $tag->delete();
        return redirect()->route('tag.index')->with('delete_success', 'Tag excluída com sucesso.');
    }
}

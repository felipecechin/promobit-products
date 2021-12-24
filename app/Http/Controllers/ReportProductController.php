<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportProductController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $tagProducts = DB::table('tag')
            ->leftJoin('product_tag', 'tag.id', '=', 'product_tag.tag_id')
            ->selectRaw('tag.name as tagName, count(product_tag.product_id) as numProducts')
            ->groupBy('tag.id')
            ->orderByRaw('numProducts desc')
            ->paginate(5);
        return view('report-product.index', ['tagProducts' => $tagProducts]);
    }
}

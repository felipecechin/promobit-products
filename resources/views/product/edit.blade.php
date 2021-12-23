@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @component('product._components.form_create_edit', ['product'=>$product, 'tags'=>$tags, 'productTags' => $productTags])
                @endcomponent
            </div>
        </div>
    </div>
@endsection

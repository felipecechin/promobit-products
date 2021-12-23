@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @component('tag._components.form_create_edit', ['tag'=>$tag])
                @endcomponent
            </div>
        </div>
    </div>
@endsection

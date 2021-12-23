@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @component('tag._components.form_create_edit')
                @endcomponent
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de tags</div>
                    <div class="card-body">
                        @if(session('delete_success'))
                            <div class="alert alert-success" role="alert">
                                {{session('delete_success')}}
                            </div>
                        @endif
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th>Nome</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <th scope="row">{{$tag->id}}</th>
                                    <td>{{$tag->name}}</td>
                                    <td>
                                        <form id="form_{{$tag->id}}" method="post" action="{{ route('tag.destroy', ['tag' => $tag->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit">Excluir</button>-->
                                            <a href="{{ route('tag.edit', ['tag' => $tag->id ]) }}" class="btn btn-primary me-2">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#" onclick="document.getElementById('form_{{$tag->id}}').submit()" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            {{$tags->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

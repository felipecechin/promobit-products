@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form action="{{route('tag.store')}}" method="post">
                    <div class="card">
                        <div class="card-header">Cadastrar tag</div>

                        <div class="card-body">
                            @if($errors->has('name'))
                                <div class="alert alert-danger" role="alert">
                                    {{$errors->first('name')}}
                                </div>
                            @endif
                            @csrf
                            <label for="inputName" class="form-label">Nome</label>
                            <input type="text" class="form-control" value="{{ old('name') }}" id="inputName" aria-describedby="nomeHelp" placeholder="Digite o nome da tag" name="name">
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm float-end">Cadastrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de tags</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th>Nome</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tags as $tag)
                                <tr>
                                    <th scope="row">{{$tag->id}}</th>
                                    <td>{{$tag->name}}</td>
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

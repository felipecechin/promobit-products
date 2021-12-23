@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Relatório de relevância de produtos</div>
                    <div class="card-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th scope="col">Tag</th>
                                <th>Quantidade de produtos</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tagProducts as $value)
                                <tr>
                                    <th scope="row">{{$value->tagName}}</th>
                                    <td>{{$value->numProducts}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="float-end">
                            {{$tagProducts->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

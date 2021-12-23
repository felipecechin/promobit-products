@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @component('product._components.form_create_edit', ['tags'=>$tags])
                @endcomponent
            </div>
        </div>

        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Lista de produtos</div>
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
                            @foreach($products as $product)
                                <tr>
                                    <th scope="row">{{$product->id}}</th>
                                    <td>{{$product->name}}</td>
                                    <td>
                                        <form id="form_{{$product->id}}" method="post" action="{{ route('product.destroy', ['product' => $product->id]) }}">
                                        @method('DELETE')
                                        @csrf
                                        <!--<button type="submit">Excluir</button>-->
                                            <a href="{{ route('product.edit', ['product' => $product->id ]) }}" class="btn btn-primary me-2">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger" onclick="deleteProduct(event, 'form_{{$product->id}}')">
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
                            {{$products->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function deleteProduct(event, form) {
            event.preventDefault();
            $.confirm({
                title: 'Deletar produto?',
                content: 'Confirme a exclusão do produto.',
                buttons: {
                    confirmar: {
                        btnClass: 'btn-danger',
                        action: function () {
                            $("#" + form).submit();
                        }
                    },
                    cancelar: {
                        btnClass: 'btn-info'
                    }
                }
            });
        }
    </script>
@endsection

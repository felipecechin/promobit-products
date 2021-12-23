@if(isset($product->id))
    <form action="{{route('product.update', ['product'=>$product])}}" method="post">
        @csrf
        @method('PUT')
        @else
            <form action="{{route('product.store')}}" method="post">
                @csrf
                @endif
                <div class="card">
                    <div class="card-header">{{(isset($product->id)) ? 'Editar produto' : 'Cadastrar produto'}}</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                        @endif
                        @csrf
                        <div class="mb-3">
                            <label for="inputName" class="form-label">Nome</label>
                            <input type="text" class="form-control" value="{{ $product->name ?? old('name') }}" id="inputName" aria-describedby="nomeHelp" placeholder="Digite o nome" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="selectTags" class="form-label">Tags</label>
                            <select class="form-control" id="selectTags" name="tags[]" multiple="multiple">
                                @foreach($tags as $tag)
                                    <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            @if(isset($product->id))
                                <a href="{{route('product.index')}}" class="btn btn-light btn-sm text-decoration-none me-2">
                                    Voltar
                                </a>
                            @endif
                            <button type="submit" class="btn btn-primary btn-sm">{{(isset($product->id)) ? 'Salvar' : 'Cadastrar'}}</button>
                        </div>
                    </div>
                </div>
            </form>
            <script>
                $(document).ready(function () {
                    @if(old('tags') !== null && is_array(old('tags')))
                    $('#selectTags').val({!! json_encode(old('tags')) !!});
                    @elseif(isset($product->id))
                    $('#selectTags').val({{json_encode($productTags)}});
                    @endif
                    $('#selectTags').select2();
                });
            </script>

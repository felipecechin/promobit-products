@if(isset($tag->id))
    <form action="{{route('tag.update', ['tag'=>$tag])}}" method="post">
        @csrf
        @method('PUT')
        @else
            <form action="{{route('tag.store')}}" method="post">
                @csrf
                @endif
                <div class="card">
                    <div class="card-header">{{(isset($tag->id)) ? 'Editar tag' : 'Cadastrar tag'}}</div>
                    <div class="card-body">
                        @if($errors->has('name'))
                            <div class="alert alert-danger" role="alert">
                                {{$errors->first('name')}}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                        @endif
                        @csrf
                        <label for="inputName" class="form-label">Nome</label>
                        <input type="text" class="form-control" value="{{ $tag->name ?? old('name') }}" id="inputName" aria-describedby="nomeHelp" placeholder="Digite o nome da tag" name="name">
                    </div>

                    <div class="card-footer">
                        <div class="d-flex justify-content-end">
                            @if(isset($tag->id))
                                <a href="{{route('tag.index')}}" class="btn btn-info btn-sm text-decoration-none me-2">
                                    Voltar
                                </a>
                            @endif
                            <button type="submit" class="btn btn-primary btn-sm">{{(isset($tag->id)) ? 'Salvar' : 'Cadastrar'}}</button>
                        </div>
                    </div>
                </div>
            </form>

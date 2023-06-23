@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Alteração de Entradas</h3><hr>
    <form action="" id="cadastro-movimento" nome="cadastro-movimento" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/movimento/edit/{{$movimento->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="movimento">
        <div class="row">
            <div class="form-group col-md-2">
                Data
                <input class="form-control" type="date" name="data" id="data" value="{{ $movimento->data }}">
            </div>
            <div class="form-group col-md-6">
                Fornecedor
                <select class="form-control" type="text" name="pessoa" id="pessoa" value="{{ $movimento->pessoa }}">
                    {{-- <option value="%">Todas</option> --}}
                    @foreach ($fornecedores as $fornecedor )
                        <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                NF
                <input class="form-control limpar" type="text" name="doc" id="doc" value="{{ $movimento->doc }}">
            </div>
            <div class="form-group col-md-6">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto" value="{{ $movimento->produto }}" >
                    {{-- <option value="%">Todas</option> --}}
                    @foreach ($produtos as $produto )
                        <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Quantidade
                <input class="form-control limpar" type="" name="quantidade" id="quantidade" value="{{ $movimento->quantidade }}" >
            </select>
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="" id="salvar" class="btn btn-success btn-block">
                    <span class="fas fa-save"></span> Salvar
                </button>
            </div>
                <div class="form-group col-md-3">
                    <button type="button" name="sair" id="sair" value="" class="btn btn-danger btn-block">
                        <span class="fa fa-door-open"></span> Sair
                    </button>
                </div>
            </div>
        </div>
    </form>

    <script>
        $(document).ready(function(){

            $('button#sair').click(function(){
                $(location).attr('href',url+'/movimento');
            })
        })

    </script>

@endsection

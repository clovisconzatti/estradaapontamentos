@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Entradas</h3><hr>
    <form action="" id="cadastro-movimento" nome="cadastro-movimento" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/movimento/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="movimento">

        <div class="row">
            <div class="form-group col-md-2">
                Data
                <input class="form-control" type="date" name="data" id="data" value="{{date('Y-m-d')}}" required>
            </div>
            <div class="form-group col-md-7">
                Fornecedor
                <select class="form-control limpar" type="text" name="pessoa" id="pessoa" required>
                    <option value="%">Todas</option>
                    @foreach ($fornecedores as $fornecedor )
                        <option value="{{ $fornecedor->id }}">{{ $fornecedor->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                NF
                <input class="form-control limpar" type="text" name="doc" id="doc" required>
            </div>
            <div class="form-group col-md-6">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto" required>
                    <option value="%">Todas</option>
                    @foreach ($produtos as $produto )
                        <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Quantidade
                <input class="form-control limpar" type="" name="quantidade" id="quantidade" required>
            </div>
                <div class="form-group col-md-11">
            Observação
            <textarea class="form-control limpar" type="text" name="obs" id="obs" maxLength="100" role="3"></textarea>
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

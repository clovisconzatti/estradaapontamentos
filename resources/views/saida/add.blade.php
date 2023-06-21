@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Saidas</h3><hr>
    <form action="" id="cadastro-saida" nome="cadastro-saida" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/saida/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="saida">

        <div class="row">
            <div class="form-group col-md-2">
                Data
                <input class="form-control" type="date" name="data" id="data" value="{{date('Y-m-d')}}">
            </div>
            <div class="form-group col-md-6">
                Cliente
                <select class="form-control limpar" type="text" name="cliente" id="pessoa">
                    <option value="%">Todas</option>
                    @foreach ($clientes as $cliente )
                        <option value="{{ $cliente->id }}">{{ $cliente->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Nr. Requisição
                <input class="form-control" type="text" name="nf" id="doc">
            </div>
            <div class="form-group col-md-6">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto">
                    <option value="%">Todas</option>
                    @foreach ($produtos as $produto )
                        <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Quantidade
                <input class="form-control" type="text" name="quantidade" id="quantidade">
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
                $(location).attr('href',url+'/saida');
            })
        })
    </script>

@endsection

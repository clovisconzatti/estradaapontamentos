@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Cadastro de Produto</h3><hr>
    <form action="" id="cadastro-produto" nome="cadastro-produto" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/produto/edit/{{$produto->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="produto">
        <div class="row">
            <div class="form-group col-md-2">
                Codigo Focco
                <input class="form-control" type="text" name="codfocco" id="codfocco" value="{{ $produto->codfocco }}">
            </div>
            <div class="form-group col-md-6">
                Nome do Produto
                <input class="form-control" type="text" name="produto" id="produto" value="{{ $produto->produto }}">
            </div>

            </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="{{$produto->id}}" id="salvar" class="btn btn-success btn-block">
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
                $(location).attr('href',url+'/produto');
            })
        })

    </script>

@endsection

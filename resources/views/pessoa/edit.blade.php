@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Cadastro Cliente/Fornecedor</h3><hr>
    <form action="" id="cadastro-pessoa" nome="cadastro-pessoa" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/pessoa/edit/{{$pessoa->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="pessoa">
        <div class="row">
            <div class="form-group col-md-2">
                Codigo Focco
                <input class="form-control" type="text" name="codfocco" id="codfocco" value="{{ $pessoa->codfocco }}">
            </div>
            <div class="form-group col-md-6">
                Nome do Cliente/Fornecedor
                <input class="form-control" type="text" name="nome" id="nome" value="{{ $pessoa->nome }}">
            </div>
            <div class="form-group col-md-2">
                Cliente
                <select class="form-control limpar" type="text" name="cliente" id="cliente" >
                    <option value="">Selecione</option>
                    <option value="Sim" {{($pessoa->cliente=='Sim')? 'selected' : ''}}>Sim</option>
                    <option value="Não" {{($pessoa->cliente=='Não')? 'selected' : ''}}>Não</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                Fornecedor
                <select class="form-control limpar" type="text" name="fornecedor" id="fornecedor" >
                    <option value="">Selecione</option>
                    <option value="Sim" {{($pessoa->fornecedor=='Sim')? 'selected' : ''}}>Sim</option>
                    <option value="Não" {{($pessoa->fornecedor=='Não')? 'selected' : ''}}>Não</option>
                </select>
            </div>
            </div>
        <div class="row">
            <div class="form-group col-md-3">
                <button type="submit" name="salvar" value="{{$pessoa->id}}" id="salvar" class="btn btn-success btn-block">
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
                $(location).attr('href',url+'/pessoa');
            })
        })

    </script>

@endsection

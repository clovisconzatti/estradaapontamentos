@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fa fa-address-book"></i> Saidas</h3><hr>
    <form action="" id="cadastro-saida" nome="cadastro-saida" method="post">
        @csrf
        @method('patch')
        <input type="hidden" name="route" id="route" value="/saida/edit/{{$saida->id}}">
        <input type="hidden" name="type" id="type" value="PATCH">
        <input type="hidden" name="origem" id="origem" value="saida">
        <div class="row">
            <div class="form-group col-md-2">
                Data
                <input class="form-control" type="text" name="data" id="data" value="{{ $saida->data }}" >
            </div>
            <div class="form-group col-md-6">
                Fornecedor
                <select class="form-control limpar" type="text" name="fornecedor" id="fornecedor" value="{{ $saida->pessoa }}">
                    {{-- <option value="%">Todas</option> --}}
                    @foreach ($clientes as $pessoa )
                        <option value="{{ $pessoa->id }}">{{ $pessoa->nome }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                NF
                <input class="form-control" type="text" name="nf" id="nf" value="{{ $saida->doc }}">
            </div>
            <div class="form-group col-md-6">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto" value="{{ $saida->produto }}">
                    {{-- <option value="%">Todas</option> --}}
                    @foreach ($produtos as $produto )
                        <option value="{{ $produto->id }}">{{ $produto->produto }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-2">
                Quantidade
                <input class="form-control" type="text" name="quantidade" id="quantidade" value="{{ $saida->quantidade }}">
            </div>
            <div class="form-group col-md-2">
                Chassi
                <input class="form-control" type="text" name="chassi" id="chassi" value="{{ $saida->chassi }}">
            </div>
            <div class="form-group col-md-11">
                Observação
                <input class="form-control" type="text" name="obs" id="obs" value="{{ $saida->obs }}">
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

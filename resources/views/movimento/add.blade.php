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
            {{-- <div class="form-group col-md-3"></div> --}}
            {{-- <div class="form-group col-md-4">Manhã</div> --}}
            {{-- <div class="form-group col-md-4">Tarde</div> --}}
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                Data
                <input class="form-control" type="date" name="data" id="data">
            </div>
            <div class="form-group col-md-6">
                Fornecedor
                <select class="form-control limpar" type="text" name="fornecedor" id="fornecedor">
                    <option value="%">Todas</option>

                </select>
            </div>
            <div class="form-group col-md-2">
                NF
                <input class="form-control" type="text" name="nf" id="nf">
            </div>
            <div class="form-group col-md-6">
                Produto
                <select class="form-control limpar" type="text" name="produto" id="produto">
                    <option value="%">Todas</option>

                </select>
            </div>
            <div class="form-group col-md-2">
                Movimento
                <select class="form-control limpar" type="text" name="movimento" id="movimento" >
                    <option value="E">Entrada</option>
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

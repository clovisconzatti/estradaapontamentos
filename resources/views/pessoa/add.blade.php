@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Cadastro Cliente e Fornecedor</h3><hr>
    <form action="" id="cadastro-pessoa" nome="cadastro-pessoa" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/pessoa/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="pessoa">

        <div class="row">
            {{-- <div class="form-group col-md-3"></div> --}}
            {{-- <div class="form-group col-md-4">Manhã</div> --}}
            {{-- <div class="form-group col-md-4">Tarde</div> --}}
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                Codigo Focco
                <input class="form-control limpar" type="text" name="codfocco" id="codfocco" required>
            </div>
            <div class="form-group col-md-6">
                Nome do Cliente/Fornecedor
                <input class="form-control limpar" type="text" name="nome" id="nome" required>
            </div>
            <div class="form-group col-md-2">
                Cliente
                <select class="form-control limpar" type="text" name="cliente" id="cliente" >
                    <option value="">Selecione</option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                Fornecedor
                <select class="form-control limpar" type="text" name="fornecedor" id="fornecedor" >
                    <option value="">Selecione</option>
                    <option value="Sim">Sim</option>
                    <option value="Não">Não</option>
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
                $(location).attr('href',url+'/pessoa');
            })
        })
    </script>

@endsection

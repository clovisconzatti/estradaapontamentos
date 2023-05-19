@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Cadastro de Produtos</h3><hr>
    <form action="" id="cadastro-produto" nome="cadastro-produto" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/produto/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="produto">

        <div class="row">
            {{-- <div class="form-group col-md-3"></div> --}}
            {{-- <div class="form-group col-md-4">Manhã</div> --}}
            {{-- <div class="form-group col-md-4">Tarde</div> --}}
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                Codigo Focco
                <input class="form-control limpar" type="text" name="codfocco" id="codfocco">
            </div>
            <div class="form-group col-md-6">
                Produto
                <input class="form-control limpar" type="text" name="produto" id="produto">
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
            $(location).attr('href',url+'/produto');
        })
    })

</script>

@endsection

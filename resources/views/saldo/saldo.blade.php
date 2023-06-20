@extends('layouts.model')

@section('content')
    <h3 class=""><i class="fas fa-laptop"></i> Saldos</h3><hr>
    <form action="" id="cadastro-saldo" nome="cadastro-saldo" method="post">
        @csrf
        @method('patch')

        <input type="hidden" name="route" id="route" value="/saldo/store">
        <input type="hidden" name="type" id="type" value="POST">
        <input type="hidden" name="origem" id="origem" value="saldo">


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
                $(location).attr('href',url+'/saldo');
            })
        })
    </script>

@endsection

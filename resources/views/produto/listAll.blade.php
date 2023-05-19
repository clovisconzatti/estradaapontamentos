@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="fas fa-laptop"></i> Produto
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>e
                    <a class="cor-digiliza" href="{{route('produto.formAdd')}}">
                        <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;
                        <span>Novo</span>
                    </a>
                </h3>
            </td>
        </tr>
    </table><hr>
    <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
        <span class="fas fa-filter"></span> Filtros
    </button><p>
    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="get" action="{{ route('produto.listAll') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-6">
                        Produto
                        <input class="form-control" type="text" name="produto" id="produto">
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" >
                    <span class="fas fa-play"></span> Filtrar
                </button>
            </form >
        </div>
    </div>
    <p>
    </div>

    <table class="table table-bordered table-condensed table-striped fonte-20">
        <thead>
            <tr>
                <th width="10%">Cod. Focco</th>
                <th width="70%">Produto</th>
                <th width="10%"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produtos as $produto)
                <tr>
                    <td> {{ $produto->codfocco }} </td>
                    <td> {{ $produto->produto }} </td>
                    <td>
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('produto.formEdit', $produto->id)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="#">
                                    {{-- <form action=" {{ route('produto.destroy',['produto'=> $produto->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='produto' value=" {{ $produto->id }} ">
                                        <i class="far fa-trash-alt"></i>
                                        <input type="submit" class="btn btn-default delete"  value="Eliminar"> --}}
                                    </form>
                                </a>
                            </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{-- {{$Operadores->links()}} --}}
@endsection

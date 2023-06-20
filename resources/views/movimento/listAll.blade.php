@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="far fa-clipboard"></i> Entradas
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('movimento.formAdd')}}">
                        <i class="fas fa-plus-circle"></i>&nbsp;&nbsp;&nbsp;
                        <span>Novo</span>
                    </a>
                </h3>
            </td>
        </tr>
    </table><hr>
    <div class="row">
        <div class="form-group col-md-2">
            <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <span class="fas fa-filter"></span> Filtros
            </button>
        </div>
    </div>

    <div class="collapse" id="collapseExample">
        <div class="card card-body">
            <form method="get" action="{{ route('movimento.listAll') }}">
                @csrf
                <div class="row">
                    <div class="form-group col-md-5">
                        Fornecedor:
                        <input class="form-control" type="text" name="fornecedor" value="{{ $filtrofornecedor }}">
                    </div>
                    <div class="form-group col-md-5">
                        Pessoa:
                        <input class="form-control" type="text" name="produto" value="{{ $filtroproduto }}">
                    </div>
                    </div>
                </div>
                <button class="btn btn-primary" type="submit" >
                    <span class="fas fa-play"></span> Filtrar
                </button>
            </form >
        </div>
    </div>
    <p>

    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th width="15%">Data</th>
                <th width="30%">Fornecedor</th>
                <th width="10%">NF</th>
                <th width="30%">Produto</th>
                <th width="10%">Quantidade</th>
                <th width="10%">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimentos as $movimento)
                <tr>
                    <td align="center"> {{ date('d/m/Y',strtotime($movimento->data)) }} </td>
                    <td>{{ $movimento->nome }}  </td>
                    <td>{{ $movimento->doc }}  </td>
                    <td>{{ $movimento->produto }}  </td>
                    <td>{{ $movimento->quantidade }}  </td>
                    <td align="center">
                        <div class="btn-group-vertical">
                            <div class="btn-group">
                            <button type="button"  class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown">
                                <i class="fas fa-cogs"></i>
                                <span>Ação</span>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="{{route('movimento.formEdit', $movimento->id)}}">
                                    <i class="far fa-edit"></i>&nbsp;&nbsp;&nbsp;
                                    <span>Editar</span>
                                </a>
                                <a class="dropdown-item" href="#">

                                </a>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection



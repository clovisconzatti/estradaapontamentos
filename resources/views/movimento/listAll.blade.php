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
                    <div class="form-group col-md-3">
                        Data inicial:
                        <input class="form-control" type="date" name="dtInicial">
                    </div>
                    <div class="form-group col-md-3">
                        Data final:
                        <input class="form-control" type="date" name="dtFinal" >
                    </div>
                    <div class="form-group col-md-3">
                        Fornecedor:
                        <select class="form-control limpar" type="text" name="pessoa" id="pessoa">
                            <option value="">Todas</option>
                            @foreach ($movimentos as $fornecedor )
                                <option value="{{ $fornecedor->id }}" {{($filtrofornecedor == $fornecedor->id)? 'selected' : ''}}>{{ $fornecedor->nome }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group col-md-3">
                        Produto:
                        <select class="form-control limpar" type="text" name="produto" id="produto">
                            <option value="">Todas</option>
                            @foreach ($produtos as $produto )
                                <option value="{{ $produto->id }}" {{($filtroproduto == $produto->id)? 'selected' : ''}}>{{ $produto->produto }}</option>
                            @endforeach
                        </select>
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
                <th width="8%">Data</th>
                <th width="20%">Fornecedor</th>
                <th width="8%">NF</th>
                <th width="15%">Produto</th>
                <th width="5%">Quantidade</th>
                <th width="25%">Observação</th>
                <th width="3%">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($movimentos as $movimento)
                <tr>
                    <td align="center"> {{ date('d/m/Y',strtotime($movimento->data)) }} </td>
                    <td>{{ $movimento->nome }}  </td>
                    <td align="right">{{ $movimento->doc }}  </td>
                    <td>{{ $movimento->produto }}  </td>
                    <td align="right">{{ $movimento->quantidade }}  </td>
                    <td></td>
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
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection



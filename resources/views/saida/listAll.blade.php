@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="far fa-clipboard"></i> Saidas
                </h3>
            </td>
            <td width="50%" align="center">
                <h3>
                    <a class="cor-digiliza" href="{{route('saida.formAdd')}}">
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
            <form method="get" action="{{ route('saida.listAll') }}">
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
                <th width="15%" data-field="name">Data</th>
                <th width="30%" data-field="name">Fornecedor</th>
                <th width="10%" data-field="name">NF</th>
                <th width="30%" data-field="name">Produto</th>
                <th width="10%" data-field="">Ação</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($saidas as $movimento)
                <tr>
                    <td align="center"> {{ date('d/m/Y',strtotime($movimento->data)) }} </td>
                    <td align="">{{ $movimento->pessoa }}  </td>
                    <td align="">{{ $movimento->doc }}  </td>
                    <td align="">{{ $movimento->produto }}  </td>
                    <td align="">
                        <a class="btn btn-info" href="{{route('movimento.movimentoAnexo',[$movimento->id])}}" target="_blank">
                            <i class="fa fa-upload"></i>
                        </a>
                    </td>
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
                                    {{-- <form action=" {{ route('menu.destroy',['menu'=> $menu->id ]) }} " method="POST">
                                        @csrf
                                        @method('delete')
                                        <input type="hidden" name='menu' value=" {{ $menu->id }} ">
                                        <i class="far fa-trash-alt"></i>
                                        <input type="submit" class="btn btn-default delete"  value="Eliminar">
                                    </form> --}}
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



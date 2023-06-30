@extends('layouts.model')
@section('content')
    <table class="table table-borderless table-advance table-condensed">
        <tr>
            <td width="80%">
                <h3>
                    <i class="far fa-clipboard"></i> Saldos
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
            <form method="get" id='formulario' action="">
                @csrf
                <div class="row">
                    <div class="form-group col-md-3">
                        Data inicial:
                        <input class="form-control" type="date" name="dtInicial" value="{{$filtroDtInicial}}">
                    </div>
                    <div class="form-group col-md-3">
                        Data final:
                        <input class="form-control" type="date" name="dtFinal" value="{{$filtroDtFinal}}" >
                    </div>
                    <div class="form-group col-md-3">
                        Produto:
                        <select class="form-control limpar" type="text" name="produto" id="produto">
                            <option value="">Todas</option>
                            @foreach ($produtos as $produto )
                                <option value="{{ $produto->id }}" {{($filtroprodutoid == $produto->id)? 'selected' : ''}}>{{ $produto->produto }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button class="btn btn-primary" type="button" id="tela" >
                    <span class="fas fa-play"></span> Filtrar
                </button>
                <button class="btn btn-warning" type="button" id="pdf">
                    <span class="fas fa-print"></span> Relatório PDF
                </button>
            </form >
        </div>
    </div>
    <p>

    <table class="table table-bordered table-condensed table-striped">
        <thead>
            <tr>
                <th width="10%" data-field="name">Codigo</th>
                <th width="30%" data-field="name">Produto</th>
                <th width="10%" data-field="name">Quantidade</th>

            </tr>
        </thead>
        <tbody>
            @foreach ($saldo as $movimento)
                <tr>
                    <td align="left">{{ $movimento->codfocco }}  </td>
                    <td align="">{{ $movimento->produto }}  </td>
                    <td align="right">{{ number_format($movimento->quantidade,2,',','.') }}  </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        $(document).ready(function(){
            $(document).on('click','#tela',function(event){
                event.preventDefault();
                $(document).find('#formulario').attr('action')
                $(document).find('#formulario').attr('target');
                $(document).find('#formulario').submit()
            })
            $(document).on('click','#pdf',function(event){
                event.preventDefault();
                $(document).find('#formulario').attr('action',url+'/saldo/pdf')
                $(document).find('#formulario').attr('target',"_blank");
                $(document).find('#formulario').submit()
            })
        })
    </script>@endsection



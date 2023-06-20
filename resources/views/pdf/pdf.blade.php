<style>
    table.borda {
        border-collapse: collapse;
        background: #FFF;
        width: 100%;
    }

    table.borda td {
        border-bottom: 1px solid black;
        /* border-left: 1px solid black; */
        padding: 0.20em;
    }

    table.borda th {
        border: 1px solid black;
        background: #F0FFF0;
        padding: 0.20em;
    }
    table tr td:first-child,
    table tr th:first-child {
        border-left: 0;
    }


/* ******************etiqueta**************************** */
    table.etiqueta {
        border-collapse: collapse;
        background: #FFF;
        width: 100%;

    }
    table.etiqueta td, table th {
        border: 1px solid black;
    }
    table.etiqueta tr:first-child th {
        border-top: 0;
    }
    table.etiqueta tr:last-child td {
        border-bottom: 0;
        padding: 0.20em;
    }
    table.etiqueta tr td:first-child,
    table.etiqueta tr th:first-child {
        border-left: 0;
    }
    table.etiqueta tr td:last-child,
    table.etiqueta tr th:last-child {
        border-right: 0;
    }

/* ******************bordaSimples**************************** */
table.bordaSimples {
        border-collapse: collapse;
        background: #FFF;
        width: 100%;
    }
    table.bordaSimples td {
        border: 1px solid black;
        padding: 0.20em;
    }

/* ******************bordaSimples**************************** */
table.semBordas {
        border-collapse: collapse;
        background: #FFF;
        width: 100%;
    }
    table.semBordas td {
        border: 0px solid black;
        padding: 0.20em;
    }

/* ******************fonte**************************** */
    .fontArial{
        font-family: Arial, Helvetica, sans-serif;
    }
    .font7{
        font-size: 7px;
    }
    .font10{
        font-size: 10px;
    }
    .font12{
        font-size: 12px;
    }

    .quadrado{
		border-top: 	1px;
		border-left: 	1px;
		border-right: 	1px;
		border-bottom: 	1px;
		border-style: 	solid;
		border-color: 	#999;
}

.quadradoSel {
    background-color:white;
    height: 40px !important;
    width: 40px !important;
    text-align: center;
    border: 1px solid;
    border-color: black;
    padding-top: 50%;
}

</style>

<table class="bordaSimples">
    <thead>
        <tr>
            <th width="30%" data-field="name">Produto</th>
            <th width="10%" data-field="name">Quantidade</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($saldo as $movimento)
            <tr>
                <td align="">{{ $movimento->produto }}  </td>
                <td align="right">{{ number_format($movimento->quantidade,2,',','.') }}  </td>
            </tr>
        @endforeach
    </tbody>
</table>

$(document).ready(function(){
    $(document).find('select').chosen();

    /*********************hoje*********************************************************** */
        today=new Date();
        y=today.getFullYear();
        m=today.getMonth()+1;
        m=("00" + m).slice(-2);
        d=today.getDate();
        d=("00" + d).slice(-2);

        const hoje = y + '-' + m + '-' + d;
        $('#data1').val(hoje);


        /**********sempre que tabalhar com Ajax no Laravel tem que incluir essa tag *************/
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

/***********************colocando duas casas decimais************************************* */
    var decimal = $('.floatNumberField').attr('decimal');
    $('.floatNumberField').val(parseFloat($('.floatNumberField').val()).toFixed(decimal));

    $(".floatNumberField").on('change',function(){
        var decimal = $(this).attr('decimal');
        $(this).val(parseFloat($(this).val()).toFixed(decimal));
    });
/**********************formata numero **************************************************/
    const formCurrency = new Intl.NumberFormat('pt-BR', {
        style: 'currency',
        currency: 'BRL',
        minimumFractionDigits: 2
    })


/*************************pegando a url do servidor**************************************/

    url = $('input#appurl').val();
    var proCodigo = $(document).find('#produto').val();

/************************ buscaCep ******************************************************/
    $(document).on('blur', 'input#cep', function(event){
        event.preventDefault() // não permite que o navegador faça o submit
        var cep = $(this).val();
        var endereco = $('input#endereco').val().trim();
        if(endereco==''){
            buscaCep(cep);
        };
    })

/************************ buscaCnpj ******************************************************/
    $(document).on('blur', 'input#cnpj', function(event){
        var cnpj=$(this).val().replace('.','').replace('/','').replace('-','');

        if(cnpj.length>=14){
            buscaCnpj(cnpj);
        };
    })


/***********************mensagem confirma exclusão **************************************/
    $(document).on('click', '.delete', function(event){
        event.preventDefault()
        Swal({
            title: 'Deseja realmente excluir?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Remover'
        }).then((result) => {
            if (result.value) {
                var form = $(this).parent()
                form.submit()
            }
        });
    })

    /**********************time intervel *********************************************************************/
    // atualizaCards();
    // setInterval(function(){
    //     atualizaCards();
    // }, 5000);

    /**********************FORMATA VALOR DIGITAR ***************************************************************/
    $('.formataValor').on('change',function(event){
        var valor  = parseFloat($(this).val().replace('.','').replace(',','.'));
        valor = formCurrency.format(valor).replace('R$','');
        $(this).val(valor);
    })

    /**********************FORMATA CNPJ DIGITAR ***************************************************************/
    $('#cnpj').on('keyup',function(){
        var cnpj = $(this).val().replaceAll('.','').replaceAll('-','').replaceAll('/','');
        $(this).val(cnpj);

        if(cnpj.length>=11 && cnpj.length<14){
            $(this).val(cnpj.replace(/^(\d{3})(\d{3})(\d{3})(\d{2})/, "$1.$2.$3-$4"))
        }else if(cnpj.length>=14){
            $(this).val(cnpj.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/, "$1.$2.$3/$4-$5"))
        }
    })


    /**********************gravar menu com ajax **************************************************/
    $(document).on('submit', 'form#cadastro-menu', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var descricao           = $(this).find('input#descricao').val();
        var tipo                = $(this).find('select#tipo').val();
        var ordem               = $(this).find('input#ordem').val();
        var rota                = $(this).find('input#rota').val();
        var icone               = $(this).find('input#icone').val();


        /********************************************************************************************* */
        if(!descricao || !tipo || !ordem ){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'descricao' : descricao
                ,'tipo'     : tipo
                ,'ordem'    : ordem
                ,'rota'     : rota
                ,'icone'    : icone
            }
            grava(dados,route,type,origem);
        }
    })


    /***********************liberaMenu *****************************/
    $('#usuario').on('change',function(){
        liberaMenuDisponivel();
        removeMenuLiberado();
    })

    $(document).on('click','input.disponivel',function(event){
        if($(this).is(":checked")){
            var disponivelId = $(this).val();
            var usuario = $(document).find('#usuario').val();
            addMenuUsuario(disponivelId,usuario)
        }else{
            var liberadoId = $(this).val();
            removeMenuUsuario(liberadoId)
        }
    })
    $(document).on('click','button.liberado',function(event){
        var liberadoId = $(this).val();
        removeMenuUsuario(liberadoId)
    })

    /**********************gravar pessoa **************************************************/
    $(document).on('submit', 'form#cadastro-pessoa', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var codfocco = $(this).find('#codfocco').val();
        var nome = $(this).find('#nome').val();
        var cliente = $(this).find('#cliente').val();
        var fornecedor = $(this).find('#fornecedor').val();


        /********************************************************************************************* */
          if(!codfocco || !nome || !cliente || !fornecedor){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'codfocco'          : codfocco
                ,'nome'             : nome
                ,'cliente'          : cliente
                ,'fornecedor'       : fornecedor

            }
            grava(dados,route,type,origem);
        }
    })

    /**********************gravar produto **************************************************/
    $(document).on('submit', 'form#cadastro-produto', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var codfocco = $(this).find('#codfocco').val();
        var produto = $(this).find('#produto').val();


    /********************************************************************************************* */
        if(!codfocco || !produto){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'codfocco'          : codfocco
                ,'produto'          : produto
            }
            grava(dados,route,type,origem);
        }
    })


    /**********************gravar entrada **************************************************/
    $(document).on('submit', 'form#cadastro-movimento', function(event){
        event.preventDefault()
        var route = $(this).find('input#route').val();
        var type = $(this).find('input#type').val();
        var origem = $(this).find('#origem').val();

        var data = $(this).find('#data').val();
        var pessoa = $(this).find('#pessoa').val();
        var doc = $(this).find('#doc').val();
        var produto = $(this).find('#produto').val();
        var obs= $(this).find('#obs').val();
        var movimento = 'E';
        var quantidade = $(this).find('#quantidade').val();

    /********************************************************************************************* */
        if(!data || !pessoa || !doc || !produto || !quantidade){
            Swal({
                title: 'Preencha todos os campos obrigatório',
                type: 'error',
                timer:3000
            })
        }else{
            var dados= {
                'data'          : data
                ,'pessoa'       : pessoa
                ,'doc'          : doc
                ,'produto'      : produto
                ,'movimento'    : movimento
                ,'quantidade'   : quantidade
                ,'obs'          : obs
            }
            grava(dados,route,type,origem);
        }
    })
 /**********************gravar saida **************************************************/
 $(document).on('submit', 'form#cadastro-saida', function(event){
    event.preventDefault()
    var route = $(this).find('input#route').val();
    var type = $(this).find('input#type').val();
    var origem = $(this).find('#origem').val();

    var data = $(this).find('#data').val();
    var pessoa = $(this).find('#pessoa').val();
    var doc = $(this).find('#doc').val();
    var produto = $(this).find('#produto').val();
    var obs = $(this).find('#obs').val();
    var chassi = $(this).find('#chassi').val();
    var movimento = 'S';
    var quantidade = $(this).find('#quantidade').val();

/********************************************************************************************* */
    if(!data){
        Swal({
            title: 'Preencha todos os campos obrigatório',
            type: 'error',
            timer:3000
        })
    }else{
        var dados= {
            'data'          : data
            ,'pessoa'       : pessoa
            ,'doc'          : doc
            ,'produto'      : produto
            ,'movimento'    : movimento
            ,'quantidade'   : quantidade
            ,'obs'          : obs
            ,'chassi'       : chassi
        }
        grava(dados,route,type,origem);
    }
})


})


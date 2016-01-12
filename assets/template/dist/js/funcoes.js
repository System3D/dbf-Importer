$(document).ready(function(){

    var Basepath = "http://localhost/s4w";

    // Inicio das regras de gravação de etapas do saas
    jQuery("#form-etapa").submit(function(e){
        var codigoEtapa         = $("#codigoEtapa").val();
        var peso                = $("#peso").val();
        var outro               = $("#outro").val();
        var observacao          = $("#observacao").val();
        var obraID              = $("#obraID").val();

        if($("#estruturaPrincipal").is(":checked")) {
            var estruturaPrincipal = 1;
        } else {
            var estruturaPrincipal = 0;
        }
        if($("#estruturaSecundaria").is(":checked")) {
            var estruturaSecundaria = 1;
        } else {
            var estruturaSecundaria = 0;
        }
        if($("#telhasCobertura").is(":checked")) {
            var telhasCobertura = 1;
        } else {
            var telhasCobertura = 0;
        }
        if($("#telhasFechamento").is(":checked")) {
            var telhasFechamento = 1;
        } else {
            var telhasFechamento = 0;
        }
        if($("#calhas").is(":checked")) {
            var calhas = 1;
        } else {
            var calhas = 0;
        }
        if($("#rufosArremates").is(":checked")) {
            var rufosArremates = 1;
        } else {
            var rufosArremates = 0;
        }
        if($("#steelDeck").is(":checked")) {
            var steelDeck = 1;
        } else {
            var steelDeck = 0;
        }
        if($("#gradesPiso").is(":checked")) {
            var gradesPiso = 1;
        } else {
            var gradesPiso = 0;
        }
        if($("#escadas").is(":checked")) {
            var escadas = 1;
        } else {
            var escadas = 0;
        }
        if($("#corrimao").is(":checked")) {
            var corrimao = 1;
        } else {
            var corrimao = 0;
        }


        if (obraID != '' && codigoEtapa != '' && peso != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {codigoEtapa:codigoEtapa, peso:peso, estruturaPrincipal:estruturaPrincipal, estruturaSecundaria:estruturaSecundaria, telhasCobertura:telhasCobertura, telhasFechamento:telhasFechamento, calhas:calhas, rufosArremates:rufosArremates, steelDeck:steelDeck, gradesPiso:gradesPiso, escadas:escadas, corrimao:corrimao, outro:outro, observacao:observacao, obraID:obraID},
                url: Basepath + "/saas/etapas/gravar",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#codigoEtapa").val('');
                        $("#peso").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Verifique os campos obrigatórios!');
         }
         e.preventDefault();
    });

    // Inicio das regras de gravação de etapas do saas
    jQuery("#form-etapa-edita").submit(function(e){
        var codigoEtapa         = $("#codigoEtapa").val();
        var peso                = $("#peso").val();
        var outro               = $("#outro").val();
        var observacao          = $("#observacao").val();
        var obraID              = $("#obraID").val();
        var etapaID             = $("#etapaID").val();

        if($("#estruturaPrincipal").is(":checked")) {
            var estruturaPrincipal = 1;
        } else {
            var estruturaPrincipal = 0;
        }
        if($("#estruturaSecundaria").is(":checked")) {
            var estruturaSecundaria = 1;
        } else {
            var estruturaSecundaria = 0;
        }
        if($("#telhasCobertura").is(":checked")) {
            var telhasCobertura = 1;
        } else {
            var telhasCobertura = 0;
        }
        if($("#telhasFechamento").is(":checked")) {
            var telhasFechamento = 1;
        } else {
            var telhasFechamento = 0;
        }
        if($("#calhas").is(":checked")) {
            var calhas = 1;
        } else {
            var calhas = 0;
        }
        if($("#rufosArremates").is(":checked")) {
            var rufosArremates = 1;
        } else {
            var rufosArremates = 0;
        }
        if($("#steelDeck").is(":checked")) {
            var steelDeck = 1;
        } else {
            var steelDeck = 0;
        }
        if($("#gradesPiso").is(":checked")) {
            var gradesPiso = 1;
        } else {
            var gradesPiso = 0;
        }
        if($("#escadas").is(":checked")) {
            var escadas = 1;
        } else {
            var escadas = 0;
        }
        if($("#corrimao").is(":checked")) {
            var corrimao = 1;
        } else {
            var corrimao = 0;
        }


        if (obraID != '' && codigoEtapa != '' && peso != '' && etapaID != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {codigoEtapa:codigoEtapa, peso:peso, estruturaPrincipal:estruturaPrincipal, estruturaSecundaria:estruturaSecundaria, telhasCobertura:telhasCobertura, telhasFechamento:telhasFechamento, calhas:calhas, rufosArremates:rufosArremates, steelDeck:steelDeck, gradesPiso:gradesPiso, escadas:escadas, corrimao:corrimao, outro:outro, observacao:observacao, obraID:obraID, etapaID:etapaID},
                url: Basepath + "/s4w/saas/etapas/gravarEdicao",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Verifique os campos obrigatórios!');
         }
         e.preventDefault();
    });

    // Inicio das regras de gravação de usuários do saas
    jQuery("#form-obra").submit(function(e){
        var codigo       = $("#codigo").val();
        var nome         = $("#nome").val();
        var descricao    = $("#descricao").val();
        var cidade       = $("#cidade").val();
        var endereco     = $("#endereco").val();
        var cep          = $("#cep").val();
        var clienteID    = $("#clienteID").val();
        var construtora  = $("#construtora").val();
        var gerenciadora = $("#gerenciadora").val();
        var calculista   = $("#calculista").val();
        var detalhamento = $("#detalhamento").val();
        var montagem     = $("#montagem").val();

        if (nome != '' && cidade != '' && endereco != '' && clienteID != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {codigo:codigo, nome:nome, descricao:descricao, cidade:cidade, endereco:endereco, cep:cep, clienteID:clienteID, construtora:construtora, gerenciadora:gerenciadora, calculista:calculista, detalhamento:detalhamento, montagem:montagem},
                url: Basepath + "/saas/obras/gravar",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#codigo").val('');
                        $("#nome").val('');
                        $("#descricao").val('');
                        $("#endereco").val('');
                        $("#cep").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Verifique os campos obrigatórios!');
         }
         e.preventDefault();
    });

    jQuery("#form-obra-edita").submit(function(e){
        var codigo       = $("#codigo").val();
        var nome         = $("#nome").val();
        var descricao    = $("#descricao").val();
        var cidade       = $("#cidade").val();
        var endereco     = $("#endereco").val();
        var cep          = $("#cep").val();
        var clienteID    = $("#clienteID").val();
        var construtora  = $("#construtora").val();
        var gerenciadora = $("#gerenciadora").val();
        var calculista   = $("#calculista").val();
        var detalhamento = $("#detalhamento").val();
        var montagem     = $("#montagem").val();
        var obraID       = $("#obraID").val();

        if (nome != '' && cidade != '' && endereco != '' && clienteID != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {codigo:codigo, nome:nome, descricao:descricao, cidade:cidade, endereco:endereco, cep:cep, clienteID:clienteID, construtora:construtora, gerenciadora:gerenciadora, calculista:calculista, detalhamento:detalhamento, montagem:montagem, obraID:obraID},
                url: Basepath + "/s4w/saas/obras/gravarEdicao",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Verifique os campos obrigatórios!');
         }
         e.preventDefault();
    });
    //Fim das regras de gravação de OBRAS


    // Inicio das regras de gravação de usuários do saas
    jQuery("#form-usuario").submit(function(e){
        var nome          = $("#nome").val();
        var email         = $("#email").val();
        var senha         = $("#senha").val();
        var tipoUsuarioID = $("#tipoUsuarioID").val();

        if ( nome != '' && email != '' && senha != '' && tipoUsuarioID != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {nome:nome, email:email, senha:senha, tipoUsuarioID:tipoUsuarioID},
                url: Basepath + "/saas/usuarios/gravar",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#nome").val('');
                        $("#email").val('');
                        $("#senha").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });

    jQuery("#form-usuario-edita").submit(function(e){
            var nome          = $("#nome").val();
            var email         = $("#email").val();
            var senha         = $("#senha").val();
            var tipoUsuarioID = $("#tipoUsuarioID").val();
            var usuarioLocatarioID = $("#usuarioLocatarioID").val();

            if ( nome != '' && email != '' && senha != '' && tipoUsuarioID != '' && usuarioLocatarioID != '') {
                $('#tipoError2').addClass('hidden');
                $('#tipoError').addClass('hidden');
                $('#tipoSuccess').addClass('hidden');
                $('#tipoLoading').removeClass('hidden');
                jQuery.ajax({
                    type: "POST",
                    data: {nome:nome, email:email, senha:senha, tipoUsuarioID:tipoUsuarioID, usuarioLocatarioID:usuarioLocatarioID},
                    url: Basepath + "/saas/usuarios/gravarEdicao",
                    dataType: "html",
                    success: function(result){
                        if (result.substring(0,7) == 'sucesso') {
                            $('#tipoLoading').addClass('hidden');
                            $('#tipoSuccess').removeClass('hidden');
                            $('#tipoError').addClass('hidden');
                            $('#tipoError2').addClass('hidden');
                            $("#nome").val('');
                            $("#email").val('');
                            $("#senha").val('');
                        } else {
                            $('#tipoLoading').addClass('hidden');
                            $('#tipoError2').removeClass('hidden');
                            $('#tipoSuccess').addClass('hidden');
                        }
                    },
                    error: function(result){
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    },
                });
             } else {
                alert('Todos os campos são obrigatórios!');
             }
             e.preventDefault();
        });
    //Fim das regras de gravação de usuários SAAS

    // Inicio das regras de gravação de clientes
    jQuery("#form-cliente").submit(function(e){
        var razao     = $("#razao").val();
        var fantasia  = $("#fantasia").val();
        var email     = $("#email").val();
        var tipo      = $("#tipo").val();
        var documento = $("#documento").val();
        var inscricao = $("#inscricao").val();
        var telefone  = $("#telefone").val();
        var cidade    = $("#cidade").val();
        var endereco  = $("#endereco").val();
        var cep       = $("#cep").val();

        if ( razao != '' && fantasia != '' && email != '' && tipo != '' && documento != '' && inscricao != '' && telefone != '' && cidade != '' && endereco != '' && cep != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {razao:razao, fantasia:fantasia, email:email, tipo:tipo, documento:documento, inscricao:inscricao, telefone:telefone, cidade:cidade, endereco:endereco, cep:cep},
                url: Basepath + "/saas/clientes/gravar",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#razao").val('');
                        $("#fantasia").val('');
                        $("#email").val('');
                        $("#tipo").val('');
                        $("#documento").val('');
                        $("#inscricao").val('');
                        $("#telefone").val('');
                        $("#cidade").val('');
                        $("#endereco").val('');
                        $("#cep").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });

    jQuery("#form-cliente-edita").submit(function(e){
        var razao     = $("#razao").val();
        var fantasia  = $("#fantasia").val();
        var email     = $("#email").val();
        var tipo      = $("#tipo").val();
        var documento = $("#documento").val();
        var inscricao = $("#inscricao").val();
        var telefone  = $("#telefone").val();
        var cidade    = $("#cidade").val();
        var endereco  = $("#endereco").val();
        var cep       = $("#cep").val();
        var clienteID = $("#clienteID").val();

        if ( razao != '' && fantasia != '' && email != '' && tipo != '' && documento != '' && inscricao != '' && telefone != '' && cidade != '' && endereco != '' && cep != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {razao:razao, fantasia:fantasia, email:email, tipo:tipo, documento:documento, inscricao:inscricao, telefone:telefone, cidade:cidade, endereco:endereco, cep:cep, clienteID:clienteID},
                url: Basepath + "/saas/clientes/gravarEdicao",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#razao").val('');
                        $("#fantasia").val('');
                        $("#email").val('');
                        $("#tipo").val('');
                        $("#documento").val('');
                        $("#inscricao").val('');
                        $("#telefone").val('');
                        $("#cidade").val('');
                        $("#endereco").val('');
                        $("#cep").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });
    // FIM das regras de gravação de clientes

    // Inicio das regras de gravação de parceiro
    jQuery("#form-parceiro").submit(function(e){
        var razao     = $("#razao").val();
        var fantasia  = $("#fantasia").val();
        var email     = $("#email").val();
        var tipo      = $("#tipo").val();
        var documento = $("#documento").val();
        var inscricao = $("#inscricao").val();
        var telefone  = $("#telefone").val();
        var cidade    = $("#cidade").val();
        var endereco  = $("#endereco").val();
        var cep       = $("#cep").val();
        var outro     = $("#outro").val();

        if($("#construtora").is(":checked")) {
            var construtora = 1;
        } else {
            var construtora = 0;
        }
        if($("#gerenciadora").is(":checked")) {
            var gerenciadora = 1;
        } else {
            var gerenciadora = 0;
        }
        if($("#calculista").is(":checked")) {
            var calculista = 1;
        } else {
            var calculista = 0;
        }
        if($("#detalhamento").is(":checked")) {
            var detalhamento = 1;
        } else {
            var detalhamento = 0;
        }
        if($("#montagem").is(":checked")) {
            var montagem = 1;
        } else {
            var montagem = 0;
        }

        if ( razao != '' && fantasia != '' && email != '' && tipo != '' && documento != '' && inscricao != '' && telefone != '' && cidade != '' && endereco != '' && cep != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {razao:razao, fantasia:fantasia, email:email, tipo:tipo, documento:documento, inscricao:inscricao, telefone:telefone, cidade:cidade, endereco:endereco, cep:cep, construtora:construtora, gerenciadora:gerenciadora, calculista:calculista, detalhamento:detalhamento, montagem:montagem, outro:outro},
                url: Basepath + "/saas/parceiros/gravar",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#razao").val('');
                        $("#fantasia").val('');
                        $("#email").val('');
                        $("#tipo").val('');
                        $("#documento").val('');
                        $("#inscricao").val('');
                        $("#telefone").val('');
                        $("#cidade").val('');
                        $("#endereco").val('');
                        $("#cep").val('');
                        $("#outro").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });

    jQuery("#form-parceiro-edita").submit(function(e){
        var razao     = $("#razao").val();
        var fantasia  = $("#fantasia").val();
        var email     = $("#email").val();
        var tipo      = $("#tipo").val();
        var documento = $("#documento").val();
        var inscricao = $("#inscricao").val();
        var telefone  = $("#telefone").val();
        var cidade    = $("#cidade").val();
        var endereco  = $("#endereco").val();
        var cep       = $("#cep").val();
        var outro     = $("#outro").val();
        var clienteID = $("#clienteID").val();

        if($("#construtora").is(":checked")) {
            var construtora = 1;
        } else {
            var construtora = 0;
        }
        if($("#gerenciadora").is(":checked")) {
            var gerenciadora = 1;
        } else {
            var gerenciadora = 0;
        }
        if($("#calculista").is(":checked")) {
            var calculista = 1;
        } else {
            var calculista = 0;
        }
        if($("#detalhamento").is(":checked")) {
            var detalhamento = 1;
        } else {
            var detalhamento = 0;
        }
        if($("#montagem").is(":checked")) {
            var montagem = 1;
        } else {
            var montagem = 0;
        }
        if ( razao != '' && fantasia != '' && email != '' && tipo != '' && documento != '' && inscricao != '' && telefone != '' && cidade != '' && endereco != '' && cep != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {razao:razao, fantasia:fantasia, email:email, tipo:tipo, documento:documento, inscricao:inscricao, telefone:telefone, cidade:cidade, endereco:endereco, cep:cep, clienteID:clienteID, construtora:construtora, gerenciadora:gerenciadora, calculista:calculista, detalhamento:detalhamento, montagem:montagem, outro:outro},
                url: Basepath + "/saas/parceiros/gravarEdicao",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });
    // FIM das regras de gravação de clientes

    // INICIO das regras de gravação de locatários
    jQuery("#form-locatario").submit(function(e){
        var razao     = $("#razao").val();
        var fantasia  = $("#fantasia").val();
        var tipo      = $("#tipo").val();
        var documento = $("#documento").val();
        var telefone  = $("#telefone").val();
        var cidade    = $("#cidade").val();
        var inscricao = $("#inscricao").val();
        var endereco  = $("#endereco").val();
        var cep       = $("#cep").val();
        var email     = $("#email").val();

        if ( razao != '' && fantasia != '' && tipo != '' && documento != '' && telefone != '' && cidade != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {razao:razao, fantasia:fantasia, tipo:tipo, documento:documento, telefone:telefone, cidade:cidade, inscricao:inscricao, endereco:endereco, cep:cep, email:email},
                url: Basepath + "/sistema/locatarios/gravar",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                       $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#razao").val('');
                        $("#fantasia").val('');
                        $("#tipo").val('');
                        $("#documento").val('');
                        $("#telefone").val('');
                        $("#cidade").val('');
                        $("#inscricao").val('');
                        $("#endereco").val('');
                        $("#cep").val('');
                        $("#email").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });

    jQuery("#form-locatario-edita").submit(function(e){
        var razao       = $("#razao").val();
        var fantasia    = $("#fantasia").val();
        var tipo        = $("#tipo").val();
        var documento   = $("#documento").val();
        var telefone    = $("#telefone").val();
        var cidade      = $("#cidade").val();
        var locatarioID = $("#locatarioID").val();
        var inscricao   = $("#inscricao").val();
        var endereco    = $("#endereco").val();
        var cep         = $("#cep").val();
        var email       = $("#email").val();

        if ( razao != '' && fantasia != '' && tipo != '' && documento != '' && telefone != '' && cidade != '' && locatarioID != '') {
            jQuery.ajax({
                type: "POST",
                data: {razao:razao, fantasia:fantasia, tipo:tipo, documento:documento, telefone:telefone, cidade:cidade, locatarioID:locatarioID, inscricao:inscricao, endereco:endereco, cep:cep, email:email},
                url: Basepath + "/sistema/locatarios/gravarEdicao",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#razao").val('');
                        $("#fantasia").val('');
                        $("#tipo").val('');
                        $("#documento").val('');
                        $("#telefone").val('');
                        $("#cidade").val('');
                        $("#locatarioID").val('');
                        $("#inscricao").val('');
                        $("#endereco").val('');
                        $("#cep").val('');
                        $("#email").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });
    // FIM das regras de gravação de locatários

    // INICIO das regras de gravação de usuários dos locatários
    jQuery("#form-locatariousuario").submit(function(e){
        var nome          = $("#nome").val();
        var email         = $("#email").val();
        var senha         = $("#senha").val();
        var locatarioID   = $("#locatarioID").val();
        var tipoUsuarioID = $("#tipoUsuarioID").val();

        if ( nome != '' && email != '' && senha != '' && locatarioID != '' && tipoUsuarioID != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {nome:nome, email:email, senha:senha, locatarioID:locatarioID, tipoUsuarioID:tipoUsuarioID},
                url: Basepath + "/sistema/locatariosUsuarios/gravar",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#nome").val('');
                        $("#email").val('');
                        $("#senha").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });

    jQuery("#form-locatariousuario-edita").submit(function(e){
        var nome               = $("#nome").val();
        var email              = $("#email").val();
        var senha              = $("#senha").val();
        var locatarioID        = $("#locatarioID").val();
        var usuarioLocatarioID = $("#usuarioLocatarioID").val();
        var tipoUsuarioID      = $("#tipoUsuarioID").val();

        if ( nome != '' && email != '' && senha != '' && locatarioID != '' && usuarioLocatarioID != '' && tipoUsuarioID != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {nome:nome, email:email, senha:senha, locatarioID:locatarioID, usuarioLocatarioID:usuarioLocatarioID, tipoUsuarioID:tipoUsuarioID},
                url: Basepath + "/sistema/locatariosUsuarios/gravarEdicao",
                dataType: "html",
                success: function(result){
                   if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#nome").val('');
                        $("#email").val('');
                        $("#senha").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });
    // FIM das regras de gravação de usuários de locatários

    // Inicio das regras de gravação de usuários do saas
    jQuery("#form-admin").submit(function(e){
        var nome          = $("#nome").val();
        var email         = $("#email").val();
        var senha         = $("#senha").val();

        if ( nome != '' && email != '' && senha != '') {
            $('#tipoError2').addClass('hidden');
            $('#tipoError').addClass('hidden');
            $('#tipoSuccess').addClass('hidden');
            $('#tipoLoading').removeClass('hidden');
            jQuery.ajax({
                type: "POST",
                data: {nome:nome, email:email, senha:senha},
                url: Basepath + "/sistema/usuarios/gravar",
                dataType: "html",
                success: function(result){
                    if (result.substring(0,7) == 'sucesso') {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoSuccess').removeClass('hidden');
                        $('#tipoError').addClass('hidden');
                        $('#tipoError2').addClass('hidden');
                        $("#nome").val('');
                        $("#email").val('');
                        $("#senha").val('');
                    } else {
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError2').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    }
                },
                error: function(result){
                    $('#tipoLoading').addClass('hidden');
                    $('#tipoError').removeClass('hidden');
                    $('#tipoSuccess').addClass('hidden');
                },
            });
         } else {
            alert('Todos os campos são obrigatórios!');
         }
         e.preventDefault();
    });

    jQuery("#form-admin-edita").submit(function(e){
            var nome          = $("#nome").val();
            var email         = $("#email").val();
            var senha         = $("#senha").val();
            var usuarioAdminID = $("#usuarioAdminID").val();

            if ( nome != '' && email != '' && senha != '' && usuarioAdminID != '') {
                jQuery.ajax({
                    type: "POST",
                    data: {nome:nome, email:email, senha:senha, usuarioAdminID:usuarioAdminID},
                    url: Basepath + "/sistema/usuarios/gravarEdicao",
                    dataType: "html",
                    success: function(result){
                        if (result.substring(0,7) == 'sucesso') {
                            $('#tipoLoading').addClass('hidden');
                            $('#tipoSuccess').removeClass('hidden');
                            $('#tipoError').addClass('hidden');
                            $('#tipoError2').addClass('hidden');
                        } else {
                            $('#tipoLoading').addClass('hidden');
                            $('#tipoError2').removeClass('hidden');
                            $('#tipoSuccess').addClass('hidden');
                        }
                    },
                    error: function(result){
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    },
                });
             } else {
                alert('Todos os campos são obrigatórios!');
             }
             e.preventDefault();
        });

 jQuery("#profileEdit").submit(function(e){
            var nome          = $("#nome").val();
            var email         = $("#email").val();
            var role          = $("#roleID").val();
            var userID        = $("#userID").val(); 

            if ( nome != '' && email != '' && role != '' && userID != '') {
                $('#tipoError2').addClass('hidden');
                $('#tipoError').addClass('hidden');
                $('#tipoSuccess').addClass('hidden');
                $('#tipoLoading').removeClass('hidden');
                jQuery.ajax({
                    type: "POST",
                    data: {nome:nome, email:email, role:role, userID:userID},
                    url: Basepath + "/sistema/usuarios/userEdicao",
                    dataType: "html",
                    success: function(result){
                        if (result.substring(0,7) == 'sucesso') {
                            $('#tipoLoading').addClass('hidden');
                            $('#tipoSuccess').removeClass('hidden');
                            $('#tipoError').addClass('hidden');
                            $('#tipoError2').addClass('hidden');
                        } else {
                            $('#tipoLoading').addClass('hidden');
                            $('#tipoError2').removeClass('hidden');
                            $('#tipoSuccess').addClass('hidden');
                        }
                    },
                    error: function(result){
                        $('#tipoLoading').addClass('hidden');
                        $('#tipoError').removeClass('hidden');
                        $('#tipoSuccess').addClass('hidden');
                    },
                });
             } else {
                alert('Todos os campos são obrigatórios!');
             } 
             e.preventDefault();
        });
    //Fim das regras de gravação de usuários SAAS

    $('#dataTables').DataTable({
         responsive: true
    });

    var FoneMaskBehavior = function (val) {
      return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    foneOptions = {
      onKeyPress: function(val, e, field, options) {
          field.mask(FoneMaskBehavior.apply({}, arguments), options);
        }
    };

    $('.telefone').mask(FoneMaskBehavior, foneOptions);

    // var options = {
    //     onKeyPress: function(documento, e, field, options){
    //         var masks = ['000.000.000-00', '00.000.000/0000-00'];
    //         var teste = (documento.length > 20) ? masks[1] : masks[0];
    //         console.log(teste);
    //         $('.documento').mask(teste, options);
    //     }
    // };

    // $('.documento').mask('00.000.000/0000-00', docOptions);
    // $('.documento').mask('00.000.000/0000-00', options);
    $('.cep').mask('00000-000');
});
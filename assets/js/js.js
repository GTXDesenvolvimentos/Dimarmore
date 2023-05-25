selectUsuarios();
selectDepto();
selectProjeto();
////////////////////////////////////////
// FUNÇOES GLOBAIS                   
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
function clearForm() {
    $('#formDepartamentos').trigger('reset');
    $('#formProjetos').trigger('reset');
    $('#formEtapas').trigger('reset');
    $(".selectpicker").selectpicker("refresh");
    $('#ModalDepto').modal('hide');
    $('#ModalProjeto').modal('hide');
    $('#ModalEtapas').modal('hide');
}

//==================================================================

////////////////////////////////////////
// FUNÇÃO DE LOGIN                  
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
$(document).ready(function () {
    $('#btnLogin').click(function (e) {
        e.preventDefault();
        var serializeDados = $('#formLogin').serialize();
        $.ajax({
            url: base_url + "/login/login",
            data: serializeDados,
            type: 'POST',
            dataType: "json",
            cache: false,
            beforeSend: function () {
                swal.fire({
                    title: "Aguarde!",
                    text: "Logando no sistema...",
                    imageUrl: base_url + "/assets/img/gifs/loader.gif",
                    showConfirmButton: false
                });
            },
            //complete: function(data) {
            // alert('123');
            // },
            success: function (data) {
                console.log(data);
                if (data.code == 2) {
                    swal.fire({
                        title: "Atenção!",
                        html: data.message,
                        icon: 'info',
                        showConfirmButton: false
                    });
                } else if (data.code == 0) {
                    swal.fire("Atenção!", data.message, "warning");
                } else {
                    window.location.href = base_url;
                }
            },
            error: function (xhr, er) {
                swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
            }
        });
    });
});
//==================================================================






////////////////////////////////////////
// FUNÇÃO CAD E ALTERAR DEPARTAMENTOS                  
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
$(document).ready(function () {
    $('#btnDepartamentos').click(function (e) {
        e.preventDefault();
        var serializeDados = $('#formDepartamentos').serialize();
        $.ajax({
            url: base_url + "/deptos/cadDepto",
            data: serializeDados,
            type: 'POST',
            dataType: "json",
            cache: false,
            beforeSend: function () {
                swal.fire({
                    title: "Aguarde!",
                    text: "Validando os dados...",
                    imageUrl: base_url + "/assets/img/gifs/loader.gif",
                    showConfirmButton: false
                });
            },
            success: function (data) {

                console.log(data);
                if (data.code == 2) {
                    swal.fire({
                        title: "Atenção!",
                        html: data.message,
                        icon: 'info',
                        confirmButtonColor: '#0b475a',
                        confirmButtonText: 'Voltar'
                    });
                } else if (data.code == 0) {
                    swal.fire("Atenção!", data.message, "warning");
                } else if (data.code == 1) {
                    clearForm();
                    $('#tableDepto').bootstrapTable('refresh');
                    Swal.fire({
                        title: 'Sucesso!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#268917',
                        confirmButtonText: 'Sair'
                    });
                }
            },
            error: function (xhr, er) {
                swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
            }
        });
    });

    // document.getElementById('formEtapas')
});
//==================================================================






////////////////////////////////////////
// FUNÇÃO CAD E ALTERAR ETAPAS                 
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
$(document).ready(function () {
    $('#formProjetos').submit(function (e) {
        e.preventDefault()
        var serializeDados = $('#formProjetos').serialize()
        $.ajax({
            url: base_url + 'projetos/cadProjeto',
            dataType: 'json',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                swal.fire({
                    title: "Aguarde!",
                    text: "Validando os dados...",
                    imageUrl: base_url + "/assets/img/gifs/loader.gif",
                    showConfirmButton: false
                });
            },
            success: function (data) {
                console.log(data);
                if (data.code == 2) {
                    swal.fire({
                        title: "Atenção!",
                        html: data.message,
                        icon: 'info',
                        confirmButtonColor: '#0b475a',
                        confirmButtonText: 'Voltar'
                    });
                } else if (data.code == 0) {
                    swal.fire("Atenção!", data.message, "warning");
                } else if (data.code == 1) {

                    clearForm();
                    $('#tableDepto').bootstrapTable('refresh');
                    Swal.fire({
                        title: 'Sucesso!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#268917',
                        confirmButtonText: 'Sair'
                    });
                }

            },
            error: function (xhr, er) {

            }
        })
    })
})
//==================================================================






////////////////////////////////////////
// FUNÇÃO DELETA DEPARTAMENTOS                  
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
function delDepto(value) {
    Swal.fire({
        title: 'Atenção!',
        text: "Deseja realmente deletar o deparatamento?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, quero deletar',
        cancelButtonText: 'Não, voltar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base_url + "/deptos/delDepto",
                data: {
                    id_departamento: value
                },
                type: 'POST',
                dataType: "json",
                cache: false,
                beforeSend: function () {
                    swal.fire({
                        title: "Aguarde!",
                        text: "Validando os dados...",
                        imageUrl: base_url + "/assets/img/gifs/loader.gif",
                        showConfirmButton: false
                    });
                },
                success: function (data) {
                    console.log(data);
                    if (data.code == 2) {
                        swal.fire({
                            title: "Atenção!",
                            html: data.message,
                            icon: 'info',
                            confirmButtonColor: '#0b475a',
                            confirmButtonText: 'Voltar'
                        });
                    } else if (data.code == 0) {
                        swal.fire("Atenção!", data.message, "warning");
                    } else if (data.code == 1) {

                        clearForm();
                        $('#tableDepto').bootstrapTable('refresh');
                        Swal.fire({
                            title: 'Sucesso!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#268917',
                            confirmButtonText: 'Sair'
                        });
                    }
                },
                error: function (xhr, er) {
                    swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
                }
            });
        }
    })
}



////////////////////////////////////////
// FUNÇÃO DELETA DEPARTAMENTOS                  
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
function delEtapas(value) {
    Swal.fire({
        title: 'Atenção!',
        text: "Deseja realmente deletar o etapa?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, quero deletar',
        cancelButtonText: 'Não, voltar'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base_url + "/Etapas/delEtapa",
                data: {
                    id_etapa: value
                },
                type: 'POST',
                dataType: "json",
                cache: false,
                beforeSend: function () {
                    swal.fire({
                        title: "Aguarde!",
                        text: "Validando os dados...",
                        imageUrl: base_url + "/assets/img/gifs/loader.gif",
                        showConfirmButton: false
                    });
                },
                success: function (data) {
                    console.log(data);
                    if (data.code == 2) {
                        swal.fire({
                            title: "Atenção!",
                            html: data.message,
                            icon: 'info',
                            confirmButtonColor: '#0b475a',
                            confirmButtonText: 'Voltar'
                        });
                    } else if (data.code == 0) {
                        swal.fire("Atenção!", data.message, "warning");
                    } else if (data.code == 1) {

                        clearForm();
                        $('#tableDepto').bootstrapTable('refresh');
                        Swal.fire({
                            title: 'Sucesso!',
                            text: data.message,
                            icon: 'success',
                            confirmButtonColor: '#268917',
                            confirmButtonText: 'Sair'
                        });
                    }
                },
                error: function (xhr, er) {
                    swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
                }
            });
        }
    })
}




////////////////////////////////////////
// FUNÇÃO CAD E ALTERAR ETAPAS                 
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
$(document).ready(function () {
    $('#formEtapas').submit(function (e) {
        e.preventDefault()
        var serializeDados = $('#formProjetos').serialize()
        $.ajax({
            url: base_url + 'etapas/cadEtapa',
            dataType: 'json',
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false,
            beforeSend: function () {
                swal.fire({
                    title: "Aguarde!",
                    text: "Validando os dados...",
                    imageUrl: base_url + "/assets/img/gifs/loader.gif",
                    showConfirmButton: false
                });
            },
            success: function (data) {
                console.log(data);
                if (data.code == 2) {
                    swal.fire({
                        title: "Atenção!",
                        html: data.message,
                        icon: 'info',
                        confirmButtonColor: '#0b475a',
                        confirmButtonText: 'Voltar'
                    });
                } else if (data.code == 0) {
                    swal.fire("Atenção!", data.message, "warning");
                } else if (data.code == 1) {

                    clearForm();
                    $('#tableDepto').bootstrapTable('refresh');
                    Swal.fire({
                        title: 'Sucesso!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonColor: '#268917',
                        confirmButtonText: 'Sair'
                    });
                }

            },
            error: function (xhr, er) {

            }
        })
    })
})
//==================================================================





////////////////////////////////////////
// MONTA SELECT DE USUARIOS                 
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
function selectUsuarios() {

    $.ajax({
        url: base_url + "Etapas/retUsers",
        type: 'POST',
        dataType: "json",
        cache: false,
        error: function () {
            swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
        },
        beforeSend: function () {
            swal.fire({
                title: "Aguarde!",
                text: "Validando os dados...",
                imageUrl: base_url + "/assets/img/gifs/loader.gif",
                showConfirmButton: false
            });
        },
        success: function (result) {
            $('#slEtapResponsavel, #slRespProjeto, #slInforResponsavel').prop('disabled', false);
            $('#slEtapResponsavel, #slRespProjeto, #slInforResponsavel').selectpicker('refresh');
            $('#slEtapResponsavel, #slRespProjeto, #slInforResponsavel').html('');
            $('#slEtapResponsavel, #slRespProjeto, #slInforResponsavel').append('<option value=""> Responsável </option>');

            var jsonData1 = JSON.stringify(result);
            $.each(JSON.parse(jsonData1), function (idx, obj) {
                $('#slEtapResponsavel, #slRespProjeto, #slInforResponsavel').append('<option value="' + obj.id_users + '">' + obj.nome + '</option>').selectpicker('refresh');
            });
            swal.fire({
                timer: 1,
                title: "Aguarde!",
                text: "Validando os dados...",
                imageUrl: base_url + "/assets/img/gifs/loader.gif",
                showConfirmButton: false
            });
        }
    });

}
//==================================================================

////////////////////////////////////////
// MONTA SELECT DE DEPARTAMENTOS                 
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
function selectDepto() {

    $.ajax({
        url: base_url + "deptos/retDepto",
        type: 'POST',
        dataType: "json",
        cache: false,
        error: function () {
            swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
        },
        beforeSend: function () {
            swal.fire({
                title: "Aguarde!",
                text: "Validando os dados...",
                imageUrl: base_url + "/assets/img/gifs/loader.gif",
                showConfirmButton: false
            });
        },
        success: function (result) {
            $('#slDepProjeto').prop('disabled', false);
            $('#slDepProjeto').selectpicker('refresh');
            $('#slDepProjeto').html('');
            $('#slDepProjeto').append('<option value="">Projetos</option>');

            var jsonData1 = JSON.stringify(result);
            $.each(JSON.parse(jsonData1), function (idx, obj) {
                $('#slDepProjeto').append('<option value="' + obj.id_departamento + '">' + obj.descricao + '</option>').selectpicker('refresh');
            });
            swal.fire({
                timer: 1,
                title: "Aguarde!",
                text: "Validando os dados...",
                imageUrl: base_url + "/assets/img/gifs/loader.gif",
                showConfirmButton: false
            });
        }
    });

}
//==================================================================

////////////////////////////////////////
// MONTA SELECT DE PROJETOS                 
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
function selectProjeto() {

    $.ajax({
        url: base_url + "Etapas/retProjeto",
        type: 'POST',
        dataType: "json",
        cache: false,
        error: function () {
            swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
        },
        beforeSend: function () {
            swal.fire({
                title: "Aguarde!",
                text: "Validando os dados...",
                imageUrl: base_url + "/assets/img/gifs/loader.gif",
                showConfirmButton: false
            });
        },
        success: function (result) {
            $('#slEtapProjeto, #slInforProjeto').prop('disabled', false);
            $('#slEtapProjeto, #slInforProjeto').selectpicker('refresh');
            $('#slEtapProjeto, #slInforProjeto').html('');
            $('#slEtapProjeto, #slInforProjeto').append('<option value=""> Projeto </option>');

            var jsonData1 = JSON.stringify(result);
            $.each(JSON.parse(jsonData1), function (idx, obj) {
                $('#slEtapProjeto, #slInforProjeto').append('<option value="' + obj.id_projeto + '">' + obj.id_projeto + " - " + obj.descricao + '</option>').selectpicker('refresh');
            });
            swal.fire({
                timer: 1,
                title: "Aguarde!",
                text: "Validando os dados...",
                imageUrl: base_url + "/assets/img/gifs/loader.gif",
                showConfirmButton: false
            });
        }
    });

}
//==================================================================

////////////////////////////////////////
// ALTERA O NOME DO INPUT FILE
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////
$("#anexoEtapa").on('change', function () {
    var input = document.getElementById("anexoEtapa");
    let anexo = input.files[0].name;
    document.getElementById("lbEtapa").innerHTML = anexo
})
//==================================================================

function imgEtapa(value) {
    $.ajax({
        url: base_url + "Etapas/imgEtapa",
        type: 'POST',
        dataType: "json",
        data: {
            id_etapa: value
        },
        cache: false,
        error: function () {
            swal.fire("Atenção!", "Ocorreu um erro ao retornar a imagem!", "error");
        },
        beforeSend: function () {
            swal.fire({
                title: "Aguarde!",
                text: "Validando os dados...",
                imageUrl: base_url + "/assets/img/gifs/loader.gif",
                showConfirmButton: false
            });
        },
        success: function (result) {
            console.log(result);
            swal.fire({
                timer: 1,
                title: "Aguarde!",
                text: "Validando os dados...",
                imageUrl: base_url + "/assets/img/gifs/loader.gif",
                showConfirmButton: false
            });
            $('#ModalInfor').modal('show');
            $('#txtInfor').html("ETAPA : " + value);
            var img = document.querySelector("#imgInfor");
            img.setAttribute('src', base_url + 'assets/uploads/imgEtapas/' + result[0].anexo);
            $('#txtIdInfor').val(result[0].id_etapa);
            $('#txtNomeInfor').val(result[0].etapa);
            $('#txtDescInfor').val(result[0].descricao);
            $('#txtInforDtLimit').val(result[0].data_fim);
            $('#slInforPrioridade').selectpicker('val', result[0].prioridade);
            $('#slInforProjeto').selectpicker('val', result[0].id_projeto);
            $('#slInforResponsavel').selectpicker("val", result[0].responsavel);
            $('#slInforPrioridade, #slInforProjeto, #slInforResponsavel').prop('disabled', true);
            $('#slInforPrioridade, #slInforProjeto, #slInforResponsavel').selectpicker('refresh');
        }
    });
}
''
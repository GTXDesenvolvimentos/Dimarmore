
// FUNÇÃO arrayColumn DO PHP PARA JAVASCRIPT
const arrayColumn = (array, column) => {
    return array.map(item => parseInt(item[column]));
};

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
                    clearModal();
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

$(document).ready(function () {
    $('[data-id="slRespProjeto"]').on('click', function () {
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
                $('#slEtapResponsavel').prop('disabled', false);
                $('#slEtapResponsavel').selectpicker('refresh');
                $('#slEtapResponsavel').html('');
                $('#slEtapResponsavel').append('<option value=""> Responsável </option>');

                var jsonData1 = JSON.stringify(result);
                $.each(JSON.parse(jsonData1), function (idx, obj) {
                    $('#slResponsavel, #slRespProjeto').append('<option value="' + obj.id_users + '">' + obj.nome + '</option>').selectpicker('refresh');
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

    });
});

//==================================================================


////////////////////////////////////////
// MONTA SELECT DE DEPARTAMENTOS                 
// CRIADO POR MARCIO SILVA            
// DATA: 09/02/2023                   
////////////////////////////////////////

$(document).ready(function () {
    $('[data-id="slDepProjeto"]').on('click', function () {

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
                console.log(result);


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

    });
});

//==================================================================

////////////////////////////////////////
// MONTA SELECT DE RESPONSÁVEIS           
// CRIADO POR ELIEL AMORIM    
// DATA: 25/05/2023                   
////////////////////////////////////////
$('#ModalAtividades').on('show.bs.modal', function () {
    $('[data-id="slRespAtividade"]').click(function () {
        $('#slRespAtividade').on('show.bs.select', function () {
            $.ajax({
                url: base_url + '/usuarios/retUsers',
                dataType: 'json',
                type: 'post',
                success: function (ret) {
                    $('#slRespAtividade').html('');
                    $('#slRespAtividade').append('<option value=""> Responsável </option>').selectpicker('refresh')
                    $.each(ret, (index, row) => {
                        $('#slRespAtividade').append('<option value="' + row.id_users + '"> ' + row.registro + ' - ' + row.nome + ' </option>').selectpicker('refresh')
                    })

                    swal.close();
                },
                error: function () {
                    swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
                },
                beforeSend: function () {
                    swal.fire({
                        title: "Aguarde!",
                        text: "Buscando os responsáveis...",
                        imageUrl: base_url + "/assets/img/gifs/loader.gif",
                        showConfirmButton: false
                    });
                },
            })
        })
    })

    $('[data-id="slEtapa"]').click(function () {
        $('#slEtapa').on('show.bs.select', function () {
            $.ajax({
                url: base_url + '/etapas/retEtapas',
                dataType: 'json',
                type: 'post',
                success: function (ret) {
                    console.log(ret)
                    $('#slEtapa').html('');
                    $('#slEtapa').append('<option value=""> Etapa </option>').selectpicker('refresh')
                    $.each(ret, (index, row) => {
                        $('#slEtapa').append('<option value="' + row.id_etapa + '"> ' + row.id_etapa + ' - ' + row.etapa + ' </option>').selectpicker('refresh')
                    })

                    swal.close();
                },
                error: function () {
                    swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
                },
                beforeSend: function () {
                    swal.fire({
                        title: "Aguarde!",
                        text: "Buscando as etapas...",
                        imageUrl: base_url + "/assets/img/gifs/loader.gif",
                        showConfirmButton: false
                    });
                },
            })
        })
    })
});

///////////////////////////////////////////////////
// MONTA SELECT DE PROJETOS APÓS SELEÇÃO DE ETAPA
// CRIADO POR ELIEL AMORIM    
// DATA: 25/05/2023                   
///////////////////////////////////////////////////

function retAllProjects(id_etapa) {
    $.ajax({
        url: base_url + '/projetos/retAllProjects',
        dataType: 'json',
        type: 'post',
        data: { id_etapa: id_etapa },
        success: function (ret) {
            console.log(ret)
            $('#slProjeto').html('');
            $('#slProjeto').append('<option value=""> Projeto </option>').selectpicker('refresh')
            $.each(ret, (index, row) => {
                $('#slProjeto').append('<option value="' + row.id_projeto + '"> ' + row.id_projeto + ' - ' + row.nomeProjeto + ' </option>').selectpicker('refresh')
            })

            if (ret.length == 1) {
                $('#slProjeto').selectpicker('val', ret[0].id_projeto);
            }

            swal.close();
        },
        error: function () {
            swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
        },
        beforeSend: function () {
            swal.fire({
                title: "Aguarde!",
                text: "Buscando os projetos...",
                imageUrl: base_url + "/assets/img/gifs/loader.gif",
                showConfirmButton: false
            });
        },
    })
}

//==================================================================

///////////////////////////////////////////////////
// CADASTRO DE ETAPA
// CRIADO POR ELIEL AMORIM    
// DATA: 25/05/2023                   
///////////////////////////////////////////////////

$('#formAtividade').submit(function (e) {
    e.preventDefault()

    $.ajax({
        url: base_url + 'atividades/cadAtividades',
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
                $('#tableAtividades').bootstrapTable('refresh');
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

// TRANSFORMA TODOS OS SELECTPICKERS EM MODO MOBILE
$(document).ready(function () {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent)) {
        $('.selectpicker').selectpicker('mobile');
    }
})

//==================================================================

function viewAnexo(value) {
    if (value !== '') {
        return '<buttom class="btn btn-outline-success btn-sm" onclick="modalAnexo(\'' + value + '\');"><i class="fa-regular fa-images"></i></button';
    }
}

function modalAnexo(value) {
    $('#docAnexoView').html('<embed id="docAnexoView" src="' + base_url + '/assets/uploads/' + value + '" frameborder="0" width="100%" height="400px">');
    $('#modalAnexo').modal('show');
}
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


}

function situacao(value) {
    if (value == 'P') {
        return 'Pendente';
    }
}


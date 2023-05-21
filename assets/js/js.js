    ////////////////////////////////////////
    // FUNÇOES GLOBAIS                   
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    function clearForm() {
        $('#formDepartamentos').trigger('reset');
    }

    function clearModal() {
        $('#ModalDepto').modal('hide');
    }
    //==================================================================



    ////////////////////////////////////////
    // FUNÇÃO DE LOGIN                  
    // CRIADO POR MARCIO SILVA            
    // DATA: 09/02/2023                   
    ////////////////////////////////////////
    $(document).ready(function() {
        $('#btnLogin').click(function(e) {
            e.preventDefault();
            var serializeDados = $('#formLogin').serialize();
            $.ajax({
                url: base_url + "/login/login",
                data: serializeDados,
                type: 'POST',
                dataType: "json",
                cache: false,
                beforeSend: function() {
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
                success: function(data) {
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
                error: function(xhr, er) {
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
    $(document).ready(function() {
        $('#btnDepartamentos').click(function(e) {
            e.preventDefault();
            var serializeDados = $('#formDepartamentos').serialize();
            $.ajax({
                url: base_url + "/deptos/cadDepto",
                data: serializeDados,
                type: 'POST',
                dataType: "json",
                cache: false,
                beforeSend: function() {
                    swal.fire({
                        title: "Aguarde!",
                        text: "Validando os dados...",
                        imageUrl: base_url + "/assets/img/gifs/loader.gif",
                        showConfirmButton: false
                    });
                },
                success: function(data) {

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
                error: function(xhr, er) {
                    swal.fire("Atenção!", "Ocorreu um erro ao retornar os dados!", "error");
                }
            });
        });
    });
    //==================================================================
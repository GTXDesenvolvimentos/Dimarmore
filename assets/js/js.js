//FUNÇÃO DE LOGIN
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
})


// var dadosajax = {
//     email: $('#email').val(),
//     password: $('#password').val()
// };
// $.ajax({
//     url: "http://localhost/dimarmore/login/login",
//     data: dadosajax,
//     type: 'POST', //MÉTODO DE ENVIO TIPO POST//
//     dataType: "json",
//     cache: false,
//     error: function() {
//         swal.fire("Atenção!", "Ocorreu um erro ao buscar dados!", "error");
//     },
//     beforeSend: function() {

//         swal.fire({
//             title: "Aguarde!",
//             text: "Buscando dados...",
//             imageUrl: "http://localhost/dimarmore/assets/img/gifs/loader.gif",
//             showConfirmButton: false
//         });
//     },
//     success: function(result) {
//         if (result.cod == 2) {
//             swal.fire({
//                 timer: 1000,
//                 title: "Aguarde!",
//                 text: "Buscando dados...",
//                 imageUrl: "http://localhost/dimarmore/assets/img/gifs/loader.gif",
//                 showConfirmButton: false
//             });
//             $('#msg').html(result.mensagens);
//             $('#alert').removeClass('d-none');
//         } else {
//             swal.fire("Atenção!", "Logado!", "info");
//         }
//     }
// });
// }
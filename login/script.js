'use strict'

$(document).ready(function () {
   $('#formLogin').submit(function(e) {
        e.preventDefault(); // Prevent form from submitting the traditional way
        $('button').attr('disabled', true);
        $.ajax({
            url: 'controller.php', // File PHP untuk login
            type: 'POST',
            data: $(this).serialize(), // Mengirim form data
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                     window.location.href = "/hawai-karaoke/index.php";
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Login Gagal",
                        text: response.message,
                    });
                }
                $('button').attr('disabled', false);
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
    });
})
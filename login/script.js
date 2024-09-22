'use strict'

$(document).ready(function () {
   $('#formLogin').submit(function(e) {
        e.preventDefault(); // Prevent form from submitting the traditional way

        $.ajax({
            url: 'controller.php', // File PHP untuk login
            type: 'POST',
            data: $(this).serialize(), // Mengirim form data
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    // Login berhasil, redirect ke halaman yang diinginkan
                     window.location.href = "/hawai-karaoke/index.php";
                } else {
                    // Tampilkan pesan error
                    $('#errorMessage').text(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
            }
        });
    });
})
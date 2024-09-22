

$(document).ready(function () {
     $('#formRegister').on('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission
      var formData = $(this).serialize(); // Serialize form data
      $.ajax({
          url: 'register.php', // URL to send the request to
          type: 'POST', // Method type
          data: formData, // Data to send
          success: function(response) {
            var result = JSON.parse(response);
            if (result.status) {
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Data berhasil ditambahkan",
                showConfirmButton: false,
                timer: 1500
              }).then(function () {
                // Redirect after the SweetAlert finishes
                window.location.href = "/hawai-karaoke/login/view.php";
              });
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Simpan Data Error",
              });
            } 
            
          },
          error: function(xhr, status, error) {
              // Handle errors
              
              Swal.fire({
                icon: "error",
                title: "Ajax Error",
                text: error,
              });
              
          }
      });
    });
});


window.confirmPassword = (input, evt) => {
  const password = $("#password").val();
  if (password != $(input).val()) {
    $(input).addClass('border border-danger');
    $("#cerror").fadeIn(100);
  } else {
    $("#cerror").fadeOut(10);
    $(input).removeClass('border border-danger');
  }
  console.log($(input).val());
}
'use strict'

let customerTable;
$(document).ready(function () { 
  
  // menampilkan data menggunakan dataTableJs serverside
  customerTable = $("#tableCustomer").DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": "dataTable.php",
          "type": "POST"
      },
      "columns": [
          { 
              "data": 'id', // Kolom untuk nomor urut
              "render": function(data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "name" },
          { "data": "username" },
          { "data": "email" },
          {
          "data": "role_id", 'render': function (data) {
              if (data == 1) return "Administrator";
              return "User";
            }
          },
          { "data": "created_at" },
          {
            "render": function (data, type, row) {
                
                return `<button data-id="${row.id}" class="btn btn-success btn-sm me-2" onclick="editCustomer(this,event)">Edit</button> <button data-id="${row.id}" class="btn btn-danger btn-sm" onclick="deleteCustomer(this,event)">Hapus</button>`
          }
        }
    ],
    "columnDefs": [
      {
          "targets": 0, // Target kolom pertama
          "className": "text-center", // Kelas CSS untuk memusatkan teks
          "sWidth" : '5%'
      },
      {
          "targets": -1, // Target kolom terakhir
          "className": "text-center" // Kelas CSS untuk memusatkan teks
      }
    ]

  
  });


 $('#formCreate').on('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission
      var formData = $(this).serialize(); // Serialize form data
      $.ajax({
          url: 'create_customer.php', // URL to send the request to
          type: 'POST', // Method type
          data: formData, // Data to send
          success: function(response) {
            var result = JSON.parse(response);
            if (result.status) {
              $("#formAddCustomer").modal('hide');
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Data berhasil ditambahkan",
                showConfirmButton: false,
                timer: 1500
              });
              customerTable.ajax.reload();
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

 $('#isChangePassword').click(function() {
        if ($('#isChangePassword').is(':checked')) {
            $("#formEdit #password").attr('required', true);
            $("#formEdit #parent-password").fadeIn(100);
        } else {
             $("#formEdit #password").attr('required', false);
             $("#formEdit #parent-password").fadeOut(100);
        }
 });
 
 $('#formEdit').on('submit', function(event) {
      event.preventDefault(); // Prevent the default form submission
      var formData = $(this).serialize(); // Serialize form data
      $.ajax({
          url: 'update_customer.php', // URL to send the request to
          type: 'POST', // Method type
          data: formData, // Data to send
          success: function(response) {
            var result = JSON.parse(response);
            if (result.status) {
              $("#formEditCustomer").modal('hide');
              Swal.fire({
                position: "top-end",
                icon: "success",
                title: "Data berhasil diperbaharui",
                showConfirmButton: false,
                timer: 1500
              });
              customerTable.ajax.reload();
            } else {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: "Ubah Data Error",
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

window.deleteCustomer = (input, evt) => {
    const userId = $(input).data('id'); 
  
    // Use SweetAlert2 for confirmation
    Swal.fire({
        title: 'Hapus Data',
        text: "Anda yakin ingin menghapus data ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            // If confirmed, perform AJAX request
            $.ajax({
                url: 'delete_customer.php',
                method: 'POST',
                data: { id: userId },
                dataType: 'json',
                success: function (response) {
                    result = response;
                    console.log(result);
                    if (result.status == 'success') {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Data berhasil dihapus",
                            showConfirmButton: false,
                            timer: 1500
                        });
                        customerTable.ajax.reload();
                    } else {
                        Swal.fire({
                            icon: "error",
                            title: "Simpan Data Error",
                            text: result.message,
                        });
                    } 
                },
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: "error",
                        title: "Ajax Error",
                        text: error,
                    });
                    
                }
            });
        }
    });
}

window.editCustomer = (input, evt) => {
    const userId = $(input).data('id');   
    $.ajax({
        url: 'update_customer.php',
        method: 'GET',
        data: { id: userId },
        dataType: 'json',
        success: function(user) {
            $('#edit-id').val(user.id);
            $('#edit-name').val(user.name);
            $('#edit-username').val(user.username);
            $('#edit-email').val(user.email);
            $('#edit-role_id').val(user.role_id);
            
            $("#formEditCustomer").modal('show');

        }
    });
}


'use strict'

let customerTable;
const ROLE = $("#role-code").val();
$(document).ready(function () { 
  moment.locale('id');
  // menampilkan data menggunakan dataTableJs serverside
  customerTable = $("#tableCustomer").DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": "dataTable.php",
          "type": "POST",
          "dataSrc": function (json) {
              if (ROLE == '1') return json.data;
              const filteredUsers = json.data.filter(user => user.role_id == 3);
              return filteredUsers;
            }
          
      },
      "columns": [
          { 
              "data": 'id', // Kolom untuk nomor urut
              "render": function(data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "name" },
          { "data": "email" },
          {
          "data": "role_id", 'render': function (data) {
              if (data == 1) return "Administrator";
              if (data == 2) return "Kasir";
              return "Customer";
            }
          },
        {
          "data": "created_at", "render": function (data) {
            return `${moment(data).format('D MMMM YYYY')}  <small class="text-muted">${moment(data).format('HH:mm')}</small>`;
          }
        },
          {
            "render": function (data, type, row) {
              
              if (ROLE == '1') {
                return `
                <button data-toggle="tooltip" title="Lihat Detail" data-id="${row.id}" class="btn btn-info btn-sm me-2" onclick="detailCustomer(this,event)"> <i class="fas fa-eye"></i> </button> 
                <button data-toggle="tooltip" title="Edit Customer" data-id="${row.id}" class="btn btn-success btn-sm me-2" onclick="editCustomer(this,event)"> <i class="fas fa-user-edit"></i> </button> 
                <button data-toggle="tooltip" title="Hapus Customer" data-id="${row.id}" class="btn btn-danger btn-sm" onclick="deleteCustomer(this,event)"> <i class="fas fa-trash"></i> </button>`;
              } else {
                    return `
                <button data-toggle="tooltip" title="Lihat Detail" data-id="${row.id}" class="btn btn-info btn-sm me-2" onclick="detailCustomer(this,event)"> <i class="fas fa-eye"></i> </button> 
                <button data-toggle="tooltip" title="Edit Customer" data-id="${row.id}" class="btn btn-success btn-sm me-2" onclick="editCustomer(this,event)"> <i class="fas fa-user-edit"></i> </button> 
                `;
              }
              
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
  
$("#role_id").on('change', function () {
  const value = $(this).val();
  if (value == '3') {
    $("#parent-for-customer").fadeIn(100);
  } else {
    $("#parent-for-customer").fadeOut(100);
  }
})
    
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

window.detailCustomer = (input, evt) => {
  const userId = $(input).data('id'); 
  $("#modaShowDetail").modal('show');
    $.ajax({
        url: 'update_customer.php',
        method: 'GET',
        data: { id: userId },
        dataType: 'json',
        success: function(user) {
            $('#address-d').val(user.address);
            $('#phone-d').val(user.phone);
            $('#birthyear-d').val(user.birthyear);
            $('#email-d').val(user.email);
            $('#name-d').val(user.name);
            $('#username-d').val(user.username);
            $('#role-d').val(user.role_id == 1 ? "Administrator" : (user.role_id == 2 ? "Kasir" : "Customer"));
            if (user.gender == "L") {
              $("#label-gender").text("Pria");
            } else if (user.gender == "P") {
              $("#label-gender").text("Wanita");
            } else {
              $("#label-gender").text("");
            }
            $("#modaShowDetail").modal('show');

        }
    });
}


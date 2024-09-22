let bookingTable;
$(document).ready(function () { 
    bookingTable = $("#tableBooking").DataTable({
      "processing": true,
      "serverSide": true,
      "ajax": {
          "url": "dataTable.php",
          "type": "POST",
          "dataSrc": function (json) {
            return json.data;
          }
          
      },
      "columns": [
          { 
              "data": 'id', // Kolom untuk nomor urut
              "render": function(data, type, row, meta) {
                  return meta.row + meta.settings._iDisplayStart + 1;
              }
          },
          { "data": "bookingCode" },
        {
          "data": "userName", "render": function (data, type, row) {
            return `${data} - Member`
          }
        },
          {
          "data": "roomCode", 'render': function (data, type, row) {
              return `${data} - ${row.roomName}`;
            }
          },
        {
          "data": "start", "render": function (data) {
            return `<small class="text-muted">${moment(data).format('D MMMM YYYY')}</small>  <span class="text-bold">${moment(data).format('HH:mm')}<span>`;
          }
        },
        {
          "data": "end", "render": function (data) {
            if(data == null) return `<small class="text-muted">Belum terjadwal</small>`
            return `<small class="text-muted">"${moment(data).format('D MMMM YYYY')}</small>  <span class="text-bold">${moment(data).format('HH:mm')}<span>`;
          }
        },
        {
          "data": "status", "render": function (data) {
            switch (data) {
              case "booked":
                return `<span class="bg-warning p-2 rounded text-dark">Sudah Dibooking</span>`;
              case "played":
                return `<span class="bg-success p-2 rounded text-dark">Sedang di ruangan</span>`;
              default:
                return `<span class="bg-danger p-2 rounded text-dark">Dibatalkan</span>`;
            }
          }
        },
          {
            "render": function (data, type, row) {
              
              return `
                <button data-toggle="tooltip" title="Lihat Detail" data-id="${row.id}" class="btn btn-info btn-sm me-2" onclick="detailCustomer(this,event)"> <i class="fas fa-eye"></i> </button> 
                <button data-toggle="tooltip" title="Edit Customer" data-id="${row.id}" class="btn btn-success btn-sm me-2" onclick="editCustomer(this,event)"> <i class="fas fa-user-edit"></i> </button> 
                <button data-toggle="tooltip" title="Hapus Customer" data-id="${row.id}" class="btn btn-danger btn-sm" onclick="deleteCustomer(this,event)"> <i class="fas fa-trash"></i> </button>`;
              
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
});
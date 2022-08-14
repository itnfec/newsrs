/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*************************************!*\
  !*** ./resources/js/admin/level.js ***!
  \*************************************/
var table = $('#table').DataTable({
  processing: true,
  serverSide: true,
  ajax: {
    url: URL_ADMIN + '/level/datatable'
  },
  columns: [{
    data: 'index',
    name: 'id'
  }, {
    data: 'name'
  }, {
    data: 'point'
  }, {
    data: 'opsi',
    name: 'id'
  }]
}); // Tambah level

var modalTambah = $('#modalTambah');
var formTambah = document.getElementById('formTambah');
formTambah.addEventListener('submit', function (e) {
  e.preventDefault();
  var form = new FormData(this);
  $.post({
    url: URL_ADMIN + '/level',
    processData: false,
    contentType: false,
    data: form,
    success: function success(res) {
      $(this).trigger('reset');
      modalTambah.modal('hide');
      table.draw();
      Swal.fire('Berhasil', 'level berhasil ditambahkan', 'success');
    }
  });
}); // Edit Level

var modalEdit = $('#modalEdit');
var formEdit = document.getElementById('formEdit');
$(document).on('click', '.btn-edit', function () {
  var data = $(this).data();
  $('#editId').val(data.id);
  $('#editName').val(data.nama);
  $('#editPoint').val(data.point);
  modalEdit.modal('show');
});
formEdit.addEventListener('submit', function (e) {
  e.preventDefault();
  var id = document.getElementById('editId').value;
  var form = new FormData(this);
  $.post({
    url: URL_ADMIN + '/level/' + id,
    processData: false,
    contentType: false,
    data: form,
    success: function success(res) {
      Swal.fire('Berhasil', 'level berhasil diperbarui', 'success');
      table.draw();
      modalEdit.modal('hide');
    }
  });
}); // Hapus level

$(document).on('click', '.btn-hapus', function () {
  var data = $(this).data();
  Swal.fire({
    title: "Hapus level?",
    html: '<div class="alert alert-danger">Menghapus level akan menghapus data lainnya yang terkait</div>',
    icon: "question",
    showCancelButton: true,
    cancelButtonText: "Tidak",
    confirmButtonText: "Ya, hapus!"
  }).then(function (hapus) {
    if (hapus.value) {
      $.ajax({
        url: URL_ADMIN + '/level/' + data.id,
        type: "DELETE",
        success: function success(res) {
          if (res.status) {
            Swal.fire("Berhasil", 'level berhasil dihapus', 'success');
            table.draw();
          }
        }
      });
    }
  });
});
/******/ })()
;
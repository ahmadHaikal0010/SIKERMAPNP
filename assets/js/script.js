$(document).ready(function () {
  // Inisialisasi DataTables pada tabel dengan ID "example"
  $("#tabel-mou-moa").DataTable({
    paging: true, // Aktifkan pagination
    searching: true, // Aktifkan fitur pencarian
    ordering: true, // Aktifkan fitur pengurutan
    responsive: true,
    lengthChange: true,
  });
  
});
$(document).ready(function () {
  // Inisialisasi DataTables pada tabel dengan ID "example"
  $("#tabel-mou-moa").DataTable({
    paging: true, // Aktifkan pagination
    searching: true, // Aktifkan fitur pencarian
    ordering: true, // Aktifkan fitur pengurutan
  });
});


// SideBar
// $(document).ready(function () {
//   $('#toggleSidebar').click(function () {
//       $('#sidebar').toggleClass('collapsed');
//       $('#header').toggleClass('collapsed');
//       $('#mainContent').toggleClass('collapsed');
//       $('#footer').toggleClass('collapsed');
//   });
// });
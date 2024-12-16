new DataTable("#tabel-mou-moa");
new DataTable("#tabel-mitra");
new DataTable("#tabel-user");
new DataTable("#tabel-kegiatan");

// In your Javascript (external .js resource or <script> tag)
$(document).ready(function() {
    $('#mitra_idMitra').select2();
    $('#idMouMoa').select2();
});
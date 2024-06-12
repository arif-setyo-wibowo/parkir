// Dismiss Alert
setTimeout(function() {
    document.getElementById("autoDismissAlert").style.display = "none";
}, 3000);

// Edit Kategori
function editKategori(id, kategori, harga) {
    $('[href="#tab-tambah-edit"]').tab("show");
    $("#idkategori").val(id);
    $("#kategori").val(kategori);
    $("#harga").val(harga);
    $("#proses").val("Update");
}

// Hapus Value Kategori
$("#custom-tab-tambah-edit").on("click", function() {
    $("#idkategori").val("");
    $("#kategori").val("");
    $("#harga").val("");
    $("#proses").val("Tambah");
});

// Edit Pengguna
function editPengguna(id, nama, username, password, role) {
    $('[href="#tab-tambah-edit"]').tab("show");
    $("#id").val(id);
    $("#nama").val(nama);
    $("#username").val(username);
    $("#password_lama").val(password);
    $("#role").val(role);
    $("#notifPassword").text("*Kosongkan Jika Tidak Ingin Merubah Password");
    $("#password").removeAttr("required");
    $("#proses").val("Update");
}

// Tambah Value Pengguna
$("#tambah-edit-tab").on("click", function() {
    $("#idpengguna").val("");
    $("#nama").val("");
    $("#username").val("");
    $("#email").val("");
    $("#level").val("User");
    $("#notifPassword").empty();
    $("#password").prop("required", true);
    $("#proses").val("Tambah");
});

// Edit Mobil
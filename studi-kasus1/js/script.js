// SCRIPT LOGIN

function login() {
  var email = document.getElementById("email").value;
  var password = document.getElementById("password").value;

  var hasil = document.getElementById("hasil");

  // cek data pengguna
  var pengguna = dataPengguna.find(function (user) {
    return user.email === email && user.password === password;
  });

  // jika berhasil
  if (pengguna) {
    localStorage.setItem("nama", pengguna.nama);
    localStorage.setItem("role", pengguna.role);

    // pindah halaman
    window.location.href = "menu/dashboard.html";
  } else {
    hasil.innerHTML = "<p style='color:red'>Email atau Password salah!</p>";
  }
}

// SCRIPT INFORMASI BAHAN AJAR

// cek apakah id listBahanAjar ada
var listBahanAjar = document.getElementById("listBahanAjar");

if (listBahanAjar) {
  var tampil = "";

  // looping data
  dataBahanAjar.forEach(function (item) {
    tampil += `

      <div class="card">

        <img src="${item.cover}" alt="${item.namaBarang}">

        <div class="card-body">

          <h3>${item.namaBarang}</h3>

          <p>
            <b>Kode Barang:</b>
            ${item.kodeBarang}
          </p>

          <p>
            <b>Kode Lokasi:</b>
            ${item.kodeLokasi}
          </p>

          <p>
            <b>Jenis:</b>
            ${item.jenisBarang}
          </p>

          <p>
            <b>Edisi:</b>
            ${item.edisi}
          </p>

          <p>
            <b>Stok:</b>
            ${item.stok}
          </p>

        </div>

      </div>

    `;
  });

  // tampilkan ke HTML
  listBahanAjar.innerHTML = tampil;
}

// SCRIPT TRACKING PENGIRIMAN

function cariTracking() {
  // ambil nomor DO
  var nomorDO = document.getElementById("nomorDO").value;

  // ambil hasil
  var hasil = document.getElementById("hasilTracking");

  // cari data tracking
  var tracking = dataTracking[nomorDO];

  // jika data ditemukan
  if (tracking) {
    var perjalananHTML = "";

    // looping perjalanan
    tracking.perjalanan.forEach(function (item) {
      perjalananHTML += `

        <div class="timeline-item">

          <h4>${item.waktu}</h4>

          <p>${item.keterangan}</p>

        </div>

      `;
    });

    // tampilkan data
    hasil.innerHTML = `

      <div class="tracking-card">

        <h2>Data Pengiriman</h2>

        <p>
          <b>Nomor DO:</b>
          ${tracking.nomorDO}
        </p>

        <p>
          <b>Nama:</b>
          ${tracking.nama}
        </p>

        <p>
          <b>Status:</b>
          ${tracking.status}
        </p>

        <p>
          <b>Ekspedisi:</b>
          ${tracking.ekspedisi}
        </p>

        <p>
          <b>Tanggal Kirim:</b>
          ${tracking.tanggalKirim}
        </p>

        <p>
          <b>Paket:</b>
          ${tracking.paket}
        </p>

        <p>
          <b>Total:</b>
          ${tracking.total}
        </p>

        <hr>

        <h3>Riwayat Perjalanan</h3>

        ${perjalananHTML}

      </div>

    `;
  } else {
    hasil.innerHTML = `

      <div class="tracking-card">

        <p style="color:red;">
          Data tracking tidak ditemukan
        </p>

      </div>

    `;
  }
}

<!doctype html>
<html>
  <head>
    <title>CRUD Mahasiswa Axios</title>
  </head>
  <body>
    <h2>CRUD Mahasiswa</h2>
    <input type="hidden" id="id" />
    <p>NIM</p>
    <input type="text" id="nim" />
    <p>Nama</p>
    <input type="text" id="nama" />
    <p>Jurusan</p>
    <input type="text" id="jurusan" />
    <p>Fakultas</p>
    <input type="text" id="fakultas" />

    <br /><br />

    <button onclick="simpanData()">Simpan</button>
    <button onclick="resetForm()">Batal</button>

    <hr />

    <table border="1" cellpadding="10">
      <thead>
        <tr>
          <th>ID</th>
          <th>NIM</th>
          <th>Nama</th>
          <th>Jurusan</th>
          <th>Fakultas</th>
          <th>Aksi</th>
        </tr>
      </thead>

      <tbody id="hasil"></tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
      ambilData();

      function ambilData() {
        axios.get("mahasiswa.php?aksi=lihat").then(function (response) {
          let html = "";

          response.data.forEach(function (mhs) {
            html += `
            <tr>

                <td>${mhs.id}</td>
                <td>${mhs.nim}</td>
                <td>${mhs.nama}</td>
                <td>${mhs.jurusan}</td>
                <td>${mhs.fakultas}</td>

                <td>

                    <button onclick="editData(
                        '${mhs.id}',
                        '${mhs.nim}',
                        '${mhs.nama}',
                        '${mhs.jurusan}',
                        '${mhs.fakultas}'
                    )">
                        Edit
                    </button>

                    <button onclick="hapusData(${mhs.id})">
                        Hapus
                    </button>

                </td>

            </tr>
            `;
          });

          document.getElementById("hasil").innerHTML = html;
        });
      }

      function simpanData() {
        let id = document.getElementById("id").value;

        let data = {
          nim: document.getElementById("nim").value,
          nama: document.getElementById("nama").value,
          jurusan: document.getElementById("jurusan").value,
          fakultas: document.getElementById("fakultas").value,
        };

        if (id == "") {
          axios.post("mahasiswa.php?aksi=tambah", data).then(function () {
            resetForm();
            ambilData();
          });
        } else {
          data.id = id;
          axios.post("mahasiswa.php?aksi=edit", data).then(function () {
            resetForm();
            ambilData();
          });
        }
      }

      function editData(id, nim, nama, jurusan, fakultas) {
        document.getElementById("id").value = id;
        document.getElementById("nim").value = nim;
        document.getElementById("nama").value = nama;
        document.getElementById("jurusan").value = jurusan;
        document.getElementById("fakultas").value = fakultas;
      }

      function hapusData(id) {
        if (confirm("Yakin hapus data?")) {
          axios.get("mahasiswa.php?aksi=hapus&id=" + id).then(function () {
            ambilData();
          });
        }
      }

      function resetForm() {
        document.getElementById("id").value = "";
        document.getElementById("nim").value = "";
        document.getElementById("nama").value = "";
        document.getElementById("jurusan").value = "";
        document.getElementById("fakultas").value = "";
      }
    </script>
  </body>
</html>

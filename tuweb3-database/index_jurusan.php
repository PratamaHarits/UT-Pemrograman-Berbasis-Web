<!doctype html>
<html>
  <head>
    <title>Data Jurusan</title>
  </head>
  <body>
    <h2>Data Jurusan</h2>
    <table border="1" cellpadding="10">
      <thead>
        <tr>
          <th>Kode Jurusan</th>
          <th>Nama Jurusan</th>
          <th>Fakultas</th>
        </tr>
      </thead>

      <tbody id="hasil"></tbody>
    </table>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
      axios
        .get("jurusan.php")

        .then(function (response) {
          let data = response.data;
          let html = "";

          data.forEach(function (jurusan) {
            html += `
                    <tr>
                        <td>${jurusan.kode_jurusan}</td>
                        <td>${jurusan.nama_jurusan}</td>
                        <td>${jurusan.fakultas}</td>
                    </tr>
                `;
          });

          document.getElementById("hasil").innerHTML = html;
        })

        .catch(function (error) {
          console.log(error);
        });
    </script>
  </body>
</html>

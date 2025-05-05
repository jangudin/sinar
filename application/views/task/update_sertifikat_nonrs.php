<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Faskes Edit - Kementerian Kesehatan</title>
  <style>
    /* General Styles */
    body {
      font-family: 'Arial', sans-serif;
      background: linear-gradient(135deg, #64b5f6, #81c784); /* Soft pastel colors */
      color: #333;
      margin: 0;
      padding: 0;
      background-image: url('https://images.unsplash.com/photo-1597267417410-91cda4721211'); /* Optional background image */
      background-size: cover;
      background-position: center;
      animation: fadeInBackground 1.5s ease-in;
    }

    .container {
      width: 90%;
      max-width: 1100px;
      margin: 50px auto;
      padding: 30px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 15px;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      position: relative;
      animation: slideIn 0.8s ease-out;
    }

    header {
      text-align: center;
      margin-bottom: 30px;
      position: relative;
      animation: fadeIn 1s ease-in-out;
    }

    header img {
      position: absolute;
      top: -30px;
      left: 50%;
      transform: translateX(-50%);
      width: 80px;
      height: auto;
      animation: bounce 1s infinite alternate;
    }

    h1 {
      font-size: 2rem;
      color: #388e3c; /* Light green for a calm effect */
      text-transform: uppercase;
      letter-spacing: 2px;
      text-shadow: 0 0 5px rgba(56, 142, 108, 0.8);
      animation: fadeIn 2s ease-in-out;
      margin-top: 20px;
    }

    .form-container {
      margin-bottom: 30px;
      text-align: center;
      animation: fadeIn 1.5s ease-in-out;
    }

    .form-container form {
      display: flex;
      justify-content: center;
      gap: 15px;
      padding: 12px;
      background-color: #f1f8e9;
      border-radius: 8px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      animation: fadeIn 2s ease-in-out;
    }

    .form-container select,
    .form-container input,
    .form-container button {
      padding: 10px 16px;
      font-size: 0.9rem;
      border-radius: 6px;
      border: 1px solid #c8e6c9;
      background-color: #81c784;
      color: #333;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
      transition: 0.3s ease;
    }

    .form-container select:hover,
    .form-container input:hover,
    .form-container button:hover {
      background-color: #66bb6a;
      color: #fff;
    }

    .form-container select {
      width: 200px;
    }

    .form-container input {
      width: 280px;
    }

    .form-container button {
      background-color: #388e3c;
      color: #fff;
      cursor: pointer;
      border-radius: 8px;
    }

    .form-container button:hover {
      background-color: #2c6f3f;
    }

    /* Enhanced Table Styles */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
      color: #333;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
      background: rgba(255, 255, 255, 0.9); /* Lighter background */
      animation: fadeIn 1s ease-in-out;
    }

    table thead {
      background: linear-gradient(135deg, #388e3c, #81c784); /* Green gradient */
      color: white;
      text-transform: uppercase;
      font-weight: bold;
      letter-spacing: 1px;
    }

    table th, table td {
      padding: 12px;
      text-align: left;
      font-size: 0.9rem;
      border-bottom: 1px solid #ccc;
      transition: background-color 0.3s ease;
    }

    table td {
      background-color: #f1f8e9;
      color: #555;
    }

    table tr:nth-child(even) td {
      background-color: #e8f5e9;
    }

    table tr:hover td {
      background-color: #c8e6c9;
      cursor: pointer;
      transform: translateY(-3px);
      transition: all 0.3s ease;
    }

    table td:nth-child(4), table th:nth-child(4) {
      width: 250px; /* Atur lebar kolom sesuai kebutuhan */
    }

    .edit-btn-container {
      display: flex;
      justify-content: flex-start;
      gap: 10px;
    }

    .edit-btn-container button {
      background-color: #ff9800;
      color: white;
      border: none;
      padding: 8px 16px;
      border-radius: 6px;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    .edit-btn-container button:hover {
      background-color: #f57c00;
    }

    .hidden {
      display: none;
    }

    /* Input Fields */
    .edit-input {
      width: 100%;
      padding: 12px;
      font-size: 0.9rem;
      background-color: #e8f5e9;
      color: #333;
      border: 1px solid #c8e6c9;
      border-radius: 6px;
      transition: all 0.3s ease;
    }

    /* Stylish PDF viewer */
    object {
      width: 100%;
      height: 450px;
      border: none;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.4);
      margin-top: 30px;
      transition: all 0.3s ease;
    }

    object:hover {
      transform: scale(1.02);
    }

    /* Animations */
    @keyframes slideIn {
      0% { transform: translateY(-100%); opacity: 0; }
      100% { transform: translateY(0); opacity: 1; }
    }

    @keyframes fadeIn {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }

    @keyframes bounce {
      0% { transform: translateY(0); }
      100% { transform: translateY(-10px); }
    }

    @keyframes fadeInBackground {
      0% { opacity: 0; }
      100% { opacity: 1; }
    }
    /* Notifikasi sukses */
    .notification {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #4caf50;
      color: white;
      padding: 15px 30px;
      border-radius: 8px;
      font-size: 1rem;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      opacity: 0;
      transform: translateX(100%);
      transition: opacity 0.5s ease, transform 0.5s ease;
      z-index: 9999;
    }

/* Tampilkan notifikasi */
.notification.show {
  opacity: 1;
  transform: translateX(0);
}


</style>
</head>
<body>

  <div class="container">
    <header>
      <h1><code>Cari Data Faskes - Kementerian Kesehatan</code></h1>
    </header>

    <div class="form-container">
      <form action="<?= site_url('Task/update_sertifikat_nonrs') ?>" method="POST">
        <select name="data">
          <option value="0">Jenis Faskes</option>
          <option value="1">Puskesmas</option>
          <option value="2">Klinik</option>
          <option value="3">Labkes</option>
          <option value="4">Utd</option>
        </select>
        <input type="text" name="fasyankes_input" placeholder="Kode faskes / Nama Faskes" value="">
        <button type="submit">Cari</button>
      </form>
    </div>

    <h3>Edit Data 
      <?php if ($message): ?>
        <span style="color: #388e3c;"><?= $message ?></span>
      <?php endif; ?>
    </h3>

    <hr>
    <table>
      <thead>
        <tr>
          <th>Kode Lama</th>
          <th>Kode Baru</th>
          <th>Nama Fasyankes</th>
          <th>Alamat</th>
          <th>Kecamatan</th>
          <th>Kabupaten</th>
          <th>Provinsi</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($fasyankes_data as $row): ?>
          <form action="<?= site_url('Task/update') ?>" method="POST">
            <input type="hidden" name="fasyankes_id" value="<?= htmlspecialchars($row['idpp']) ?>" />
            <input type="hidden" name="dsid" value="<?= htmlspecialchars($row['dsid']) ?>" />
            <tr>
              <td><?= htmlspecialchars($row['fasyankes_id']) ?></td>
              <td><?= htmlspecialchars($row['kode_baru']) ?></td>
              <td>
                <span id="nama-fasyankes-text"><?= htmlspecialchars($row['nama_fasyankes']) ?></span>
                <input type="text" id="nama-fasyankes-input" class="edit-input hidden" name="nama_fasyankes" value="<?= htmlspecialchars($row['nama_fasyankes']) ?>" />
              </td>
              <td>
                <span id="alamat-text"><?= htmlspecialchars($row['alamat']) ?></span>
                <!-- Ubah input menjadi textarea -->
                <textarea id="alamat-input" class="edit-input hidden" name="alamat"><?= htmlspecialchars($row['alamat']) ?></textarea>
              </td>
              <td><?= htmlspecialchars($row['nama_kecamatan']) ?></td>
              <td><?= htmlspecialchars($row['nama_kota']) ?></td>
              <td><?= htmlspecialchars($row['nama_prop']) ?></td>
              <td>
                <button type="button" class="btn btn-primary btn-sm" id="edit-btn">Edit</button>
                <button type="submit" class="btn btn-success btn-sm hidden" id="save-btn">Save</button>
              </td>
            </tr>
          </form>
        </tbody>
      </table>
      <hr>

      <div class="form-container">
        <form action="<?= site_url('Task/update_sertifikat_nonrs') ?>" method="POST">
          <input type="hidden" name="fasyankes_input" placeholder="Kode faskes / Nama Faskes" value="">
          <button type="submit">Perbarui Sertifikat</button>
        </form>
      </div>
      <object data="https://sinar.kemkes.go.id/assets/faskessertif/finaltteshowttedir<?= htmlspecialchars($row['id_pengajuan']) ?>.pdf" type="application/pdf" width="100%" height="500px"></object>
    <?php endforeach; ?>
  </div>

  <script>
    document.querySelectorAll('.btn-primary').forEach(function(btn) {
      btn.addEventListener('click', function() {
        const row = this.closest('tr');
        const namaFasyankesText = row.querySelector('#nama-fasyankes-text');
        const namaFasyankesInput = row.querySelector('#nama-fasyankes-input');
        const alamatText = row.querySelector('#alamat-text');
        const alamatInput = row.querySelector('#alamat-input');
        const editButton = row.querySelector('#edit-btn');
        const saveButton = row.querySelector('#save-btn');

        // Toggle between Edit and Save modes
        const isEditing = namaFasyankesInput.classList.contains('hidden');
        
        if (isEditing) {
          namaFasyankesText.classList.add('hidden');
          namaFasyankesInput.classList.remove('hidden');
          alamatText.classList.add('hidden');
          alamatInput.classList.remove('hidden');
          editButton.textContent = 'Cancel';
          saveButton.classList.remove('hidden');
        } else {
          namaFasyankesText.classList.remove('hidden');
          namaFasyankesInput.classList.add('hidden');
          alamatText.classList.remove('hidden');
          alamatInput.classList.add('hidden');
          editButton.textContent = 'Edit';
          saveButton.classList.add('hidden');
        }
      });
    });
  </script>
  <script>
  // Cek apakah ada pesan flash dari server (CodeIgniter)
    <?php if ($this->session->flashdata('message')): ?>
    // Ambil pesan dari session flashdata
      var message = '<?= $this->session->flashdata('message'); ?>';

    // Buat elemen notifikasi
      var notification = document.createElement('div');
      notification.classList.add('notification');
      notification.textContent = message;

    // Tambahkan notifikasi ke body
      document.body.appendChild(notification);

    // Tampilkan notifikasi
      setTimeout(function() {
        notification.classList.add('show');
      }, 100);

    // Hapus notifikasi setelah 3 detik
      setTimeout(function() {
        notification.classList.remove('show');
        setTimeout(function() {
        notification.remove(); // Hapus elemen setelah animasi selesai
      }, 500);
      }, 3000);
    <?php endif; ?>
  </script>


</body>
</html>

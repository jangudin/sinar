<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f9f9f9;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 1200px;
      margin: 20px auto;
      background: #ffffff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    header {
      text-align: center;
      margin-bottom: 20px;
    }
    header h1 {
      font-size: 1.5rem;
      color: #333;
    }
    .storage-info {
      text-align: right;
      margin-bottom: 10px;
    }
    .storage-info p {
      font-size: 0.9rem;
      color: #555;
    }
    .storage-info span {
      color: #e53935;
      font-weight: bold;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    table th,
    table td {
      text-align: left;
      padding: 12px;
      border-bottom: 1px solid #ddd;
    }
    table th {
      background-color: #f4f4f4;
      font-weight: bold;
      color: #555;
    }
    table tr:nth-child(even) {
      background-color: #f9f9f9;
    }
    table tr:hover {
      background-color: #f1f1f1;
    }
    .folder-icon::before {
      content: '\\1F4C1'; /* Folder Emoji */
      margin-right: 8px;
    }
    .download-icon::before {
      content: '\\2B07'; /* Down Arrow Emoji */
      margin-right: 5px;
      color: #666;
      cursor: pointer;
    }
    .star-icon::before {
      content: '\\2B50'; /* Star Emoji */
      margin-left: 10px;
      color: #fbc02d;
      cursor: pointer;
    }
    .action-button {
      padding: 8px 12px;
      font-size: 0.9rem;
      font-weight: bold;
      color: #ffffff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      margin-right: 8px;
      transition: background-color 0.3s ease;
    }

    .action-button.download {
      background-color: #1a73e8;
    }

    .action-button.download:hover {
      background-color: #185abc;
    }

    .action-button.star {
      background-color: #fbc02d;
    }

    .action-button.star:hover {
      background-color: #e6a900;
    }

    table td button {
      margin: 4px 0;
    }
  </style>
</head>
<body>
  <div class="container">
    <header>
      <h1><code>Pilih Yang Mau Dikerjakan</code></h1>
    </header>
    <div class="storage-info">
      <p>

      </p>
    </div>
    <table>
      <thead>
        <tr>
          <th><code>Task</code></th>
          <th><code>Actions</code></th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><code>Merubah Sertifikat Non RS</code></td>
          <td>
            <a href="https://sinar.kemkes.go.id/Task/update_sertifikat_nonrs" class="action-button download"><code>Pilih</code></a>
          </td>

        </tr>
        <tr>
          <td><code>Merubah Sertifikat RS</code></td>
          <td>
            <a class="action-button download"><code>Pilih</code></a>
          </td>
        </tr>

        <tr>
          <td><code>Merubah Surat Tugas Non RS</code></td>
          <td>
            <a class="action-button download"><code>Pilih</code></a>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</body>
</html>
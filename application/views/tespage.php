<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<title>A4 Landscape Background Image</title>
<style>
  /* Page sized exactly A4 landscape dimensions at 96 dpi */
  html, body {
    margin: 0;
    padding: 0;
    width: 297mm;
    height: 210mm;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    box-sizing: border-box;
    overflow: hidden;
  }
  body {
    position: relative;
  }

  /* Container sized exactly A4 landscape */
  .a4-container {
    width: 297mm;
    height: 210mm;
    position: relative;
    overflow: hidden;
  }

  /* Background image exactly fills the container with no distortion */
  .a4-bg-image {
    position: absolute;
    top: 0; left: 0;
    width: 297mm;
    height: 210mm;
    object-fit: cover;
    object-position: center center;
    z-index: 0;
  }

  /* Content on top */
  .content {
    position: relative;
    z-index: 1;
    width: 100%;
    height: 100%;
    color: #333;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    background: rgba(255 255 255 / 0.65);
    font-weight: 600;
    padding: 1rem;
    box-sizing: border-box;
    text-align: center;
  }

  h1 {
    margin: 0 0 0.5rem;
    font-size: 2.4rem;
  }

  p {
    font-size: 1.2rem;
    margin: 0;
  }

  @media print {
    html, body {
      width: 297mm;
      height: 210mm;
      margin: 0;
    }
    .a4-bg-image {
      width: 297mm;
      height: 210mm;
      object-fit: cover;
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
    .content {
      background: transparent;
    }
  }
</style>
</head>
<body>
  <div class="a4-container">
    <img class="a4-bg-image" src="https://sinar.kemkes.go.id/assets/faskesbg/backgroundsertifikat.jpeg" alt="A4 Landscape Background" />
    <div class="content">
      <h1>Halaman Ukuran A4 Landscape</h1>
      <p>Background image ditampilkan persis dengan ukuran A4 lanscape</p>
    </div>
  </div>
</body>
</html>
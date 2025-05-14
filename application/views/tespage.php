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
    top: 0;
    left: 0;
    width: 297mm;
    height: 210mm;
    object-fit: cover;
    object-position: center center;
    z-index: 0;
    user-select: none;
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
  }
</style>
</head>
<body>
  <div class="a4-container">
    <img class="a4-bg-image" src="https://sinar.kemkes.go.id/assets/ttdfaskes/dirjen.png" alt="A4 Landscape Background" />
  </div>
</body>
</html>
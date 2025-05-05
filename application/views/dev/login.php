<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital@0;1&display=swap" rel="stylesheet"> 
  <style type="text/css">
    #judul{
      font-size: 25px;
      font-family: 'Roboto', sans-serif;
    }
  </style>
<style>
body{
  font-family: sans-serif;
  background: #32807d;
}
 
h1{
  text-align: center;
  /*ketebalan font*/
  font-weight: 300;
}
 
.tulisan_login{
  text-align: center;
  /*membuat semua huruf menjadi kapital*/
  text-transform: uppercase;
}
 
.kotak_login{
  width: 300px;
  background: white;
  /*meletakkan form ke tengah*/
  margin: 80px auto;
  padding: 30px 20px;
  border-radius: 25px;
  box-shadow:20px 20px 50px 10px black;
}
 
label{
  font-size: 11pt;
}
 
.form_login{
  /*membuat lebar form penuh*/
  box-sizing : border-box;
  width: 100%;
  padding: 10px;
  font-size: 11pt;
  margin-bottom: 20px;
  border-radius: 20px;
  border-color: #32807d;
}
 
.tombol_login{
  background: #32807d;
  color: white;
  font-size: 11pt;
  width: 30%;
  border: none;
  border-radius: 3px;
  padding: 10px 10px;
  border-radius: 25px;
  margin-left:auto;
  margin-right:auto;
}
 
.link{
  color: #232323;
  text-decoration: none;
  font-size: 10pt;
}
img {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
</style>
</head>
<body>
 
<br> 
  <div class="kotak_login">
    <img src="<?php echo base_url('assets/dev/img/gear.gif')?>" />
    <h4 class="tulisan_login">Admin SINAR</h4>
 
    <form action="<?php echo base_url('dev/Logindev/aksi_login'); ?>" method="post">
      <input type="text" name="username" class="form_login" placeholder="Username">
      <input type="password" name="password" class="form_login" placeholder="Password">
      <center>
      <input type="submit" class="tombol_login" value="LOGIN">
      </center>
    </form>
    
  </div>
 
 
</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SURAT JALAN BARANG</title>
    <link rel="stylesheet" href="">
    <style>
/* --------------------------------------------------------------
Hartija Css Print Framework
* Version: 1.0
-------------------------------------------------------------- */
body {
width:100% !important;
margin:0 !important;
padding:0 !important;
padding-left:0 !important;
padding-right:0 !important;
color: #000;
background: none;
}

/* Headings */

/* Table */

.qr{
    position: absolute; bottom: 200; left: 0;
}
/* Hide various parts from the site
#header, #footer, #navigation, #rightSideBar, #leftSideBar
{display:none;}
*/
</style>
</head>
<body>
    <h3><u>Pengaduan Kerusakan Mesin</u></h3>
    <p>
       <b>{{ $data['user'] }}</b> telah membuat pengaduan terkait kerusakan mesin <b>{{ $data['mesin'] }}</b> pada lokasi <b>{{ $data['lokasi'] }}</b> dengan keterangan <b>{{ $data['keterangan'] }}</b>
    </p>
    
</body>
</html>
<center>
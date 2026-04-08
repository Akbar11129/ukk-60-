<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Admin - APSA School</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
margin:0;
font-family:Arial, Helvetica, sans-serif;
background:#f4f6f9;
}


/* TOPBAR */

.topbar{

position:fixed;
top:0;
left:0;
width:100%;
height:60px;

background:#ffffff;

display:flex;
justify-content:space-between;
align-items:center;

padding:0 20px;

box-shadow:0 2px 5px rgba(0,0,0,0.1);

z-index:1000;

}


/* LOGO */

.logo{

font-weight:bold;
font-size:20px;
color:#0d6efd;

}


/* PROFILE */

.profile{

display:flex;
align-items:center;
gap:10px;

}

.profile img{

width:35px;
height:35px;
border-radius:50%;

}



/* SIDEBAR */

.sidebar{

position:fixed;

top:60px;

left:0;

width:250px;

height:100%;

background:#0d6efd;

padding-top:20px;

color:white;

}


.sidebar a{

display:block;

color:white;

padding:15px 20px;

text-decoration:none;

}


.sidebar a:hover{

background:#0b5ed7;

}



/* CONTENT */

.content{

margin-left:250px;

margin-top:60px;

padding:20px;

}



</style>

</head>

<body>



<!-- TOPBAR -->

<div class="topbar">


<div class="logo">

APSA School

</div>



<div class="profile">


<div>

Admin<br>

<small>Administrator</small>

</div>


<img src="https://ui-avatars.com/api/?name=Admin&background=0d6efd&color=fff">


<a href="{{ route('login') }}" class="btn btn-danger btn-sm">

Logout

</a>


</div>


</div>




<!-- SIDEBAR -->

<div class="sidebar">


<a href="{{ route('admin.dashboard') }}">

Dashboard

</a>


<a href="{{ route('admin.pengaduan') }}">

Pengaduan

</a>


<a href="{{ route('admin.kategori.index') }}">

Kategori

</a>


<a href="{{ route('admin.siswa')}}">

Siswa

</a>


</div>




<!-- CONTENT -->

<div class="content">


@yield('content')


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

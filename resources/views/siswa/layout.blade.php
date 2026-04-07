<!DOCTYPE html>
<html lang="id">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>@yield('title')</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


<style>

/* BODY */

body{
margin:0;
display:flex;
height:100vh;
background:#f4f7fa;
font-family:Arial, Helvetica, sans-serif;
}


/* SIDEBAR */

.sidebar{

width:280px;

background:linear-gradient(180deg,#1e3c72,#2a5298);

color:white;

padding:20px;

}


.logo{

font-size:22px;

font-weight:bold;

margin-bottom:30px;

text-align:center;

}


/* MENU */

.nav-item{

display:block;

color:white;

padding:12px;

text-decoration:none;

border-radius:8px;

margin-bottom:5px;

}


.nav-item:hover{

background:rgba(255,255,255,0.2);

}


/* MAIN */

.main{

flex:1;

display:flex;

flex-direction:column;

}


/* TOPBAR */

.topbar{

background:white;

padding:15px;

display:flex;

justify-content:space-between;

align-items:center;

box-shadow:0 2px 5px rgba(0,0,0,0.1);

}


/* LOGOUT */

.logout-btn{

background:red;

color:white;

border:none;

padding:8px 15px;

border-radius:8px;

}


/* CONTENT */

.content{

padding:20px;

}

</style>


</head>


<body>


<!-- SIDEBAR -->

<div class="sidebar">


<div class="logo">

APSA School

</div>


<a href="{{ route('siswa.dashboard') }}" class="nav-item">

Dashboard

</a>


<a href="{{ route('siswa.pengaduan') }}" class="nav-item">

Pengaduan

</a>


<a href="{{ route('siswa.riwayat') }}" class="nav-item">

Riwayat

</a>


</div>




<!-- MAIN -->

<div class="main">



<!-- TOPBAR -->

<div class="topbar">


<h4>

@yield('title')

</h4>


<form action="/logout" method="POST">

@csrf

<button class="logout-btn">

Logout

</button>


</form>


</div>



<!-- CONTENT -->

<div class="content">


@yield('content')


</div>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

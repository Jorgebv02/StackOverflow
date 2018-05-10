<?php

include ("database.php");
?>
<!DOCTYPE html>
<html>
<title>Stack</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/w3.css">
<link rel="stylesheet" href="../css/lato.css">
<link rel="stylesheet" href="../css/font-awesome.css">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/ajax"></script>
<script src="../js/bootstrap"></script>

<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
    body, html {
        height: 100%;
        color: #777;
        line-height: 1.8;
    }
    
    .navbar{        
        box-shadow: 0px 2px 18px rgba(0,0,0,0.3);
        border-radius: 0px 0px 0px 0px;
    }
</style>
<script>
    function register() {
        var nombre = document.getElementById("nombre").valueOf().value;
        var apellido = document.getElementById("apellido").valueOf().value;
        var correo = document.getElementById("correo").valueOf().value;
        var contrasena = document.getElementById("contrasena").valueOf().value;

        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange  = function() {
            if(this.readyState == 4){
            }
        };
        xmlhttp.open("GET", "register.php?name="+nombre+"&lastname="+apellido+"&mail="+correo+"&pass="+contrasena, true);
        xmlhttp.send();
    }

    function verifyMail (obj) {
        var mail = obj.value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange  = function() {
            if(this.readyState == 4){
                if("exist" == this.responseText){
                    document.getElementById("alert").style.display = "block";
                    document.getElementById("buttonCreate").disabled = true;
                } else {
                    document.getElementById("alert").style.display = "none";
                    document.getElementById("buttonCreate").disabled = false;
                }
            }
        };
        xmlhttp.open("GET", "checkMail.php?mail="+mail, true);
        xmlhttp.send();
    }

    function login() {
        var correo = document.getElementById("correoL").valueOf().value;
        var contrasena = document.getElementById("contrasenaL").valueOf().value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange  = function() {
            if(this.readyState == 4){
                if(this.responseText.toString() == "error"){
                    alert(this.responseText+": wrong mail or password.");
                } else {
                    window.location.replace("main.php");
                }
            }
        };
        xmlhttp.open("GET", "login.php?mail="+correo+"&pass="+contrasena, true);
        xmlhttp.send();

    }
</script>

<body class="w3-responsive w3">

<!-- Navbar (sit on top) -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#"><span class="fa fa-stack-overflow"></span> Stack</a>

        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="http://127.0.0.1:8529/_db/_system/_admin/aardvark/index.html#dashboard"><span class="fa fa-database"></span> Arango</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a data-toggle="modal" data-target="#modalLogin" ><span class="fa fa-sign-in"></span> Iniciar sesión</a></li>
            <li><a data-toggle="modal" data-target="#myModal" ><span class="fa fa-user-plus"></span> Registrarse</a></li>
        </ul>
    </div>
</nav>

<!-- Content -->
<div class="w3-center">
    <h1 style="color: black"><span class="fa fa-stack-overflow" style="color: black"></span> Stack</h1>
</div>


<!-- Modal Register-->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="fa fa-user-plus"></span>Registrarse</h4>
            </div>
            <div class="modal-body w3-center">
                <input id="nombre" type="text" class="form-control" placeholder="Nombre" required="required">
                <input id="apellido" type="text" class="form-control" placeholder="Apellido" required="required">
                <input id="correo" type="email" onchange="verifyMail(this)" class="form-control" placeholder="Correo" required="required">
                <input id="contrasena" type="password" class="form-control" placeholder="Contrasena" required="required">
                <h5 id="alert" style="display: none" class="w3-text-red"><span class="fa fa-warning"></span> El correo ya existe</h5>
            </div>
            <div class="modal-footer">
                <h6>.</h6>
                <button  id="buttonCreate" disabled data-dismiss="modal" onclick="register()" type="button" class="w3-left w3-border-0 btn btn-primary center-block w3-hover-opacity">
                    <i class="fa fa-user-plus"></i> Registrarse</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal Login-->
<div id="modalLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="fa fa-sign-in"></span>Iniciar sesión</h4>
            </div>
            <div class="modal-body w3-center">
                <input id="correoL" type="email" onchange="" class="form-control" placeholder="Correo" required="required">
                <input id="contrasenaL" type="password" onchange="" class="form-control" placeholder="Contrasena" required="required">
            </div>
            <div class="modal-footer">
                <h6>.</h6>
                <button  id="buttonCreateL" data-dismiss="modal" onclick="login()" type="button" class="w3-left w3-border-0 btn btn-primary center-block w3-hover-opacity">
                    <i class="fa fa-sign-in"></i> Iniciar sesión</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

</body>
</html>




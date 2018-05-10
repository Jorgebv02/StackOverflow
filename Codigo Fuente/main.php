<?php

include ("database.php");

session_start();
if(!isset($_SESSION['mail'])){
    header("Location: index.php");
}

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
<link rel="stylesheet" href="../css/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.css">
<script src="../js/ajax"></script>
<script src="../js/bootstrap"></script>

<style>
    body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif;}
    body, html {
        height: 100%;
        color: #777;
        line-height: 1.8;
    }

    .bootstrap-tagsinput {
        background-color: #f1f1f1;
        border: 1px solid #f1f1f1;
        box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        display: block;
        padding: 4px 6px;
        color: #555;
        vertical-align: middle;
        border-radius: 4px;
        max-width: 100%;
        line-height: 22px;
        cursor: text;
    }
    .bootstrap-tagsinput input {
        border: none;
        box-shadow: none;
        outline: none;
        background-color: transparent;
        padding: 0 6px;
        margin: 0;
        width: auto;
        max-width: inherit;
    }
    
    .navbar{
        /*background-color: rgba(0,0,0,.7);    */
        box-shadow: 0px 2px 18px rgba(0,0,0,0.3);
        border-radius: 0px 0px 0px 0px;
    }

</style>
<script>
    function view(name) {
        window.location.replace("view.php?id="+name);
    }

</script>

<body class="w3-responsive w3-red">

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
            <li><a  href="logout.php"><span class="fa fa-sign-out"></span> Cerrar sesión</a></li>
        </ul>
    </div>
</nav>


<div class="w3-panel w3-col m2">

</div>
<div class="w3-panel w3-col m7" style="width: 65%">
    <div class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card-2 w3-round w3-dark-gray">
                <div class="w3-container w3-padding">
                    <h3 class="w3-center">Preguntas <span class="fa fa-question-circle"></span></h3>
                </div>
            </div>
        </div>
    </div>
    <h6></h6>

    <div id="" class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card-2 w3-round w3-dark-gray">
                <div class="w3-container w3-padding">
                    <textarea class="form-control w3-light-gray" placeholder="Pregunta" style="height:150px"></textarea>
                    <br>
                    <input type="text" data-role="tagsinput" name="tags" placeholder="Tags (opcional)">
                    <h6></h6>
                    <button class="btn btn-default w3-right w3-gray w3-border-gray w3-hover-light-gray">Preguntar</button>
                </div>
            </div>
        </div>
    </div>

    <h6></h6>


    <div id="" class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card-2 w3-round w3-dark-gray">
                <div class="w3-container w3-padding">
                    <div class="w3-col m3">
                        <img src="../imgs/question.png" class="w3-left" alt="Norway" style="width:50%">
                    </div>
                    <div class="w3-col m6">
                        <h3>Pregunta?</h3>
                        <p>0 respuestas</p>
                    </div>
                    <div class="w3-col m3">
                        <button name="" onclick='view(this.name)' type="button" class="btn btn-defaul w3-right w3-gray w3-hover-light-gray" data-dismiss="modal"><span class="fa fa-eye"></span> Ver respuestas</button>
                        <h6>date</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h6></h6>

</div>

<!-- Modal Login-->
<div id="modalLogin" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="fa fa-sign-in"></span>Login</h4>
            </div>
            <div class="modal-body w3-center">
                <input id="correoL" type="email" onchange="" class="form-control" placeholder="Correo" required="required">
                <input id="contrasenaL" type="password" onchange="" class="form-control" placeholder="Contrasena" required="required">
            </div>
            <div class="modal-footer">
                <h6>.</h6>
                <button  id="buttonCreateL" data-dismiss="modal" onclick="login()" type="button" class="w3-left w3-border-0 btn btn-primary center-block w3-hover-opacity">
                    <i class="fa fa-sign-in"></i> Login</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
            </div>
        </div>

    </div>
</div>

<script src="../css/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.js" type="text/javascript"></script>
<script src="../css/bootstrap-tagsinput-latest/src/bootstrap-tagsinput-angular.js" type="text/javascript"></script>

</body>
</html>




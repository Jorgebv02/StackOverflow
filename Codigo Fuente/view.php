<?php

include ("database.php");

session_start();
if(!isset($_SESSION['mail'])){
    header("Location: index.php");
}

$json = readDoc("questions", $_REQUEST['id']);
$array = json_decode($json);

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

    hr {
        color: #5f555c;
    }
    
    .navbar{
        /*background-color: rgba(0,0,0,.7);    */
        box-shadow: 0px 2px 18px rgba(0,0,0,0.3);
        border-radius: 0px 0px 0px 0px;
    }

    bootstrap-tagsinput {
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

</style>
<script>
    
    function answer() {
        var answer = document.getElementById("respuesta").valueOf().value;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange  = function() {
            if(this.readyState == 4){
                location.reload();
            }
        };
        xmlhttp.open("GET", "newAnswer.php?answer="+answer+"&question="+<?php echo $_REQUEST['id']; ?>, true);
        xmlhttp.send();
    }

</script>

<body class="w3-responsive">

<!-- Navbar (sit on top) -->
<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="main.php"><span class="fa fa-stack-overflow"></span> Stack</a>

        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="http://127.0.0.1:8529/_db/_system/_admin/aardvark/index.html#dashboard"><span class="fa fa-database"></span> Arango</a></li>
            <li><a href="main.php"><span class="fa fa-question-circle-o"></span> Preguntas</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a  href="#"><span class="fa fa-user"></span> <?php echo $_SESSION['name']." ".$_SESSION['lastname'];?></a></li>
            <li><a  href="logout.php"><span class="fa fa-sign-out"></span> Cerrar sesión</a></li>
        </ul>
    </div>
</nav>


<div class="w3-panel w3-col m2">

</div>
<div class="w3-panel w3-col m7" style="width: 65%">

    <div id="" class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card-2 w3-round w3-dark-gray">
                <div class="w3-container w3-padding">
                    <div class="w3-col m3">
                        <img src="../imgs/user.png" class="w3-left" alt="Norway" style="width:50%">
                    </div>
                    <div class="w3-col m6">
                        <h3><?php echo $array->{'name'}." ".$array->{'lastname'} ?></h3>
                        <p><?php echo $array->{'question'} ?></p>
                        <input disabled value="<?php echo $array->{'tags'} ?>" class="w3-dark-gray" id="tags" type="text" data-role="tagsinput" name="tags" placeholder="">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="w3-border-dark-gray">
    <div id="" class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card-2 w3-round w3-dark-gray">
                <div class="w3-container w3-padding">
                    <textarea id="respuesta" class="form-control w3-light-gray" placeholder="Respuesta" style="height:150px"></textarea>
                    <h6></h6>
                    <button onclick="answer()" class="btn btn-default w3-right w3-gray w3-border-gray w3-hover-light-gray">Responder</button>
                </div>
            </div>
        </div>
    </div>

    <h6></h6>

    <!--
    <div id="" class="w3-row-padding">
        <div class="w3-col m12">
            <div class="w3-card-2 w3-round w3-gray">
                <div class="w3-container w3-padding">
                    <div class="w3-col m3">
                        <img src="../imgs/reply.png" class="w3-left" alt="Norway" style="width:50%">
                    </div>
                    <div class="w3-col m6">
                        <h3>Usuario</h3>
                        <p>Respuesta</p>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <?php loadAnswers($array->{'answers'}) ?>



</div>

<script src="../css/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.js" type="text/javascript"></script>
<script src="../css/bootstrap-tagsinput-latest/src/bootstrap-tagsinput-angular.js" type="text/javascript"></script>

</body>
</html>




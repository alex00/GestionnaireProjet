<?php

use Components\Auth\TzAuth;

if(TzAuth::isUserLoggedIn()){
    $connect = true;
}
else{
    $connect = false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />

    <meta name="description" content="" />
    <meta name="author" content="" />

    <link type="text/css" rel="stylesheet" href="/css/bootstrap/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="/css/bootstrap/responsive.css">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="/css/original-style.css" >
    <link rel="stylesheet" type="text/css" href="/css/styles.css" >

    <script type="text/javascript" src="/js/jquery/jquery.js"></script>
    <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
    <script type="text/javascript" src="/js/jquery/jquery.cookie.js" ></script>
    <script type="text/javascript" src="/js/jquery/jquery.easing.1.3.js" ></script>
    <script type="text/javascript" src="/js/jquery/jquery.dataTables.min.js" ></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap.js"></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap-dropdown.js" ></script>
    <script type="text/javascript" src="/js/bootstrap/bootstrap-collapse.js" ></script>
    <link href='http://fonts.googleapis.com/css?family=Jockey+One' rel='stylesheet' type='text/css'>

    <script type="text/javascript" language="javascript" src="/js/master.js" ></script>
    <?php
    if ($connect) {
        ?>
    <style>
        .row-1 {
            min-height: 517px;
        }
    </style>
    <?php
    }
    else {
        ?>
        <style>
            .row-1 {
                    min-height: 566px;
            }
        </style>

    <?php
    }
    ?>
</head>

<body>
<?php
if ($connect){
    ?>

<header>
    <div id="panel">
        <div class="navbar navbar-inverse navbar-fixed-top" id="advanced">
            <span class="trigger"><strong></strong><em></em></span>
            <div class="navbar-inner" style="padding-left: 30px">
                <button type="button" class="btn btn-navbar " data-toggle="collapse" data-target=".nav-top-collapse"><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
                <a class="brand" href="/">ProjectManager</a>
                <div class="nav-collapse collapse nav-top-collapse">
                    <ul class="nav">
                        <li class="home"><a href="/"><img src="/img/tm_home.png"></a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/myprojects">My Projects</a></li>
                    </ul>
                    <ul class=" nav pull-right">
                        <li ><a href="/account"> My Account</a></li>
                        <li class="divider-vertical"></li>
                        <li><a href="/deconnect">Deconnexion</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
<?php
}
?>

<div class="bg-content">
    <div class="container">
        <div class="row" id="connectHeader">
            <div class="span5">
                <a class="brand" href="/">ProjectManager</a>
            </div>
        </div>
    </div>
<div>
    <div class="row-1">

        <div class="container" >
            <div id="block404Left" class="span5">
                <p class="error404">404</p>
                <p class="textError404">Page Not Found</p>
            </div>
            <?php
            if ($connect){
                ?>

            <div id="block404Right" class="span5">
                <p class="textLink404">Come back to my projects : </p>
                <p class="linkProject404"><a class="link404 linkBlack" href="/project/1">Ssejfiosef12</a></p>
                <p class="linkProject404"><a class="link404 linkBlack" href="/project/1">Projec osfef45</a></p>
            </div>
            <?php
            }
            else {
                ?>
                <div id="block404Right" class="span5">
                    <p class="textLink404">Come back to the home : </p>
                    <p><a class="link404 linkBlack" href="/">Project Manager</a></p>
                </div>

            <?php
            }
            ?>
        </div>
    </div>
</div>

<div class="bg-content">
    <footer>
        <div class="container clearfix">
            <div class="row">
                <article class="span10">
                    <h3>Shortly about us</h3>
                    <div class="wrapper">
                        <div class="inner-1 extra">
                            <p>Students at Sup'internet, Kremlin-Bicêtre France.<br />This website is a school project.<br /> QM let you manage your project. </p>
                            <div class="txt-1">
                                <ul>
                                    <li>Souleymane Diallo</li>
                                    <li>Stéphane Aboulaghras</li>
                                    <li>Alexandre François</li>
                                    <li>Nils</li>
                                    <li>Alexandre Ktifa</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </footer>
</div>
</body>
</html>


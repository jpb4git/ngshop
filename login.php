<?php

Session_start();
$state = "";

if (!empty($_POST) && !empty($_POST['login'] && !empty($_POST['password']))){
    var_dump('in Post ');

    //----------------------------------------------------
    include_once     "class/database.php";
    include_once     "class/User.php";

    $db = new Database();
    $login_db = $db->getInstance();
    $UserAuth = new User($db->getInstance());

    $errors = array();

    if (empty($_POST['password'])){
        $errors['password'] = 'Le champ Password ne doit Pas être vide.';
    }

    if (empty($errors)){
        //selection de l'email
        $state = $UserAuth->Auth($_POST['login'],$_POST['password']);
        var_dump($state);
        $login_db = null;
        //header('Location:  index.php');
        //exit();
    }
}
?>
<html>
<head>
    <meta charset="utf-8">
    <title>ngshop Login</title>
    <link href="https://fonts.googleapis.com/css?family=Ubuntu+Condensed" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="css/app.css">
</head>
<body>
<div class="container">
    <div class="row mt-5 rounded">
        <div  class="col-sm-12 d-flex justify-content-center mt-5">
            <img id="logo" src="assets/icon-hub-green.svg" alt="ngshop-login" >
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 animated infinite fadeIn">
            <form action="login.php" method="post">
                <div class="form-group">
                    <label for="login">Login</label>
                    <input class="form-control" type="text" id="login" name="login"  required autocomplete="off"/>
                    <label for="password">Password</label>
                    <input class="form-control" type="password" id="password" name="password" autocomplete="off"/>
                </div>

                    <?php  if ($state == 'not match !') { ?>
                             <div class="w-100 bg-warning">Not matching ! </div>
                        <?php } ?>

                    <button type="submit" name="submit" class="btn btn-outline-success">Se connecter</button>
            </form>
        </div>
    </div>
</div>
<script src="js/app.js"> </script>
</script>
</script>
</body>
</html>

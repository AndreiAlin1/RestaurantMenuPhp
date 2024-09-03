<?php


//$score = 50;

//operatori ternari
//operatorul ternal returneaza o valoare
//echo $score > 40 ? 'high score' : 'low score';


//superglobals
//ex: $_GET['name']
// echo $_SERVER['SERVER_NAME'] . '<br />';
// echo $_SERVER['REQUEST_METHOD'] . '<br />';
// echo $_SERVER['SCRIPT_FILENAME'] . '<br />';
// echo $_SERVER['PHP_SELF'] . '<br />';


//sessions 
// $value = 'alin';
// setcookie("Test", 'alin');
// echo $_COOKIE["Test"];


if(isset($_POST['submit'])){
    // session_start();
    // setcookie('name','test');
    // $_SESSION['name'] = $_POST['name'];
    // echo $_COOKIE;
    // header('Location: /ssss.php');
    setcookie('name',$_POST['name'],time () + 60);
    session_start();
    $_SESSION['name'] = $_POST['name'];
    header('Location: products.php ');
}


?>

<!DOCTYPE html>
<html lang="en">
<?php include ('header-index.php'); ?>

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style type="text/css">

.abc{
    margin-top: 2em;
}
.bbb{
    margin-left: 12em;
    margin-top: 1.5em;
    border-radius: 1rem;
}
.brand-text{
    color: wheat !important;
    font-weight: bold ;
}


</style>
    <title class="titlul">Alin Pizza</title>
</head>

<body>

<!--apel in html pt op ternali -->
<!-- <p><?php echo $score > 40 ? 'high score' : 'low score'; ?></p> -->

<h5 class="center-align grey-text abc">Introduceti numele mai jos</h5>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
    <input type="text" name="name">
    <input type="submit" name="submit" value="Submit" class="waves-effect waves-light btn bbb">
</form>
</div>

</body>

<?php include ('templates/footer.php'); ?>
</html>
<?php 

session_start();
if($_SERVER['QUERY_STRING'] == 'noname'){
    unset($_SESSION['name']);
}

//get cookie
$name = $_COOKIE['name'] ?? 'Guest';

?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <title>Alin Pizza</title>
    <style type="text/css">
        .brand {
            background: #80cbc4  !important;
        }

        .brand-text {
            color: wheat !important;
            font-weight: bold !important;
        }
        form{
            max-width: 460px;
            margin: 20px auto;
            padding: 20px;
        }

        .pizza{
            width: 100px;
            margin: 40px auto -30px;
            display: block;
            position:relative;
            top:-30px;
        }
        .btn {
            border-radius: 1rem;
            font-weight: bold;
        }
        
    </style>
</head>

<body class="teal lighten-5">
    <nav class="white z-dept-0">
        <div class="container">
            <a href="products.php" class="brand-logo brand-text">Alin Pizza</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li class="grey-text">Hello <?php echo htmlspecialchars($name);?></li>
                <li> <a href="add.php" class="btn brand z-depth-0 ">Add a Pizza</a></li>
            </ul>
        </div>
    </nav>
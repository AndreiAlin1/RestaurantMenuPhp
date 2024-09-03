<?php

$conn = mysqli_connect('localhost', 'Alin', 'test1234', 'alin_pizza');
//verificare conexiune
if (!$conn) {
    echo 'Connection error: ' . mysqli_connect_error();
}

?>
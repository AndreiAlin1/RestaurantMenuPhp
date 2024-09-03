<?php 
include('config/db_connect.php');

if(isset($_POST['delete'])){

    $id_to_delete=mysqli_real_escape_string($conn,$_POST['id_to_delete']);

    $sql = "DELETE FROM pizzas WHERE id = $id_to_delete";

    if(mysqli_query($conn,$sql)){
        //succes
        header('Location: products.php');
    }{
        //failure
        echo 'query error: ' . mysqli_error($conn);
    }
}

//verifica get request param id
if(isset($_GET['id'])){

    $id = mysqli_real_escape_string($conn, $_GET['id']);

    //selecteaza inregistrarile unde id ul din bd corespunde cu id ul de la user
    $sql = "SELECT * FROM pizzas WHERE id = $id";
    //get rezultate
    $result = mysqli_query($conn, $sql);
    //fetch result in format de vector
    $pizza = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    mysqli_close($conn);
}

?>

<!DOCTYPE html>
<html>

<?php include ('templates/header.php'); ?>

<style>
    .container {
        color: darkcyan;
    }
</style>

<div class="container center ">
    <?php if($pizza): ?>

        <h4><?php echo htmlspecialchars($pizza['title']);?></h4>
        <p>Created by: <?php echo htmlspecialchars($pizza['email']);?></p>
        <p>Date: <?php echo date($pizza['created_time']);?></p>
        <h5>Ingredients: </h5>
        <p><?php echo htmlspecialchars($pizza['ingredients']);?></p>


        <!-- DELETE FORM -->
        <form action="details.php" method="POST">
        <input type="hidden" name="id_to_delete" value="<?php echo $pizza['id']?>">
        <input type="submit" name="delete" value="Delete" class="btn brand z-depth-0">


        </form>

    <?php else: ?>
        <h5>Nu exista nicio pizza!</h5>

    <?php endif; ?>
</div>

<?php include ('templates/footer.php'); ?>

</html>
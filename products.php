<?php

include ('config/db_connect.php');

//write query pt toate pitele
$sql = 'SELECT title,ingredients,id FROM pizzas ORDER BY created_time';


//make query si primeste rezultate
$result = mysqli_query($conn, $sql);

//fetch the resulting rown as an array
$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

//elibereaza rezultatul din memorie
mysqli_free_result($result);

//inchide conexiunea
mysqli_close($conn);

//face un array pentru ingrediente
(explode(',', $pizzas[0]['ingredients']));


?>


<!DOCTYPE html>
<html lang="en">
<style>
    .card-content h6, 
    .card-action 
    .brand-text {
        color: wheat !important;
        font-weight: bold !important;
    }
    .card-content ul li {
        color: white;
    }
    h4{
        margin-top: 3rem !important;
    }
</style>
<?php include ('templates/header.php'); ?>

<div>
    <h4 class="center grey-text">Pizza</h4>
    <div class="container ">
        <div class="row">

            <?php foreach ($pizzas as $pizza): ?>

                <div class="col s6 md3">
                    <div class="card z-depth-0 teal lighten-3">
                    <img src="images/<?php echo strtolower(str_replace(' ', '_', $pizza['title'])); ?>.png" class="pizza">
                        <div class="card-content center">
                        <h6> <?php echo htmlspecialchars($pizza['title']); ?></h6>
                            <ul>
                                <?php foreach (explode(',', $pizza['ingredients']) as $ing): ?>
                                    <li><?php echo htmlspecialchars($ing); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="card-action right-allign">
                            <a href="details.php?id=<?php echo $pizza['id'] ?>" class="brand-text">More info</a>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>

            <!-- <?php if (count($pizzas) >= 2): ?>
            <p>There are 2 or more pizzas</p>
        <?php else: ?>
            <p>There are less than 2 pizzas</p>
        <?php endif; ?> -->

        </div>
    </div>
</div>

<?php include ('templates/footer.php'); ?>


</html>
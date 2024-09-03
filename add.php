<?php

include ('config/db_connect.php');

$title = $email = $ingredients = '';
$errors = array('email' => '', 'title' => '', 'ingredients' => '');
//titlul, emailul si ingredientele vor fi stocate in GET care este o var globala
//  if (isset($_GET['submit'])){

// //luam valoarea cu care a comentat userul
//     echo $_GET['email'];
//     echo $_GET['title'];
//     echo $_GET['ingredients'];

// }

//POST este mai sigur decat GET deoarece nu afiseaza datele in URL
//trimite datele catre server
if (isset($_POST['submit'])) {

    //vedem daca este gol
    //htmlspecialchars este o metoda de securitate 

    //check email
    if (empty($_POST['email'])) {
        $errors['email'] = 'Email necesar <br />';
    } else {
        $email = $_POST['email'];
        //validare email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Emailul trebuie sa fie o adresa valida!';
        }
    }

    //check title
    // if (empty($_POST['title'])) {
    //     $errors['title'] = 'Titlu necesar <br />';
    // } else {
    $title = $_POST['title'];
    //     if (!preg_match('/^[a-zA-Z\s]+$/', $title)) {
    //         $errors['title'] = 'Titlul trebuie sa contina doar litere si spatii!';
    //     }
    // }

    //check ingrediente
    // if (empty($_POST['ingredients'])) {
    //     $errors['ingredients'] = 'Ingrediente necesare <br />';
    // } else {
    //     $ingredients = $_POST['ingredients'];
    //     if (!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $ingredients)) {
    //         $errors['ingredients'] = 'Ingredientele nu sunt valide';
    //     }
    // }
    

    //daca returneaza FALSE inseamna ca nu sunt erori in vector
    if (array_filter($errors)) {
        //echo 'Errors';
        //daca sunt erori fisierul html merge mai departe
    } else {

        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $ingredients = mysqli_real_escape_string($conn, $_POST['ingredients']);

        //create sql
        $sql = "INSERT INTO pizzas(title,email,ingredients) VALUES ('$title','$email','$ingredients')";


        //salvare db si verificare
        if (mysqli_query($conn, $sql)) {
            //succes
            //echo 'Valid';
            //te duce pe pagina de index
            header('Location: products.php');
        } else {
            //error
            echo 'query error: ' . mysqli_error($conn);
        }

    }


}//end post

?>


<!DOCTYPE html>
<html lang="en">

<?php include ('templates/header.php'); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<style>
    .but {
        border-radius: 0rem;
    }
</style>

<body>
    <section class="container grey-text">
        <h4 class="center">Add a Pizza</h4>
        <form class="white" action="add.php" method="POST">

            <label>Your Email: </label>
            <input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>

            <label>Pizza Type: <br><br></label>
            <!-- <input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
        <div class="red-text"><?php echo $errors['title']; ?></div> -->

            <a class='dropdown-trigger btn but' href='#' data-target='dropdown1'>Select Pizza Type &dArr;</a>
            <ul id='dropdown1' class='dropdown-content'>
                <li><a href="#!" onclick="selectPizza('Margherita')">Margherita</a></li>
                <li><a href="#!" onclick="selectPizza('Pepperoni')">Pepperoni</a></li>
                <li><a href="#!" onclick="selectPizza('Vegetarian')">Vegetarian</a></li>
            </ul>
            <input type="hidden" id="title" name="title" value="<?php echo htmlspecialchars($title) ?>">


            <!-- <label><br><br>Ingredients (comma separated): </label>
            <input type="text" name="ingredients" value="<?php echo htmlspecialchars($ingredients) ?>">
            <div class="red-text"><?php echo $errors['ingredients']; ?></div> -->
            <div class="input-field col s12">
                <select multiple class="ingredients[]">
                    <option value="" disabled selected>Selecteaza ingredientul special</option>
                    <option value="1">Cheese</option>
                    <option value="2">Ananas</option>
                    <option value="3">Banana</option>
                </select>
            </div>

            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
            </div>

        </form>
    </section>

    <?php include ('templates/footer.php'); ?>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.dropdown-trigger');
            var instances = M.Dropdown.init(elems, {});
            $('select').formSelect();
        });

        function selectPizza(pizzaType) {
            document.getElementById('title').value = pizzaType;
            document.getElementById('pizzaImage').src = 'images/' + pizzaType.toLowerCase() + '_image.png';
        }

    </script>
</body>

</html>
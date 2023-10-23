<?php

include("config/db_connect.php");

//write query from pizza
$sql = "SELECT * FROM pizza";

$result = mysqli_query($conn, $sql);

$pizzas = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result
mysqli_free_result($result);

//close connection
mysqli_close($conn);

// print_r($pizzas);


// ================================================================================================================
// METHOD two
// echoed the data from the database on the top of the index page
// if (mysqli_num_rows($result) > 0) {
//   // output data of each row
//   while($row = mysqli_fetch_assoc($result)) {
//         echo "id: " . $row["id"] . " - Email: " . $row["email"] . " ". "Number: " . $row["nomber"] . "  " ."pizzaType: " . $row['pizza_type'] ."  ". "pizzaSize: " . $row['pizza_size'] ."<br/>";
//   }
// } else {
//   echo "0 results";
// }
// mysqli_close($conn);
// =====================================================================================================================


?>


<!-- why i used a template and include func is to show that i can create, edit and make corrections on one 
file or more and it will reflect on this page just by using include func. -->
<!DOCTYPE html>
<html lang="en">
    
<?php      include("template/header.php"); ?>
<h3 class="hay3">ordered pizzas!</h3>
<div class="container">
<?php foreach($pizzas as $pizza): ?>
<div class="card">
    <div class="div_card2">
    <!-- <img src="template/pizzahead3.jpg" alt="pizza" class="pizhead"> -->
    <h3> <?php echo htmlspecialchars($pizza['pizza_type'])?></h3>
    <p> <?php echo htmlspecialchars($pizza['pizza_size'])?></p>
    <p> <?php echo htmlspecialchars($pizza['email'])?></p>
    <p> <?php echo htmlspecialchars($pizza['nomber'])?></p>

    <br><br>
    <hr>
    <div class="link_div">
        <a class="a_link" href="details.php?id=<?php echo $pizza['id']?>">more info</a>
    </div>
    </div> 
         
</div>
<?php endforeach; ?>
</div>
<?php      include("template/footer.php"); ?>
    

</html>
<!-- NOTE: the code here runs only when the form is submitted -->
<?php

include('config/db_connect.php');
// TO make the input field empty when entering the page first time, you've to set the var, which is a value atrribute in the input field as empty string.
$email = $nomber = "";
// step 1: made an array of errors to catch errors. it is an empty array string because we only want to display errors when the field is not appropriately filled. this is first step!
$errors = array('email' => '', 'nomber' => '', 'pizza_type' => '', 'pizza_size' => '' );
// if(isset($_GET['submit'])){
//     echo $_GET['email'];
//     echo $_GET['pizzatype'];
//     echo $_GET['pizzasize'];
//     echo $_GET['nomber'];
// }


// To protect your data from croos site scripting use the htmlspecialchars() function
//WE USE THE ISSET FUNC TO PROCESS A DATA SENT TO US BY THE METHOD[GET OR POST]IN ADDITION WITH THE GLOBAL-VAR[$_GET OR $_POST] which extract the data and send it to the DB.
if(isset($_POST['submit'])){
    // echo htmlspecialchars($_POST['email']);
    // echo htmlspecialchars($_POST['pizzatype']);
    // echo htmlspecialchars($_POST['pizzasize']);
    // echo htmlspecialchars($_POST['nomber']);


    // this block is the validation of data field, to see if they have actually enter some data. i USed PHP empty function.
    // further validation using php built in filter and use of regex. 
if (empty($_POST['email'])){
    //since i have two types of possible errors to catch, i set empty function and filtered func error variables into variable.
    //empty func error variable.  i changed it from echo " ... "  to assinging a var. if i dont change it to var, it display at the top of the screen.
    $errors['email'] = "an email is required";
} else {
    //used a builtin filter for validation
    $email = $_POST['email'];
    //i used exclamtion mark(!) to return true into false, that is,  when the condition is false but turned true due to the (!), it fires the error message.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL )){
        //if the field data is inappropriate, it throws this error
        //step 2: second step of displaying errors underneath the input field,  i changed it from echo " ... "  to assinging a var, so that when the error occurs it saves at step one.
        $errors['email'] = 'email address is invalid!';
    }
}

if ($_POST['pizza_type'] == 'none'){
    $errors['pizza_type'] = "select a pizza type";
} 

if ($_POST['pizza_size'] == 'none'){
    $errors['pizza_size'] = "pizza size is required";
} 

if (empty($_POST['nomber'])){
    //empty func error variable.  i changed it from echo " ... "  to assinging a var
    $errors['nomber'] = "your phone number is required to get in touch";

    //used regex for validation
} else {
    $nomber = $_POST['nomber'];
    if(!preg_match('/^[\d]{11}+$/', $nomber)){
        $errors['nomber'] = "you have entered an invalid P.number";
    }
}
//if there is no error this will redirect us to another page.
if (array_filter($errors)){

}else{
    //i am connecting to d DB and as well trying to pull the data in this field into the DB
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $nomber = mysqli_real_escape_string($conn, $_POST['nomber']);
    $pizzatype = mysqli_real_escape_string($conn, $_POST['pizza_type']);
    $pizzasize = mysqli_real_escape_string($conn, $_POST['pizza_size']);

    //create sql
    $sql = "INSERT INTO pizza(email, nomber, pizza_type, pizza_size) VALUES ('$email', '$nomber', '$pizzatype', '$pizzasize' )";

//save to DB and check
if(mysqli_query($conn, $sql)){
    //if the form is correctly entered it returns to this page
    header("Location: index.php");
}else{
    //if the form is wrongly entered it throws this error
    echo "query error: " . mysqli_error($conn);
}
    
}

}





?>

<!DOCTYPE html>
<html lang="en">
    
<?php      include("template/header.php"); ?>

<section class="sec1">
    <h3 class="head3">Order your pizza</h3>
    <div class="div_card">
        <form action="add.php" method="post">
            <label >Email:</label>
            <!-- step 1: in order to retain the values in the input field, i inserted a php script in a value attribute -->
            <input type="text" name="email"  value= "<?php echo  htmlspecialchars($email) ?>"> 
    <!-- //step 3: in order to display error beneath the field, i put it in a php script tag. the error saved in step 1 is displayed here. -->
            <div class="err"><?php echo $errors['email']; ?></div>
            <br>
            <label >Phone-number:</label>
            <input type="text" name="nomber" value= "<?php echo  htmlspecialchars($nomber) ?>">
            <div class="err"><?php echo $errors['nomber']; ?></div> 
            <br>
            <label>Pizza Type:</label>
            <select name="pizza_type" class="sel">
                <option value="none">None</option>
                <option value="meatpizza" >Meat Pizza</option>
                <option value="cheesepizza">Cheese Pizza</option>
                <option value="pepperonipizza">Pepperoni Pizza</option>
                <option value="buffalopizza">Buffalo Pizza</option>
                <option value="bbqpizza">BBQ Pizza</option>
                <option value="haiwanpizza" >Haiwain Pizza</option>
                <option value="veggiepizza" >Veggie Pizza</option>
                <option value="margheritapizza" >Margherita Pizza</option>
            </select>
            
            <label>Pizza size:</label>
            <select name="pizza_size" class="sel">
            <option value="none">None</option>
            <option value="largepack" >Large pack</option>
            <option value="mediumpack " >Medium pack</option>
            <option value="smallpack " >Small Pack</option>    
            </select>

            <div class="div_sub">
           <input type="submit" name="submit" value="submit" class="sub">

           </div>

        </form>
   
    </div>
</section>
<?php      include("template/footer.php"); ?>
    

</html>
<?php 
        $value = 0;
        
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            // grab data from inputs
            $num1 = filter_input(INPUT_POST, "num01", FILTER_SANITIZE_NUMBER_FLOAT);
            $num2 = filter_input(INPUT_POST, "num02", FILTER_SANITIZE_NUMBER_FLOAT);
            $operator = htmlspecialchars($_POST["operator"]);

            //error handlers
            $errors = false;

            //if no input
            if(empty($num1) || empty($num2) || empty($operator)){
                echo "<p class='calc-error'> Fill in all fields</p>";
                $errors = true;
            }

            //if input not numeric
            if(!is_numeric($num1) || !is_numeric($num2)) {
                echo "<p class='calc-error'> Fill in all fields</p>";
                $errors = true;
            }

            // Calculate the number if no errors
            if(!$errors){
                $value = 0;

                switch($operator) {
                    case "add":
                        $value = $num1 + $num2;
                        break;
                    case "subtract":
                        $value = $num1 - $num2;
                        break;
                    case "multiply":
                        $value = $num1 * $num2;
                        break; 
                    case "divide":
                        $value = $num1 / $num2;
                        break;  
                    default: 
                        echo "<p class='calc-error'> Something went wrong </p>";
                }
                
                
            }
        } 
    ?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculator</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="text-center">
        <h2 class="mb-4">Calculator</h2>
        <div class="form-group">
            <input type="number" class="form-control mb-2" name="num01" placeholder="Number one">
            <select class="form-control mb-2" name="operator">
                <option value="add">+</option>
                <option value="subtract">-</option>
                <option value="multiply">*</option>
                <option value="divide">/</option>
            </select>
            <input type="number" class="form-control mb-2" name="num02" placeholder="Number two">
        </div>
        <button class="btn btn-primary" type="submit">Calculate</button>

       <?php echo "<p class='calc-result'> Result = " . $value . "</p>"; ?>

    </form>

</body>
</html>
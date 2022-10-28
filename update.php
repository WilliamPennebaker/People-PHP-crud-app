<?php 
require_once 'dbconnect.php';

$name = $email = $phone = "";
$name_err = $email_err = $phone_err = "";


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if(!empty($_POST["name"])) {
        $input_name = trim($_POST["name"]);
        $name = $input_name;
    } elseif(empty($_POST["name"])) 
        $name_err = "Please enter a name.";
    elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" =>"/^[a-zA-Z\s]+$/"))))
        $name_err = "Please enter a valid name.";

    // Validate email
    if(!empty($_POST["email"])) {
        $input_email = trim($_POST["email"]);
        $email = $input_email;
    } elseif(empty($input_email)) 
        $email_err = "Please enter an email.";
    elseif(!filter_var($input_email, FILTER_VALIDATE_EMAIL))
        $email_err = "Please enter a valid email.";

    // Validate phone number
    if(!empty($_POST["phone"])) {
        $input_phone = trim($_POST["phone"]);
        $phone = $input_phone;
    } elseif(empty($input_phone)) 
        $phone_err = "Please enter a phone number.";
    elseif(!filter_var($input_phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" =>"/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/"))))
        $phone_err = "Please enter a valid phone number.";

    if(empty($name_err) && empty($email_err) && empty($phone_err)) {
        $id = $_POST["id"];
        // Prepare statement
        $stmt = $conn->prepare("UPDATE people SET name = ?, email = ?, phone = ? WHERE id = ?");
        // Binding vars to statement
        $stmt->bind_param("sssi", $param_name, $param_email, $param_phone, $param_id);
        // Set parameters to the variables
        $param_name = $name;
        $param_email = $email;
        $param_phone = $phone;
        $param_id = $id;

        if($stmt->execute()) {
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        $stmt->close();
        // Close connection
        $conn->close();
    }
} else {
    // Check existence of id
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get url parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $stmt = $conn->prepare("SELECT * FROM people WHERE id = ?");
        // Binding var to statement
        $stmt->bind_param("i", $param_id);
        // Setting param
        $param_id = $id;

        if($stmt->execute()) {
            $result = $stmt->get_result();
            if($result->num_rows == 1) {
                // Fetch result as an associative array. Since the result set contains only one row, no need for a while loop
                $row = $result->fetch_array(MYSQLI_ASSOC);

                // Retrieve info from array
                $name = $row["name"];
                $email = $row["email"];
                $phone = $row["phone"];
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
        // Close statement
        $stmt->close();
        // Close connection
        $conn->close();
    } else { // Url doesn't contain id parameter.
        header("location: error.php");
        exit();
    }

}

?>

<html>
    <?php include "./assests/head.php" ?>
    <body>
        <?php include "./assests/header.php" ?>

        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5"> Update Record </h2>
                    <p> Please edit the values in this form to update persons record. </p>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="col-md-8">
                        <div class="row">
                            <input type="hidden" value="<?php echo $id ?>" name="id"/>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Name</span>
                                        <input name="name" type="text" class="form-control" value="<?php echo $name; ?>">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Email</span>
                                        <input name="email" type="email" class="form-control" value="<?php echo $email; ?>">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Phone</span>
                                        <input name="phone" type="text" class="form-control" value="<?php echo $phone; ?>">
                                    </div>
                                </div>
                        </div>
                        <?php if(isset($name_err)) echo "<p>" . $name_err . "</p>" ?>
                        <?php if(isset($email_err)) echo "<p>" . $email_err . "</p>" ?>
                        <?php if(isset($phone_err)) echo "<p>" . $phone_err . "</p>" ?>
                        <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
                
            </div>
        </div>

        <?php include "./assests/footer.php" ?>
    </body>
</html>
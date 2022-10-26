<?php 
require_once "dbconnect.php";

$name = $email = $phone = "";
$name_err = $email_err = $phone_err = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    $input_name = trim($_POST["name"]);
    if(empty($_POST["name"])) $name_err = "Please enter a name";
    elseif(!filter_var($input_name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" =>"/^[a-zA-Z\s]+$/"))))
        $name_err = "Please enter a valid name";
    else $name = $input_name;

    // Validate email
    $input_email = trim($_POST["email"]);
    if(empty($input_email)) $email_err = "Please enter an email";
    else $email = $input_email;

    // Validate phone number
    $input_phone = trim($_POST["phone"]);
    if(empty($input_phone)) $phone_err = "Please enter a phone number";
    elseif(!filter_var($input_phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" =>"/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/"))))
        $phone_err = "Please enter a valid phone number";
    else $phone = $input_phone;

    // Prepare statement
    $stmt = $conn->prepare("INSERT INTO people (name, email, phone) VALUES (?, ?, ?)");
    // Binding vars to statement
    $stmt->bind_param("sss", $param_name, $param_email, $param_phone);
    // Set parameters to the variables
    $param_name = $name;
    $param_email = $email;
    $param_phone = $phone;

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

?>


<html>
    <?php include "./assests/head.php" ?>
    <body>
        <?php include "./assests/header.php" ?>
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Record</h2>
                    <p>Please fill this form and submit to add person record to database.</p>
                </div>
                
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="col-md-8">
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Name</span>
                                        <input name="name" type="text" class="form-control" placeholder="John Doe">
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Email</span>
                                        <input name="email" type="email" class="form-control" placeholder="johndoe@example.com">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Phone</span>
                                        <input name="phone" type="text" class="form-control" placeholder="9876543210">
                                    </div>
                                </div>
                        </div>
                        <button type="submit" class="btn btn-primary" value="Submit">Submit</button>
                        <a href="index.php" class="btn btn-secondary">Cancel</a>
                    </div>
                </form>
                
            </div>
        </div>
        <?php include "./assests/footer.php" ?>
    </body>
</html>
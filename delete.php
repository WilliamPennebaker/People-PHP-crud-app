<?php 
require_once 'dbconnect.php';

$name = $email = $phone = "";
$name_err = $email_err = $phone_err = "";

if(isset($_GET["id"]) && !empty($_GET["id"])) {
    // Prepare statement to get info of id
    $stmt = $conn->prepare("SELECT * FROM people WHERE id = ?");
    // Bind variable to statement
    $stmt->bind_param("i", $param_id);
    // Set parameter
    $param_id = trim($_GET["id"]);
    $id = $param_id;
    if($stmt->execute()) {
        $result = $stmt->get_result();

        if($result->num_rows == 1) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
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
} elseif($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = trim($_POST["id"]);
    // Prepare the delete statement 
    $stmt = $conn->prepare("DELETE FROM people WHERE id=?");
    $stmt->bind_param('i', $id);

    if($stmt->execute()) {
        header("location: index.php");
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
} else {
    if(empty(trim($_GET["id"]))) {
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
                    <h2 class="mt-5"> Delete Record </h2>
                    <p> Please check the information below before deleting record. </p>
                </div>

                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="col-md-8">
                        <div class="row">
                            <input type="hidden" value="<?php echo $id ?>" name="id"/>
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Name</span>
                                        <input name="name" type="text" class="form-control" value="<?php echo $name; ?>" readonly>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Email</span>
                                        <input name="email" type="email" class="form-control" value="<?php echo $email; ?>" readonly>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text">Phone</span>
                                        <input name="phone" type="text" class="form-control" value="<?php echo $phone; ?>" readonly>
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
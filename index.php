<html>
    <?php include "./assests/head.php"?>
    <script>
        $(document).ready( 
            function() {
                $('#table').DataTable( {
                    "lengthMenu": [[10, 15, 25, 50, -1], [10, 15, 25, 50, "All"]],
                    "bAutoWidth": false,
                    columnDefs: [
                        { target: 0, visible: false},
                        { target: 5, width: "30px"}
                    ]
                } );
            }
        );
    </script>
    <body>
        <?php include "./assests/header.php"?>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">People</h2>
                            <a href="create.php" class="btn btn-success pull-right">
                                <i class="fa fa-plus">
                                    Add New Person
                                </i>
                            </a>
                        </div>
                        <table id="table" class="table table-striped table-bordered">
                        <?php
                            require_once "dbconnect.php";

                            // Attempt select query
                            $sql = "SELECT * FROM people";
                            if($result = mysqli_query($conn, $sql)) {
                                if(mysqli_num_rows($result) > 0) {
                                    //echo '<table id="table" class="table table-bordered table-striped">';
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th>#</th>";
                                                echo "<th>Name</th>";
                                                echo "<th>Email</th>";
                                                echo "<th>Phone</th>";
                                                echo "<th>Created date</th>";
                                                echo "<th>Actions</th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";
                                        while($row = $result->fetch_array()) {
                                            echo "<tr>";
                                                echo "<td>" . $row['id'] . "</td>";
                                                echo "<td>" . $row['name'] . "</td>";
                                                echo "<td>" . $row['email'] . "</td>";
                                                echo "<td>" . $row['phone'] . "</td>";
                                                echo "<td>" . $row['created'] . "</td>";
                                                echo "<td>";
                                                    echo '<a href="update.php?id='. $row['id'] .'" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                                    echo '<a href="delete.php?id='. $row['id'] .'" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                                echo "</td>";
                                            echo "</tr>";
                                        }
                                        echo "</tbody>";
                                    //echo "</table>";

                                    // free the result set
                                    $result -> free();
                                } else {
                                    echo '<div class="alert alert-danger><em>No records were found.</em></div>"';
                                }
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }

                        ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <?php include "./assests/footer.php"?>
    </body>
</html>
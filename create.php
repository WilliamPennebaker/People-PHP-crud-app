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
                
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <label class="form-label" for="name">
                                Name
                            </label>
                            <input id="name" class="form-control" type="text" placeholder="John Doe">
                        </div>
                        
                        <div class="col-md-12">
                            <label class="form-label" for="email">
                                Email
                            </label>
                            <input id="email" class="form-control" type="email" placeholder="johndoe@example.com">
                        </div>

                        <div class="col-md-12">
                            <label class="form-label" for="phone">
                                Phone
                            </label>
                            <input id="phone" class="form-control" type="text" placeholder="9876543210">
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <?php include "./assests/footer.php" ?>
    </body>
</html>
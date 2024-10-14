<?php

require_once 'includes/dbconnect.php';
require_once '../HTML/headerCRUD.php';
?>
<div class="container">
    <?php                       /* analisa se todos os campos estão preenchidos do cadastro */
    if(isset($_POST['addnew'])){
        if ( empty($_POST['firstname']) || empty($_POST['lastname']) ||
    empty($_POST['address']) || empty($_POST['contact'])) {
            echo "Please fillout all required fields";
        }else{
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $address = $_POST['address'];
            $contact = $_POST['contact'];
            $sql = "INSERT INTO users(firstname,lastname,address,contact)
        VALUES('$firstname','$lastname','$address','$contact')";
            if ( $mysqli->query($sql) === TRUE){
                echo "<div class='alert alert-success'>Successfully added new user</div>";
            }else{
                echo "<div class='alert alert-danger'>Error: There was an error while adding new user</div>";
            }
        }
    }
    ?>
    <div class="row">
    <div class="col-md-6 col-md-offset-3">
        <div class="box">
                <h3><i class="glyphicon glyphicon-plus"></i>&nbsp;Add New User</h3>
                <form action="" method="post">
                    <label for="firstname">Firstname</label>
                    <input type="text" id="firstname" name="firstname" class="form-control"><br>
                    <label for="lastname">Lastname</label>
                    <input type="text" id="lastname" name="lastname" class="form-control"><br>
                    <label for="address">Address</label>
                    <textarea rows="4" name="address" class="form-control"></textarea><br>
                    <label for="contact">Contact</label>
                    <input type="text" id="contact" name="contact" class="form-control"><br>
                    <input type="submit" name="addnew" class="btn btn-success" value="Add New">
                </form>
        </div>
    </div>
    </div>
</div>
<?php
require_once 'footer.php';
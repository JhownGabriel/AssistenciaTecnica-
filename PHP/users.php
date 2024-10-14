<?php
require_once 'includes/dbconnect.php';
require_once '../HTML/headerCRUD.php';

echo "<div class='container'>";
if ( isset($_POST['delete'])) {
    $sql = "DELETE FROM Usuario WHERE id_usu=" .$_POST['userid'];
    if($con->query($sql) === TRUE){
        echo "<div class='alert alert-success'>Successfully delete user</div>";
    }
}
$sql    = "SELECT * FROM Usuario";
$result = $mysqli->query($sql);
if ($result->num_rows > 0) {
    
    ?>
    <h2>List of all Users</h2>
    <table class="table table-bordered table-striped"> /* Locais dos botões e as informações */
            <tr>
                <td>Firstname</td>
                <td>Lastname</td>
                <td>Address</td>
                <td>Contract</td>
                <td width="70px">Delete</td>
                <td width="70px">Edit</td>
            </tr>
    <?php
    while ( $row = $result->fetch_assoc()) /* por aqui voce consegue ver os nomes ,deletar e editar */
    {
            echo "<form action='' method='POST'>";   //added
            echo "<input type='hidden' value='".$row['id_usu']."' name='userid' />"; //added
            echo "<tr>";
            echo "<td>".$row['firstname']."</td>";
            echo "<td>".$row['lastname']."</td>";
            echo "<td>".$row['address']."</td>";
            echo "<td>".$row['contact']."</td>";
            echo "<td><input type='submit' name='delete' value='Delete' class='btn btn-danger' /></td>";
            echo "<td><a href='edit.php?id=".$row['id_usu']."' class='btn btn-info' />Edit</a></td>";
            echo "</tr>";
            echo "</form>"; //added
    }
    ?>
    </table>
<?php
}
else
{
    echo "<br><br>No Record Found";
}
?>
</div>
<?php
require_once 'footer.php';

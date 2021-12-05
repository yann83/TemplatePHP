<?php 
session_start();

if (!isset($_SESSION['username'])) {
    $message = urlencode("Page requires login!");
    header('Location: ../login.php?message='.$message);
    die();
}

if (!isset($_SESSION['userrole']) || ($_SESSION['userrole']) != "admin" ) {
    $message = urlencode("You need admin role");
    header('Location: ../error.php?message='.$message);
    die();
}

include "../../layout/layout_functions.php";
echo_header("Users management");

include "../../config/pdo-connection.php";

$sql = "SELECT id, username, email, LEFT(password, 25) as pwd, role FROM ".$db.".users";
$stmt= $pdo->prepare($sql);
if ($stmt->execute()) {
    $result = $stmt->fetchAll();
} else {
    $message = "Query unsuccesfull!";
}
?>
<?php if (isset($message)): ?>
    <p class="error"><?php echo $message; ?></p>
<?php endif; ?>

<h2 class="text-center">Users list</h2>
<button type="button" id="ajouterNouveauUtilisateur" class="btn btn-success mt-2">Add an user</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Username</th>
            <th scope="col">Email</th>
            <th scope="col">Password</th>
            <th scope="col">Role</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    foreach($result as $row) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['username']}</td>
                <td>{$row['email']}</td>
                <td>{$row['pwd']}</td>
                <td>{$row['role']}</td>
                <td>
                    <a href=\"javascript:void(0)\" class=\"btn btn-primary edit\" data-id=\"{$row['id']}\">Update</a>
                    <a href=\"javascript:void(0)\" class=\"btn btn-danger delete\" data-id=\"{$row['id']}\">Delete</a>
                </td>                
            </tr>";
    }
    ?>
</tbody>
</table>
<div class="modal fade" id="modele-User" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modeleUser"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="ajouterModifierUser" name="ajouterModifierUser" class="form-horizontal" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="formUser" class="col-sm-2 control-label">Username</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="formUser" name="formUser" placeholder="Enter an username" value="" maxlength="50" required="">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="formEmail" class="col-sm-2 control-label">Email address</label>
                        <div class="col-sm-12">
                            <input type="email" class="form-control" id="formEmail" name="formEmail" placeholder="Enter an email" value="" maxlength="50" required="">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="formRole" class="col-sm-2 control-label">Role</label>
                        <select class="form-select" id="formRole" name="formRole" aria-label="Select a role">
                            <option value="user">user</option>
                            <option value="admin">admin</option>
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label for="formPassword" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="formPassword" name="formPassword" placeholder="Enter a password" value="" maxlength="50" required="">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="formPasswordCheck" class="col-sm-2 control-label">Confim password</label>
                        <div class="col-sm-12">
                            <input type="password" class="form-control" id="formPasswordCheck" name="formPasswordCheck" placeholder="Check your password" value="" maxlength="50" required="">
                        </div>
                    </div>
                    <div id="checkPassword">
                        <p class="text-danger">Passwords don't match</p>
                    </div>                                                                                 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary mt-2" id="boutonSauver" value="ajouterNouveauUtilisateur">Save</button>
                    </div>
                </form>
            </div>               
        </div>
    </div>
</div>

<script type = "text/javascript" >
    var password = '';
    var passwordCheck = '';

    $(document).ready(function($) {        
        $('#ajouterNouveauUtilisateur').click(function() {  
            $('#checkPassword').hide();          
            $('#ajouterModifierUser').trigger("reset");
            $('#id').attr('value','');
            $('#modeleUser').html("Add an user");
            $('#modele-User').modal('show');
            //console.log('id ajout',id);
        });
        $('body').on('click', '.edit', function() {
            $('#checkPassword').hide();
            var id = $(this).data('id');
            console.log('id selection',id);
            // ajax
            $.ajax({
                type: "POST",
                url: "users_edit.php",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(res) {
                    //console.log(res);
                    //console.log(res[0].username);
                    $('#modeleUser').html("Update an user");
                    $('#modele-User').modal('show');
                    $('#id').val(res[0].id);
                    $('#formUser').val(res[0].username);
                    $('#formEmail').val(res[0].email);
                    $('#formRole').val(res[0].role);
                    //$('#formPassword').val(res[0].password);
                    //$('#formPasswordCheck').val(res[0].password);
                }
            });
        });
        $('body').on('click', '.delete', function() {
            if (confirm("Do you want to delete this user ?") == true) {
                var id = $(this).data('id');
                // ajax
                $.ajax({
                    type: "POST",
                    url: "users_delete.php",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(res) {
                        console.log(res[0].username);
                        $('#formUser').html(res[0].username);
                        $('#formEmail').html(res[0].email);
                        $('#formRole').html(res[0].role);
                        $('#formPassword').html(res[0].password);                       
                        window.location.reload();
                    }
                });
            }
        });
        $('#ajouterModifierUser').submit(function() {
            console.log($(this).serialize());
            var $password = $("#formPassword").val();
            var $passwordCheck = $("#formPasswordCheck").val();
            if ($password == $passwordCheck) {
                // ajax
                $.ajax({
                    type: "POST",
                    url: "users_insertupdate.php",
                    data: $(this).serialize(), // get all form field value in 
                    dataType: "json",
                    success: function(res) {
                        console.log(res);                    
                        window.location.reload();
                    }
                });
                $('#modele-User').modal('hide');
            } else {
                $('#checkPassword').show();
            }
        });
    }); 
</script>
<?php echo_footer(); ?>

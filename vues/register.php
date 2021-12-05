<?php 
include "../layout/layout_functions.php";
echo_header("Register");


if (isset($_POST['register_button']))
{
    include "../config/pdo-connection.php";

    if ($_POST['password'] == $_POST['confirm']) {

        $data = [
            'username' => $_POST['username'],
            'passwd' => password_hash($_POST['password'], PASSWORD_DEFAULT),
            'email' => $_POST['email']
        ];

        $sql = "INSERT INTO ".$db.".users (users.username, users.password, users.email) VALUES (:username, :passwd, :email)";
        $stmt= $pdo->prepare($sql);
        if ($stmt->execute($data)) {
            $_SESSION['user_data'] = $data;
            header('Location: login.php');
        } else {
            $message = "Register unsuccesfull!";
        }

    } else {
        $message = "Passwords don't match";
    }

}


?>
    
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">   
                    <h2>S'enregister</h2>
                    <form action="" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Confirm password</label>
                            <input type="password" class="form-control" name="confirm">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" name="email">
                        </div>
                        <?php if (isset($message)): ?>
                            <p class="text-center text-danger"><?php echo $message; ?></p>
                        <?php endif; ?>
                        <input type="submit" class="btn btn-primary" name="register_button" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo_footer(); ?>
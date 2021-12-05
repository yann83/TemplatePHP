<?php 
session_start();

include "../layout/layout_functions.php";
echo_header("Login");

if (isset($_GET['message'])) { $message = $_GET['message']; }

if (isset($_POST['login_button']))
{
    include "../config/pdo-connection.php";

    $data = [
        'username' => $_POST['username']
    ];

    $sql = "SELECT id,password,role FROM ".$db.".users WHERE username = :username";
    $stmt= $pdo->prepare($sql);
    
    if ($stmt->execute($data)) {
        $result = $stmt->fetch();
        
        // Compare password hash 
        if (password_verify($_POST['password'], $result['password'])) {
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['userid'] = $result['id']; 
            $_SESSION['userrole'] = $result['role'];  
            header('Location: products.php?message='.urlencode($message));
        } else {
            $message = "Invalid password";
        }
        
    }
}

?>
<div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
            <div class="card shadow-2-strong" style="border-radius: 1rem;">
                <div class="card-body p-5 text-center">   
                    <img src="../img/logo.svg" width="100" height="100" class="d-inline-block align-top" alt="">    
                    <h2>Login</h2>

                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <?php if (isset($message)): ?>
                            <p class="text-center text-danger"><?php echo $message; ?></p>
                        <?php endif; ?>
                        <input type="submit" class="btn btn-primary" name="login_button" value="Login">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php echo_footer(); ?>
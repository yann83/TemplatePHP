<?php 
session_start();

if (!isset($_SESSION['username'])) {
    $message = urlencode("Page requires login!");
    header('Location: ../login.php?message='.$message);
    die();
}

if (isset($_GET['message'])) { $message = $_GET['message']; }

include "../layout/layout_functions.php";
echo_header("Error page");
?>
<?php if (isset($message)): ?>
</br><p class="text-center text-danger"><?php echo $message; ?></p>
<?php endif; ?>
<?php echo_footer(); ?>
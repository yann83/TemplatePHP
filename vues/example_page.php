<?php 
session_start();

// optionnal if you want to a identified user to access this page
/*
if (!isset($_SESSION['username'])) {
    $message = urlencode("Page requires login!");
    header('Location: ../login.php?message='.$message);
    die();
}
*/

include "layout/layout_functions.php";
echo_header("example");


?>
<!-- content here -->
   

<?php echo_footer(); ?>
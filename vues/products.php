<?php 
session_start();

include "../layout/layout_functions.php";
echo_header("Listes des profiles");

include "../config/pdo-connection.php";

$sql = "SELECT ".$db.".products.id,
        ".$db.".products.name,
        ".$db.".products.price,
        ".$db.".products.status,
        ".$db.".products.location  
        FROM ".$db.".products";
$stmt= $pdo->prepare($sql);
if ($stmt->execute()) {
    $result = $stmt->fetchAll();
} else {
    $message = "Query unsuccesfull!";
}
?>
    <div class="container">
        <h2 class="text-center">Products list</h2>
        <?php if (isset($message)): ?>
        <p class="text-center text-danger"><?php echo $message; ?></p>
        <?php endif; ?>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Global search</span>
            </div>
            <input type="text" class="form-control" id="products_searchall" placeholder="Global search" aria-label="Global search" aria-describedby="basic-addon1">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">Product search</span>
            </div>
            <input type="text" class="form-control" id="profile_name" placeholder="Enter the product name" aria-label="Enter the product name" aria-describedby="basic-addon1">
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</td>
                    <th scope="col">Product name</td>
                    <th scope="col">Price</td>
                    <th scope="col">Status</td>
                    <th scope="col">Location</td>
                </tr>
            </thead>
            <tbody>
            <?php 
            foreach($result as $row) {
                echo "<tr>
                        <th scope=\"row\">{$row['id']}</th>
                        <td>{$row['name']}</td>
                        <td>{$row['price']} €</td>
                        <td>{$row['status']}</td>
                        <td>{$row['location']}</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
    <!-- Script -->
    <script type='text/javascript'>
        $(document).ready(function(){

            // Search all columns
            $('#products_searchall').keyup(function(){
                // Search Text
                var search = $(this).val();

                // Hide all table tbody rows
                $('table tbody tr').hide();

                // Count total search result
                var len = $('table tbody tr:not(.notfound) td:contains("'+search+'")').length;

                if(len > 0){
                    // Searching text in columns and show match row
                    $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
                        $(this).closest('tr').show();
                    });
                }else{
                    $('.notfound').show();
                }
                
            });

            // Search on name column only
            $('#profile_name').keyup(function(){
                // Search Text
                var search = $(this).val();

                // Hide all table tbody rows
                $('table tbody tr').hide();

                // Count total search result
                var len = $('table tbody tr:not(.notfound) td:nth-child(2):contains("'+search+'")').length;
                
                if(len > 0){
                    // Searching text in columns and show match row
                    $('table tbody tr:not(.notfound) td:contains("'+search+'")').each(function(){
                        $(this).closest('tr').show();
                    });
                }else{
                    $('.notfound').show();
                }
                
            });
            
        });

        // Case-insensitive searching (Note - remove the below script for Case sensitive search )
        $.expr[":"].contains = $.expr.createPseudo(function(arg) {
            return function( elem ) {
                return $(elem).text().toUpperCase().indexOf(arg.toUpperCase()) >= 0;
            };
        });
    </script>    
<?php echo_footer(); ?>
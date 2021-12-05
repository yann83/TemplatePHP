<?php 
session_start();

if (!isset($_SESSION['username'])) {
    $message = urlencode("Page requires login!");
    header('Location: ../login.php?message='.$message);
    die();
}

include "../../layout/layout_functions.php";
echo_header("Products management");

include "../../config/pdo-connection.php";

$sql = "SELECT id, name, price, status, location FROM ".$db.".products";
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

<h2 class="text-center">Products list</h2>
<button type="button" id="addNewProduct" class="btn btn-success mt-2">Add a product</button>
<table class="table">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Price</th>
            <th scope="col">Status</th>
            <th scope="col">Location</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    foreach($result as $row) {
        echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['name']}</td>
                <td>{$row['price']} €</td>
                <td>{$row['status']}</td>
                <td>{$row['location']}</td>
                <td>
                    <a href=\"javascript:void(0)\" class=\"btn btn-primary edit\" data-id=\"{$row['id']}\">Update</a>
                    <a href=\"javascript:void(0)\" class=\"btn btn-danger delete\" data-id=\"{$row['id']}\">Delete</a>
                </td>                
            </tr>";
    }
    ?>
</tbody>
</table>
<div class="modal fade" id="model-Product" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelProduct"></h4>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0)" id="addModiftProduct" name="addModiftProduct" class="form-horizontal" method="POST">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="formName" class="col-sm-2 control-label">Product name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="formName" name="formName" placeholder="Enter a product name" value="" maxlength="50" required="">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="formPrice" class="col-sm-2 control-label">Price</label>
                        <div class="col-sm-12">
                            <input type="number" step="0.01" class="form-control" id="formPrice" name="formPrice" placeholder="Enter a price" value="" maxlength="50" required="">
                        </div>
                    </div> 
                    <div class="form-group">
                        <label for="formStatus" class="col-sm-2 control-label">Status</label>
                        <select class="form-select" id="formStatus" name="formStatus" aria-label="Select a status">
                            <option value="on sale">on sale</option>
                            <option value="out of stock">out of stock</option>
                        </select>
                    </div>                    
                    <div class="form-group">
                        <label for="formLocation" class="col-sm-2 control-label">Location</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="formLocation" name="formLocation" placeholder="Enter a location" value="" maxlength="50" required="">
                        </div>
                    </div>                                                                                 
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary mt-2" id="boutonSauver" value="addNewProduct">Save</button>
                    </div>
                </form>
            </div>               
        </div>
    </div>
</div>

<script type = "text/javascript" >

    $(document).ready(function($) {        
        $('#addNewProduct').click(function() {            
            $('#addModiftProduct').trigger("reset");
            $('#id').attr('value','');
            $('#modelProduct').html("Add a product");
            $('#model-Product').modal('show');
            //console.log('id ajout',id);
        });
        $('body').on('click', '.edit', function() {
            var id = $(this).data('id');
            //console.log('id selection',id);
            // ajax
            $.ajax({
                type: "POST",
                url: "products_edit.php",
                data: {
                    id: id
                },
                dataType: "json",
                success: function(res) {
                    $('#modelProduct').html("Update a product");
                    $('#model-Product').modal('show');
                    $('#id').val(res[0].id);
                    $('#formName').val(res[0].name);
                    $('#formPrice').val(res[0].price);
                    $('#formStatus').val(res[0].status);
                    $('#formLocation').val(res[0].location);
                }
            });
        });
        $('body').on('click', '.delete', function() {
            if (confirm("Do you want to delete this product ?") == true) {
                var id = $(this).data('id');
                // ajax
                $.ajax({
                    type: "POST",
                    url: "products_delete.php",
                    data: {
                        id: id
                    },
                    dataType: "json",
                    success: function(res) {
                        //console.log(res[0].username);
                        $('#formName').html(res[0].name);
                        $('#formPrice').html(res[0].price);
                        $('#formStatus').html(res[0].status);
                        $('#formLocation').html(res[0].location);                       
                        window.location.reload();
                    }
                });
            }
        });
        $('#addModiftProduct').submit(function() {
            //console.log($(this).serialize());

                // ajax
                $.ajax({
                    type: "POST",
                    url: "products_insertupdate.php",
                    data: $(this).serialize(), // get all form field value in 
                    dataType: "json",
                    success: function(res) {
                        //console.log(res);                    
                        window.location.reload();
                    }
                });
                $('#model-Product').modal('hide');

        });
    }); 
</script>
<?php echo_footer(); ?>

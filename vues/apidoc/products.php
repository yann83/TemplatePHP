<?php 
session_start();

if (!isset($_SESSION['username'])) {
    $message = urlencode("Page requires login!");
    header('Location: ../login.php?message='.$message);
    die();
}

include "../../layout/layout_functions.php";
echo_header("Api documentation");

//include "../config/pdo-connection.php";

//https://gist.github.com/iros/3426278
?>
<div class="container">
    <div class="container py-2 d-flex justify-content-center">
        <div class="row d-flex justify-content-center align-items-center" style="width: 800px;">
            <h3 class="text-center">Profileapps</h3>
 <!-- ############# Section ############# -->        
            <div class="row p-3 mb-2 bg-primary text-white">
                Read all products
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="inputGroup-sizing-default">GET</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="products/read.php" readonly>
            </div>
            <div class="row ">
                <div class="col mb-2 bg-secondary text-white">Details</div>
                <div class="col mb-2 bg-secondary ">
	                <button type="button" class="btn btn-primary float-end" onclick="myFunction('1')">View</button><!-- number of this div id -->
	            </div>
                <div class="w-100"></div>
                <div class="col" style="display:none;" id="myDIV1"><!-- div id -->
                    <ul>
                        <li><u>URL Params</u></li>
                        Required : none
                    </ul>
                    <ul>
                        <li><u>Data Params</u></li>
                        none
                    </ul>
                    <ul>
                        <li><u>Success Response:</u></li>
                        <ul>
                            <li>Code: <b>200</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                {
                                    "id": "1",
                                    "name": "hammer",
                                    "price": "25.59",
                                    "status": "on sale",
                                    "location": "france"
                                }
                            </code></pre>
                        </ul>
                    </ul>
                    <ul>
                        <li><u>Error Response:</u></li>
                        <ul>
                            <li>Code: <b>404</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "No products found." }
                            </code></pre>
                        </ul>
                </div>                
            </div> 
<!-- ############# Fin Section ############# -->     
<!-- ############# Section ############# -->        
 <div class="row p-3 mb-2 bg-primary text-white">
                Read products in stock
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="inputGroup-sizing-default">GET</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="products/readstock.php" readonly>
            </div>
            <div class="row ">
                <div class="col mb-2 bg-secondary text-white">Details</div>
                <div class="col mb-2 bg-secondary ">
	                <button type="button" class="btn btn-primary float-end" onclick="myFunction('2')">View</button><!-- number of this div id -->
	            </div>
                <div class="w-100"></div>
                <div class="col" style="display:none;" id="myDIV2"><!-- div id -->
                    <ul>
                        <li><u>URL Params</u></li>
                        Required : none
                    </ul>
                    <ul>
                        <li><u>Data Params</u></li>
                        none
                    </ul>
                    <ul>
                        <li><u>Success Response:</u></li>
                        <ul>
                            <li>Code: <b>200</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                {
                                    "id": "1",
                                    "name": "hammer",
                                    "price": "25.59",
                                    "status": "on sale",
                                    "location": "france"
                                }
                            </code></pre>
                        </ul>
                    </ul>
                    <ul>
                        <li><u>Error Response:</u></li>
                        <ul>
                            <li>Code: <b>404</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "No products found." }
                            </code></pre>
                        </ul>
                </div>                
            </div> 
<!-- ############# Fin Section ############# -->   
<!-- ############# Section ############# -->        
 <div class="row p-3 mb-2 bg-primary text-white">
                Read one product
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="inputGroup-sizing-default">GET</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="products/read_one.php" readonly>
            </div>
            <div class="row ">
                <div class="col mb-2 bg-secondary text-white">Details</div>
                <div class="col mb-2 bg-secondary ">
	                <button type="button" class="btn btn-primary float-end" onclick="myFunction('3')">View</button><!-- number of this div id -->
	            </div>
                <div class="w-100"></div>
                <div class="col" style="display:none;" id="myDIV3"><!-- div id -->
                    <ul>
                        <li><u>URL Params</u></li>
                        Required : id=?
                    </ul>
                    <ul>
                        <li><u>Data Params</u></li>
                        none
                    </ul>
                    <ul>
                        <li><u>Success Response:</u></li>
                        <ul>
                            <li>Code: <b>200</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                {
                                    "id": "1",
                                    "name": "hammer",
                                    "price": "25.59",
                                    "status": "on sale",
                                    "location": "france"
                                }
                            </code></pre>
                        </ul>
                    </ul>
                    <ul>
                        <li><u>Error Response:</u></li>
                        <ul>
                            <li>Code: <b>404</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "No product found." }
                            </code></pre>
                        </ul>
                </div>                
            </div> 
<!-- ############# Fin Section ############# -->  
<!-- ############# Section ############# -->        
<div class="row p-3 mb-2 bg-primary text-white">
                Read all paging
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="inputGroup-sizing-default">GET</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="products/read_paging.php" readonly>
            </div>
            <div class="row ">
                <div class="col mb-2 bg-secondary text-white">Details</div>
                <div class="col mb-2 bg-secondary ">
	                <button type="button" class="btn btn-primary float-end" onclick="myFunction('4')">View</button><!-- number of this div id -->
	            </div>
                <div class="w-100"></div>
                <div class="col" style="display:none;" id="myDIV4"><!-- div id -->
                    <ul>
                        <li><u>URL Params</u></li>
                        Required : none
                    </ul>
                    <ul>
                        <li><u>Data Params</u></li>
                        none
                    </ul>
                    <ul>
                        <li><u>Success Response:</u></li>
                        <ul>
                            <li>Code: <b>200</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                {
                                    "id": "1",
                                    "name": "hammer",
                                    "price": "25.59",
                                    "status": "on sale",
                                    "location": "france"
                                }
                            </code></pre>
                        </ul>
                    </ul>
                    <ul>
                        <li><u>Error Response:</u></li>
                        <ul>
                            <li>Code: <b>404</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "No products found." }
                            </code></pre>
                        </ul>
                </div>                
            </div> 
<!-- ############# Fin Section ############# -->  
        </div>
    </div>
</div>
<script>
function myFunction(x) {
  var x = document.getElementById("myDIV"+x);
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>
<?php echo_footer(); ?>
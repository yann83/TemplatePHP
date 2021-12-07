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
<!-- ############# Section ############# -->        
<div class="row p-3 mb-2 bg-warning text-dark">
                Create a product
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-warning text-dark" id="inputGroup-sizing-default">POST</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="products/create.php" readonly>
            </div>
            <div class="row ">
                <div class="col mb-2 bg-secondary text-white">Details</div>
                <div class="col mb-2 bg-secondary ">
	                <button type="button" class="btn btn-warning float-end" onclick="myFunction('5')">View</button><!-- number of this div id -->
	            </div>
                <div class="w-100"></div>
                <div class="col" style="display:none;" id="myDIV5"><!-- div id -->
                    <ul>
                        <li><u>URL Params</u></li>
                        Required : none
                        <li><u>Header Params</u></li>
                        Required : bearer token JWT                       
                    </ul>
                    <ul>
                        <li><u>Data Params</u></li>
                            <pre><code class="text-danger">
                                    {
                                        "name" : "tournevis",
                                        "price" : "23.20",
                                        "status" : "on sale",
                                        "location" : "france"
                                     }
                            </code></pre>
                    </ul>
                    <ul>
                        <li><u>Success Response:</u></li>
                        <ul>
                            <li>Code: <b>201</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "product was created."}
                            </code></pre>
                        </ul>
                    </ul>
                    <ul>
                        <li><u>Error Response:</u></li>
                        <ul>
                            <li>Code: <b>401</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "Access denied." }
                            </code></pre>
                            OR                           
                            <li>Code: <b>503</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "Unable to create product." }
                            </code></pre>
                            OR
                            <li>Code: <b>400</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "Unable to create product. Data is incomplete." }
                            </code></pre>                           
                        </ul>
                </div>                
            </div> 
<!-- ############# Fin Section ############# -->
<!-- ############# Section ############# -->        
<div class="row p-3 mb-2 bg-warning text-dark">
                Update a product
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-warning text-dark" id="inputGroup-sizing-default">POST</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="products/update.php" readonly>
            </div>
            <div class="row ">
                <div class="col mb-2 bg-secondary text-white">Details</div>
                <div class="col mb-2 bg-secondary ">
	                <button type="button" class="btn btn-warning float-end" onclick="myFunction('6')">View</button><!-- number of this div id -->
	            </div>
                <div class="w-100"></div>
                <div class="col" style="display:none;" id="myDIV6"><!-- div id -->
                    <ul>
                        <li><u>URL Params</u></li>
                        Required : none
                        <li><u>Header Params</u></li>
                        Required : bearer token JWT                       
                    </ul>
                    <ul>
                        <li><u>Data Params</u></li>
                            <pre><code class="text-danger">
                                    {
                                        "id": "4",
                                        "name": "tournevis",
                                        "price": "15.30",
                                        "status": "on sale",  
                                        "location": "China"
                                    }
                            </code></pre>
                    </ul>
                    <ul>
                        <li><u>Success Response:</u></li>
                        <ul>
                            <li>Code: <b>200</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "Product was updated."}
                            </code></pre>
                        </ul>
                    </ul>
                    <ul>
                        <li><u>Error Response:</u></li>
                        <ul>
                            <li>Code: <b>401</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "Access denied." }
                            </code></pre>
                            OR                           
                            <li>Code: <b>503</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "Unable to update product." }
                            </code></pre>                           
                        </ul>
                </div>                
            </div> 
<!-- ############# Fin Section ############# -->
<!-- ############# Section ############# -->        
<div class="row p-3 mb-2 bg-danger text-white">
                Delete a product
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-danger text-white" id="inputGroup-sizing-default">POST</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="products/delete.php" readonly>
            </div>
            <div class="row ">
                <div class="col mb-2 bg-secondary text-white">Details</div>
                <div class="col mb-2 bg-secondary ">
	                <button type="button" class="btn btn-danger float-end" onclick="myFunction('7')">View</button><!-- number of this div id -->
	            </div>
                <div class="w-100"></div>
                <div class="col" style="display:none;" id="myDIV7"><!-- div id -->
                    <ul>
                        <li><u>URL Params</u></li>
                        Required : none
                        <li><u>Header Params</u></li>
                        Required : bearer token JWT                       
                    </ul>
                    <ul>
                        <li><u>Data Params</u></li>
                            <pre><code class="text-danger">
                                 {
                                    "id": "4"
                                }
                            </code></pre>
                    </ul>
                    <ul>
                        <li><u>Success Response:</u></li>
                        <ul>
                            <li>Code: <b>200</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "product was deleted."}
                            </code></pre>
                        </ul>
                    </ul>
                    <ul>
                        <li><u>Error Response:</u></li>
                        <ul>
                        <li>Code: <b>401</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "Access denied." }
                            </code></pre>
                            OR                           
                            <li>Code: <b>503</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "Unable to delete product." }
                            </code></pre>
                            OR
                            <li>Code: <b>400</b></li>
                            Content: 
                            <pre><code class="text-danger">
                                { "product not found." }
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
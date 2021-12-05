<?php 
session_start();

if (!isset($_SESSION['username'])) {
    $message = urlencode("Page requires login!");
    header('Location: login.php?message='.$message);
    die();
}

include "../layout/layout_functions.php";
echo_header("Api documentation");

//include "../config/pdo-connection.php";

//https://gist.github.com/iros/3426278
?>

<div class="container">
    <h1>Listes des terminaisons</h1>
    <div class="container py-2 d-flex justify-content-center">
        <div class="row d-flex justify-content-center align-items-center" style="width: 800px;">
            <h3>Profileapps</h3>
            <!-- Section -->        
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="inputGroup-sizing-default">GET</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="profilesapps/read.php" readonly>
            </div>
            <div class="card">
                <div class="card-header">
                    Détails
                </div>
                <div class="card-body">
                    <ul><li>URL Params</li></ul>
                    Obligatoire : <br>
                    Optionels : <br>
                    <ul><li>Reponse succès</li></ul>
                    Code 200           
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    Exemple
                </div>
                <div class="card-body">
                    <ul><li>URL</li></ul>
                    profilesapps/read.php <br>
                    <ul><li>Reponse succès</li></ul>
                    Code 200 <br>
                    <ul><li>Example de réponse</li></ul>  
                    <pre><code>
                        "records": [
                            {
                                "profiles_id": "1",
                                "apps_id": "13",
                                "name": "Orphee RP_C"
                            ]},
                    </code></pre>                   
                </div>
            </div> 
             <!-- Fin Section -->     
            <!-- Section -->        
            <div class="input-group mb-3 mt-3">
                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="inputGroup-sizing-default">GET</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="applirefs/read_one.php" readonly>
            </div>
            <div class="card">
                <div class="card-header">
                    Détails
                </div>
                <div class="card-body">
                    <ul><li>URL Params</li></ul>
                    Obligatoire : profiles_id<br>
                    Optionels : <br>
                    <ul><li>Reponse succès</li></ul>
                    Code 200           
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    Exemple
                </div>
                <div class="card-body">
                    <ul><li>URL</li></ul>
                    profilesapps/read_one.php?profiles_id=1 <br>
                    <ul><li>Reponse succès</li></ul>
                    Code 200 <br>
                    <ul><li>Example de réponse</li></ul>  
                    <pre><code>
                        {
                            "records": [
                                {
                                    "apps_id": "13",
                                    "name": "Orphee RP_C"
                                },
                                {
                                    "apps_id": "61",
                                    "name": "AC_IGCT"
                                }
                            ]
                        }
                    </code></pre>                   
                </div>
            </div> 
             <!-- Fin Section -->                              
        </div>
    </div>
</div>
<?php echo_footer(); ?>
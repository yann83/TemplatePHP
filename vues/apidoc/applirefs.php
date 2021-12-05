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
            <h3>Applirefs</h3>
            <!-- Section -->        
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="inputGroup-sizing-default">GET</span>
                </div>
                <input type="text" class="form-control" aria-label="Default" 
                    aria-describedby="inputGroup-sizing-default" value="applirefs/read.php" readonly>
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
                    applirefs/read.php <br>
                    <ul><li>Reponse succès</li></ul>
                    Code 200 <br>
                    <ul><li>Example de réponse</li></ul>  
                    <pre><code>
                        "records": [
                            {
                                "id": "67",
                                "name": "7ZipApp",
                                "date_mod": "2020-05-29 10:59:02",
                                "version": "18.01",
                                "regkey": "HKLM\\SOFTWARE\\APPLILOC\\",
                                "other": "APP_TIERCES\\7zip\\Setup_7ZipApp_18.01.exe",
                                "install": "1",
                                "other64": "",
                                "reboot": "0",
                                "optioninstall": "/VERYSILENT /NORESTART /LOG=c:\\pmf\\rappinst\\Logon_7zip1801.log",
                                "versionx64": "0",
                                "otherserial": "7ZipApp;CurrentVersion",
                                "serial": ""
                            }
                        ]}
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
                    aria-describedby="inputGroup-sizing-default" value="applirefs/read_install.php" readonly>
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
                    applirefs/read_install.php <br>
                    <ul><li>Reponse succès</li></ul>
                    Code 200 <br>
                    <ul><li>Example de réponse</li></ul>  
                    <pre><code>
                        "records": [
                            {
                                "id": "67",
                                "name": "7ZipApp",
                                "date_mod": "2020-05-29 10:59:02",
                                "version": "18.01",
                                "regkey": "HKLM\\SOFTWARE\\APPLILOC\\",
                                "other": "APP_TIERCES\\7zip\\Setup_7ZipApp_18.01.exe",
                                "install": "1",
                                "other64": "",
                                "reboot": "0",
                                "optioninstall": "/VERYSILENT /NORESTART /LOG=c:\\pmf\\rappinst\\Logon_7zip1801.log",
                                "versionx64": "0",
                                "otherserial": "7ZipApp;CurrentVersion",
                                "serial": ""
                            }
                        ]}
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
                    Obligatoire : id<br>
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
                    applirefs/read_one.php?id=204<br>
                    <ul><li>Reponse succès</li></ul>
                    Code 200 <br>
                    <ul><li>Example de réponse</li></ul>  
                    <pre><code>
                    "records": [
                            {
                                "name": "Adobe reader regression 2020 vers 2015",
                                "date_mod": "2020-12-30 15:26:05",
                                "version": "13.03.10",
                                "regkey": "HKLM\\SOFTWARE\\APPLINAT\\",
                                "other": "APP_LOCALES\\Dummy\\dummy.exe",
                                "install": "0",
                                "other64": "APP_TIERCES\\Abobe Acrobat DC\\W10\\setup_ADOBE_READER_2020To2015_130310.exe",
                                "reboot": "0",
                                "optioninstall": "/VERYSILENT /NORESTART /LOG=c:\\pmf\\rappinst\\Logon_AdobeReaderC6130310.log",
                                "versionx64": "1",
                                "otherserial": "AcrobatReader;CurrentVersion",
                                "serial": ""
                            }
                    </code></pre>                   
                </div>
            </div> 
             <!-- Fin Section -->                                 
        </div>
    </div>
</div>
<?php echo_footer(); ?>
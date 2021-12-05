<?php
session_start();

if (!isset($_SESSION['username'])) {
    $message = urlencode("Page requires login!");
    header('Location: login.php?message='.$message);
    die();
}

include "../layout/layout_functions.php";
echo_header("User");

//pour $loginApi
include "../layout/constantes.php";

include "../config/pdo-connection.php";
//echo $_SESSION['username']." avec id ".$_SESSION['userid'];

$jwt = '';

$sql = "SELECT ".$db.".users.id,
        ".$db.".users.username,
        ".$db.".users.email,
        ".$db.".users.password 
        FROM ".$db.".users 
        WHERE ".$db.".users.id = '".$_SESSION['userid']."' LIMIT 0,1";
$stmt= $pdo->prepare($sql);
if ($stmt->execute()) {
    $result = $stmt->fetchAll();
} else {
    $message = "Query unsuccesfull!";
}

if (isset($_POST['changeEmail']))
{

    $data = [
        ':idmail' => $_POST['idmail'],
        ':email' => $_POST['email']
    ];

    $sql = "UPDATE ".$db.".users SET ".$db.".users.email = :email WHERE ".$db.".users.id = :idmail";            
    $stmt= $pdo->prepare($sql);
    if ($stmt->execute($data)) {
        $messagemail = '<p class="text-success align-middle">Enregistrement réussie</p>';
        header("Refresh:2");        
    } else {
        $messagemail = '<p class="text-success align-middle">Echec de l\'enregistrement</p>';
    }

}

if (isset($_POST['changePassword']))
{
    if($_POST['passwordUn'] == $_POST['passwordDeux']){
        $data = [
            ':idpassword' => $_POST['idpassword']
        ];

        $sql = "UPDATE ".$db.".users SET ".$db.".users.password='" . password_hash($_POST['passwordUn'], PASSWORD_DEFAULT) . "' WHERE ".$db.".users.id=:idpassword";          
        $stmt= $pdo->prepare($sql);
        if ($stmt->execute($data)) {
            $messagepassword = '<p class="text-success align-middle">Enregistrement réussie</p>';
            header("Refresh:2; url=logout.php");
        } else {
            $messagepassword = '<p class="text-danger align-middle">Echec de l\'enregistrement</p>';
        }
    }
}

if (isset($_POST['getJwt']))
{

    if (isset($_POST['passwordTrois'])) {        

        $datas = array (
            'username' => $_SESSION['username'],
            'password' => $_POST['passwordTrois']
        );
    
        $payload = json_encode($datas);
    
        $curl = curl_init($loginApi);
    
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLINFO_HEADER_OUT, true);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_PROXY, '');//important en entreprise pour api local
        curl_setopt($curl, CURLOPT_POSTFIELDS, $payload);
         
        // Set HTTP Header for POST request 
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json')
        );  
    
        //print_r(curl_getinfo($curl));
        $response = curl_exec($curl);
        
        if(curl_errno($curl)){
            echo 'Curl error: ' . curl_error($curl);
        } else {
            $response = json_decode($response, true); //because of true, it's in an array

            if (isset($response['jwt'])) {
                $jwt = $response['jwt'];
            }
            if (isset($response['expireAt'])) {
                $messageDateExpJwt =  '<p class="text-success align-middle">Expire le '.date("Y-m-d H:i:s", $response['expireAt']).'</p>';                
            }        
        }    
        curl_close($curl);
    } 
    
}
?>
<?php foreach($result as $row) {
    $id = $row['id'];
    $email = $row['email']; 
    $password = $row['password'];
}
?>

<div class="container py-2 d-flex justify-content-center">
    <div class="row d-flex justify-content-center align-items-center" style="width: 500px;">

        <h3>Changer votre adresse mail</h3>
        <form method='post'>
        <input type="hidden" id="<?php echo $id;?>" name="idmail" value="<?php echo $id;?>">
        <div class="mb-3">
            <label for="email" class="form-label">Votre adresse mail</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email;?>">
        </div>
        <input type="submit" name="changeEmail" class="btn btn-primary" value="Changer">
        <?php if (isset($messagemail)): echo $messagemail; endif; ?>
        </form> 
        <hr class="bg-danger border-2 border-top border-danger mt-3">

        <h3>Changer votre mot de passe</h3>               
        <form method='post'>
        <input type="hidden" id="<?php echo $id;?>" name="idpassword" value="<?php echo $id;?>">
        <div class="mb-3">
            <label for="passwordUn" class="form-label">Nouveau mot de passe</label>
            <input type="password" name="passwordUn" class="form-control" id="passwordUn">
        </div>
        <div class="mb-3">
            <label for="passwordDeux" class="form-label">Verification du mot de passe</label>
            <input type="password" name="passwordDeux" class="form-control" id="passwordDeux">
        </div>
        <p id='CheckPasswords'></p>
        <input type="submit" name="changePassword" class="btn btn-primary" value="Changer">
        <?php if (isset($messagepassword)): echo $messagepassword; endif; ?>
        </form>
        <hr class="bg-danger border-2 border-top border-danger mt-3">

        <h3>Obtenir un jeton</h3>
        <form method='post'>
        <input type="hidden" id="<?php echo $id;?>" name="idjwt" value="<?php echo $id;?>">
        <div class="mb-3">
            <label for="passwordTrois" class="form-label">Mot de passe</label>
            <input type="password" name="passwordTrois" class="form-control" id="passwordTrois">
        </div>
        <div class="mb-3">
            <label for="jwt" class="form-label">Jeton JWT</label>
            <div class="input-group">
                <input type="text" name="jwt" class="form-control" id="jwt" value="<?php echo $jwt ?>" placeholder="Ce jeton sert pour l'api">
                <div class="input-group-append">
                    <button class="btn btn-info" onclick="toClipboard('jwt')">copier</button>
                </div>
            </div>
            <?php if (isset($messageDateExpJwt)): echo $messageDateExpJwt; endif; ?>
        </div>
        <input type="submit" name="getJwt" class="btn btn-primary" value="Obtenir un jeton">
        </form>

    </div>
</div>
<script>
    $('#passwordUn, #passwordDeux').on('keyup', function () {
    if ($('#passwordUn').val() == $('#passwordDeux').val()) {
        $('#CheckPasswords').html('Les deux mots de passe correspondent').css('color', 'green');
    } else 
        $('#CheckPasswords').html('Les mots de passe sont differents').css('color', 'red');
    });

    function toClipboard($input) {
        /* Get the text field */
        var copyText = document.getElementById($input);

        /* Select the text field */
        copyText.select();
        copyText.setSelectionRange(0, 99999); /* For mobile devices */

        /* Copy the text inside the text field */
        navigator.clipboard.writeText(copyText.value);
    } 
</script>
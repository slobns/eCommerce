<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerc/core/init.php';
include 'includes/head.php';

$email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
$email = trim($email);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$errors = array();
?>

<style>
    body {
        background-image: url(../images/img4.jpg);
        background-size: 100vw 100vh;
        background-attachment: fixed;
    }
</style>
<div id="login-form">
    <div>
       <?php
       if($_POST){
            //form validation
        if(empty($_POST['email']) || empty($_POST['password'])){
              $errors[] = 'Unesite mail i lozinku.';
          }
            // validate email
          if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
              $errors[] = 'Unesite ispravan email.';
          }
            // password is more than 6 characters
          if(strlen($password)<6){
              $errors[] = 'Lozinka mora imati najmanje 6 znakova';
          }
            // check if email existes in database
            $query = $db->query("SELECT * FROM users WHERE email = '$email'");
            $user = mysqli_fetch_assoc($query);
            $userCount = mysqli_num_rows($query);
            if($userCount < 1){
                $errors[] = 'Takav mail ne postoji.Probajte ponovo ili se registrujte.';
            }
            //verifikacija passworda
          if(!password_verify($password, $user['password'])){
              $errors[] = 'Lozinka ne odgovara. Pokusajte ponovo.';
          }  
            //checks for error
              if(!empty($errors)){
                  echo display_errors($errors);
              }else{
                  //log user in
                $user_id = $user['id'];
                login($user_id);
              }
       }
        ?>
    </div>
    <h2 class="text-center">Login</h2><hr>
    <form action="login.php" method="post">
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>">
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
        </div>
        <div class="form-group">
            <input type="submit" value="Login" class="btn btn-primary">
        </div>
    </form>
    <p class="text-right"><a href="/ecommerc/index.php" alt="home">Poseti Sajt</a></p>
</div>

<?php include 'includes/footer.php'?>
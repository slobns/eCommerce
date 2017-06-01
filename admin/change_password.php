
<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerc/core/init.php';
if(!is_logged_in()){
    login_error_redirect();
}
include 'includes/head.php';

$hashed = $user_data['password'];
$old_password = ((isset($_POST['old_password']))?sanitize($_POST['old_password']):'');
$old_password = trim($old_password);
$password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
$password = trim($password);
$confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
$confirm = trim($confirm);
$new_hashed = password_hash($password, PASSWORD_DEFAULT);
$user_id = $user_data['id'];
$errors = array();
?>


<div id="login-form">
    <div>
       <?php
       if($_POST){
            //form validation
            if(empty($_POST['old_password']) || empty($_POST['password']) || empty($_POST['confirm'])){
                $errors[] = 'Morate popuniti sva polja';
              }
          
            // password is more than 6 characters
            if(strlen($password)<6){
                $errors[] = 'Lozinka mora imati najmanje 6 znakova';
            }
           
            //check if new password matches confirm
            if($password != $confirm){
                $errors[] = 'Lozinke se ne podudaraju. Unesite ponovo.';
            }
            
            if(!password_verify($old_password, $hashed)){
              $errors[] = 'Vasa stara lozinka se ne poklapa sa podatcima';
          }  
            //checks for error
             if(!empty($errors)){
                echo display_errors($errors);
              }else{
            //change the password
             $db->query("UPDATE users SET password= '$new_hashed' WHERE id= '$user_id'");     
             $_SESSION['success_flash'] = 'Vasa lozinka je uspesno promenjena';
             header('Location: index.php');
       }
       }
        ?>
    </div>
    <h2 class="text-center">Promena Lozinke</h2><hr>
    <form action="change_password.php" method="post">
        <div class="form-group">
            <label for="old_password">Stara Lozinka:</label>
            <input type="password" name="old_password" id="old_password" class="form-control" value="<?=$old_password;?>">
        </div>
        <div class="form-group">
            <label for="password">Nova Lozinka:</label>
            <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>">
        </div>
        <div class="form-group">
            <label for="confirm">Potvrdi novu lozinku:</label>
            <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>">
        </div>
        <div class="form-group">
            <a href="index.php" class="btn btn-default">Odustani</a>
            <input type="submit" value="Login" class="btn btn-primary">
        </div>
    </form>
    <p class="text-right"><a href="/ecommerc/index.php" alt="home">Poseti Sajt</a></p>
</div>

<?php include 'includes/footer.php'?>

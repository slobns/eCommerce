<?php

require_once '../core/init.php';

if(!is_logged_in()){
    login_error_redirect();
}
if(!has_permession('admin')){
    permession_error_redirect('index.php');
}
include 'includes/head.php';
include 'includes/navigation.php';

if(isset($_GET['delete'])){
  $delete_id = sanitize($_GET['delete']);
  $db->query("DELETE FROM users WHERE id='$delete_id'");   
  $_SESSION['success_flash'] = 'Korisnik je izbrisan';
  header('Location: users.php');
  
}

// dodaj novog korisnika
if(isset($_GET['add'])){
    $name = ((isset($_POST['name']))?sanitize($_POST['name']):'');
    $email = ((isset($_POST['email']))?sanitize($_POST['email']):'');
    $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
    $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
    $permessions = ((isset($_POST['permessions']))?sanitize($_POST['permessions']):'');
    $errors = array();
    //validate the form
    if($_POST){
        $emailQuery = $db->query("SELECT * FROM users WHERE email= '$email'");
        $emailCount = mysqli_num_rows($emailQuery);
        // check if email allready exist in database
        if($emailCount != 0){
            $errors[] = 'Taj email vec postoji. Unesite drugi.';
        }
        $required = array('name', 'email', 'password', 'confirm', 'permessions');
        foreach($required as $f){
            if(empty($_POST[$f])){
                $errors[] = 'Morate popuniti sva navedena polja';
                break;
            }
        }
       //check if pass more then 6 char
       if(strlen($password)<6){
          $errors[] = 'Lozinka treba da je veca od 6 znakova'; 
       }
       //if pass confirm matches
       if($password != $confirm){
           $errors[] = 'lozinka ne odgovara.Probajte opet.';
       }
       //validate email
       if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
           $errors[] = 'Email ne odgovara. Probajte ponovo.';
       }
       if(!empty($errors)){
           echo display_errors($errors);
       }else{
           //add users to database
           $hashed = password_hash($password,PASSWORD_DEFAULT);
           $sql = "INSERT INTO users (full_name,email,password,permessions) "
                   . "VALUES ('$name','$email','$hashed','$permessions')";
           $db->query($sql);
           $_SESSION['success_flash'] = 'Korisik je uspesno unesen.';
           header('Location: users.php');
          
       }
    }
    ?>
     <h2 class="text-center">Dodaj Novog Korisnika</h2><hr>
     <form action="users.php?add=1" method="post">
         <div class="form-group  col-md-6">
             <label for="name">Ime i Prezime</label>
             <input type="text" id="name" name="name" class="form-control" value="<?=$name;?>">
         </div>
         <div class="form-group  col-md-6">
             <label for="email">Email</label>
             <input type="email" id="email" name="email" class="form-control" value="<?=$email;?>">
         </div>
         <div class="form-group  col-md-6">
             <label for="password">Lozinka</label>
             <input type="password" id="password" name="password" class="form-control" value="<?=$password;?>">
         </div>
         <div class="form-group  col-md-6">
             <label for="confirm">Potvrdi lozinku</label>
             <input type="password" id="confirm" name="confirm" class="form-control" value="<?=$confirm;?>">
         </div>
         <div class="form-group  col-md-6">
             <label for="name">Dozvola</label>
             <select class="form-control" name="permessions">
                 <option value=""<?=(($permessions == '')?' selected':'');?><</option>
                 <option value="editor"<?=(($permessions == 'editor')?' selected':'');?>>Urednik</option>
                 <option value="admin,editor"<?=(($permessions == 'admin,editor')?' selected':'');?>>Admin</option>
             </select>
         </div>
         <div class="form-group  col-md-6 text-right" style="margin-top: 25px;">
             <a href="users.php" class="btn btn-default">Otkazi</a>
             <input type="submit" class="btn btn-primary" value="Dodaj korisnika">
         </div>
     </form>
    <?php
}else{
$userQuery = $db->query("SELECT * FROM users ORDER BY full_name");
?>

<h2>Korisnici</h2>

<a href="users.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Dodaj novog korisnika</a>

<hr>
<table class="table table-bordered table-striped table-condensed">
    <thead><th></th><th>Ime</th><th>Email</th><th>Datum pristupa</th><th>Zadnja poseta</th><th>Dozvola</th></thead>
<tbody>
    <?php while($user = mysqli_fetch_assoc($userQuery)):?>
    <tr>
        <td>
            <?php if($user['id'] != $user_data['id']):?>
            <a href="users.php?delete=<?=$user['id']?>" 
               class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove-sign"></span></a>
            <?php endif; ?>
        </td>
        <td><?=$user['full_name']?></td>
        <td><?=$user['email']?></td>
        <td><?=pretty_date($user['join_date']);?></td>
        <td><?=(($user['last_login'] == '0000-00-00 00:00:00')?'Never':pretty_date($user['last_login']));?></td>
        <td><?=$user['permessions']?></td>
    </tr>
    <?php endwhile;?>
</tbody>    
</table>
<?php } include 'includes/footer.php';?>
<?php require_once '../core/init.php';
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
    $db->query("DELETE FROM users WHERE id = '$delete_id'");
    $_SESSION['success_flash'] = 'Utilizatorul a fost sters'; 
    header('Location: users1.php'); 
    
    } 
    if(isset($_GET['add'])){
        
        $name = ((isset($_POST['name']))?sanitize($_POST['name']):''); 
        $email = ((isset($_POST['email']))?sanitize($_POST['email']):''); 
        $password = ((isset($_POST['password']))?sanitize($_POST['password']):'');
        $confirm = ((isset($_POST['confirm']))?sanitize($_POST['confirm']):'');
        $permessions = ((isset($_POST['permessions']))?sanitize($_POST['permessions']):'');
        $errors = array(); 
        if($_POST){
            $emailQuery = $db->query("SELECT * FROM users WHERE email = '$email'"); 
            $emailCount = mysqli_num_rows($emailQuery);
            if($emailCount != 0){ 
                $errors[] = 'Acest email deja exista in baza de date!';
                }
                $required = array('name', 'email', 'password', 'confirm', 'permessions');
                foreach($required as $f){
                    if(empty($_POST[$f])){
                        $errors[] = 'Trebuie sa completezi toate campurile!'; 
                        break; 
                        
                    } 
                    
                    } 
                    if(strlen($password) <6){ 
                        $errors[] = 'Parola trebuie sa aiba cel putin 6 caractere!';
                        } 
                        if($password != $confirm){
                            $errors[] = 'Parolele nu se potrivesc!'; 
                            
                        } 
                        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){ 
                            $errors[] = 'Trebuie sa introduci un email valid!'; 
                            
                        } 
                        if(!empty($errors)){
                            echo display_errors($errors);
                            }else{
                                //add user to db
                                $hashed = password_hash($password,PASSWORD_DEFAULT); 
                                $db->query("INSERT INTO users (full_name,email,password,permessions) "
                                        . "VALUES ('$name', '$email', '$hashed', '$permessions') ");
                                $_SESSION['success_flash'] = 'Utilizatorul a fost adaugat!';
                                header('Location: users1.php'); 
                                
                            } 
                            
                            }
                            ?> 
<h2 class="text-center">Adauga un utilizator nou</h2><hr>
<form action="users1.php?add=1" method="post">
    <div class="form-group col-md-6"> 
        <label for="name">Nume si prenume:</label> 
        <input type="text" name="name" id="name" class="form-control" value="<?=$name;?>"> 
    </div> 
    <div class="form-group col-md-6"> 
        <label for="email">Email:</label> 
        <input type="email" name="email" id="email" class="form-control" value="<?=$email;?>"> 
    </div> 
    <div class="form-group col-md-6"> 
        <label for="password">Parola:</label> 
        <input type="password" name="password" id="password" class="form-control" value="<?=$password;?>"> 
    </div>
    <div class="form-group col-md-6"> 
        <label for="confirm">Confirma parola:</label> 
        <input type="password" name="confirm" id="confirm" class="form-control" value="<?=$confirm;?>"> 
    </div> 
    <div class="form-group col-md-6"> 
        <label for="name">Permisiuni:</label> 
        <select class="form-control" name="permessions"> 
            <option value=""<?=(($permessions == '')?' selected':'');?>></option> 
            <option value="editor"<?=(($permessions == 'editor')?' selected':'');?>>Editor</option> 
            <option value="admin,editor"<?=(($permessions == 'admin,editor')?' selected':'');?>>Admin</option> 
        </select> 
    </div> 
    <div class="form-group col-md-6 text-right" style="margin-top:25px;"> 
        <a href="users1.php" class="btn btn-default">Anuleaza</a> 
        <input type="submit" value="Adauga utilizator" class="btn btn-primary"> 
    </div> 
</form> 
    <?php 
    
 
    } else{ 
        $userQuery = $db->query("SELECT * FROM users ORDER BY full_name"); ?>
<h2>Utilizatori</h2>
<a href="users1.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Adauga utiliaztor nou</a> 
<hr> 
<table class="table table-bordered table-striped table-condensed"> 
    <thead>
    <th></th><th>Nume</th><th>Email</th><th>Data alaturarii</th><th>Ultima logare</th><th>Permisiuni</th></thead> 
<tbody> 
    <?php while($user = mysqli_fetch_assoc($userQuery)): ?> 
    <tr> 
        <td> 
            <?php if($user['id'] != $user_data['id']): ?> 
            <a href="users1.php?delete=<?=$user['id'];?>" 
               class="btn btn-default btn-xs"><span class="glyphicon glyphicon-remove-sign"></span></a> 
                <?php endif; ?> 
        </td> 
        <td><?=$user['full_name'];?></td> 
        <td><?=$user['email'];?></td> 
        <td><?=pretty_date($user['join_date']);?></td> 
        <td><?=(($user['last_login'] == '0000-00-00 00:00:00')?'Never':pretty_date($user['last_login']));?></td> 
        <td><?=$user['permessions'];?></td> 
    </tr> 
        <?php endwhile; ?> 
</tbody> 
</table> 
    
    <?php } include 'includes/footer.php'; ?>﻿
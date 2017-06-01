<?php
function display_errors($errors){
    $display='<ul class="bg-danger">';
    foreach($errors as $error){
        $display .='<li class="text-danger">'.$error.'</li>';
    }
    $display .='</ul>';
    return $display;
}
function sanitize($text) {
    return htmlentities($text, ENT_QUOTES, "UTF-8");
}

function money($num){
    return 'Din '. number_format($num,2);
}

function login($user_id){
    $_SESSION['SBUser'] = $user_id;
    //update the last login
    global $db;
    $date = date('Y-m-d H:i:s');
    $db->query("UPDATE users SET last_login= '$date' WHERE id= '$user_id'");
    $_SESSION['success_flash'] = 'Ulogovali ste se.';
    header('Location: index.php');
}

function is_logged_in(){
    if(isset($_SESSION['SBUser']) && $_SESSION['SBUser'] > 0){
        return true;
    }
    return false;
}
function login_error_redirect($url = 'login.php'){
    $_SESSION['error_flash'] = "Morate se ulogovati";
    header('Location: '.$url);
}
function permession_error_redirect($url = 'login.php'){
    $_SESSION['error_flash'] = "Nemate dozvolu da udjete na trazenu stranicu";
    header('Location: '.$url);
}
function has_permession($permession = 'admin'){
    global $user_data;
    $permessions = explode(',',$user_data['permessions']);
    if(in_array($permession,$permessions,true)){
        return true;
    }
    return false;
}

//format date
function pretty_date($date){
    return date("M d, Y h:i A",strtotime($date));
}
function get_category($child_id){
    global $db;
    $id = sanitize($child_id);
    $sql = "SELECT p.id AS 'pid', p.category AS 'parent', c.id AS 'cid', "
            . "c.category AS 'child' "
            . "FROM categories c "
            . "INNER JOIN categories p ON c.parent = p.id "
            . "WHERE c.id = '$id' ";
    $query = $db->query($sql);
    $category = mysqli_fetch_assoc($query);
    return $category;
}
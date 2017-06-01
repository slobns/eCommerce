<?php

require_once '../core/init.php';
if(!is_logged_in()){
    login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';

//get brands from database
$sql = "SELECT * FROM brand ORDER BY brand";
$results = $db->query($sql);
$errors = array();
//delete brand 
if(isset($_GET['delete'])&&!empty($_GET['delete'])){
    $delete_id = (int)$_GET['delete'];
    $delete_id = sanitize($delete_id);
    //echo $delete_id;
    $sql = "DELETE FROM brand WHERE id = '$delete_id'";
    $db->query($sql);
    header("Location : brands.php");
}
//edit brand
if(isset($_GET['edit'])&&!empty($_GET['edit'])){
    $edit_id = (int)$_GET['edit'];
    $edit_id = sanitize($edit_id);
    $sql2 = "SELECT * FROM brand WHERE id= '$edit_id'";
    $edit_result = $db->query($sql2);
    $eBrand = mysqli_fetch_assoc($edit_result);
    
}
// if add form is submitted
if(isset($_POST['add_submit'])){
    $brand = sanitize($_POST['brand']);
    // check if brand was blank
    if($_POST['brand'] == ''){
       $errors[] = 'Unesite proizvod'; 
    }
    //check if brand exist in database
    $sql = "SELECT * FROM brand WHERE brand = '$brand'";
    if(isset($_GET['edit'])){
        $sql = "SELECT * FROM brand WHERE brand = '$brand' AND !='$edit_id'";
    }
    $result = $db->query($sql);
    $count = mysqli_num_rows($result);
    if($count>0){
        $errors[] = $brand." se vec nalazi u bazi";
    }
   
    
    //display errors
    if(!empty($errors)){
        echo display_errors($errors);
    }else{
        // add brand to database
        $sql = "INSERT INTO brand(brand) VALUES('$brand')";
        if(isset($_GET['edit'])){
            $sql = "UPDATE brand SET brand = '$brand' WHERE id= '$edit_id'";
        }
        $db -> query($sql);
        header("Location: brands.php");
    }
}
?>
<h2 class="text-center">Brands</h2><hr>
<div class="text-center">
    <form class="form-inline" action="brands.php<?=((isset($_GET['edit']))?'?edit='.$edit_id:'');?>" method="post">
        <div class="form-group">
            <?php
            $brand_value = '';
            if(isset($_GET['edit'])){
                $brand_value = $eBrand['brand'];
            }else{
                if(isset($_POST['brand'])){
                    $brand_value = sanitize($_POST['brand']);
                }
            }
            ?>
            <label for="brand"><?=((isset($_GET['edit']))?'Izmeni':'Dodaj');?> proizvod: </label>
            <input type="text" name="brand" id="brand"
                   class="form-control" value="<?=$brand_value; ?>">
            <?php if(isset($_GET['edit'])): ?>
            <a href="brands.php" class="btn btn-default">Zatvori</a>
            <?php endif; ?>
            <input type="submit" name="add_submit" class="btn btn-success" value="<?=((isset($_GET['edit']))?'Izmeni':'Dodaj');?> proizvod" >
        </div>
    </form>
</div><hr>
<table class="table table-bordered table-striped table-auto table-condensed">
    <thead>
    <th></th><th class="text-center">Brand</th><th></th>
    </thead>
    <tbody>
        <?php while($brand = mysqli_fetch_assoc($results)):?>
        <tr>
            <td><a href="brands.php?edit=<?=$brand['id']; ?>" class="bt btn-sm btn-default"><span class="glyphicon glyphicon-pencil"></span></a></td>
            <td><?=$brand['brand'];?></td>
            <td><a href="brands.php?delete=<?=$brand['id']; ?>" class="bt btn-sm btn-default"><span class="glyphicon glyphicon-remove-sign"></span></a></td>
        </tr>
     </tbody>
     <?php endwhile;?>
</table>
<?php include 'includes/footer.php';?>
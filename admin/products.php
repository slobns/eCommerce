<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerc/core/init.php';
if(!is_logged_in()){
    login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';

//Delete products
if(isset($_GET['delete'])){
    $id = sanitize($_GET['delete']);
    $db->query("UPDATE product SET deleted = 1, featured = 0 WHERE id='$id'");
    header('Location: products.php');
}
$dbPath = '';
if(isset($_GET['add']) || isset($_GET['edit'])){
 $brandQuery = $db->query("SELECT * FROM brand ORDER BY brand"); 
 $parentQuery = $db->query("SELECT * FROM categories WHERE parent=0 ORDER BY category");
 $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):'');
 $brand = ((isset($_POST['brand']) && !empty($_POST['brand']))?sanitize($_POST['brand']):'');
 $parent = ((isset($_POST['parent']) && !empty($_POST['parent']))?sanitize($_POST['parent']):'');
 $category = ((isset($_POST['child']) && !empty($_POST['child']))?sanitize($_POST['child']):'');
 $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):'');
 $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):'');
 $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):'');
 $sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):'');
 $sizes = rtrim($sizes, '.');
 $saved_image = '';
 if(isset($_GET['edit'])){
     $edit_id = (int)$_GET['edit'];
     $productResult = $db->query("SELECT * FROM product WHERE id ='$edit_id'");
     $product = mysqli_fetch_assoc($productResult);
     if(isset($_GET['delete_image'])){
         $image_url = $_SERVER['DOCUMENT_ROOT'].$product['image'];echo $image_url;
         unlink($image_url);
         $db->query("UPDATE product SET image = '' WHERE id='$edit_id'");
         header('Location: products.php?edit='.$edit_id);
     }
     $category = ((isset($_POST['child']) && $_POST['child'] != '')?sanitize($_POST['child']):$product['categories']);
     $title = ((isset($_POST['title']) && $_POST['title'] != '')?sanitize($_POST['title']):$product['title']);
     $brand = ((isset($_POST['brand']) && $_POST['brand'] != '')?sanitize($_POST['brand']):$product['brand']);
     $parentSql = $db->query("SELECT * FROM categories WHERE id = '$category'");
     $parentResult = mysqli_fetch_assoc($parentSql);
     $parent = ((isset($_POST['parent']) && $_POST['parent'] != '')?sanitize($_POST['parent']):$parentResult['parent']);
     $price = ((isset($_POST['price']) && $_POST['price'] != '')?sanitize($_POST['price']):$product['price']);
     $list_price = ((isset($_POST['list_price']) && $_POST['list_price'] != '')?sanitize($_POST['list_price']):$product['list_price']);
     $description = ((isset($_POST['description']) && $_POST['description'] != '')?sanitize($_POST['description']):$product['description']);
     $sizes = ((isset($_POST['sizes']) && $_POST['sizes'] != '')?sanitize($_POST['sizes']):$product['sizes']);
     $sizes = rtrim($sizes, '.');
     $saved_image = (($product['image'] != '')?$product['image']:'');
     $dbPath = $saved_image;
 }
    if(!empty($sizes)){
         $sizeString = sanitize($sizes);
         $sizeString = rtrim($sizeString,',');
         $sizesArray = explode(',', $sizeString);
         $sArray = array();//create array for stand upload data in modal
         $qArray = array();
         foreach($sizesArray as $ss){
             $s = explode(':', $ss);
             $sArray[]=$s[0];
             $qArray[]=$s[1];
         }
     }else{$sizesArray = array();}
     
    if($_POST){//for data in Kolicina i Velicina
        $errors = array();
        //fill all required fields in form
        $required = array('title','brand','parent','child','sizes');
        foreach ($required as $field){
            if($_POST[$field]==''){
                $errors[] = 'Sva oznacena polja trebaju biti popunjena';
                break;
            }
        }
     if(!empty($_FILES)){
        
         $photo = $_FILES['photo'];
         $name = $photo['name'];
         $nameArray = explode('.',$name);
         $fileArray = $nameArray[0];
         $fileExt = $nameArray[1];
         $mime = explode('/',$photo['type']);
         $mimeType = $mime[0];
         $mimeExt = $mime[1];
         $tmpLoc = $photo['tmp_name'];
         $allowed = array('png','jpg','jpeg','gif','JPG' );
         $uploadName = md5(microtime()). '.' .$fileExt;
         $uploadPath = BASEURL. '/images/proizvod/'.$uploadName;
         $dbPath = '/ecommerc/images/proizvod/'.$uploadName;
         $fileSize = $photo['size'];
         
         if($mimeType != 'image'){
             $errors[] = 'Unesite odgovarajuci fajl.';
         }
         if(!in_array($fileExt, $allowed)){
             $errors[] = 'Slika treba da bude u odredjenom formatu, jpg, png, jpeg ili gif.';
         }
         if($fileSize>15000000){
             $errors[] = 'Slika treba da je manja od 15Mb';
         }
         if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg')){
             $errors[] = 'File ext does not match the file!';
         }
     }
     if(!empty($errors)){
         echo display_errors($errors);
     }else{
         //upload file and insert into database
         if(!empty($_FILES)){
         move_uploaded_file($tmpLoc, $uploadPath);
         }
         $insertSql = "INSERT INTO product (`title`, `brand`,`list_price`, `price`,"
                 . " `categories`, `sizes`,`description`,`image`) VALUES ('$title',"
                 . "'$brand','$list_price','$price', '$category', '$sizes', "
                 . "'$description', '$dbPath')";
         if(isset($_GET['edit'])){
             $insertSql = "UPDATE product SET title ='$title',price ='$price', brand ='$brand', "
                     . "list_price ='$list_price', categories = '$category', sizes = '$sizes',"
                     . "image ='$dbPath', description = '$description' WHERE id = '$edit_id'";
         }
         $db->query($insertSql);
         header('Location: products.php');
     }
 }
?>
<h2 class="text-center"><?=((isset($_GET['edit']))?'Izmeni':'Dodaj novi')?> proizvod</h2>
<form action="products.php?<?=((isset($_GET['edit']))?'edit='.$edit_id:'add=1');?>" method="POST" enctype="multipart/form-data">
    <div class="form-group col-md-3">
        <label for="title">Title*:</label>
        <input type="text" name="title" id="title" class="form-control" value="<?=$title;?>">
    </div>
    <div class="form-group col-md-3">
        <label for="brand">Brand*:</label>
        <select class="form-control" id="brand" name="brand">
            <option value="<?=(($brand == '')?' selected':'');?>"></option>
            <?php while($brand_b = mysqli_fetch_assoc($brandQuery)):?>
            <option value="<?=$brand_b['id'];?>"<?=(($brand == $brand_b['id'])?' selected':'')  ?>><?=$brand_b['brand'];?></option>
            <?php endwhile;?>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="parent">Parent Category*:</label>
        <select class="form-control" id="parent" name="parent">
            <option value="<?=(($parent == '')? ' selected':'') ;?>"></option>
            <?php while($parent_p = mysqli_fetch_assoc($parentQuery)):?>
            <option value="<?=$parent_p['id'];?>"<?=(($parent == $parent_p['id'])?' selected':'');?>><?=$parent_p['category'];?></option>
            <?php endwhile;?>
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="child">Child Category*:</label>
        <select id="child" name="child" class="form-control">
        </select>
    </div>
    <div class="form-group col-md-3">
        <label for="price">Cena*:</label>
        <input type="text" id="price" name="price" class="form-control" value="<?=$price;?>">
    </div>
    <div class="form-group col-md-3">
        <label for="price">Stara Cena:</label>
        <input type="text" id="list_price" name="list_price" class="form-control" value="<?=$list_price;?>">
    </div>
    <div class="form-group col-md-3">
        <label>Kolicina i Velicina*:</label>
        <button class="btn btn-default form-control" onclick="jQuery('#sizesModal').modal('toggle');return false;">Kolicina i Velicina</button>
    </div>
    <div class="form-group col-md-3">
        <label for="sizes">Pregled Vel. i Kol.:</label>
        <input type="text" id="sizes" name="sizes" class="form-control" value="<?=$sizes;?>" readonly="">
    </div>
    <div class="form-group col-md-6">
        <?php if($saved_image !=''):?>
        <div class="saved-image">
            <img src="<?=$saved_image?>" alt="saved image"/><br>
            <a href="products.php?delete_image=1&edit=<?=$edit_id;?>" class="text-danger">Obrisi sliku</a>
        </div>
        <?php else:?>
        <label for="photo">Slika Proizvoda:</label>
        <input type="file" name="photo" id="photo" class="form-control">
        <?php endif;?>
    </div>
    <div class="form-group col-md-6">
        <label for="decsription">Opis:</label>
        <textarea id="description" name="description" class="form-control" rows="6"><?=$description;?></textarea>
    </div>
    <div class="form-group pull-right">
        <a href="products.php" class="btn btn-default">Odustani</a>
        <input type="submit" value="<?=((isset($_GET['edit']))?'Izmeni':'Dodaj')?> Proizvod" class="btn btn-success">
    </div><div class="clearfix"></div>     
</form>
<!-- Modal -->
<div class="modal fade" id="sizesModal" tabindex="-1" role="dialog" aria-labelledby="sizesModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="sizesModalLabel">Velicina & Kolicina</h4>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
              <?php for($i=1;$i<=12;$i++):?>
              <div class="form-group col-md-4">
                  <label for="size<?=$i;?>">Velicina</label>
                  <input type="text" name="size<?=$i;?>" id="size<?=$i;?>" 
                         value="<?=((!empty($sArray[$i-1]))?$sArray[$i-1]:'');?>" class="form-control">
              </div>
              <div class="form-group col-md-2">
                  <label for="qty<?=$i;?>">Kolicina</label>
                  <input type="number" name="qty<?=$i;?>" id="qty<?=$i;?>" 
                         value="<?=((!empty($qArray[$i-1]))?$qArray[$i-1]:'');?>" min="0" class="form-control">
              </div>
               <?php endfor;?>
          </div>
             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Zatvori</button>
        <button type="button" class="btn btn-primary" onclick="updateSizes();jQuery('#sizesModal').modal('toggle');return false;">Sacuvaj izmene</button>
      </div>
    </div>
  </div>
</div>
<?php }else{
        $sql = "SELECT * FROM product WHERE deleted = 0";
        $presult = $db->query($sql);
    if(isset($_GET['featured'])){
        $id = (int)$_GET['id'];
        $featured = (int)$_GET['featured'];
        $featuredSql = "UPDATE product SET featured = '$featured' WHERE id = '$id'";
        $db->query($featuredSql);
        header('Location: products.php');
}
?>
<h2 class="text-center">Product</h2>
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-btn">Dodaj proizvod</a><div class="clearfix"></div>
<hr>

<table class="table table-bordered table-condensed table-striped">
    <thead>
      <th></th><th>Product</th><th>Price</th><th>Category</th><th>Featured</th><th>Sold</th>
    </thead>
    <tbody>
        <?php while($prod = mysqli_fetch_assoc($presult)): 
            $childID = $prod['categories'];
            $catSql = "SELECT * FROM categories WHERE id ='$childID'";
            $result = $db->query($catSql);
            $child = mysqli_fetch_assoc($result);
            $parentID = $child['parent'];
            $parentSql = "SELECT * FROM categories WHERE id = '$parentID'";
            $parResult = $db->query($parentSql);
            $parent = mysqli_fetch_assoc($parResult);
            $categoryAll = $parent['category'].'-'.$child['category'];
            
            ?>
        <tr>
            <td>
                <a href="products.php?edit=<?=$prod['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                <a href="products.php?delete=<?=$prod['id'];?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
            </td>
            <td><?=$prod['title']?></td>
            <td><?=money($prod['price']);?></td>
            <td><?=$categoryAll;?></td>
            <td><a href="products.php?featured=<?=(($prod['featured']== 0)?'1':'0');?>&id=<?=$prod['id'];?>" class="btn btn-xs btn-default">
                <span class="glyphicon glyphicon-<?=(($prod['featured']== 1)?'minus':'plus');?>"></span>
                </a>&nbsp; <?=(($prod['featured'] == 1)?'Postavljeno na sajtu':'') ;?></td>
            <td>0</td>
        </tr>
        <?php endwhile;?>
    </tbody>
</table>

<?php }include 'includes/footer.php';?>
<script>
    jQuery('document').ready(function(){
        get_child_options('<?=$category;?>');
    });
    </script>
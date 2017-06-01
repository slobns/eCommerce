<?php 
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/partheader.php';
    include 'includes/leftbar.php';
    
    if(isset($_GET['cat'])){
        $cat_id = $_GET['cat'];
    }else{
        $cat_id = '';
    }
    
    $sql = "SELECT * FROM product WHERE categories ='$cat_id'";
    $productQ = $db->query($sql);
    $category = get_category($cat_id);
    
     
?>       
        
          
             <!--main side-->
             <div class="col-md-8">
                 <div class="row">
                     <h2 class="text-center"><?=$category['parent'].' '.$category['child']; ?></h2>
                     <?php while($product = mysqli_fetch_assoc($productQ)) : ?>
                    
                     <div class="col-sm-3 text-center">
                         <h4><?php echo $product['title']?></h4>
                         <img src="<?php echo $product['image'];?>"  alt="<?php echo $product['title'];?>" class="img-thumb"/>
                         <p class="list-price text-danger">Stara Cena: <s><?php echo $product['list_price'];?> Din</s></p>
                         <p class="price">Nova Cena: <?php echo $product['price'];?> Din</p>
                         <button type="button" class="btn btn-sm btn-success" name="submit"
                            onclick="detailsmodal(<?php echo $product['id']; ?>)">Detaljnije</button>
                     </div>
                     <?php endwhile; ?>
                </div>
             </div>
          
<?php 


    include 'includes/rightbar.php';
    include 'includes/footer.php';
?>
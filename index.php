<?php 
    require_once 'core/init.php';
    include 'includes/head.php';
    include 'includes/navigation.php';
    include 'includes/headerfull.php';
    include 'includes/leftbar.php';
    
    $sql = "SELECT * FROM product WHERE featured = 1";
    $featured = $db->query($sql);
    
    
     
?>       
        
          
             <!--main side-->
             <div class="col-md-8">
                 <div class="row">
                     <h2 class="text-center">Nasa Ponuda</h2>
                     <?php while($product = mysqli_fetch_assoc($featured)) : ?>
                    
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
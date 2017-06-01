<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/ecommerc/core/init.php';
if(!is_logged_in()){
    login_error_redirect();
}
include 'includes/head.php';
include 'includes/navigation.php';

 $sql = "SELECT * FROM product WHERE deleted = 1";
 $featured = $db->query($sql);
    
?>


    
             <!--main side-->
             <div class="container">
                 <div class="row">
                     <h2 class="text-center">Arhiva</h2>
                     <?php while($product = mysqli_fetch_assoc($featured)) : ?>
                    
                     <div class="col-sm-6 text-center">
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
             
             
<?php include 'includes/footer.php';?>
             
     <script>
function detailsmodal(id) {
        var data = {"id" : id};
        //console.log(data);
        jQuery.ajax ({
            url:'/ecommerc/includes/detailsmodal.php',
            method: "post",
            data: data,
            success: function(data){
                jQuery('body').append(data);
                jQuery('#details-modal').modal('toggle');
            },
            error: function() {
                alert('Something went wrong!!!');            }
        });
     };
     </script>
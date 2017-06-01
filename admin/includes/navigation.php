  
<nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <a href="/ecommerc/admin/index.php" class="navbar-brand">Brands Admin</a>
                <ul class="nav navbar-nav">
                    <li><a href="brands.php">Brand</a></li>  
                    <li><a href="categories.php">Categories</a></li>
                    <li><a href="products.php">Products</a></li>
                    <li><a href="arhiva.php">Arhiva</a></li>
                       <?php if(has_permession('admin')):?>
                    <li><a href="users.php">Korisnici</a></li>
                       <?php endif;?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Hello <?=$user_data['first'];?>!
                            <span class="caret"></span>
                        </a> 
                        <ul class="dropdown-menu" role="menu">
                            <li><a href="change_password.php">Promeni lozinku</a></li>
                            <li><a href="logout.php">Odjavi se</a></li>
                        </ul>
                    </li>
                 <!--   <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <span class="caret"></span></a> 
                            <ul class="dropdown-menu" role="menu">
                                
                                <li><a href="#"><?php echo $child['category'];?></a></li>
                               
                    </li> -->
                  
                </ul>
              
            </div>
        </nav>
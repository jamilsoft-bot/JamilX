
<div class="px-4 py-5 my-5 text-center ">
                        <h1 class="display-5 fw-bold"><?php echo $blog->getName();?></h1>
                        <div class="col-lg-6 mx-auto">
                            <p class="lead mb-4 text-muted">
                                <?php echo  $blog->getSummary();?>
                                <a class="w3-button w3-block w3-blue" >Learn More</a>
                            </p>
                            
                        </div>
                        <?php //include "blog-navlist.php";?>
                      
                        <div class="w3-bar d-inline-flex  justify-content-center ">
                           
                                <div class="">
                                <a href="?action=home" class="w3-bar-item">Home</a>
                                <a href="?action=posts" class="w3-bar-item">News</a>
                                <a href="?action=products" class="w3-bar-item">Shop</a>
                                <a href="?action=commingsoon" class="w3-bar-item">Gallary</a>
                                <a href="?action=commingsoon" class="w3-bar-item">Videos</a>
                                <a href="?action=about" class="w3-bar-item">About us</a>
                                <a href="?action=contact" class="w3-bar-item w3-center">Contact us</a>
                                
                               
                        </div>

                                

                            </div>
                        <?php 
                        global $Url;
                        $action = $Url->get('action');

                        if(is_null($action)){

                            include "blog-slide.php";

                        }elseif($action == "home"){
                            include "blog-slide.php";
                        }
                        
                        
                        
                        
                        ?>
                    </div> 
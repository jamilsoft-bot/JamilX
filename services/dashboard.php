<?php



class Dashboard extends JX_Serivce implements JX_service
{
    public function __construct()
    {
        global $Url;
        $b = $Url->get('b');
        if (isset($_SESSION['uid'])) {
        } else {
            echo "<script>";
            echo "location.assign('login&resume=dashboard')";
            echo "</script>";
        }
        $this->setTitle('Dashboard');
    }
    public function main()
    {
        global $Url; 

        $action = is_null($Url->get('action')) ? 'home' : $Url->get('action');
        include('containers/dashboard/dashboard.php');
        // JX_get_container
    }

    public function about()
    {
        include('containers/dashboard/about.php');
    }

    public function home()
    {
        include('containers/dashboard/home.php');
    }
    public function messages()
    {
        include('containers/messages/message-list.php');
    }

    public function updatesetting()
    {
        global $JX_db, $Me, $Url;
        $this->setTitle("Setting");
        $code = $Url->get('b');


        if (isset($_POST['submit'])) {
            $lg = $_FILES['logo'];
            $f = $lg['name'];
            $data = json_encode($_POST);
            $sql = business_update_with_logo($f, 'data', $data, $code);

            if (UploadpostImage($lg)) {
                if ($JX_db->query($sql)) {

                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Business Alert!</strong> the Business was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                } else {
                    echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                    echo "<strong>Business Alert!</strong> " . $JX_db->error . "<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Business Alert!</strong> Image Was Not Upload<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        echo "<form action='' enctype='multipart/form-data' method='post'>";
        include('containers/dashboard/update-bus.php');
        echo "</form>";
    }

    public function setting()
    {
        $this->setTitle("Setting");
        include('containers/dashboard/update-bus.php');
    }

    public function seo()
    {
        $this->setTitle("seo service");
        echo "SEO";
    }
    public function emails()
    {
        $this->setTitle("Email service");
        $this->emaildel();
        include('containers/email/email-list.php');
    }

    public function emailupdate()
    {
        global $db, $Url;
        $this->setTitle("Email list");
        if ($Url->post('update') !== null) {

            $subject = $Url->post('subject');
            $content = $Url->post('content');
            $cc = $Url->post('cc');
            $owner  = $Url->get('b');
            $eid  = $Url->get('eid');


            $sql = "UPDATE `mails` SET `owner`='$owner',`subject`='$subject',`cc`='$cc',`content`= '$content',`updated`= CURRENT_TIMESTAMP WHERE `id` = $eid";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the Email was successfully updated.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        include('containers/email/email-update.php');
    }

    public function emaildel()
    {
        global $db, $Url;
        $this->setTitle("Email List");

        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this Email?.<br>";
            echo "<br><a href='dashboard?b=$code&action=emails&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `mails` WHERE `id`=$id";

            if ($db->Query($sql)) {

                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the email was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }

    public function emailadd()
    {
        global $db;
        if (isset($_POST['add'])) {
            $powner = $_GET['b'];
            $subject = $_POST['subject'];
            $content = $_POST['content'];
            $cc_bcc = $_POST['cc'];

            $sql = "INSERT INTO `mails`(`subject`, `cc`, `content`, `owner`) VALUES ('$subject','$cc_bcc','$content','$powner')";

            if ($db->Query($sql)) {
                echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Created!</strong> Email was created Sucessfully.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        } else {
        }




        $this->setTitle("Create Email");
        include('containers/email/email-add.php');
    }

    public function pages()
    {
        $this->setTitle("blogs list");
        $this->pagedel();
        include('containers/blog/blog-list.php');
    }

    public function pageupdate()
    {
        global $db, $Url;
        $this->setTitle("blogs list");
        if ($Url->post('update') !== null) {
            $lg = $_FILES['bloglogo'];
            $name = $Url->post('blogname');
            $des = $Url->post('blogDes');
            $cat = $Url->post('cat');
            $keywords = $Url->post('keyword');
            $owner  = $Url->post('owner');
            $url = $Url->post('blogurl');
            $bid = $Url->get('bid');
            $logo = $_FILES['bloglogo']['name'];

            if (UploadpostImage($lg)) {
                $sql = "UPDATE `blogs` SET `name`='$name',`url`='$url',`logo`='$logo',`category`='$cat',`description`= '$des',`keywords`='$keywords',`date_update`= CURRENT_TIMESTAMP WHERE `id` = $bid";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Alert!</strong> the blog was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            }
        }
        include('containers/blog/blog-update.php');
    }

    public function pagedel()
    {
        global $db, $Url;
        $this->setTitle("Blog List");
        //include('containers/posts/post-list.php');
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this blog?.<br>";
            echo "<br><a href='dashboard?b=$code&action=pages&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `blogs` WHERE `id`=$id";

            if ($db->Query($sql)) {

                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the blog was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }

    public function pageadd()
    {
        global $db;
        $this->setTitle("Blog list");
        $url = "";
        $name = "";
        $author = "";
        $dec = "";
        $keywords = "";
        $owner = "";
        $logo = "";
        $cat = "";

        if (isset($_POST['badd'])) {
            $url = $_POST['blogurl'];
            $name = $_POST['blogname'];
            $author = $_POST['author'];
            $owner = $_POST['owner'];
            $dec = $_POST['blogDes'];
            $keywords = $_POST['keywords'];
            $logo = $_FILES['bloglogo'];
            $cat = $_POST['cat'];


            if (UploadpostImage($logo)) {
                $lg = $logo['name'];
                $sql = "INSERT INTO `blogs`(`name`,`owner`,`description`,`author`,`keywords`,`logo`,`url`,`category`)VALUES('$name','$owner','$dec','$author','$keywords','$lg','$url','$cat')";

                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Created!</strong> blog was created Sucessfully.";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            }
        }

        include('containers/blog/blog-add.php');
    }




    public function ads()
    {
        $this->setTitle("Ads List");
        include('containers/dashboard/pad.php');
    }

    public function catadd()
    {
        global $db;
        if (isset($_POST) && $_FILES) {

            //echo $_FILES['image']['name'];
            $powner = $_GET['b'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $blog = $_POST['parent'];
            $pimage = $_FILES['image']['name'];
            $pimageu = $_FILES['image'];
            $author = intval($_SESSION['uid']);
            $parent = $_POST['parent'];

            $sql = "INSERT INTO `categories`(`name`, `description`, `parent`, `image`, `owner`,`author`) VALUES ('$title','$content','$parent','$pimage','$powner',$author)";
            if (UploadpostImage($pimageu)) {
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Content Created!</strong> Category was created Sucessfully.";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Content Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }


        $this->setTitle("Create Category");
        include('containers/cat/cat-add.php');
    }

    public function catupdate()
    {
        $this->setTitle("Category update");
        global $db, $Url, $Me;

        if ($Url->post('update') !== null) {
            $lg = $_FILES['image'];
            $title = $Url->post('title');
            $body = $Url->post('content');
            $keywords = $Url->post('keyword');
            $owner  = $Url->get('b');
            $blog = $Url->post('parent');
            $pid = $Url->get('cid');
            $logo = $_FILES['image']['name'];
            $author = $Me->username();

            if (UploadpostImage($lg)) {
                $sql = "UPDATE `categories` SET `name`='$title',`description`='$body',`image`='$logo',`owner`='$owner',`parent`='$blog',`keywords`='$keywords',`author`='$author',`updated`=CURRENT_TIMESTAMP WHERE `id` = '$pid'";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Content Alert!</strong> the Category was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Content Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        include('containers/cat/cat-update.php');
    }

    public function cats()
    {
        $this->setTitle("Categoery List");
        $this->catdel();
        include('containers/cat/cat-list.php');
    }

    public function catdel()
    {
        global $db, $Url;
        // $this->setTitle("Post List");
        //include('containers/posts/post-list.php');
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Content Alert!</strong><br> Are you Sure, You want to delete this Category?.<br>";
            echo "<br><a href='dashboard?b=$code&action=cat&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `categories` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Content Alert!</strong> the Category has successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }

    public function postview()
    {
        $this->setTitle("Post List");
        include('containers/posts/post-view.php');
    }

    public function postupdate()
    {
        $this->setTitle("Post post update");
        global $db, $Url, $Me;

        if ($Url->post('update') !== null) {
            $lg = $_FILES['image'];
            $title = $Url->post('title');
            $body = $Url->post('content');
            $keywords = $Url->post('keyword');
            $owner  = $Url->get('b');
            $blog = $Url->post('parent');
            $pid = $Url->get('pid');
            $cat = $Url->post('cat');
            $logo = $_FILES['image']['name'];
            $author = $Me->username();

            if (UploadpostImage($lg)) {
                $sql = "UPDATE `posts` SET `title`='$title',`cat`='$cat',`content`='$body',`image`='$logo',`owner`='$owner',`blog`='$blog',`keywords`='$keywords',`author`='$author',`date_updated`=CURRENT_TIMESTAMP WHERE `id` = '$pid'";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Alert!</strong> the Post was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        include('containers/posts/post-update.php');
    }
    public function postlist()
    {
        $this->setTitle("Post List");
        $this->postdel();
        include('containers/posts/post-list.php');
    }

    public function postdel()
    {
        global $db, $Url;
        $this->setTitle("Post List");
        //include('containers/posts/post-list.php');
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this post?.<br>";
            echo "<br><a href='dashboard?b=$code&action=posts&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `posts` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the post has successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }
    public function postadd()
    {
        global $db, $Me;
        if (isset($_POST) && $_FILES) {

            //echo $_FILES['image']['name'];
            $powner = $_GET['b'];
            $title = $_POST['title'];
            $content = $_POST['content'];
            $blog = $_POST['parent'];
            $pimage = $_FILES['image']['name'];
            $cat = $_POST['cat'];
            $pimageu = $_FILES['image'];
            $author = $Me->username();

            // $sql = "INSERT INTO `campaigns`(`title` `content`, `type`, `image`, `owner`) VALUES ('$title','$content','post','$pimage','$powner')";
            $sql = "INSERT INTO `posts`(`blog`, `title`, `content`, `type`, `image`, `owner`,`author`,`cat`) VALUES ('$blog','$title','$content','post','$pimage','$powner','$author','$cat')";
            if (UploadpostImage($pimageu)) {
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Created!</strong> Post created Sucessfully.";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }


        $this->setTitle("Create Posts");
        include('containers/posts/post-add.php');
    }

    public function posts()
    {
        $this->setTitle("Posts management tool");
        $this->postdel();
        include('containers/posts/post-list.php');
    }

    public function productupdate()
    {
        global $db, $Url, $Me;
        $this->setTitle("Product update");
        if ($Url->post('update') !== null) {
            $name = $Url->post('name');
            $author = $Me->username();
            $content = $Url->post('content');
            $price = $Url->post('rprice');
            $sale = $Url->post('sprice');
            $type = $Url->post('type');
            $owner = $Url->get('b');
            $pid = $Url->get('pid');
            $blog = $Url->post('parent');
            $image = $_FILES['image'];
            $pic = $image['name'];

            if (UploadpostImage($image)) {
                $sql = "UPDATE `products` SET `name`='$name',`content`='$content',`pic`='$pic',`owner`='$owner',`blog`='$blog',`type`='$type',`price`='$price',`sale`='$sale',`author`='$author',`date_update`=CURRENT_TIMESTAMP WHERE `id` = '$pid'";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Alert!</strong> the Product was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include('containers/product/product-update.php');
    }
    public function products()
    {
        $this->setTitle("Products List");
        $this->productdel();
        include('containers/product/product-list.php');
    }
    public function productdel()
    {
        global $db, $Url;
        $this->setTitle("Product list");
        //include('containers/posts/post-list.php');
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this post?.<br>";
            echo "<br><a href='dashboard?b=$code&action=products&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `products` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the Product was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }

    public function productadd()
    {
        global $db, $Url, $Me;
        $this->setTitle("Create Product");


        if (isset($_POST['padd'])) {

            $name = $Url->post('name');
            $author = $Me->username();
            $content = $Url->post('content');
            $price = $Url->post('rprice');
            $sale = $Url->post('sprice');
            $type = $Url->post('type');
            $owner = $Url->get('b');
            $blog = $Url->post('parent');
            $image = $_FILES['image'];
            $pic = $image['name'];




            if (UploadpostImage($image)) {
                $sql = "INSERT INTO `products`( `name`, `content`, `pic`, `price`, `sale`,`type` , `owner`, `blog`, `author`) VALUES ('$name','$content','$pic','$price','$sale','$type','$owner','$blog','$author')";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Created!</strong> Product was created Sucessfully.";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        include('containers/product/product-add.php');
    }
    public function Blist()
    {
        $this->setTitle("Business List");
        include('containers/dashboard/pad.php');
    }

    public function offers()
    {
        $this->setTitle("Business Offers");
        $this->offerdel();
        include('containers/offer/offer-list.php');
    }

    public function offeradd()
    {

        global $db, $Url, $Me;
        $this->setTitle("Create Offer");


        if (isset($_POST['oadd'])) {

            $name = $Url->post('name');
            $author = $Me->username();
            $content = $Url->post('content');

            $type = $Url->post('type');
            $btnText = $type;
            $link = $Url->post('link');
            $owner = $Url->get('b');
            $blog = $Url->post('parent');
            $image = $_FILES['image'];
            $pic = $image['name'];




            if (UploadpostImage($image)) {
                $sql = "INSERT INTO `offers`(`link`, `name`,`btnText`, `content`, `image`,  `owner`, `blog`, `author`,`type`) VALUES ('$link','$name','$btnText','$content','$pic','$owner','$blog','$author','$type')";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-flat-wet-asphalt alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Created!</strong> Offer was created Sucessfully.";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        include('containers/offer/offer-add.php');
    }

    public function offerupdate()
    {
        $this->setTitle("Business Offers");
        global $db, $Url, $Me;

        if ($Url->post('update') !== null) {
            $name = $Url->post('name');
            $author = $Me->username();
            $content = $Url->post('content');

            $type = $Url->post('type');
            $btnText = $type;
            $link = $Url->post('link');
            $owner = $Url->get('b');
            $oid = $Url->get('oid');
            $blog = $Url->post('parent');
            $image = $_FILES['image'];
            $pic = $image['name'];

            if (UploadpostImage($image)) {
                $sql = "UPDATE `offers` SET `name`='$name',`content`='$content',`image`='$pic',`owner`='$owner',`blog`='$blog',`type`='$type',`btnText`='$btnText',`link`='$link',`author`='$author',`date_update`=CURRENT_TIMESTAMP WHERE `id` = '$oid'";
                if ($db->Query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Campaign Alert!</strong> the Product was successfully updated.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Error!</strong> Something went wrong, please check<br>your fields to correct the errors.";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }

        include('containers/offer/offer-update.php');
    }

    public function offerdel()
    {
        global $db, $Url;
        $this->setTitle("Offer list");
        //include('containers/posts/post-list.php');
        if ($Url->get('del') !== null) {
            $id = $Url->get('del');
            $code = $Url->get('b');
            echo "<div class='alert w3-border w3-border-red w3-leftbar alert-dismissible fade show' role='alert'>";
            echo "<strong>Campaign Alert!</strong><br> Are you Sure, You want to delete this Offer?.<br>";
            echo "<br><a href='dashboard?b=$code&action=offers&yesdel=$id' class='btn btn-danger '>Comfrim Delete</a>";
            echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
            echo "</div>";
        }

        if ($Url->get('yesdel') !== null) {
            $id = $Url->get('yesdel');

            $sql = "DELETE FROM `offers` WHERE `id`=$id";
            if ($db->Query($sql)) {
                echo "<div class='alert w3-red alert-dismissible fade show' role='alert'>";
                echo "<strong>Campaign Alert!</strong> the offer was successfully deleted.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
    }
    public function medialist()
    {
        include "containers/media/image-list.php";
    }
    public function addmedia()
    {
        global $JX_db;
        $filename = null;
        $filesize = null;
        $summary = null;
        $fileowner = intval($_SESSION['uid']);
        if (isset($_POST['upload'])) {
            $summary = $_POST['text'];
            $file = $_FILES['nfile'];
            $filename = $file['name'];
            $filesize = $file['size'];
            $filetype = $file['type'];
            if (UploadpostImage($file)) {
                $sql = "INSERT INTO `media`(`name`,`type`,`summary`,`size`,`owner`)VALUES('$filename','$filetype','$summary','$filesize','$fileowner')";
                if ($JX_db->query($sql)) {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Media Alert!</strong> the Image was successfully Uploaded.<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                } else {
                    echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                    echo "<strong>Media Alert!</strong> " . $JX_db->error . ".<br>";
                    echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                    echo "</div>";
                }
            } else {
                echo "<div class='alert w3-green alert-dismissible fade show' role='alert'>";
                echo "<strong>Media Alert!</strong> the Image was not Uploaded.<br>";
                echo "<button type='button' class='btn-close w3-white' data-bs-dismiss='alert' aria-label='Close'></button>";
                echo "</div>";
            }
        }
        echo "<form action='' method='post' enctype='multipart/form-data'>";
        include "containers/media/fileuploader.php";
        echo "</form>";
    }
}

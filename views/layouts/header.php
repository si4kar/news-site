
<!DOCTYPE html>
<html lang="en">
<head>
    <title>T-shirt</title>
    <!-- add bootstrap css file -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/webroot/css/style.css">
    <link rel="stylesheet" type="text/css" href="/webroot/css/styleNav.css">
    <link href="/webroot/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

</head>
<div id="wrap">
    <div id="header">
        <nav class="navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="collapse navbar-collapse navbar-brand" id="navbarSupportedContent">
                <ul class="navbar-nav mr-4">
                    <li class="nav-item">
                        <a href="/cart/index/"><i class="fa fa-shopping-cart"></i> Claim
                            <?php if (Cart::countItems() != false) { ?>
                                (<span id="cart-count"><?php echo Cart::countItems();?></span>)
                            <?php } ?>
                        </a>
                    </li>

                    <?php if(Session::get('login') != null) { ?>
                        <li><a href="/cabinet/index/" id="showLogin"> <i class="fa fa-user"></i><?php Session::showLogin()?> </a></li>
                        <li><a href="/user/exit/"><i class="fa fa-unlock"></i> Выход</a></li>
                    <?php } else { ?>
                        <li><a href="/user/login/"> <i class="fa fa-lock"></i> LogIn</a></li>
                    <?php } ?>

                </ul>
            </div>
        </nav>

        <div class="container" id="secondNav">
            <ul class="navbar cf">
                <li><a href="/">HOME</a></li>
                <li><a href="/category/">COLLECTIONS</a>
                    <ul class="ulColor">
                        <?php foreach (Category::createTreeForNav() as $category):?>
                        <li><a href="/category/<?=$category['id']?>"><?=$category['name']?></a>
                            <ul>
                                <li><a href="/category/<?=$category['id']?>/1">BOYS</a></li>
                                <li><a href="/category/<?=$category['id']?>/2">GIRLS</a></li>
                            </ul>
                        </li>
                        <?php endforeach; ?>
                   </ul>
                </li>
                <li><a href="#">OUTLET</a></li>
                <li><a href="#">STORE</a></li>
            </ul>
        </div>
    </div>

    <div id="main" class = "clearfix">
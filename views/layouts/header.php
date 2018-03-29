
<!DOCTYPE html>
<html lang="en">
<head>
    <title>News-site</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="/webroot/css/style.css">
    <link rel="stylesheet" type="text/css" href="/webroot/css/styleNav.css">
    <link rel="stylesheet" type="text/css" href="/webroot/css/carusel.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

</head>
<div id="wrap">
    <div id="header">
        <nav class="navbar-expand-md navbar-dark bg-dark fixed-top">
            <div class="collapse navbar-collapse navbar-brand" id="navbarSupportedContent">
                <ul class="navbar-nav mr-4">
                    <li class="nav-item">
                        <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">

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
                <li><a href="/category/">Category</a>
                    <ul class="ulColor">
                        <li>
                            <a href="">Analitic</a>
                        </li>
                        <li><a href="">List</a>
                                <ul>
                                    <?php $categories = Category::getCategoriesList() ?>
                                    <?php foreach ($categories as $categoryNav): ?>
                                    <li><a href="/category/<?=$categoryNav['id']?>"><?=$categoryNav['name']?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                        </li>
                   </ul>

                </li>
            </ul>
        </div>
    </div>

    <div id="main" class = "clearfix">
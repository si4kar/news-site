<?php include ROOT.'/views/layouts/header.php'; ?>

<div class="container text-center" style="width: 400px">

    <?php if (Session::hasFlash()) { ?>
        <div class="alert alert-info" role="alert">
            <?php Session::flash(); ?>
        </div>
    <?php } ?>

    <?php if (Session::hasFlashError()) { ?>
        <div class="alert alert-danger" role="alert">
            <?php Session::flashError(); ?>
        </div>
    <?php } ?>


    <form class="form-signin" method="post">

        <h1 class="h3 mb-3 font-weight-normal" id="checkLogin">Registration a new user</h1>

        <label for="name" class="sr-only">Name</label>
        <input type="text" id="name" name = "name" class="form-control" placeholder="Name" required autofocus>

        <label for="email" class="sr-only">Email</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="Email" required autofocus>

        <label for="password" class="sr-only">Password</label>
        <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>

        <label for="password2" class="sr-only">Duplicate password </label>
        <input type="password" id="password2" name="password2" class="form-control" placeholder="Duplicate password" required>

        <!-- <div class="checkbox mb-3">
             <label>
                 <input type="checkbox" value="remember-me"> Remember me
             </label>
         </div>
-->
        <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Register">

    </form>
</div>


<?php include ROOT . '/views/layouts/footer.php'; ?>


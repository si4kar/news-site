<?php include ROOT.'/views/layouts/header.php'; ?>

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

        <div class="container text-center" style="width: 400px">
                <form class="form-signin" method="post">

                    <h1 class="h3 mb-3 font-weight-normal" id="checkLogin">Please sign in</h1>
                    <label for="email" class="sr-only">Email</label>
                    <input type="text" name="email" id="email" class="form-control" placeholder="Email" required autofocus>

                    <label for="password" class="sr-only">Password</label>
                    <input type="password" name = "password" id="password" class="form-control" placeholder="Password" required>

                   <!-- <div class="checkbox mb-3">
                        <label>
                            <input type="checkbox" value="remember-me"> Remember me
                        </label>
                    </div>
    -->
                    <input type="submit" class="btn btn-lg btn-primary btn-block" name="submit" value="Sign in">

                </form>
            <a href="/user/register">I don't have an account yet</a>
        </div>


<?php include ROOT . '/views/layouts/footer.php'; ?>
<?php include ROOT . '/views/layouts/header.php'; ?>

    <section>
        <div class="container">
            <div class="row">

                <div class="col-sm-4 col-sm-offset-4 padding-right">

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
                        <div class="signup-form"><!--sign up form-->
                            <h2>Обратная связь</h2>
                            <h5>Есть вопрос? Напишите нам</h5>
                            <br/>
                            <form action="#" method="post">
                                <p>Ваша почта</p>
                                <input type="email" name="userEmail" placeholder="E-mail" value="<?php echo $userEmail; ?>"/>
                                <p>Сообщение</p>
                                <input type="text" name="userText" placeholder="Сообщение" value="<?php echo $userText; ?>"/>
                                <br/>
                                <input type="submit" name="submit" class="btn btn-default" value="Отправить" />
                            </form>
                        </div><!--/sign up form-->


                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </section>

    <?php include ROOT.'/views/layouts/footer.php'; ?>
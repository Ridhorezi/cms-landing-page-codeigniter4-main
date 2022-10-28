<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Administrator</title>
    <link rel="stylesheet" href=" <?= base_url('admin') ?>/css/main/app.css">
    <link rel="stylesheet" href="<?= base_url('admin') ?>/css/pages/auth.css">
    <link rel="shortcut icon" href="<?= base_url(
        'admin'
    ) ?>/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url(
        'admin'
    ) ?>/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="#"><img src="<?= base_url(
                            'admin'
                        ) ?>/images/logo/logo.svg" alt="Logo"></a>
                    </div>
                    <?php
                    $session = \Config\Services::session();
                    if ($session->getFlashData('warning')) { ?>
                    <div class="alert alert-warning alert-dismissible show fade">
                        <ul>
                            <?php foreach (
                                $session->getFlashData('warning')
                                as $value
                            ) { ?>
                            <li>
                                <?= $value ?>
                            </li>
                            <?php } ?>
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php }
                    ?>
                    <form action="<?= site_url(
                        'admin/auth-login'
                    ) ?>" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" id="inputUsername" name="username"
                                placeholder="Username" value="<?php if (
                                    $session->getFlashData('username')
                                ) {
                                    echo $session->getFlashData('username');
                                } ?>" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" id="inputPassword"
                                name="password" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" value="1" name="remember_me"
                                id="inputRememberPassword">
                            <label class="form-check-label text-gray-600" for="inputRememberPassword">
                                Remember Me
                            </label>
                        </div>
                        <button type="submit" name="submit" value="login"
                            class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Log in</button>
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                        <p><a class="font-bold" href="<?= site_url(
                            'admin/auth-forgot'
                        ) ?>">Forgot password ?</a></p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img class="image-style-login" src="<?= base_url(
                        'admin'
                    ) ?>/images/bg/image-login-background.jpg" alt="Logo">
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('admin'); ?>/js/bootstrap.js"></script>
    <script src="<?php echo base_url('admin'); ?>/js/app.js"></script>
</body>
</html>
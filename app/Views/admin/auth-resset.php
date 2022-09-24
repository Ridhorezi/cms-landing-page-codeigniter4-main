<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resset-Password | Administrator</title>
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
                            <div class="alert alert-warning">
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
                            </div>
                        <?php }
                        if ($session->getFlashData('success')) { ?>
                             <div class="alert alert-success">
                              <?php echo $session->getFlashData('success'); ?>
                            </div>
                            <?php }
                        ?>
                    <form action="" method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" id="inputPassword" name="password" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-2">
                            <input type="password" class="form-control form-control-xl" id="inputConfirmPassword" name="confirm_password" placeholder="Confirm Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                        </div>
                        <button type="submit" name="submit" value="login" class="btn btn-primary btn-block btn-lg shadow-lg mt-4">Send</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img class="image-style-resset" src="<?= base_url(
                        'admin'
                    ) ?>/images/bg/image-resset-password-admin.png" alt="Logo">
                </div>
            </div>
        </div>
    </div>
</body>
</html>

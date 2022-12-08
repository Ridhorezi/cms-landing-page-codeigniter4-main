<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= $templateJudul ?></title>
    <link rel="stylesheet" href=" <?php echo base_url(
        'admin'
    ); ?>/css/main/app.css">
    <link rel="stylesheet" href=" <?php echo base_url(
        'admin'
    ); ?>/css/main/app-dark.css">
    <link rel="shortcut icon" href="<?= base_url(
        'admin'
    ) ?>/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="<?= base_url(
        'admin'
    ) ?>/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href=" <?= base_url(
        'admin'
    ) ?>/css/shared/iconly.css">
    <link rel="stylesheet" href="<?= base_url(
        'admin'
    ) ?>/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="<?= base_url(
        'admin'
    ) ?>/css/pages/simple-datatables.css">
    <link rel="stylesheet" href="<?= base_url(
        'admin'
    ) ?>/css/pages/summernote.css">
    <link rel="stylesheet" href="<?= base_url(
        'admin'
    ) ?>/extensions/summernote/summernote-lite.css">
    <link rel="stylesheet" href="<?= base_url(
        'admin'
    ) ?>/extensions/toastify-js/src/toastify.css">
        <style>
    .size-text {
        font-size: 21.3px;
    }

    @media only screen and (max-width: 600px) {
        .size-text {
            font-size: 15px;
        }
    }
    </style>
</head>

<body>

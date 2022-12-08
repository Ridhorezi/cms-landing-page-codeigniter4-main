<!-- Layout Header  -->

<div id="app">

    <!-- Layout Sidebar -->

    <div id="main">

        <!-- Header Content -->
        <header class='mb-3'>
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
            <nav class="navbar navbar-expand navbar-light navbar-top">
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <?php
                    $session = \Config\Services::session();
                    if ($session->getFlashData('success')) { ?>
                    <div class="alert alert-info alert-dismissible show fade w-75">
                        <i class="bi bi-check-circle"></i>
                        <?php echo $session->getFlashData('success'); ?>
                        <?php echo session()->get('akun_nama_lengkap'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php }
                    ?>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ms-auto mb-lg-0">
                        </ul>
                        <div class="dropdown">
                            <a href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="user-menu d-flex">
                                    <div class="user-name text-end me-3">
                                        <h6 class="mb-0 text-gray-600"><?php echo session()->get(
                                            'akun_nama_lengkap'
                                        ); ?></h6>
                                        <p class="mb-0 text-sm text-gray-600">
                                            <?php echo session()->get(
                                                'akun_email'
                                            ); ?>
                                        </p>
                                    </div>
                                    <div class="user-img d-flex align-items-center">
                                        <div class="avatar avatar-md">
                                            <img src="<?= base_url(
                                                'admin'
                                            ) ?>/images/faces/1.jpg" alt="Face 1" />
                                            <span class="avatar-status bg-success" style=""></span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton"
                                style="min-width: 11rem;">
                                <li>
                                    <h6 class="dropdown-header">Hello, Administrator!</h6>
                                </li>
                                <li><a class="dropdown-item" href="#" data-bs-toggle="modal"
                                        data-bs-target="#inlineForm"><i class="icon-mid bi bi-gear me-2"></i>
                                        Settings</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="<?= site_url(
                                    'admin/logout'
                                ) ?>"><i class="icon-mid bi bi-box-arrow-left me-2"></i>
                                        Logout</a></li>
                            </ul>
                        </div>
                        <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog"
                            aria-labelledby="myModalLabel33" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel33">Settings Profile</h4>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <i data-feather="x"></i>
                                        </button>
                                        <?php
                                        $session = \Config\Services::session();
                                        if (
                                            $session->getFlashData('warning')
                                        ) { ?>
                                        <div class="alert alert-warning alert-dismissible show fade">
                                            <ul>
                                                <?php foreach (
                                                    $session->getFlashData(
                                                        'warning'
                                                    )
                                                    as $value
                                                ) { ?>
                                                <li>
                                                    <?= $value ?>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                        <?php }
                                        ?>
                                    </div>
                                    <form method="post" action="user" enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <input type="hidden" name="id" class="form-control" value="<?= session()->get(
                                                        'akun_id'
                                                    ) ?>">
                                            </div>
                                            <label>User Name: </label>
                                            <div class="form-group">
                                                <input type="text" placeholder="User Name" name="username"
                                                    class="form-control" value="<?= session()->get(
                                                        'akun_username'
                                                    ) ?>">
                                            </div>
                                            <label>Full Name: </label>
                                            <div class="form-group">
                                                <input type="text" placeholder="Full Name" name="fullname"
                                                    class="form-control" value="<?= session()->get(
                                                        'akun_nama_lengkap'
                                                    ) ?>">
                                            </div>
                                            <label>Email: </label>
                                            <div class="form-group">
                                                <input type="email" placeholder="Email Address" name="email"
                                                    class="form-control" value="<?= session()->get(
                                                        'akun_email'
                                                    ) ?>">
                                            </div>
                                            <label>Password: </label>
                                            <div class="form-group">
                                                <input type="password" placeholder="Password" name="password"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary ml-1" data-bs-dismiss="modal">
                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Update</span>
                                            </button>
                                            <button type="button" class="btn btn-light-secondary"
                                                data-bs-dismiss="modal">
                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                <span class="d-none d-sm-block">Close</span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3 class="ms-1">Dashboard</h3>
                    <p class="text-subtitle text-muted"></p>
                </div>
                <div class="col-12 col-md-6 order-md-2 order-first">
                    <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?= site_url(
                                    'admin/dashboard'
                                ) ?>">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page"></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="page-content">
            <section class="row">
                <div class="col-12 col-lg-9">
                    <div class="row">
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon purple mb-2">
                                                <i class="iconly-boldShow"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">
                                                Visitor
                                            </h6>
                                            <h6 class="font-extrabold mb-0"><?= $totalVisitors; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon blue mb-2">
                                                <i class="iconly-boldCall"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Contacts</h6>
                                            <h6 class="font-extrabold mb-0"><?= $totalMessages; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 col-lg-4 col-md-6">
                            <div class="card">
                                <div class="card-body px-4 py-4-5">
                                    <div class="row">
                                        <div
                                            class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start">
                                            <div class="stats-icon green mb-2">
                                                <i class="iconly-boldChat"></i>
                                            </div>
                                        </div>
                                        <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                            <h6 class="text-muted font-semibold">Feedback</h6>
                                            <h6 class="font-extrabold mb-0"><?= $totalFeedbacks; ?></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <div class="card">
                        <div class="card-body py-4 px-4">
                            <div class="d-flex align-items-center">
                                <div class="avatar avatar-xl">
                                    <img src="<?= base_url(
                                            'admin'
                                        ) ?>/images/faces/1.jpg" alt="Face 1" />
                                </div>
                                <div class="ms-3 name">
                                    <h5 class="font-bold">Login As : </h5>
                                    <h6 class="text-muted mb-0"> <?php echo session()->get(
                                            'akun_nama_lengkap'
                                        ); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <section class="section">
            <div class="card">
                <div class="card-body">
                    <!-- <h4 class="card-title">Hello Administrator <i class="bi bi-stars text-primary"></i></h4> -->
                    <h4 class="ms-1">Hello Administrator <i class="bi bi-stars text-primary"></i></h4>
                    <p class="size-text">
                        Welcome to the landing page data management dashboard of PT.GBVRJ SOLUTIONS
                        TECHNOLOGY, 
                        In this system you can manage the front page of the content profile PT.GBVRJ SOLUTIONS
                        TECHNOLOGY.
                    </p>
                </div>
            </div>
        </section>
        <footer>
            <div class="footer clearfix mb-0 text-muted">
                <div class="float-start">
                    <p>2022 &copy; Gbvrj Solutions Technology</p>
                </div>
                <div class="float-end">
                    <p>Building in <span class="text-primary"><i class="bi bi-windows"></i></span>
                        by <a href="https://www.instagram.com/dho.s.a_18/">PT.Gbvrj Solutions Technology</a></p>
                </div>
            </div>
        </footer>
<!-- Layout Footer -->
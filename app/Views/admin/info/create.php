<!-- Layout Header  -->
<div id="app">
    <!-- Layout Sidebar -->
    <div id="main">
        <!-- Header Content -->
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Add Data</h3>
                        <br>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(
                                    'admin/dashboard'
                                ) ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url(
                                    'admin/info/index'
                                ) ?>">info</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Data</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Layout Content -->
            <section id="multiple-column-form">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <?php
                                    $session = \Config\Services::session();
                                    if ($session->getFlashData('warning')) { ?>
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
                                    <?php } ?>
                                    <form method="post" class="form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="company_name">Company Name</label>
                                                    <input type="text" class="form-control" placeholder="Input Company Name"
                                                        name="company_name" value="<?= isset(
                                                            $company_name
                                                        )
                                                            ? $company_name
                                                            : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="company_contact">Company Contact</label>
                                                    <input type="text" class="form-control" placeholder="Input Company Contact"
                                                        name="company_contact" value="<?= isset(
                                                            $company_contact
                                                        )
                                                            ? $company_contact
                                                            : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="company_mail">Company Email</label>
                                                    <input type="email" class="form-control" placeholder="Input Company Email"
                                                        name="company_mail" value="<?= isset(
                                                            $company_mail
                                                        )
                                                            ? $company_mail
                                                            : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="company_location">Company Location</label>
                                                    <input type="text" class="form-control" placeholder="Input Company Location"
                                                        name="company_location" value="<?= isset(
                                                            $company_location
                                                        )
                                                            ? $company_location
                                                            : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="copyright">Copyright</label>
                                                    <input type="text" class="form-control" placeholder="Input Copyright"
                                                        name="copyright" value="<?= isset(
                                                            $copyright
                                                        )
                                                            ? $copyright
                                                            : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-12 d-flex justify-content-end">
                                                <button type="submit" name="submit"
                                                    class="btn btn-primary me-1 mb-1">Submit</button>
                                                <button type="reset"
                                                    class="btn btn-light-secondary me-1 mb-1">Reset</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
<!-- Layout Footer -->
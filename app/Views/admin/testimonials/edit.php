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
                        <h3>Edit Data</h3>
                        <br>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= base_url(
                                    'admin/dashboard'
                                ) ?>">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="<?= base_url(
                                    'admin/testimonials/index'
                                ) ?>">Testimonials</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Edit Data</li>
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
                                    <?php }
                                    ?>
                                    <form method="post" class="form" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" class="form-control" placeholder="Input Title"
                                                        name="name" value="<?= isset(
                                                            $name
                                                        )
                                                            ? $name
                                                            : '' ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="quotes">Quote</label>
                                                    <textarea class="form-control" placeholder="Input Quotes"
                                                        name="quote" id="summernote">
                                                    <?= isset($quote)
                                                        ? $quote
                                                        : '' ?>
                                                    </textarea>
                                                </div>
                                            </div>
                                            <?php if (isset($image)) { ?>
                                            <div
                                                class="embed-responsive embed-responsive-item embed-responsive-16by9 w-100">
                                                <iframe src="<?= base_url(
                                                    'assets/image' .
                                                        '/' .
                                                        $image
                                                ) ?>" style="width:100%; border-radius:7px;" height="200"
                                                    allowfullscreen></iframe>
                                            </div>
                                            <?php } ?>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="image">Image</label>
                                                    <input type="file" class="form-control" id="image" name="image"
                                                        placeholder="Input Image">
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label for="user_profession_id">Profession</label>
                                                    <select name="user_profession_id" class="form-select"
                                                        id="basicSelect">
                                                        <option value=""></option>
                                                        <?php foreach (
                                                            $professions
                                                            as $list
                                                        ): ?>
                                                        <option
                                                            <?= $profession_id ==
                                                            $list->profession_id
                                                                ? 'selected'
                                                                : '' ?>
                                                            value="<?= $list->profession_id ?>">
                                                            <?= $list->profession_name ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
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
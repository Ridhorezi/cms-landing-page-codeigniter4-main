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
                        <h3>Works Page</h3>
                        <br>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(
                            'admin/dashboard'
                        ) ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Works</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Layout Content -->
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Categori</th>
                                    <th>Title</th>
                                    <th>Quote</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>dummy</td>
                                    <td>dummy</td>
                                    <td>dummy</td>
                                    <td>dummy</td>
                                    <td>
                                        <span class="badge bg-success">Active</span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- Layout Footer -->
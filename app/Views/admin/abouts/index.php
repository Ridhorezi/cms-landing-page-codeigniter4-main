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
        <?php
        $session = \Config\Services::session();
        if ($session->getFlashData('success')) { ?>
        <div class="alert alert-info alert-dismissible show fade">
            <i class="bi bi-check-circle"></i> 
            <?php echo $session->getFlashData('success'); ?>  
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php }
        ?>
        <div class="page-heading">
            <div class="page-title">
                <div class="row">
                    <div class="col-12 col-md-6 order-md-1 order-last">
                        <h3>Abouts Page</h3>
                        <br>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(
                                    'admin/dashboard'
                                ) ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Abouts</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Layout Content -->
            <section class="section">
                <div class="card">
                    <div class="card-body">
                        <div class="buttons">
                            <a href="<?= site_url(
                                'admin/abouts/create'
                            ) ?>" class="btn btn-primary"> <i class="bi bi-plus"></i> Add Data</a>
                        </div>
                        <table class="table table-striped" id="table1">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Title</th>
                                    <th>Quote</th>
                                    <th>Url Video</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($readAbout as $about) {
                                    $id = $about['id'];
                                    $link_edit = site_url(
                                        "admin/abouts/edit/$id"
                                    );
                                    $link_delete = site_url(
                                        "admin/abouts/index/?aksi=hapus&id=$id"
                                    );
                                    ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $about['title'] ?></td>
                                    <td><?= $about['quote'] ?></td>
                                    <td><?= $about['url_video'] ?></td>
                                    <td>
                                        <a href="<?= $link_edit ?>" class="btn btn-success btn-sm" title='Edit'> <i
                                                class="bi bi-pencil"></i> Edit</a>
                                        <button onclick="confirmationHapusData('<?= $link_delete ?>')"
                                            class="btn btn-danger btn-sm" title='Hapus'><i class="bi bi-trash"></i> Delete</button>
                                    </td>
                                </tr>
                                <?php $no++;
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- Layout Footer -->

<!-- Sweatallert Confirm Delete -->
<script>
function confirmationHapusData(url) {
    Swal.fire({
        title: ' Are you sure ?',
        text: 'You will not be able to return this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#DD6B55',
        confirmButtonText: 'Yes, delete it!',
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire({
                position: 'top-center',
                icon: 'success',
                title: 'Data succesfully deleted',
                showConfirmButton: false,
                timer: 1750
            })
            setTimeout(function() {
                window.location.href = url;
            }, 1700);
        } else if (
            result.dismiss === Swal.DismissReason.cancel
        ) {
            Swal.fire(
                'Cancelled',
                '',
                'error'
            )
        }
    })
}
</script>
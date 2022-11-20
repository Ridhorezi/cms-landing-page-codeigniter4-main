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
                        <h3>Feedback Page</h3>
                        <br>
                    </div>
                    <div class="col-12 col-md-6 order-md-2 order-first">
                        <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="<?= site_url(
                                    'admin/dashboard'
                                ) ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Feedback</li>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                foreach ($readFeedbacks as $feedback) {
                                    $id = $feedback['id'];
                                    $link_edit = site_url(
                                        "admin/feedbacks/edit/$id"
                                    );
                                    $link_delete = site_url(
                                        "admin/feedbacks/index/?aksi=hapus&id=$id"
                                    );
                                    ?>
                                <tr>
                                    <td><?= $no ?></td>
                                    <td><?= $feedback['name'] ?></td>
                                    <td><?= $feedback['email'] ?></td>
                                    <td><?= $feedback['message'] ?></td>
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
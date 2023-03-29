<?= $this->extend('dashboard\include\admin_layout') ?>

<!-- Page style -->
<?= $this->section('stylesheet') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery.dataTables.min.css">
<?= $this->endSection() ?>


<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">News
                        <?= $lang ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">News</li>
                        <li class="breadcrumb-item active">
                            <?= $lang ?>
                        </li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">
                                <h3>List</h3>
                            </div>
                            <div class="card-tools">
                                <?php if (checkaccess("ROLES", "add")): ?>
                                    <a href="<?= base_url("news/details/$langsmall/") ?>"
                                        class="btn btn-primary float-right btn-new">Add New ...</a>
                                <?php endif ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-striped table-bordered table-hover"
                                style="width:100%">
                                <thead>
                                    <th>Id</th>
                                    <th style="display:none;">Heading</th>
                                    <th>Heading</th>
                                    <th>Source</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $item):
                                        echo "<tr>";
                                        echo "<td>$item->id</td>";
                                        echo "<td style=\"display:none;\">$item->heading</td>";
                                        if (strlen($item->heading) > 95)
                                            echo "<td>" . substr($item->heading, 0, 100) . " ...</td>";
                                        else
                                            echo "<td>" . $item->heading . "</td>";
                                        echo "<td>$item->source</td>";
                                        echo "<td>";
                                        if (checkaccess("NEWS", "edit")):
                                            echo '<a href="' . base_url("news/details/$langsmall/") . base64_encode($item->id) . '">Edit</a> /';
                                        endif;
                                        if (checkaccess("NEWS", "delete")):
                                            echo '<a href="' . base_url("news/deletenews/$langsmall/") . base64_encode($item->id) . '" onclick="return confirmdel();">Delete</a>';
                                        endif;
                                        echo "</td>";

                                        echo "</tr>";
                                    endforeach;
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section><!-- /.content -->
</div><!-- /.content-wrapper -->


<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<!-- jsGrid -->
<script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    var data = JSON.parse('<?php $datatable ?>');
    jQuery('#example').DataTable();

    const confirmdel = () => {
        if (confirm("Are you sure to delete this Role?")) {
            return true;
        }
        return false;
    }
</script>
<?= $this->endSection() ?>
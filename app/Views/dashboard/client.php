<?= $this->extend('dashboard/include/admin_layout') ?>

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
                    <h1 class="m-0">Clients</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active">Client Master</li>
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
                                <?php if (checkaccess("CLIENT", "add")): ?>
                                    <button type="button" class="btn btn-primary float-right btn-new" data-toggle="modal"
                                        data-target="#mymodal">Add New ...</button>
                                <?php endif ?>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example" class="table table-striped table-bordered table-hover"
                                style="width:100%">
                                <thead>
                                    <th>Id</th>
                                    <th>Client</th>
                                    <th>Url</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($records as $item) {
                                        echo "<tr>";
                                        echo "<td>" . $item->id . "</td>";
                                        echo "<td>" . $item->clientname . "</td>";
                                        echo "<td>" . $item->baseurl . "</td>";
                                        echo "<td>";
                                        if (checkaccess("CLIENT", "edit")):
                                            echo '<a href="#" onclick="openmodel(' . $item->id . ')">Edit</a> /';
                                        endif;
                                        if (checkaccess("CLIENT", "delete")):
                                            echo '<a href="' . base_url("masters/deleteclient/") . $item->id . '" onclick="return confirmdel();">Delete</a>';
                                        endif;
                                        echo "</td>";

                                        echo "</tr>";
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Model -->
<div class="modal fade" id="mymodal" style="display: none;" data-backdrop="static" data-keyboard="false"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Client</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="txthdn" value="-1" />
                    <input type="hidden" name="txtguid" value="-1" />
                    <div class="form-group">
                        <label for="role">Client</label>
                        <input type="text" class="form-control" name="txtclient" placeholder="Enter client name">
                    </div>
                    <div class="form-group">
                        <label for="desc">Url</label>
                        <input type="text" class="form-control" name="txturl" placeholder="Enter client URL">
                    </div>
                </div>

                <div class="modal-footer text-right">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<!-- /.content-wrapper -->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<!-- jsGrid -->
<script src="<?= base_url() ?>assets/js/jquery.dataTables.min.js"></script>
<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
    var data = JSON.parse('<?= $datatable ?>');

    const clearcontrol = () => {
        jQuery("input[name=txthdn]").val("-1");
        jQuery("input[name=txtguid]").val(uuid());
        jQuery("input[name=txtclient]").val("");
        jQuery("input[name=txturl]").val("");
    }

    const openmodel = (idn) => {
        var row = data.filter(element => element.id == idn)
        if (row != null && row.length > 0) {
            jQuery("input[name=txthdn]").val(row[0].id);
            jQuery("input[name=txtguid]").val(row[0].guid);
            jQuery("input[name=txtclient]").val(row[0].clientname);
            jQuery("input[name=txturl]").val(row[0].baseurl);
            jQuery.noConflict();
            jQuery('#mymodal').modal('toggle');
        }
    }

    const confirmdel = () => {
        if (confirm("Are you sure to delete this Client?")) {
            return true;
        }
        return false;
    }
    jQuery('#mymodal').on('hidden.bs.modal', function () { clearcontrol(); })

    jQuery(document).ready(function () {
        jQuery('#example').DataTable();

        jQuery("input[name=txtguid]").val(uuid());

        jQuery("form").submit(function (e) {
            if (jQuery("input[name=txtclient]").val() == "") {
                alert("Enter Client Name !!!");
                return false;
            }
            if (jQuery("input[name=txtclient]").val().indexOf(";") > 0) {
                alert("Don't use Semicolon ' ; ' in client name.");
                return false;
            }
            if (jQuery("input[name=txturl]").val() == "") {
                alert("Enter URL !!!");
                return false;
            }
        });
    });

    function uuid() {
        var chars = '0123456789abcdef'.split('');

        var uuid = [], rnd = Math.random, r;
        uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
        uuid[14] = '4'; // version 4

        for (var i = 0; i < 36; i++) {
            if (!uuid[i]) {
                r = 0 | rnd() * 16;

                uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r & 0xf];
            }
        }

        return uuid.join('');
    }

</script>
<?= $this->endSection() ?>
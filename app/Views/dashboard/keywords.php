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
                    <h1 class="m-0">Company Stockcode-Keywords</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active">Keywords Master</li>
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
                                <?php if (checkaccess("KEYWORDS", "add")): ?>
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
                                    <th>Company</th>
                                    <th>Stock Code</th>
                                    <th>Keywords</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($records as $item) {
                                        echo "<tr>";
                                        echo "<td>" . $item->id . "</td>";
                                        echo "<td>" . $item->company . "</td>";
                                        echo "<td>" . $item->stockcode . "</td>";
                                        echo "<td>" . $item->keywords . "</td>";
                                        echo "<td>";
                                        if (checkaccess("KEYWORDS", "edit")):
                                            echo '<a href="#" onclick="openmodel(' . $item->id . ')">Edit</a> /';
                                        endif;
                                        if (checkaccess("KEYWORDS", "delete")):
                                            echo '<a href="' . base_url("masters/deletekeyword/") . $item->id . '" onclick="return confirmdel();">Delete</a>';
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
                <h4 class="modal-title">Keywords</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="txthdn" value="-1" />
                    <div class="form-group">
                        <label for="role">Company</label>
                        <input type="text" class="form-control" name="txtcompany" placeholder="Enter company name">
                    </div>
                    <div class="form-group">
                        <label for="desc">Stock Code</label>
                        <input type="text" class="form-control" name="txtstockcode" placeholder="Enter stock code">
                    </div>
                    <div class="form-group">
                        <label for="desc">Keyword <sub>[use semi-comma ' ; ' to add multiple keywords]</sub></label>
                        <input type="text" class="form-control" name="txtkeywords"
                            placeholder="Enter keywords [semi-comma separated]">
                        <div id="dvkeywords">

                        </div>
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
        jQuery("input[name=txtcompany]").val("");
        jQuery("input[name=txtstockcode]").val("");
        jQuery("input[name=txtkeywords]").val("");
    }

    const openmodel = (idn) => {
        var row = data.filter(element => element.id == idn)
        if (row != null && row.length > 0) {
            jQuery("input[name=txthdn]").val(row[0].id);
            jQuery("input[name=txtcompany]").val(row[0].company);
            jQuery("input[name=txtstockcode]").val(row[0].stockcode);
            jQuery("input[name=txtkeywords]").val(row[0].keywords);
            jQuery.noConflict();
            jQuery('#mymodal').modal('toggle');
        }
    }

    const confirmdel = () => {
        if (confirm("Are you sure to delete this information?")) {
            return true;
        }
        return false;
    }
    jQuery('#mymodal').on('hidden.bs.modal', function () { clearcontrol(); })

    jQuery(document).ready(function () {
        jQuery('#example').DataTable();

        jQuery("form").submit(function (e) {
            if (jQuery("input[name=txtcompany]").val() == "") {
                alert("Enter Company Name !!!");
                return false;
            }
            if (jQuery("input[name=txtcompany]").val().indexOf(";") > 0) {
                alert("Don't use Semicolon ' ; ' in company name.");
                return false;
            }
            if (jQuery("input[name=txtstockcode]").val() == "") {
                alert("Enter Stock Code !!!");
                return false;
            }
            if (jQuery("input[name=txtkeywords]").val() == "") {
                alert("Enter Keywords !!!");
                return false;
            }
        });
    });

</script>
<?= $this->endSection() ?>
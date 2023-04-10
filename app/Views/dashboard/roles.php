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
                    <h1 class="m-0">Roles</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">System Administration</li>
                        <li class="breadcrumb-item active">Role Master</li>
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
                                    <th>Role</th>
                                    <th>description</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($records as $item) {
                                        echo "<tr>";
                                        echo "<td>" . $item->id . "</td>";
                                        echo "<td>" . $item->role . "</td>";
                                        echo "<td>" . $item->description . "</td>";
                                        echo "<td>";
                                        if (checkaccess("ROLES", "edit")):
                                            echo '<a href="#" onclick="openmodel(' . $item->id . ')">Edit</a> /';
                                        endif;
                                        if (checkaccess("ROLES", "delete")):
                                            echo '<a href="' . base_url("sysadmin/deleterole/") . $item->id . '" onclick="return confirmdel();">Delete</a>';
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
                <h4 class="modal-title">Role</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="txthdn" value="-1" />
                    <div class="form-group">
                        <label for="role">Role</label>
                        <input type="text" class="form-control" name="txtrole" placeholder="Enter role">
                    </div>
                    <div class="form-group">
                        <label for="desc">Description</label>
                        <textarea type="password" class="form-control" name="txtdesc"
                            placeholder="Enter Description"></textarea>
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
        jQuery("input[name=txtrole]").val("");
        jQuery("textarea[name=txtdesc]").val("");
    }

    const openmodel = (idn) => {
        var row = data.filter(element => element.id == idn)
        if (row != null && row.length > 0) {
            jQuery("input[name=txthdn]").val(row[0].id);
            jQuery("input[name=txtrole]").val(row[0].role);
            jQuery("textarea[name=txtdesc]").val(row[0].description);
            jQuery.noConflict();
            jQuery('#mymodal').modal('toggle');
        }
    }

    const confirmdel = () => {
        if (confirm("Are you sure to delete this Role?")) {
            return true;
        }
        return false;
    }
    jQuery('#mymodal').on('hidden.bs.modal', function () { clearcontrol(); })

    jQuery(document).ready(function () {
        // jQuery('#example').DataTable({
        //     columnDefs: [
        //         {
        //             // The `data` parameter refers to the data for the cell (defined by the
        //             // `data` option, which defaults to the column being worked with, in
        //             // this case `data: 0 column`.
        //             //targets: 0 is setting which first column to be customize.
        //             //If it is set to 'targets: 1'  which will customize second column.
        //             render: function (data, type, row) {
        //                 return data + ' (' + row[3] + ')';
        //             },
        //             targets: 0,
        //         },
        //         //setting 'Age' column fourth-one visibe false
        //         { visible: false, targets: [3] },
        //     ],
        // });

        jQuery('#example').DataTable();

        jQuery("form").submit(function (e) {
            if (jQuery("input[name=txtrole]").val() == "") {
                alert("Enter Role !!!");
                return false;
            }
        });
    });

</script>
<?= $this->endSection() ?>
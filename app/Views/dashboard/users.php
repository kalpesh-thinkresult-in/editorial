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
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">System Administration</li>
                        <li class="breadcrumb-item active">User Master</li>
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
                                <?php if (checkaccess("USERS", "add")): ?>
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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($records as $item) {
                                        echo "<tr>";
                                        echo "<td>" . $item->id . "</td>";
                                        echo "<td>" . $item->fullname . "</td>";
                                        echo "<td>" . $item->email . "</td>";
                                        echo "<td>" . $item->role . "</td>";
                                        //echo '<td><a href="#" onclick="openmodel(' . $item->id . ')">Edit</a> / <a href="' . base_url("sysadmin/deleteuser/") . $item->id . '" onclick="return confirmdel();">Delete</a></td>';
                                        echo "<td>";
                                        if (checkaccess("USERS", "edit")):
                                            echo '<a href="#" onclick="openmodel(' . $item->id . ')">Edit</a> /';
                                        endif;
                                        if (checkaccess("USERS", "delete")):
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
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">User</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" name="txthdn" value="-1" />
                    <div class="form-group">
                        <label for="txtname">Name</label>
                        <input type="text" class="form-control" name="txtname" placeholder="Enter full name">
                    </div>
                    <div class="form-group">
                        <label for="txtemail">Email</label>
                        <input type="email" class="form-control" name="txtemail" placeholder="Enter email">
                    </div>
                    <div id="dvpasseord">
                        <div class="form-group">
                            <label for="txtpassword">Password</label>
                            <input type="password" class="form-control" name="txtpassword" placeholder="Enter password">
                        </div>
                        <div class="form-group">
                            <label for="txtcpassword">Confirm Password</label>
                            <input type="password" class="form-control" name="txtcpassword"
                                placeholder="Re-enter password">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Select Role</label>
                        <select class="form-control select2 select2-hidden-accessible" id="selrole" name="selrole"
                            style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                            <option selected="selected" value="-1">Select Role</option>
                            <?php
                            if (!empty($roles)):
                                foreach ($roles as $item):
                                    echo '<option value="' . $item->id . '">' . $item->role . '</option>';
                                endforeach;
                            endif;
                            ?>
                        </select>
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
    var data = JSON.parse('<?= $datatable ?>');
    var mode = 'add';
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }

    const openmodel = (idn) => {
        var row = data.filter(element => element.id == idn)
        if (row != null && row.length > 0) {
            mode = 'edit';
            jQuery("input[name=txthdn]").val(row[0].id);
            jQuery("input[name=txtname]").val(row[0].fullname);
            jQuery("input[name=txtemail]").val(row[0].email);
            jQuery("#selrole").val(row[0].roleid);
            // jQuery('#selrole [value=' + row[0].roleid + ']').attr('selected', 'true');

            jQuery("#dvpasseord").hide();
            jQuery.noConflict();
            jQuery('#mymodal').modal('toggle');
        }
    }

    const confirmdel = () => {
        if (confirm("Are you sure to delete this User?")) {
            return true;
        }
        return false;
    }

    const closemodal = () => {
        mode = 'add';
        jQuery("input[name=txthdn]").val("-1");
        jQuery("input[name=txtname]").val("");
        jQuery("input[name=txtemail]").val("");
        jQuery("input[name=txtpassword]").val("");
        jQuery("input[name=txtcpassword]").val("");
        jQuery("#selrole").val("-1");

        jQuery("#dvpasseord").show();
    }
    jQuery('#mymodal').on('hidden.bs.modal', function () {
        closemodal()
    })

    jQuery(document).ready(function () {
        $('#selrole').select2();
        jQuery('#example').DataTable();

        jQuery("form").submit(function (e) {
            if (jQuery("input[name=txtname]").val() == "") {
                alert("Enter Name !!!");
                return false;
            }
            if (jQuery("input[name=txtemail]").val() == "") {
                alert("Enter email !!!");
                return false;
            }
            if (!validateEmail(jQuery("input[name=txtemail]").val())) {
                alert("Invalid email format !!!");
                return false;
            }
            if (mode != 'edit') {
                if (jQuery("input[name=txtpassword]").val() == "") {
                    alert("Enter password !!!");
                    return false;
                }
                if (jQuery("input[name=txtcpassword]").val() == "") {
                    alert("Enter confirm password !!!");
                    return false;
                }
                if (jQuery("input[name=txtpassword]").val() != jQuery("input[name=txtcpassword]").val()) {
                    alert("Password did not matched !!!");
                    return false;
                }
            }
            if (jQuery("#selrole").val() == "-1") {
                alert("Select role !!!");
                return false;
            }
            return true;
        });

        const validateEmail = ($email) => {
            var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
            return emailReg.test($email);
        }
    });

</script>
<?= $this->endSection() ?>
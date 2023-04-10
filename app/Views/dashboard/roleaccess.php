<?= $this->extend('dashboard/include/admin_layout') ?>

<!-- Page style -->
<?= $this->section('stylesheet') ?>
<style>
    .menuhead {
        color: cornflowerblue;
    }

    .menuchild {
        padding-left: 50px !important;
    }
</style>

<?= $this->endSection() ?>


<?= $this->section('content') ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Role Access</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">System Administration</li>
                        <li class="breadcrumb-item active">Role Access</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Role Section -->
            <div class="row">
                <div class="col-lg-6 col-sm-12">
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
            </div>
            <!-- Menu Section -->
            <div class="row">
                <div class="col-12 text-right" style="padding-right:370px;">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="selectAll">
                        <label class="form-check-label" for="selectAll">Select All</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered table-hover" style="width:100%">
                        <thead>
                            <th>Menu</th>
                            <th width="150px">Add</th>
                            <th width="150px">Edit</th>
                            <th width="150px">Delete</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="menuhead"><b>System Administration</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="menuchild">Role Master</td>
                                <td>
                                    <input type="checkbox" class="form-control" id="ROLESadd">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="ROLESedit">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="ROLESdelete">
                                </td>
                            </tr>
                            <tr>
                                <td class="menuchild">User Master</td>
                                <td>
                                    <input type="checkbox" class="form-control" id="USERSadd">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="USERSedit">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="USERSdelete">
                                </td>
                            </tr>
                            <tr>
                                <td class="menuchild">Role Access</td>
                                <td>
                                    <input type="checkbox" class="form-control" id="ROLEACCadd" style="display:none;">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="ROLEACCedit">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="ROLEACCdelete"
                                        style="display:none;">
                                </td>
                            </tr>
                            <tr>
                                <td class="menuhead"><b>Masters</b></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td class="menuchild">Client Master</td>
                                <td>
                                    <input type="checkbox" class="form-control" id="CLIENTadd">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="CLIENTedit">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="CLIENTdelete">
                                </td>
                            </tr>
                            <tr>
                                <td class="menuchild">Category Master</td>
                                <td>
                                    <input type="checkbox" class="form-control" id="CATEadd">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="CATEedit">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="CATEdelete">
                                </td>
                            </tr>
                            <tr>
                                <td class="menuchild">Tag Master</td>
                                <td>
                                    <input type="checkbox" class="form-control" id="TAGSadd">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="TAGSedit">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="TAGSdelete">
                                </td>
                            </tr>
                            <tr>
                                <td class="menuchild">Keyword Master</td>
                                <td>
                                    <input type="checkbox" class="form-control" id="KEYWORDSadd">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="KEYWORDSedit">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="KEYWORDSdelete">
                                </td>
                            </tr>
                            <tr>
                                <td class="menuhead"><b>News</b></td>
                                <td>
                                    <input type="checkbox" class="form-control" id="NEWSadd">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="NEWSedit">
                                </td>
                                <td>
                                    <input type="checkbox" class="form-control" id="NEWSdelete">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <?php if (checkaccess("ROLEACC", "add") || checkaccess("ROLEACC", "edit")): ?>
                        <button class="btn btn-primary" id="btnupdate">Update</button>
                    <?php endif ?>

                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->

<?= $this->endSection() ?>


<?= $this->section('javascript') ?>
<script>
    var data = JSON.parse('<?= $datatable ?>');
    const menucode = ["ROLES", "USERS", "ROLEACC", "CLIENT", "CATE", "TAGS", "NEWS", "KEYWORDS"];

    $(function () {
        $('#selrole').select2();
        $("input[data-bootstrap-switch]").each(function () {
            $(this).bootstrapSwitch("state", $(this).prop("checked"));
        });
    });

    jQuery('input[type=checkbox]').prop('checked', false);

    jQuery("#selectAll").on('change', function () {
        jQuery('input[type=checkbox]').prop('checked', this.checked);
    })

    jQuery("#btnupdate").click(function () {
        if (jQuery('#selrole').val() == "-1") {
            alert("Select Role !!!");
            return false
        };
        var data = [];
        menucode.forEach(element => {
            var row = {
                "roleid": jQuery('#selrole').val(),
                "menucode": element,
                "allowadd": (jQuery("#" + element + "add").is(':checked')) ? 1 : 0,
                "allowedit": (jQuery("#" + element + "edit").is(':checked')) ? 1 : 0,
                "allowdelete": (jQuery("#" + element + "delete").is(':checked')) ? 1 : 0,
            }
            data.push(row);
        });
        // console.log(data);
        $.post('<?= base_url("sysadmin/updateaccess") ?>', { "roleid": jQuery('#selrole').val(), "data": data }, function () {
            location.reload();
        });
    });

    jQuery('#selrole').on('change', function () {
        jQuery('#selrole').val();
        jQuery('input[type=checkbox]').prop('checked', false);;
        displayaccess();
    });

    const displayaccess = () => {
        menucode.forEach(item => {
            var row = data.filter(element => (element.roleid == jQuery('#selrole').val() && element.menucode == item))
            console.log(row[0].allowadd);
            if (row != null && row.length > 0) {
                jQuery("#" + item + "add").prop('checked', (row[0].allowadd == 1) ? true : false);
                jQuery("#" + item + "edit").prop('checked', (row[0].allowedit == 1) ? true : false);
                jQuery("#" + item + "delete").prop('checked', (row[0].allowdelete == 1) ? true : false);
            }
        });

    }
</script>
<?= $this->endSection() ?>
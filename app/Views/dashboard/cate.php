<?= $this->extend('dashboard\include\admin_layout') ?>

<!-- Page style -->
<?= $this->section('stylesheet') ?>
<link rel="stylesheet" href="<?= base_url() ?>assets/css/jquery.dataTables.min.css">

<style>
    .maincate {
        font-weight: 600;
        color: dimgrey;
    }

    .subcate {
        padding-left: 65px !important;
    }

    .modal-dialog {
        overflow-y: initial !important
    }

    .modal-body {
        max-height: calc(100vh - 200px);
        overflow-y: auto;
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
                    <h1 class="m-0">Clientwise Categories</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Masters</li>
                        <li class="breadcrumb-item active">Category Master</li>
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
                                <h3>Clients</h3>
                            </div>
                            <div class="card-tools">

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
                                        if (checkaccess("CATE", "edit") && checkaccess("CATE", "edit") && checkaccess("CATE", "edit")):
                                            echo '<a href="#" onclick="openmodel(' . $item->id . ')">Show Categories</a>';
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
                <h4 class="modal-title"><span id="lblclient"></span></h4>
                <?php if (checkaccess("CATE", "add")): ?>
                    <button type="button" id="btnaddcate" class="btn btn-primary ">Add New</button>
                <?php endif ?>
            </div>
            <form method="post">
                <div class="modal-body">
                    <input type="hidden" id="txthdn" name="txthdn" value="-1" />
                    <table class="table table-striped table-bordered table-hover" style="width:100%">
                        <thead>
                            <th>Category</th>
                            <th>Language</th>
                            <th>Action</th>
                        </thead>
                        <tbody id="categorieslist">

                        </tbody>
                    </table>
                </div>

                <div class="modal-footer text-right">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<!-- Model -->
<div class="modal fade" id="mymodal2" style="display: none;" data-backdrop="static" data-keyboard="false"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span id="lblmodal2head"></span></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="txthdn2" name="txthdn2" value="-1" />
                <div class="form-group">
                    <label for="role">Category</label>
                    <input type="text" class="form-control" id="txtcate" placeholder="Enter Category">
                </div>
                <div class="form-group">
                    <label for="role">Language</label>
                    <select class="form-control" id="sellanguage">
                        <option value="-1">Select Language</option>
                        <option value="eng">English</option>
                        <option value="hindi">Hindi</option>
                    </select>
                </div>
                <div id="dvparent">
                    <div class="form-group">
                        <label for="role">Parent Category</label>
                        <select class="form-control" id="selparentcate">

                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <span id="txtguid"></span>
                <button type="button" id="btnsavecate" class="btn btn-primary float-right">Save changes</button>
                <button type="button" class="btn btn-default float-right" id="mdcl2">Close</button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

<!-- Model -->
<div class="modal fade" id="mymodal3" style="display: none;" data-backdrop="static" data-keyboard="false"
    aria-hidden="true" role="dialog">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Move child to:</span></h4>
            </div>
            <div class="modal-body">
                <input type="hidden" id="txthdn3" name="txthdn3" value="-1" />
                <div id="dvparent">
                    <div class="form-group">
                        <label for="role">Select Category</label>
                        <select class="form-control" id="selmovetocate">

                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-right">
                <button type="button" id="btnmovecate" class="btn btn-primary">Move All</button>
                <button type="button" class="btn btn-default" id="mdcl3">Close</button>
            </div>
        </div>
    </div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

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
    var tblcate = JSON.parse('<?= $categories ?>');

    jQuery(document).ready(function () {
        jQuery('#example').DataTable();
    });

    const clearcontrol = () => {
        jQuery("#txthdn").val("-1");
    }

    const clearcontrol2 = () => {
        jQuery("#txthdn2").val("-1");
        jQuery("#txtcate").val("");
        jQuery("#txtguid").html("");
        jQuery("#sellanguage").val("-1");

    }
    const clearcontrol3 = () => {
        jQuery("#txthdn3").val("-1");
    }

    const openmodel = (idn, iname) => {
        var row = data.filter(element => element.id == idn)
        if (row != null && row.length > 0) {
            jQuery("#txthdn").val(row[0].id);
            jQuery("#lblclient").html("Categories: " + row[0].clientname);
            getMainCates(row[0].id);
            jQuery.noConflict();
            jQuery('#mymodal').modal('toggle');
        }
    }
    const openmodel2 = (cateid = -1, isparent = false) => {
        jQuery.noConflict();

        var catename = "", categuid = "";
        var parentid = -1;
        var language = -1;
        var row = tblcate.filter(element => element.id == cateid)
        if (row != null && row.length > 0) {
            catename = row[0].category;
            categuid = row[0].guid;
            parentid = row[0].parent_cate_id;
            language = row[0].lang;
        }

        jQuery('#selparentcate').empty();
        jQuery('#dvparent').hide();

        if (isparent == false) {
            getParentCatesDropdown(parentid);
            jQuery('#dvparent').show();
        }

        if (cateid == -1)
            jQuery("#lblmodal2head").html("Add New Category");
        else {
            jQuery("#lblmodal2head").html(catename + " : [Edit Category]");
            jQuery("#txtcate").val(catename);
            jQuery("#txtguid").html(categuid);
            jQuery("#sellanguage").val(language);
        }

        jQuery("#txthdn2").val(cateid);
        jQuery.noConflict();
        jQuery('#mymodal2').modal('toggle');

    }
    const openmodel3 = (cateid = -1,) => {
        jQuery.noConflict();

        jQuery("#txthdn3").val(cateid);
        jQuery('#selmovetocate').empty();

        getParentCatesDropdown(0, "#selmovetocate");

        jQuery.noConflict();
        jQuery('#mymodal3').modal('toggle');

    }

    jQuery("#btnaddcate").click(function () {
        openmodel2(-1, false);
    });
    jQuery("#mdcl2").click(function () {
        jQuery.noConflict();
        jQuery('#mymodal2').modal('toggle');
    });
    jQuery("#mdcl3").click(function () {
        jQuery.noConflict();
        jQuery('#mymodal3').modal('toggle');
    });

    jQuery('#mymodal').on('hidden.bs.modal', function () { clearcontrol(); })
    jQuery('#mymodal2').on('hidden.bs.modal', function () { clearcontrol2(); })

    jQuery("#btnsavecate").click(function () {
        if (jQuery("#txtcate").val() == "") {
            alert("Enter Category");
            return false;
        }
        if (jQuery("#txtcate").val().indexOf(";") > 0) {
            alert("Don't use Semicolon ' ; ' in category.");
            return false;
        }
        if (jQuery("#sellanguage").val() == "-1") {
            alert("Select Language");
            return false;
        }
        var parentid = (jQuery("#txthdn2").val() == jQuery("#selparentcate").val()) ? 0 : jQuery("#selparentcate").val();
        var formdata = {
            "id": jQuery("#txthdn2").val(),
            "clientid": jQuery("#txthdn").val(),
            "guid": uuid(),
            "category": jQuery("#txtcate").val(),
            "lang": jQuery("#sellanguage").val(),
            "parentid": parentid,

        };
        jQuery.post("<?= base_url("masters/savecate") ?>", formdata)
            .done(function (data) {
                tblcate = JSON.parse(data);
            })
            .fail(function () {
                alert("error");
            })
            .always(function () {
                getMainCates(jQuery("#txthdn").val());
                jQuery.noConflict();
                jQuery('#mymodal2').modal('toggle');
            });
    });

    jQuery("#btnmovecate").click(function () {
        if (jQuery("#selmovetocate").val() == "-1") {
            alert("Select Category");
            return false;
        }
        var formdata = {
            "clientid": jQuery("#txthdn").val(),
            "cateid": jQuery("#txthdn3").val(),
            "parentid": jQuery("#selmovetocate").val(),
        };
        jQuery.post("<?= base_url("masters/movecate") ?>", formdata)
            .done(function (data) {
                tblcate = JSON.parse(data);
            })
            .fail(function () {
                alert("error");
            })
            .always(function () {
                getMainCates(jQuery("#txthdn").val());
                jQuery.noConflict();
                jQuery('#mymodal3').modal('toggle');
            });
    })

    const deletecate = (cateid) => {
        if (!confirm("Are you sure to delete this Category?")) {
            return false;
        }
        var formdata = {
            "id": cateid,
        };
        jQuery.post("<?= base_url("masters/deletecate") ?>", formdata)
            .done(function (data) {
                tblcate = JSON.parse(data);
            })
            .fail(function () {
                alert("error");
            })
            .always(function () {
                getMainCates(jQuery("#txthdn").val());
            });
    };

    ////======================================  Category handling ==========================
    // get main categories
    const getMainCates = (idn) => {
        var html = "";
        var row = tblcate.filter(element => element.clientid == idn && element.parent_cate_id == 0)
        if (row != null && row.length > 0) {
            for (let index = 0; index < row.length; index++) {
                const item = row[index];
                var subhtml = getSubCate(item.clientid, item.id);
                html += "<tr>";
                html += "<td class=\"maincate\">" + item.category + " [" + item.id + "]</td>";
                html += "<td>";
                html += (item.lang == "eng") ? "English" : "Hindi";
                html += "</td>";
                if (subhtml == "") {
                    html += "<td>";
                    <?php if (checkaccess("CATE", "edit")): ?>
                        html += createEditLink(item.id, false) + " / "
                    <?php endif ?>
                    <?php if (checkaccess("CATE", "delete")): ?>
                        html += createDeleteLink(item.id);
                    <?php endif ?>
                    html += "</td>";
                } else {

                    html += "<td>";
                    <?php if (checkaccess("CATE", "edit")): ?>
                        html += createEditLink(item.id, true) + "/ <a href=\"#\" onclick=\"openmodel3('" + item.id + "');\" >Move all child to other category</a>";
                    <?php endif ?>
                    html += "</td>";
                }

                html += "</tr>";
                // console.log("-" + item.category);
                html += subhtml;
            }
        }
        jQuery("#categorieslist").html(html);
    }
    //get sub categories
    const getSubCate = (idc, idn) => {
        var subhtml = "";
        var row = tblcate.filter(element => element.clientid == idc && element.parent_cate_id == idn)
        if (row != null && row.length > 0) {
            for (let index = 0; index < row.length; index++) {
                const item = row[index];
                subhtml += "<tr>";
                subhtml += "<td class=\"subcate\">" + item.category + " [" + item.id + "]</td>";
                subhtml += "<td>";
                subhtml += (item.lang == "eng") ? "English" : "Hindi";
                subhtml += "</td>";
                subhtml += "<td>";
                <?php if (checkaccess("CATE", "edit")): ?>
                    subhtml += createEditLink(item.id, false) + " / ";
                <?php endif ?>
                <?php if (checkaccess("CATE", "delete")): ?>
                    subhtml += createDeleteLink(item.id);
                <?php endif ?>
                subhtml += "</td>";
                subhtml += "</tr>";
            }
        }
        return subhtml;
    }

    const createEditLink = (cateid, isparent) => {
        return "<a href=\"#\" onclick=\"return openmodel2(" + cateid + ", " + isparent + ");\">Edit</a>";
    }
    const createDeleteLink = (cateid) => {
        return "<a href=\"#\" onclick=\"return deletecate(" + cateid + ");\">Delete</a>";
    }
    //get parent categories list
    const getParentCatesDropdown = (defaultId = 0, cntrlname = "#selparentcate") => {
        jQuery(cntrlname).empty()
        var row = tblcate.filter(element => element.clientid == jQuery("#txthdn").val() && element.parent_cate_id == 0)
        if (row != null && row.length > 0) {
            jQuery(cntrlname).append("<option value=\"-1\" " + selected + " >Select</option>");
            for (let index = 0; index < row.length; index++) {
                var selected = "";
                const item = row[index];
                if (defaultId == item.id) selected = "selected";
                jQuery(cntrlname).append("<option value=\"" + item.id + "\" " + selected + " >" + item.category + "</option>");
            }
        }
        return true;
    }

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
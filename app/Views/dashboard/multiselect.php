<?= $this->extend('dashboard\include\admin_layout') ?>
<?= $this->section('stylesheet') ?>
<style>
    .note-editor.note-airframe .note-editing-area .note-editable,
    .note-editor.note-frame .note-editing-area .note-editable {
        height: 300px !important;
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Categories
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <select id="selcategory" class="form-control" name="selcategory[]" multiple="multiple">
                                <?php if (!empty($menulist)):
                                    $selected = ""; ?>
                                    <?php foreach ($menulist as $item):
                                        $selected = (!empty($item->newsid)) ? "selected" : "";
                                        ?>
                                        <option value="<?= $item->id ?>" <?= $selected ?>><?= $item->menu ?></option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- ./row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                News Heading
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="form-group">
                                <label for="txttitle">Title</label>
                                <input type="text" class="form-control" id="txttitle" name="txttitle"
                                    placeholder="Enter News Title">
                            </div>
                            <div class="form-group">
                                <label for="txtslug">Slug</label>
                                <input type="text" class="form-control" id="txtslug" name="txtslug"
                                    placeholder="Enter Slug">
                            </div>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- ./row -->
            <div class="row">
                <!-- /.col -->
                <div class="col-md-6">
                    <select id="seltags" class="form-control" name="tags[]" multiple="multiple">
                        <option value="w1" selected>India</option>
                        <option value="o1">Market</option>
                        <option value="o1">Money</option>
                        <option value="t1" selected>Stock</option>
                    </select>

                    <select id="selstockcodes" class="form-control" name="sockcode[]" multiple="multiple">
                        <?php if (!empty($ks)):
                            $selected = ""; ?>
                            <?php foreach ($ks as $item):
                                //$selected = (!empty($item->newsid)) ? "selected" : "";
                                ?>
                                <option value="<?= $item->stockcode ?>" <?= $selected ?>><?= $item->company . " -> " . $item->stockcode ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">
                                Detailed News
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <textarea id="newsdescription" style="height:300px!important;"></textarea>
                        </div>
                    </div>
                </div><!-- /.col-->
            </div><!-- ./row -->


        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<!-- Page specific script -->
<script>
    $(function () {
        //==============================================================================================
        //initialization
        //==============================================================================================
        //init html editor
        $('#newsdescription').summernote()

        //init selects
        $('#selcategory').select2();
        $('#seltags').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
        $('#selstockcodes').select2({
            tags: true,
            tokenSeparators: [',', ' ']
        });
        //==============================================================================================
    })

</script>
<?= $this->endSection() ?>
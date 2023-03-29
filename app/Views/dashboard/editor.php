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
                                Summernote
                            </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <textarea id="newsdescription" style="height:500px!important;">
                Place <em>some</em> <u>text</u> <strong>here</strong>
              </textarea>
                        </div>

                    </div>
                </div>
                <!-- /.col-->
            </div>
            <!-- ./row -->
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
        // Summernote
        $('#newsdescription').summernote()
    })
</script>
<?= $this->endSection() ?>
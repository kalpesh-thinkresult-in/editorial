<?= $this->extend('dashboard/include/admin_layout') ?>


<?= $this->section('content') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard v1</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?= $engtodaycount ?>
                            </h3>
                            <p>Today - English News</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?= $hinditodaycount ?>
                            </h3>
                            <p>Today - Hindi News</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>
                                <?= $engallcount ?>
                            </h3>
                            <p>Total - English News</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>
                                <?= $hindiallcount ?>
                            </h3>
                            <p>Total - Hindi News</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <style>
                .clsum {
                    overflow-y: auto;
                    max-height: 550px !important;
                    margin-bottom: 10px;

                }
            </style>
            <div class="row">
                <div class="col-12">
                    <h5 class="m-1">Client and category wise News Count update:</h5>
                </div>
                <?php if (!empty($clientcatewisecount)):
                    $clientname = "";
                    $isfirst = 1;
                    foreach ($clientcatewisecount as $item):
                        if ($clientname != $item->clientname):
                            $clientname = $item->clientname;
                            if ($isfirst != 1):
                                echo "</tbody></table></div>";
                            else:
                                $isfirst = 0;
                            endif;
                            echo '<div class="col-sm-12 col-lg-4 clsum">
                                <div class="bg-primary pl-2" style="position: sticky!important;top:0px">
                                    <h5>
                                        ' . $item->clientname . '
                                    </h5>
                                    ' . $item->baseurl . '
                                </div>
                                <table class="table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>Category</th>
                                            <th>Today</th>
                                            <th>All</th>
                                        </tr>
                                    </thead><tbody>';
                        endif;
                        echo '<tr>
                                <td>' . $item->category . '</td>
                                <td>' . (($item->Todaynews > 0) ? $item->Todaynews : "-") . '</td>
                                <td>' . (($item->Totalnews > 0) ? $item->Totalnews : "-") . '</td>
                            </tr>';

                    endforeach;
                    echo "</tbody></table></div>";
                endif ?>
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<?= $this->endSection() ?>


<?= $this->section('javascript') ?>

<?= $this->endSection() ?>
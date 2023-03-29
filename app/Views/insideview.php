<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="meta keywords">
    <meta name="description" content="meta desciption">
    <title>Dynamic Pages</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
        integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
        crossorigin="anonymous"></script>

</head>

<body>
    <div class="container">
        <div class="row pt-3">
            <div class="col-sm-12">
                <h3>
                    <?= $header ?>
                </h3>
            </div>
        </div>
        <hr />
        <div class="row">
            <div class="col-sm-2">
                <a href="javascript:void" class="menu-link" data-name="getgainer">Top Gainer</a>
            </div>
            <div class="col-sm-2">
                <a href="javascript:void" class="menu-link" data-name="run">Run</a>
            </div>
            <div class="col-sm-2">
                <a href="javascript:void" class="menu-link" data-name="getgainer">Top Gainer</a>
            </div>
        </div>
        <hr />
        <div class="row pt-5" id="dvwait">
            <div class="col-sm-12 text-center">
                <div class="spinner-border text-muted"></div>
                <div class="spinner-border text-primary"></div>
                <div class="spinner-border text-success"></div>
                <div class="spinner-border text-info"></div>
                <div class="spinner-border text-warning"></div>
                <div class="spinner-border text-danger"></div>
                <div class="spinner-border text-secondary"></div>
                <div class="spinner-border text-dark"></div>
                <div class="spinner-border text-light"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div id="dvcontainer">

                </div>
            </div>
        </div>

    </div>

    <!-- ========================================================================================== -->
    <!-- ================================== Script ================================================ -->
    <!-- ========================================================================================== -->
    <script>
        $(document).ready(function () {
            $("#dvwait").hide();

            $(".menu-link").click(function () {
                let url = "<?= base_url("test/") ?>" + $(this).data("name");
                $("#dvcontainer").hide();
                $("#dvwait").show();
                $.get(url, function (data, status) {
                    $('meta[name=keywords]').attr('content', "new_keywords");
                    $('meta[name=description]').attr('content', "new_description");
                    $("#dvcontainer").html(data);
                    $("#dvwait").hide();
                    $("#dvcontainer").show();
                });

            })
        })
    </script>
</body>

</html>
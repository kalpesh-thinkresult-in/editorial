<!DOCTYPE html>
<html>

<head>
    <title>
        <?= (isset($advpage->title)) ? $advpage->title : ""; ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?= (isset($advpage->description)) ? $advpage->description : ""; ?>">
    <meta name="keywords" content="<?= (isset($advpage->keywords)) ? $advpage->keywords : ""; ?>">
    <link rel="shortcut icon" href="<?php echo base_url('assets/') ?>images/fav.jpg">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/') ?>nerolac/css/style.css">

    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-7947628-9"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());
        gtag('config', 'UA-7947628-9');
    </script>


    <!-- bootstrap cdn -->
    <link href="<?php echo base_url('assets/') ?>nerolac/css/bootstrap.min.css" rel="stylesheet">
    <script src="<?php echo base_url('assets/') ?>nerolac/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>nerolac/js/popper.min.js"></script>
    <script src="<?php echo base_url('assets/') ?>nerolac/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        var baseurl = "<?= base_url("pro/subform") ?>";
        var contexturl = "<?= $slug ?>"
    </script>
    <script src="<?php echo base_url('assets/') ?>nerolac/js/bootstrap-page.js"></script>

    <script>
        !function (f, b, e, v, n, t, s) {
            if (f.fbq) return; n = f.fbq = function () {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n; n.push = n; n.loaded = !0; n.version = '2.0';
            n.queue = []; t = b.createElement(e); t.async = !0;
            t.src = v; s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script', 'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '766285021011392');
        fbq('track', 'PageView');
    </script>
    <noscript>
        <img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=766285021011392&ev=PageView&noscript=1" />
    </noscript>
</head>

<body>
    <script>
        fbq('track', 'ViewContent');		
    </script>
    <div class="container">
        <div class="headerSection">
            <div class="logobox">
                <img src="<?php echo base_url('assets/') ?>nerolac/images/colourgurulogo.png">
            </div>
            <div class="rightLogoBox">
                <?php if (isset($advpage->logo_url) && !empty($advpage->logo_url)) { ?>
                    <img src="<?php echo base_url($advpage->logo_url) ?>">
                <?php } ?>

            </div>
        </div>
    </div>
    <div class="container">
        <div class="nerolacServiceHeading">
            <h3 class="colorDarkBlue font36">
                <?= (isset($advpage->title)) ? $advpage->title : ""; ?>
            </h3>
            <p class="font20">
                <?= (isset($advpage->titledesc)) ? $advpage->titledesc : ""; ?>
            </p>
        </div>
        <div class="mainBannerSection">
            <div class="sliderBox">
                <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php if (isset($slider)):
                            $active = "active";
                            ?>
                            <?php if (!empty($slider)): ?>
                                <?php foreach ($slider as $item):
                                    $imgurl = base_url($item->image_url);
                                    ?>
                                    <div class="carousel-item <?= $active ?>">
                                        <img src="<?= $imgurl ?>" class="d-block w-100" alt="...">
                                    </div>
                                    <?php
                                    $active = "";
                                endforeach ?>
                            <?php endif ?>
                        <?php endif ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="nerolacServiceHeading mobileResponsive">
                <h3 class="colorDarkBlue font36">
                    <?= (isset($advpage->title)) ? $advpage->title : ""; ?>
                </h3>
            </div>
            <div class="userFormBox">
                <h4 class="colorDarkBlue font20">
                    <?= (isset($advpage->formtitle)) ? $advpage->formtitle : ""; ?>
                </h4>
                <p class="font16">
                    <?= (isset($advpage->formdesc)) ? $advpage->formdesc : ""; ?>
                </p>
                <div class="form-cntrl">
                    <div class="">
                        <label for="txtname" class="form-label">Name</label>
                        <input type="name" id="txtname" name="name" placeholder="Enter Name" class="form-control"
                            required>
                    </div>
                    <div class="">
                        <label for="txtmobile" class="form-label">Contact Number</label>
                        <input type="text" class="form-control" id="txtmobile" name="mobile"
                            placeholder="Enter Mobile Number" value="" maxlength="10" required>
                    </div>
                    <div class="">
                        <label for="txtemail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="txtemail" name="email"
                            placeholder="Enter Email Address" aria-describedby="emailHelp" required>
                    </div>
                    <div class="">
                        <label for="txtpincode" class="form-label">PIN Code</label>
                        <input type="text" id="txtpincode" name="pincode" class="form-control"
                            placeholder="Enter Pincode" value="" maxlength="6" required>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="chkiaggree" checked>
                        <label class="form-check-label" for="chkiaggree">I agree to the Terms of Service and Privacy
                            Policy
                            Yes, I would like to receive important updates and notifications through calls, sms, or
                            e-mail.</label>
                    </div>
                    <button type="button" class="getStartedBtn btn" onclick="return formq();">Get Started</button>
                </div>
                <div class="thank-you" style="padding-top:100px;">
                    <center>
                        <h4>Thank you for your inquiry.</h4>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <div class="nerolacServicesSection">
        <div class="container">
            <div class="nerolacServiceHeading">
                <h3 class="colorDarkBlue font26">Features</h3>
            </div>
            <div class="servicesBoxHolder">
                <div class="row">
                    <?php
                    if (isset($services)):
                        if (!empty($services)): foreach ($services as $item):
                                $imgurl = base_url($item->image_url);
                                ?>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="serviceBox">
                                        <div class="serviceIconBox">
                                            <img src="<?= $imgurl ?>">
                                        </div>
                                        <div class="serviceDescription">
                                            <h5 class="colorDarkBlue font20">
                                                <?= $item->head ?>
                                            </h5>
                                            <p class="font16">
                                                <?= $item->description ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            endforeach;
                        endif;
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="footerSection">
        <div class="container">
            <div class="footerMenuBox">
                <ul>
                    <li><a href="https://www.colourguru.in/about-html/">About us</a></li>
                    <li><a href="https://www.colourguru.in/terms/">Terms</a></li>
                    <li><a href="https://www.colourguru.in/privacy-policy/">Privacy policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
<!DOCTYPE html>

<html>
<?php
include "connect.php";
include "functions.php";
$user_id = "";
if (!empty($_SESSION['hash_id'])) {
    $user_id = $_SESSION['hash_id'];
} 
if (!empty($_SESSION['ip_address'])) {
    $user_id = $_SESSION['ip_address'];
}

// echo $user_id;
?>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Cart</title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/Favicon.png" />

    <link rel="stylesheet" href="assets/css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/icomoon.css" />
    <link rel="stylesheet" href="assets/css/vendor/remixicon.css" />
    <link rel="stylesheet" href="assets/css/vendor/magnifypopup.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/odometer.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/lightbox.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/animation.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/jqueru-ui-min.css" />
    <link rel="stylesheet" href="assets/css/vendor/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/vendor/tipped.min.css" />
    <link href="assets/Calender/EventCalender.css" rel="stylesheet" type="text/css" />
    <!-- <script src="assets/Calender/EventCalender.js" type="text/javascript"></script> -->
     <link rel="canonical" href="https://ceuservices.com/cart" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css" />
    <style type="text/css">
        .parentSpace {
            width: 100%;
            display: block;
            color: white;
        }

        .left {
            float: left;
            width: 87%;
        }

        .right {
            float: right;
            width: 5%;

        }

        .center {
            float: right;
            width: 8%;
        }


        .legend .row:nth-of-type(odd) div {
            background-color: #fff;
        }

        .legend .row:nth-of-type(even) div {
            background: #FFF;
        }

        .legend .row:hover div {
            background-color: #1AB39A;
        }


        .text {
            color: #808080;
        }


        .tooltip {
            position: relative;
            display: inline-block;

        }

        .tooltip .tooltiptext {
            visibility: hidden;
            width: 250px;
            background-color: #C8F7EF;
            color: #fff;
            text-align: left;
            border-radius: 6px;
            padding: 2px 5px 5px 5px;
            top: 20px;
            right: 105%;
            font-size: xx-small;

            /* Position the tooltip */
            position: absolute;
            z-index: 1;
        }

        .tooltip:hover .tooltiptext {
            visibility: visible;
        }

        #clockdiv {
            color: #fff;
            display: inline-block;
            font-weight: 500;
            text-align: center;
            font-size: 15px;
            margin-bottom: 20px;
            margin-top: 50px;
        }

        #clockdiv>div {
            display: inline-block;
            padding: 12px 15px;
            margin-right: 5px;
            border: 3px solid #FB0351;
            border-radius: 50%;
        }

        #clockdiv div>span {
            display: inline-block;
            width: 55px;
            height: 35px;
            font-family: "Nunito", sans-serif;
            font-size: 30px;
            font-weight: bold;
            color: #0E1851;
        }

        .smalltext {
            padding-top: 0px;
            font-size: 12px;
            text-transform: uppercase;
            color: #0E1851;
            font-weight: bold;
        }

        svg #oval,
        svg #plus,
        svg #diamond,
        svg #bubble-rounded {
            -webkit-animation: plopp 4s ease-out infinite;
            animation: plopp 4s ease-out infinite;
        }

        svg #oval:nth-child(1),
        svg #plus:nth-child(1),
        svg #diamond:nth-child(1),
        svg #bubble-rounded:nth-child(1) {
            -webkit-animation-delay: -240ms;
            animation-delay: -240ms;
        }

        svg #oval:nth-child(2),
        svg #plus:nth-child(2),
        svg #diamond:nth-child(2),
        svg #bubble-rounded:nth-child(2) {
            -webkit-animation-delay: -480ms;
            animation-delay: -480ms;
        }

        svg #oval:nth-child(3),
        svg #plus:nth-child(3),
        svg #diamond:nth-child(3),
        svg #bubble-rounded:nth-child(3) {
            -webkit-animation-delay: -720ms;
            animation-delay: -720ms;
        }

        svg #oval:nth-child(4),
        svg #plus:nth-child(4),
        svg #diamond:nth-child(4),
        svg #bubble-rounded:nth-child(4) {
            -webkit-animation-delay: -960ms;
            animation-delay: -960ms;
        }

        svg #oval:nth-child(5),
        svg #plus:nth-child(5),
        svg #diamond:nth-child(5),
        svg #bubble-rounded:nth-child(5) {
            -webkit-animation-delay: -1200ms;
            animation-delay: -1200ms;
        }

        svg #oval:nth-child(6),
        svg #plus:nth-child(6),
        svg #diamond:nth-child(6),
        svg #bubble-rounded:nth-child(6) {
            -webkit-animation-delay: -1440ms;
            animation-delay: -1440ms;
        }

        svg #oval:nth-child(7),
        svg #plus:nth-child(7),
        svg #diamond:nth-child(7),
        svg #bubble-rounded:nth-child(7) {
            -webkit-animation-delay: -1680ms;
            animation-delay: -1680ms;
        }

        svg #oval:nth-child(8),
        svg #plus:nth-child(8),
        svg #diamond:nth-child(8),
        svg #bubble-rounded:nth-child(8) {
            -webkit-animation-delay: -1920ms;
            animation-delay: -1920ms;
        }

        svg #oval:nth-child(9),
        svg #plus:nth-child(9),
        svg #diamond:nth-child(9),
        svg #bubble-rounded:nth-child(9) {
            -webkit-animation-delay: -2160ms;
            animation-delay: -2160ms;
        }

        svg #oval:nth-child(10),
        svg #plus:nth-child(10),
        svg #diamond:nth-child(10),
        svg #bubble-rounded:nth-child(10) {
            -webkit-animation-delay: -2400ms;
            animation-delay: -2400ms;
        }

        svg #oval:nth-child(11),
        svg #plus:nth-child(11),
        svg #diamond:nth-child(11),
        svg #bubble-rounded:nth-child(11) {
            -webkit-animation-delay: -2640ms;
            animation-delay: -2640ms;
        }

        svg #oval:nth-child(12),
        svg #plus:nth-child(12),
        svg #diamond:nth-child(12),
        svg #bubble-rounded:nth-child(12) {
            -webkit-animation-delay: -2880ms;
            animation-delay: -2880ms;
        }

        svg #oval:nth-child(13),
        svg #plus:nth-child(13),
        svg #diamond:nth-child(13),
        svg #bubble-rounded:nth-child(13) {
            -webkit-animation-delay: -3120ms;
            animation-delay: -3120ms;
        }

        svg #oval:nth-child(14),
        svg #plus:nth-child(14),
        svg #diamond:nth-child(14),
        svg #bubble-rounded:nth-child(14) {
            -webkit-animation-delay: -3360ms;
            animation-delay: -3360ms;
        }

        svg #oval:nth-child(15),
        svg #plus:nth-child(15),
        svg #diamond:nth-child(15),
        svg #bubble-rounded:nth-child(15) {
            -webkit-animation-delay: -3600ms;
            animation-delay: -3600ms;
        }

        svg #oval:nth-child(16),
        svg #plus:nth-child(16),
        svg #diamond:nth-child(16),
        svg #bubble-rounded:nth-child(16) {
            -webkit-animation-delay: -3840ms;
            animation-delay: -3840ms;
        }

        svg #bg-line:nth-child(2) {
            fill-opacity: 0.3;
        }

        svg #bg-line:nth-child(3) {
            fill-opacity: 0.4;
        }

        @-webkit-keyframes plopp {
            0% {
                transform: translate(0, 0);
                opacity: 1;
            }

            100% {
                transform: translate(0, -10px);
                opacity: 0;
            }
        }

        @keyframes plopp {
            0% {
                transform: translate(0, 0);
                opacity: 1;
            }

            100% {
                transform: translate(0, -10px);
                opacity: 0;
            }
        }
    </style>

</head>

<body>

    <div id="main-wrapper" class="main-wrapper">


        <?php include "header.php" ?>

        <div class="edu-breadcrumb-area">
            <div class="container">
                <div class="breadcrumb-inner">
                    <div class="page-title">
                        <h1 class="title">Cart</h1>
                    </div>
                    <ul class="edu-breadcrumb">
                        <li class="breadcrumb-item"><a href="webinar.php">Webinar</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                        <li class="breadcrumb-item active" aria-current="page">Cart</li>
                    </ul>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1">
                    <span></span>
                </li>
                <li class="shape-2 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="2" src="assets/images/about/shape-13.png" alt="shape" style="transform: translate3d(-36.8px, 21.9px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
                <li class="shape-3 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="-2" src="assets/images/about/shape-15.png" alt="shape" style="transform: translate3d(20px, -4.6px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
                <li class="shape-4">
                    <span></span>
                </li>
                <li class="shape-5 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="2" src="assets/images/about/shape-07.png" alt="shape" style="transform: translate3d(-24.3px, 22.5px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
            </ul>
        </div>

        <section class="cart-page-area edu-section-gap">
            <div class="container">
                <?php
                $all_price = 0;
                $discount_price = 0;
                $subtotal = "";
                $course = "";
                $c_sql = mysqli_query($con, "SELECT cart.cart_id, cart.course_hash_id, cart.array, course_detail.title,course_detail.slug, cart.hash_id as cart_hash_id 
                FROM cart JOIN course_detail ON cart.course_hash_id = course_detail.hash_id 
                WHERE cart.user_id = '" . $user_id . "' AND cart.cart_status = '1'");
                $a = 0;
                if (mysqli_num_rows($c_sql) > 0) {
                ?>
                    <div class="table-responsive">
                        <table class="table cart-table">
                            <thead>
                                <tr>
                                    <th scope="col" class="product-remove"></th>
                                    <th scope="col" class="product-title">Course Name</th>
                                    <th scope="col" class="product-price">Registration options</th>
                                    <th scope="col" class="product-subtotal">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                while ($row = mysqli_fetch_assoc($c_sql)) {
                                    $a++;
                                    $array = stringToArray($row['array']);
                                    $sum = array_sum(array_map('intval', $array));
                                    $all_price += $sum;
                                    $discount = extractKeys($array, '/\(Save \$(\d+)\)/');
                                    $discount_price += $discount;
                                    $subtotal .= "<tr class='order-subtotal'><td>Course " . $a . "</td><td>$" . $sum . ".00</td></tr>";
                                    $course .= $row['cart_hash_id'] . ",";
                                ?>
                                    <tr>
                                        <td class="product-remove">
                                            <a href="delete.php?cart_id=<?php echo $row['cart_id'] ?>" class="remove-wishlist"><i class="icon-73"></i></a>
                                        </td>
                                        <td class="product-title">
                                            <a href="course-details.php?id=<?php echo $row['slug'] ?>"><?php echo $row['title'] ?></a>
                                        </td>
                                        <td>
                                            <table class="table cart-table">
                                                <tr id="tr_price">
                                                    <?php
                                                    $price = 0;
                                                    foreach ($array as $key => $value) {
                                                        $price += $value; ?>
                                                        <td style="padding: 10px 15px;"><?php echo $key; ?></td>
                                                        <td style="padding: 10px 15px;">$<?php echo $value; ?></td>
                                                </tr>
                                            <?php } ?>
                                            </table>
                                        </td>
                                        <td>
                                            <h3 class="product-price" data-title="price" style="font-weight: bolder;color:#1ab69d;"><span class="currency-symbol">$</span><?php echo $sum; ?></h3>
                                        </td>
                                    </tr>
                                <?php }
                                $course = rtrim($course, ',');
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                    <div class="col-xl-5 col-lg-7 offset-xl-7 offset-lg-5">
                        <div class="order-summery">
                            <h4 class="title">Cart Totals</h4>
                            <table class="table summery-table">
                                <tbody>
                                    <?php echo $subtotal; ?>
                                    <tr class="order-total">
                                        <td>Order Total</td>
                                        <td>$<?php echo $all_price ?>.00</td>
                                    </tr>
                                </tbody>
                            </table>
                            <?php ?>
                            <a href="checkout.php?id=<?php echo $course ?>" class="edu-btn btn-medium checkout-btn">Proceed to Checkout <i class="icon-4"></i></a>
                        </div>
                    </div>
                </div>
                <?php } else {  ?>

                    <div class="col-sm-12 empty-cart-cls text-center mt-0">
                        <svg viewBox="656 573 264 182" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="max-width:30%;padding:5rem 3rem;">
                            <rect id="bg-line" stroke="none" fill-opacity="0.2" fill="#FFE100" fill-rule="evenodd" x="656" y="624" width="206" height="38" rx="19"></rect>
                            <rect id="bg-line" stroke="none" fill-opacity="0.2" fill="#FFE100" fill-rule="evenodd" x="692" y="665" width="192" height="29" rx="14.5"></rect>
                            <rect id="bg-line" stroke="none" fill-opacity="0.2" fill="#FFE100" fill-rule="evenodd" x="678" y="696" width="192" height="33" rx="16.5"></rect>
                            <g id="shopping-bag" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(721.000000, 630.000000)">
                                <polygon id="Fill-10" fill="#FFA800" points="4 29 120 29 120 0 4 0"></polygon>
                                <polygon id="Fill-14" fill="#FFE100" points="120 29 120 0 115.75 0 103 12.4285714 115.75 29"></polygon>
                                <polygon id="Fill-15" fill="#FFE100" points="4 29 4 0 8.25 0 21 12.4285714 8.25 29"></polygon>
                                <polygon id="Fill-33" fill="#FFA800" points="110 112 121.573723 109.059187 122 29 110 29"></polygon>
                                <polygon id="Fill-35" fill-opacity="0.5" fill="#FFFFFF" points="2 107.846154 10 112 10 31 2 31"></polygon>
                                <path d="M107.709596,112 L15.2883462,112 C11.2635,112 8,108.70905 8,104.648275 L8,29 L115,29 L115,104.648275 C115,108.70905 111.7365,112 107.709596,112" id="Fill-36" fill="#FFE100"></path>
                                <path d="M122,97.4615385 L122,104.230231 C122,108.521154 118.534483,112 114.257931,112 L9.74206897,112 C5.46551724,112 2,108.521154 2,104.230231 L2,58" id="Stroke-4916" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <polyline id="Stroke-4917" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" points="2 41.5 2 29 122 29 122 79"></polyline>
                                <path d="M4,50 C4,51.104 3.104,52 2,52 C0.896,52 0,51.104 0,50 C0,48.896 0.896,48 2,48 C3.104,48 4,48.896 4,50" id="Fill-4918" fill="#000000"></path>
                                <path d="M122,87 L122,89" id="Stroke-4919" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <polygon id="Stroke-4922" stroke="#000000" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" points="4 29 120 29 120 0 4 0"></polygon>
                                <path d="M87,46 L87,58.3333333 C87,71.9 75.75,83 62,83 L62,83 C48.25,83 37,71.9 37,58.3333333 L37,46" id="Stroke-4923" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <path d="M31,45 C31,41.686 33.686,39 37,39 C40.314,39 43,41.686 43,45" id="Stroke-4924" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <path d="M81,45 C81,41.686 83.686,39 87,39 C90.314,39 93,41.686 93,45" id="Stroke-4925" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <path d="M8,0 L20,12" id="Stroke-4928" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <path d="M20,12 L8,29" id="Stroke-4929" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <path d="M20,12 L20,29" id="Stroke-4930" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <path d="M115,0 L103,12" id="Stroke-4931" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <path d="M103,12 L115,29" id="Stroke-4932" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                                <path d="M103,12 L103,29" id="Stroke-4933" stroke="#000000" stroke-width="3" stroke-linecap="round"></path>
                            </g>
                            <g id="glow" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" transform="translate(768.000000, 615.000000)">
                                <rect id="Rectangle-2" fill="#000000" x="14" y="0" width="2" height="9" rx="1"></rect>
                                <rect fill="#000000" transform="translate(7.601883, 6.142354) rotate(-12.000000) translate(-7.601883, -6.142354) " x="6.60188267" y="3.14235449" width="2" height="6" rx="1"></rect>
                                <rect fill="#000000" transform="translate(1.540235, 7.782080) rotate(-25.000000) translate(-1.540235, -7.782080) " x="0.54023518" y="6.28207994" width="2" height="3" rx="1"></rect>
                                <rect fill="#000000" transform="translate(29.540235, 7.782080) scale(-1, 1) rotate(-25.000000) translate(-29.540235, -7.782080) " x="28.5402352" y="6.28207994" width="2" height="3" rx="1"></rect>
                                <rect fill="#000000" transform="translate(22.601883, 6.142354) scale(-1, 1) rotate(-12.000000) translate(-22.601883, -6.142354) " x="21.6018827" y="3.14235449" width="2" height="6" rx="1"></rect>
                            </g>
                            <polygon id="plus" stroke="none" fill="#7DBFEB" fill-rule="evenodd" points="689.681239 597.614697 689.681239 596 690.771974 596 690.771974 597.614697 692.408077 597.614697 692.408077 598.691161 690.771974 598.691161 690.771974 600.350404 689.681239 600.350404 689.681239 598.691161 688 598.691161 688 597.614697"></polygon>
                            <polygon id="plus" stroke="none" fill="#EEE332" fill-rule="evenodd" points="913.288398 701.226961 913.288398 699 914.773039 699 914.773039 701.226961 917 701.226961 917 702.711602 914.773039 702.711602 914.773039 705 913.288398 705 913.288398 702.711602 911 702.711602 911 701.226961"></polygon>
                            <polygon id="plus" stroke="none" fill="#FFA800" fill-rule="evenodd" points="662.288398 736.226961 662.288398 734 663.773039 734 663.773039 736.226961 666 736.226961 666 737.711602 663.773039 737.711602 663.773039 740 662.288398 740 662.288398 737.711602 660 737.711602 660 736.226961"></polygon>
                            <circle id="oval" stroke="none" fill="#A5D6D3" fill-rule="evenodd" cx="699.5" cy="579.5" r="1.5"></circle>
                            <circle id="oval" stroke="none" fill="#CFC94E" fill-rule="evenodd" cx="712.5" cy="617.5" r="1.5"></circle>
                            <circle id="oval" stroke="none" fill="#8CC8C8" fill-rule="evenodd" cx="692.5" cy="738.5" r="1.5"></circle>
                            <circle id="oval" stroke="none" fill="#3EC08D" fill-rule="evenodd" cx="884.5" cy="657.5" r="1.5"></circle>
                            <circle id="oval" stroke="none" fill="#66739F" fill-rule="evenodd" cx="918.5" cy="681.5" r="1.5"></circle>
                            <circle id="oval" stroke="none" fill="#C48C47" fill-rule="evenodd" cx="903.5" cy="723.5" r="1.5"></circle>
                            <circle id="oval" stroke="none" fill="#A24C65" fill-rule="evenodd" cx="760.5" cy="587.5" r="1.5"></circle>
                            <circle id="oval" stroke="#66739F" stroke-width="2" fill="none" cx="745" cy="603" r="3"></circle>
                            <circle id="oval" stroke="#EFB549" stroke-width="2" fill="none" cx="716" cy="597" r="3"></circle>
                            <circle id="oval" stroke="#FFE100" stroke-width="2" fill="none" cx="681" cy="751" r="3"></circle>
                            <circle id="oval" stroke="#3CBC83" stroke-width="2" fill="none" cx="896" cy="680" r="3"></circle>
                            <polygon id="diamond" stroke="#C46F82" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" fill="none" points="886 705 889 708 886 711 883 708"></polygon>
                            <path d="M736,577 C737.65825,577 739,578.34175 739,580 C739,578.34175 740.34175,577 742,577 C740.34175,577 739,575.65825 739,574 C739,575.65825 737.65825,577 736,577 Z" id="bubble-rounded" stroke="#3CBC83" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" fill="none"></path>
                        </svg>
                        <h3><strong>Your Cart is Empty</strong></h3>
                        <h4>Add something to make me happy :)</h4>
                        <a href="webinar.php" class="edu-btn btn-medium checkout-btn cart-btn-transform m-3" data-abc="true">Go to Webinar</a>
                    </div>
                <?php } ?>

                
            </div>
        </section>


        <?php include "footer.php" ?>

    </div>
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- JS
	============================================ -->
    <!-- Modernizer JS -->
    <script src="assets/js/vendor/modernizr.min.js"></script>
    <!-- Jquery Js -->
    <script src="assets/js/vendor/jquery.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/sal.min.js"></script>
    <script src="assets/js/vendor/backtotop.min.js"></script>
    <script src="assets/js/vendor/magnifypopup.min.js"></script>
    <script src="assets/js/vendor/jquery.countdown.min.js"></script>
    <script src="assets/js/vendor/odometer.min.js"></script>
    <script src="assets/js/vendor/isotop.min.js"></script>
    <script src="assets/js/vendor/imageloaded.min.js"></script>
    <script src="assets/js/vendor/lightbox.min.js"></script>
    <script src="assets/js/vendor/paralax.min.js"></script>
    <script src="assets/js/vendor/paralax-scroll.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.min.js"></script>
    <script src="assets/js/vendor/swiper-bundle.min.js"></script>
    <script src="assets/js/vendor/svg-inject.min.js"></script>
    <script src="assets/js/vendor/vivus.min.js"></script>
    <script src="assets/js/vendor/tipped.min.js"></script>
    <script src="assets/js/vendor/smooth-scroll.min.js"></script>
    <script src="assets/js/vendor/isInViewport.jquery.min.js"></script>
    <!--Calender Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
    <!-- Site Scripts -->
    <script src="assets/js/app.js"></script>
    <script>
        function myFunction() {
            var dots = document.getElementById("dots");
            var moreText = document.getElementById("more");
            var btnText = document.getElementById("myBtn");

            if (dots.style.display === "none") {
                dots.style.display = "inline";
                btnText.innerHTML = "Read more";
                moreText.style.display = "none";
            } else {
                dots.style.display = "none";
                btnText.innerHTML = "Read less";
                moreText.style.display = "inline";
            }
        }
    </script>
</body>


</html>
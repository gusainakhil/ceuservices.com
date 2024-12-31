<!DOCTYPE html>

<html>
<?php
include "connect.php";
include_once "config.php";
include "functions.php";
$coupon = 0;
if (!empty($_SESSION['couponPrice'])) {
    $coupon = $_SESSION['couponPrice'];
}
// echo $_GET;
if (empty($_GET['id'])) {
    header("Location: login");
}
$components = explode(",", $_GET['id']);

if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
    $update_sql = mysqli_query($con, "SELECT * FROM user_info WHERE email='" . $_SESSION['email'] . "' ");
    $update_row = mysqli_fetch_assoc($update_sql);
    $full_name = explode(" ", $update_row['name']);
}

?>

<head>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Checkout</title>
    <meta name="description" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

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
    <script src="assets/Calender/EventCalender.js" type="text/javascript"></script>
    <!-- Site Stylesheet -->
    <link rel="stylesheet" href="assets/css/app.css" />
    <style type="text/css">
        .circle {
            height: 50px;
            width: 50px;
            background-color: rgba(255, 0, 0, 0.4);
            border-radius: 50%;
        }

        .circle1 {
            height: 50px;
            width: 50px;
            background-color: rgba(26, 182, 157, 0.4);
            border-radius: 50%;
        }

        .square {
            text-align: center;
            height: 100px;
            width: 320px;
            padding: 25px;
            background-color: #fff;
            border-radius: 50px 8px 50px 8px;
            box-shadow: 3px 3px 5px 5px rgba(0, 0, 0, 0.05);
        }

        .square1 {
            text-align: center;
            height: 100px;
            width: 320px;
            padding: 25px;
            background-color: #fff;
            border-radius: 8px 50px 8px 50px;
            box-shadow: 3px 3px 5px 5px rgba(0, 0, 0, 0.05);
        }

        .content1 {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 10px;
            text-align: center;

        }

        .section-gap-equal {
            padding: 80px 0;
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
                        <h1 class="title">Checkout</h1>
                    </div>
                    <ul class="edu-breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="separator"><i class="icon-angle-right"></i></li>
                        <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                    </ul>
                </div>
            </div>
            <ul class="shape-group">
                <li class="shape-1">
                    <span></span>
                </li>
                <li class="shape-2 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="2" src="assets/images/about/shape-13.png" alt="shape" style="transform: translate3d(-36.7px, 22.2px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
                <!-- <li class="shape-3 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="-2" src="assets/images/about/shape-15.png" alt="shape" style="transform: translate3d(9.9px, -4.7px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li> -->
                <li class="shape-4">
                    <span></span>
                </li>
                <li class="shape-5 scene" style="transform: translate3d(0px, 0px, 0px) rotate(0.0001deg); transform-style: preserve-3d; backface-visibility: hidden; pointer-events: none;"><img data-depth="2" src="assets/images/about/shape-07.png" alt="shape" style="transform: translate3d(-24.3px, 22.8px, 0px); transform-style: preserve-3d; backface-visibility: hidden; position: relative; display: block; left: 0px; top: 0px;"></li>
            </ul>
        </div>
        <section class="checkout-page-area section-gap-equal">
            <div class="container">
                <form method="POST" action="<?php echo PAYPAL_URL; ?>">
                    <div class="checkout-notice">
                        <div class="coupn-box">
                            <h6 class="toggle-bar"> Have a coupon?
                                <a href="javascript:void(0)" class="toggle-btn">Click here to enter your code</a>
                            </h6>
                            <div class="toggle-open">
                                <p>If you have a coupon code, please apply it below.</p>
                                <div class="input-group">
                                    <input placeholder="Enter coupon code" type="text" id="couponCode" name="coupon_code">
                                    <div class="apply-btn">
                                        <button type="button" onclick="applyCoupon()" class="edu-btn btn-medium">Apply</button>
                                    </div>
                                </div>
                            </div>
                            <div id="result"></div>
                        </div>
                    </div>
                    <div class="row row--25">
                        <div class="col-lg-6">
                            <div class="checkout-billing">
                                <h3 class="title">Billing Details</h3>
                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>First Name*</label>
                                            <input type="text" id="fname" name="fname" required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Last Name*</label>
                                            <input type="text" id="lname" name="lname" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Company Name*</label>
                                            <input type="text" id="company_name" name="company_name" <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
                                                                                                            echo "value='" . $update_row['company_name'] . "'";
                                                                                                        } ?> required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Job Title*</label>
                                            <input type="text" id="job_profile" name="job_profile" <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
                                                                                                        echo "value='" . $update_row['job_profile'] . "'";
                                                                                                    } ?> required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Phone*</label>
                                            <input type="tel" id="number" name="number" <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
                                                                                            echo "value='" . $update_row['number'] . "'";
                                                                                        } ?> required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Email Address*</label>
                                            <input type="email" id="email" name="email" <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
                                                                                            echo "value='" . $update_row['email'] . "'";
                                                                                        } ?> required>
                                            <div id="result123"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Country*</label>
                                            <select id="country" name="country" required>
                                                <option>Select Option</option>
                                                <option value="Australia" <?php
                                                                            if (!empty($_SESSION['email']) && !empty($_SESSION['password']) && $update_row['country'] == 'Australia') {
                                                                                echo "selected";
                                                                            } ?>>Australia</option>
                                                <option value="England" <?php
                                                                        if (!empty($_SESSION['email']) && !empty($_SESSION['password']) && $update_row['country'] == "England") {
                                                                            echo "selected";
                                                                        } ?>>England</option>
                                                <option value="New Zealand" <?php
                                                                            if (!empty($_SESSION['email']) && !empty($_SESSION['password']) && $update_row['country'] == 'New Zealand') {
                                                                                echo "selected";
                                                                            } ?>>New Zealand</option>
                                                <option value="Switzerland" <?php
                                                                            if (!empty($_SESSION['email']) && !empty($_SESSION['password']) && $update_row['country'] == 'Switzerland') {
                                                                                echo "selected";
                                                                            } ?>>Switzerland</option>
                                                <option value="United Kindom (UK)" <?php
                                                                                    if (!empty($_SESSION['email']) && !empty($_SESSION['password']) && $update_row['country'] == 'United Kindom (UK)') {
                                                                                        echo "selected";
                                                                                    } ?>>United Kindom (UK)</option>
                                                <option value="United States (USA)" <?php
                                                                                    if (!empty($_SESSION['email']) && !empty($_SESSION['password']) && $update_row['country'] == 'United States (USA)') {
                                                                                        echo "selected";
                                                                                    } ?>>United States (USA)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>City*</label>
                                            <input type="text" id="city" name="city" <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
                                                                                            echo "value='" . $update_row['city'] . "'";
                                                                                        } ?> required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Address 1*</label>
                                    <input type="text" id="address1" name="address1" <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
                                                                                            echo "value='" . $update_row['address'] . "'";
                                                                                        } ?> required>
                                </div>
                                <div class="form-group">
                                    <label>Address 2</label>
                                    <input type="text" id="address2" name="address2" <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
                                                                                            echo "value='" . $update_row['address2'] . "'";
                                                                                        } ?>>
                                </div>
                                <div class="row g-lg-5">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>State*</label>
                                            <input type="text" id="state" name="state" <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
                                                                                            echo "value='" . $update_row['state'] . "'";
                                                                                        } ?> required>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Zip Code*</label>
                                            <input type="tel" id="pin_code" name='pin_code' <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) {
                                                                                                echo "value='" . $update_row['pin_code'] . "'";
                                                                                            } ?> required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="order-summery checkout-summery">
                                <div class="summery-table-wrap">
                                    <h4 class="title">Your Orders</h4>
                                    <?php
                                    $price = 0;
                                    $course_id = "";
                                    $selling_options = array();
                                    $course_name = "";

                                    foreach ($components as $component) {
                                        // echo $component;
                                        $checkout_sql = mysqli_query($con, "SELECT cart.*, course_detail.title, course_detail.id as checkout_course_id FROM cart JOIN course_detail ON cart.course_hash_id=course_detail.hash_id WHERE cart.hash_id='$component' ");
                                        while ($check_row = mysqli_fetch_assoc($checkout_sql)) {
                                            $course_id .= $check_row['course_id'] . ",";
                                            $selling_options[$check_row['title']] = stringToArray($check_row['array']);
                                            // echo $selling_options; 

                                            $cart_hash_id = $check_row['hash_id'] . ",";
                                            $course_name .= $check_row['title'] . ", "; ?>
                                            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                                            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                                            <p style="color: #1ab69d;margin-bottom:0;font-weight:bolder;" class="my-5"><?php echo course($con, $check_row['checkout_course_id']); ?></p>
                                            <table class="table summery-table">
                                                <tbody>
                                                    <?php
                                                    $array = stringToArray($check_row['array']);
                                                    $discount = extractKeys($array, '/\(Save \$(\d+)\)/');
                                                    foreach ($array as $key => $value) {
                                                        $price += $value; ?>

                                                        <tr id="tr_price">
                                                            <td style="font-weight: 100;"><?php echo $key; ?></td>
                                                            <td>$<?php echo $value; ?></td>
                                                        </tr>

                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                    <?php }
                                    }
                                    $course_id = rtrim($course_id, ',');
                                    $cart_hash_id = rtrim($cart_hash_id, ',');
                                    $course_name = rtrim($course_name, ', ');
                                     ?>
                                    <input type="hidden" name="selling_options" id="selling_options" value="<?php echo arrayToString($selling_options); ?>">
                                    <input type="hidden" name="course_id" id="course_id" value="<?php echo $course_id; ?>">
                                    <table class="table summery-table">
                                        <tbody>
                                            <tr class="order-subtotal">
                                                <td>Sub Total</td>
                                                <td class="text-danger" style="font-weight:bold;">$<?php echo $price;
                                                                                                    $price -= $coupon; ?></td>
                                            </tr>
                                            <tr class="order-subtotal">
                                                <td>Coupon Applied</td>
                                                <td id="sub_total">$0</td>
                                            </tr>
                                            <tr class="order-total">
                                                <td>Order Total</td>
                                                <td id="order_total" class="text-success">$<?php echo $price; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                            $ord_id = generateorder();
                            ?>
                            <input type="hidden" name="cart_hash_id" id="cart_hash_id" value="<?php echo $cart_hash_id; ?>">
                            <input type="hidden" name="coupon_price" id="coupon_price">
                            <input type="hidden" name="type" value="checkout">
                            <input type="hidden" name="business" value="<?php echo PAYPAL_ID; ?>">
                            <input type="hidden" name="item_name" value="<?php echo $course_name ?>" />
                            <input type="hidden" id="item_name" />
                            <input type="hidden" name="item_number" id="order_id" value='<?php echo $ord_id; ?>'>
                            <input type="hidden" name="amount" id="course_price" value="<?php echo $price ?>">
                            <input type="hidden" name="currency_code" id="currency_code" value="<?php echo PAYPAL_CURRENCY; ?>">
                            <input type="hidden" name="no_shipping" value="1">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="return" value="<?php echo PAYPAL_RETURN_URL; ?>">
                            <input type="hidden" name="cancel_return" value="<?php echo PAYPAL_CANCEL_URL; ?>">
                            <div class="order-payment">
                                <h4 class="title">Payment</h4>
                                <div class="payment-method" style="padding: 30px 30px;">
                                    <div class="form-group">
                                        <div class="edu-form-check">
                                            <input type="radio" id="pay-bank" name="payment">
                                            <label for="pay-bank">Debit & Credit Cards</label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="edu-form-check">
                                            <input type="radio" id="pay-pal" name="payment" checked>
                                            <label for="pay-pal">Pay with PayPal</label>
                                        </div>
                                    </div>
                                </div>
                                <div id="submitContainer"></div>
                                <?php if (!empty($_SESSION['email']) && !empty($_SESSION['password'])) { ?>
                                    <button type='submit' class='edu-btn order-place w-100' id='submitButton'>Place Your order</button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <?php include "footer.php" ?>

    </div>
    <div class="rn-progress-parent">
        <svg class="rn-back-circle svg-inner" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

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
        <?php if (empty($_SESSION['email']) && empty($_SESSION['password'])) { ?>
            $(document).ready(function() {
                $("#email").keyup(function() {
                    checkEmail();
                });
            });

            function checkEmail() {
                var email = $("#email").val();
                var submit_here = "<button type='submit' class='edu-btn order-place w-100' id='submitButton' >Place Your order</button>"
                console.log(submit_here);
                $.ajax({
                    type: "POST",
                    url: "check_email.php",
                    data: {
                        email: email
                    },
                    success: function(response) {
                        if (response.trim() === "<label class='text-danger'>Email already exists. <a href='login.php'>Login Here?</label>") {
                            $("#result123").html(response);
                            $("#submitContainer").html("<a href='login.php' class='edu-btn order-place w-100'>Login</a><label class='text-danger'>Email already exists. You need to login first.</label>");
                        } else {
                            $("#result123").html(response);
                            $("#submitContainer").html(submit_here);
                        }
                    }

                });
            }
        <?php } ?>

        $(document).ready(function() {
            // Attach an event listener to input fields and the select dropdown
            $('input, select').on('input change', function() {
                var fname = $("#fname").val();
                var lname = $('#lname').val();
                var email = $('#email').val();
                var hash_id = $('#cart_hash_id').val();
                var number = $('#number').val();
                var address = $('#address1').val().replace(/'/g, '`');
                var address2 = $('#address2').val().replace(/'/g, '`');
                var order_id = $('#order_id').val();
                var state = $('#state').val().replace(/'/g, '`');
                var pin_code = $('#pin_code').val();
                var course_id = $('#course_id').val().replace(/'/g, '`');
                var city = $('#city').val().replace(/'/g, '`');
                var amount = $('#course_price').val();
                var coupon_price = $('#coupon_price').val();
                var couponCode = $('#couponCode').val();
                var selling_options = $('#selling_options').val();
                var company_name = $('#company_name').val().replace(/'/g, '`');
                var job_profile = $('#job_profile').val().replace(/'/g, '`');
                var country = $('#country').val();

                // $('#curreny_code').val(curreny_code);
                $.ajax({
                    type: "POST",
                    url: "save_session.php",
                    data: {
                        fname: fname,
                        lname: lname,
                        email: email,
                        hash_id: hash_id,
                        number: number,
                        address: address,
                        address2: address2,
                        order_id: order_id,
                        state: state,
                        pin_code: pin_code,
                        course_id: course_id,
                        couponCode: couponCode,
                        city: city,
                        amount: amount,
                        coupon_price: coupon_price,
                        selling_options: selling_options,
                        company_name: company_name,
                        job_profile: job_profile,
                        country: country
                    },
                    success: function(response) {
                        console.log(response); // Output the response from the server
                    },
                    error: function(error) {
                        console.error("Error:", error);
                    }
                });
            });
        });


        function applyCoupon() {
            var couponCode = $('#couponCode').val();

            $.ajax({
                type: 'POST',
                url: 'coupon_ajax.php',
                data: {
                    coupon_code: couponCode
                },
                dataType: 'json', // Expecting JSON response
                success: function(response) {
                    if (response.couponPrice !== "0") {
                        // Update the coupon statement
                        if (response.statement == "Coupon applied successfully!") {
                            var text = "success";
                        } else {
                            var text = "danger";
                        }
                        $('#result').html("<label class='text-" + text + "'>" + response.statement + "</label>");

                        // Update the coupon subtotal
                        $('#sub_total').text('$' + response.couponPrice);

                        // Update the order total
                        var originalTotal = parseFloat('<?php echo $price; ?>');
                        var newTotal = originalTotal - parseFloat(response.couponPrice);
                        $('#order_total').text('$' + newTotal.toFixed(2));
                        var newTotal = parseFloat($('#order_total').text().replace('$', ''));
                        $('#course_price').val(newTotal.toFixed(2));
                        $('#coupon_price').val(response.couponPrice);

                    } else {
                        console.log(response);
                    }
                },
                error: function(error) {
                    console.log(error);
                    $('#result').html("<label class='text-danger'><strong>Invalid</strong> coupon code. Please try again.</label>");
                }
            });
        }


        function updateTotalPrice(couponPrice) {
            // Update the total price dynamically based on the received coupon price
            var totalPrice = <?php echo $price; ?>; // Fetch the initial total price from PHP
            totalPrice -= couponPrice; // Apply the coupon discount

            // Update the displayed total price on the webpage
            $('#orderTotal').text('$' + totalPrice);
        }


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

        $(document).ready(function() {
            $("#checkout_form").submit(function(e) {
                e.preventDefault(); // Prevent the default form submission

                $.ajax({
                    url: "signin_ajax.php",
                    method: "POST",
                    data: $(this).serialize(),
                    success: function(data) {
                        console.log(data);
                        // if (data == "0") {
                        //     Swal.fire('Success!', 'Your message has been submitted.', 'success');
                        // } else {
                        //     Swal.fire('Error!', 'Please try again. Your form was not submitted.', 'error');
                        // }
                    },
                    error: function(error) {
                        console.log(error);
                        // Swal.fire('Error!', 'Something went wrong. Please try again later.', 'error');
                    }
                });
            });
        });
    </script>

</body>

</html>
<?php
include 'connect.php';
include 'functions.php';

ob_start();


if (!empty($_SESSION['s_fname'])) {

	$fname = mysqli_real_escape_string($con,$_SESSION['s_fname']);
	$lname = mysqli_real_escape_string($con,$_SESSION['s_lname']);
	$email = mysqli_real_escape_string($con,$_SESSION['s_email']);
	$cart_hash_id = mysqli_real_escape_string($con,$_SESSION['s_hash_id']);
	$number = mysqli_real_escape_string($con,$_SESSION['s_number']);
	$address = mysqli_real_escape_string($con,$_SESSION['s_address']);
	$address2 = mysqli_real_escape_string($con,$_SESSION['s_address2']);
	$order_id =mysqli_real_escape_string($con, $_SESSION['s_order_id']);
	$state = mysqli_real_escape_string($con,$_SESSION['s_state']);
	$pin_code = mysqli_real_escape_string($con,$_SESSION['s_pin_code']);
	$course_id = mysqli_real_escape_string($con,$_SESSION['s_course_id']);
	$city = mysqli_real_escape_string($con,$_SESSION['s_city']);
	$amount = mysqli_real_escape_string($con,$_SESSION['s_amount']);
	$couponCode = mysqli_real_escape_string($con,$_SESSION['s_couponCode']);
	$coupon_price = mysqli_real_escape_string($con,$_SESSION['s_coupon_price']);
	$selling_options = mysqli_real_escape_string($con,$_SESSION['s_selling_options']);
	$company_name = mysqli_real_escape_string($con,$_SESSION['s_company_name']);
	$job_profile = mysqli_real_escape_string($con,$_SESSION['s_job_profile']);
	$country = mysqli_real_escape_string($con,$_SESSION['s_country']);
	
	$num_sql = mysqli_query($con, "SELECT id FROM order_details WHERE cart_hash_id='$cart_hash_id' ");
    if(mysqli_num_rows($num_sql)>=1){
        header("Location: index");
    }

	$cart_hash_id1 = $cart_hash_id;
	$user_id = username();
	$password = password();
	$datetime = date("Y-m-d H:i:s");
	$hash_id1 = random($email);

	$link = "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	$session_array="[$fname,$lname,$email,$cart_hash_id,$number,$address,$address2,$order_id,$state,$pin_code,$course_id,$city,$amount,$coupon_price,$selling_options,$company_name,$job_profile,$country]";
	
	mysqli_query($con, "INSERT INTO rawdata (raw,link) VALUES ('$session_array','$link') ");
	

	
	$insert = "INSERT INTO user_info (email,country,number,city,pin_code,course_id,address2,company_name,job_profile, state, name, user_id, password, datetime, hash_id,address) VALUES ('$email','$country','$number','$city','$pin_code','$course_id','$address2','$company_name','$job_profile', '$state', '$fname $lname', '$user_id', '$password', '$datetime','$hash_id1','$address');";

	$update = "UPDATE user_info SET country='$country',number='$number',city='$city',pin_code='$pin_code',course_id='$course_id',address2='$address2',company_name='$company_name',job_profile='$job_profile', state='$state', name='$fname $lname', address='$address' WHERE email='$email' ;";


	if (!empty($couponCode) && !empty($coupon_price)) {
		mysqli_query($con, "UPDATE sales_promotion_coupon SET coupons_limit=coupons_limit-1 WHERE coupon_code='$couponCode' ");
	}


	$payment_status = $_GET['payment_status'];
	$amount = $_GET['amt'];
	$PayerID = $_GET['PayerID'];
	$txn_id = $_GET['tx'];
	$cc = $_GET['cc'];
	$payer_email = $_GET['payer_email'];
	$payment_fee = $_GET['payment_fee'];
	$payment_gross = $_GET['payment_gross'];
	$payment_type = $_GET['payment_type'];
	$handling_amount = $_GET['handling_amount'];
	$shipping = $_GET['shipping'];
	$txn_type = $_GET['txn_type'];
	$payment_date = $_GET['payment_date'];
	$hash_id = random(date("Y-m-d H:i:s"));


	$user_info_sql = mysqli_query($con, "SELECT * FROM user_info WHERE email='$email' ");
	if (mysqli_num_rows($user_info_sql) > 0) {
		
		mysqli_query($con, $update);

	} else {
		
		sendemail($con, $email, $password);
		mysqli_query($con, $insert);

	}

	$user_sql = mysqli_query($con, "SELECT id FROM user_info WHERE email='$email' ");
	$user_row = mysqli_fetch_assoc($user_sql);

	$order_sql = "INSERT INTO order_details (
  user_id, course_id, order_id, amount, 
  PayerID, payment_status, selling_options, 
  txn_id, cc, payer_email, payment_fee, 
  payment_gross, payment_type, handling_amount, 
  shipping, txn_type, payment_date, 
  hash_id, name, address, coupon_discount, 
  cart_hash_id
) 
VALUES 
  (
    '" . $user_row['id'] . "', '$course_id', 
    '$order_id', '$amount', '$PayerID', 
    '$payment_status', '" . $selling_options . "', 
    '$txn_id', '$cc', '$payer_email', 
    '$payment_fee', '$amount', '$payment_type', 
    '$handling_amount', '$shipping', 
    '$txn_type', '$payment_date', '$hash_id', 
    '$fname $lname', '$address', '$coupon_price', 
    '$cart_hash_id'
  ) ";

	$cart_hash_id = explode(',', $cart_hash_id);
	$cart_st = 0;
	foreach ($cart_hash_id as $cart_hash_id_element) {
		$cart_sql = mysqli_query($con, "SELECT cart_status FROM cart WHERE cart_status='1' AND hash_id='$cart_hash_id_element' ");
		if (mysqli_num_rows($cart_sql) > 0) {
			$cart_st++;
			mysqli_query($con, "UPDATE cart SET cart_status='1' AND user_id='$user_id' where hash_id='$cart_hash_id_element' AND cart_status='0' ");
		}
	}
// 	if ($cart_st > 0) {
		mysqli_query($con, $order_sql);
		order_email($con, $cart_hash_id1, $email);
		// echo $order_sql;
// 	}
    
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $password;
    $_SESSION['user_id'] = user_last_id($con);
    $_SESSION['name'] = $fname." ".$lname;
    $_SESSION['hash_id'] = $hash_id1;
    
	unset($_SESSION['s_fname']);
	unset($_SESSION['s_lname']);
	unset($_SESSION['s_email']);
	unset($_SESSION['s_hash_id']);
	unset($_SESSION['s_number']);
	unset($_SESSION['s_address']);
	unset($_SESSION['s_address2']);
	unset($_SESSION['s_order_id']);
	unset($_SESSION['s_state']);
	unset($_SESSION['s_pin_code']);
	unset($_SESSION['s_course_id']);
	unset($_SESSION['s_city']);
	unset($_SESSION['s_amount']);
	unset($_SESSION['s_couponCode']);
	unset($_SESSION['s_coupon_price']);
	unset($_SESSION['s_selling_options']);
	unset($_SESSION['s_company_name']);
	unset($_SESSION['s_job_profile']);
	unset($_SESSION['s_country']);

	header("Location: https://ceuservices.com/payment-done?order_id=$cart_hash_id1");
	exit;
} else {
	header("Location: index");
}

ob_end_flush();

?>
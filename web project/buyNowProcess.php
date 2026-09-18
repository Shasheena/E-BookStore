<?php 
require "connection.php";
session_start();

if(isset($_SESSION["user"])){
    $email = $_SESSION["user"]["email"];
    $book_id = $_GET["id"];
    $qty = $_GET["qty"];

    $array;

    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'");
    $user_num = $user_rs->num_rows;

    $address_rs = Database::search("SELECT * FROM `address` WHERE `user_email` = '".$email."'");
    $address_num = $address_rs->num_rows;

    $order_id = uniqid();

    $book_rs = Database::search("SELECT * FROM `books` WHERE `book_id` = '".$book_id."'");
    $book_data = $book_rs->fetch_assoc();

    if($book_data["qty"]>=$qty){
        $address_data = $address_rs->fetch_assoc();
        $user_data = $user_rs->fetch_assoc();
        $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id` = '".$address_data["ci_id"]."'");
        $city_data = $city_rs->fetch_assoc();
        $district_rs = Database::search("SELECT * FROM `city` INNER JOIN `district` ON district.district_id = city.city_id WHERE
        city.city_id = '".$address_data["ci_id"]."'");
        $district_data = $district_rs->fetch_assoc();

        if($city_data["di_id"]==1){
            $d_fee = $book_data["delivery_fee_colombo"];
            $shipping = $book_data["shipping"];
            $price = $book_data["price"];
            $discount = $book_data["discount"];

            $d_value = $price / 100 * $discount;
            $new_total1 = $price - $d_value;
            $total = $d_fee + $shipping + $new_total1;
            $final_price = $total * $qty;
        }else{
            $d_fee = $book_data["delivery_fee_other"];
            $shipping = $book_data["shipping"];
            $price = $book_data["price"];
            $discount = $book_data["discount"];

            $d_value = $price / 100 * $discount;
            $new_total1 = $price - $d_value;
            $total = $d_fee + $shipping + $new_total1;
            $final_price = $total * $qty;
        }

        $merchant_id = 1221975;
        $merchant_secret = "MzQxNzY1NjIwNDEyMDQyODQwOTc2MTcxNTU2MzIxNjA3Mzg1Mzc3";
        $currency = "LKR";

        $hash = $merchant_id;
        $hash .= $order_id;
        $hash .= number_format($final_price, 2, '.', '');
        $hash .= $currency;
        $hash .= strtoupper(md5($merchant_secret));
        $hash = strtoupper(md5($hash));

      

        $fname = $user_data["fname"];
        $lname = $user_data["lname"];
        $line1 = $address_data["line1"];
        $line2 = $address_data["line2"];
        $title = $book_data["title"];
        $city = $city_data["city_name"];
        
        $array["fname"] = $fname;
        $array["lname"] = $lname;
        $array["line1"] = $line1;
        $array["line2"] = $line2;
        $array["title"] = $title;
        $array["city"] = $city;
        $array["id"] = $order_id;
        $array["email"] = $email;
        $array["book_id"] = $book_id;
        $array["amount"] = $final_price;
        $array["hash"] = $hash;

        echo json_encode($array);

        
        
        }else{
            echo("can't");
        }

   
}else{
    echo ("Sign in first!");
}




$hash = strtoupper(
    md5(
        $merchant_id . 
        $order_id . 
        number_format($final_price, 2, '.', '') . 
        $currency .  
        strtoupper(md5($merchant_secret)) 
    ) 
);
?>
                                                                
var num = 1;
function plus() {
    document.getElementById("num").value = num;
    num = num + 1;
    document.getElementById("num").innerHTML = parseInt(num) + 1;

}
function minus() {
    document.getElementById("num").value = num;
    num = num - 1;
    document.getElementById("num").innerHTML = parseInt(num) - 1;
    if (num <= 0) {
        num = 0;
    }

}
var num1;
var num2;
var price1;
var price;
var newPrice;
var newPrice1;
function Update() {
    document.getElementById("price").innerHTML = price;
    // price1 = parseInt(price);
    document.getElementById("num") = num1;
    // num2 = parseInt(num1);
    var newPrice = parseInt(num1) * parseInt(price);
    // var newPrice1 = toString(newPrice);
    if (num1 > 1) {
        document.getElementById("price").innerHTML = toString(newPrice);
    }


}
function newAccount() {
    var email = document.getElementById("email");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var password = document.getElementById("pw");
    var line1 = document.getElementById("line1");
    var line2 = document.getElementById("line2");
    var pc = document.getElementById("pc");
    var mobile = document.getElementById("mobile");
    var city = document.getElementById("city");

    var f = new FormData();
    f.append("e", email.value);
    f.append("f", fname.value);
    f.append("l", lname.value);
    f.append("p", password.value);
    f.append("l1", line1.value);
    f.append("l2", line2.value);
    f.append("pc", pc.value);
    f.append("mb", mobile.value);
    f.append("ci", city.value);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);

        }
    };
    r.open("POST", "newAccountProcess.php", true);
    r.send(f);
    // alert("ok");
}
function signIn() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("pw").value;
    var rememberme = document.getElementById("rememberMe").checked;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "index.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "signInProcess.php?e=" + email + "&p=" + password + "&rm=" + rememberme, true);
    r.send();
}
function forgotPasswordMd() {
    var modal = document.getElementById("fpm");
    var md = new bootstrap.Modal(modal);
    md.show();
}
function sendCode() {
    var email = document.getElementById("e").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                var modal = document.getElementById("fpm1");
                var md = new bootstrap.Modal(modal);
                md.show();
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "sendCodeProcess.php?e=" + email, true);
    r.send();
}
function verifyCode() {
    var code = document.getElementById("code").value;
    var pw = document.getElementById("password").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("successfully updated.");
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "VerifyCodeProcess.php?code=" + code + "&pw=" + pw, true);
    r.send();
}
function addToCart(i) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("successfully added.");
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "cartProcess.php?id=" + i, true);
    r.send();
    // alert(i);
}
function removeCart(c) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "removeCartProcess.php?id=" + c, true);
    r.send();
    // alert(c);
}
function updateQty(d) {
    var qty = document.getElementById("num").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Succefully updated");
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "updateCartQtyProcess.php?qty=" + qty + "&id=" + d, true);
    r.send();
}
function buyNow(id) {
    var qty = document.getElementById("qty").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            var obj = JSON.parse(t);

            if (t == "can't") {
                alert("Sorry!Your requsted quantity exceeded the limit");
            } else if (t == "Sign in first!") {
                alert(t);
            } else {
                // Payment completed. It can be a successful failure.
                payhere.onCompleted = function onCompleted(orderId) {
                    console.log("Payment completed. OrderID:" + orderId);
                    // Note: validate the payment and show success or failure page to the customer
                };

                // Payment window closed
                payhere.onDismissed = function onDismissed() {
                    // Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Error occurred
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1222112",    // Replace your Merchant ID
                    "return_url": "http://localhost/web%20project/singleView.php?id=" + id,     // Important
                    "cancel_url": "http://localhost/web%20project/singleView.php?id=" + id,     // Important
                    "notify_url": "http://sample.com/notify",
                    "order_id": obj["id"],
                    "items": obj["title"],
                    "amount": obj["amount"],
                    "currency": "LKR",
                    "first_name": obj["fname"],
                    "last_name": obj["lname"],
                    "email": obj["email"],
                    "phone": "",
                    "address": obj["line1"] + obj["line2"],
                    "city": obj["city"],
                    "country": "Sri Lanka",
                    "delivery_address": obj["line1"] + obj["line2"],
                    "delivery_city": obj["city"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };

                // Show the payhere.js popup, when "PayHere Pay" is clicked
                // document.getElementById('payhere-payment').onclick = function (e) {
                payhere.startPayment(payment);
                // };
            }

        }
    }

    r.open("GET", "buyNowProcess.php?qty=" + qty + "&id=" + id, true);
    r.send();

}
function updatingUser() {
    var email = document.getElementById("email").value;
    var line1 = document.getElementById("line1").value;
    var line2 = document.getElementById("line2").value;
    var pcode = document.getElementById("pcode").value;
    var city = document.getElementById("city").value;
    var mobile = document.getElementById("mb").value;

    var f = new FormData();
    f.append("e", email);
    f.append("l1", line1);
    f.append("l2", line2);
    f.append("pc", pcode);
    f.append("mb", mobile);
    f.append("ci", city);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }
        }
    };
    r.open("POST", "UpdateUserProfileProcess.php", true);
    r.send(f);
    // alert(email); alert(line1); alert(line2); alert(pcode); alert(city); alert(mobile);
}
function addToWishlist(g) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                alert("Succefully added");
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "addToWatchlistProcess.php?id=" + g, true);
    r.send();
    // alert(g);
}
function addToWishlist1(h) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "wishlist.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "addToWatchlist1Process.php?id=" + h, true);
    r.send();
}
function addToCart1(j) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "basket.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "cart1Process.php?id=" + j, true);
    r.send();
}
function removeWishlist(k) {
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location.reload();
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "removeWishlistProcess.php?id=" + k, true);
    r.send();
}
function adminSignUp() {
    var email = document.getElementById("email").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var pword = document.getElementById("pwd").value;
    var mobile = document.getElementById("mb").value;
    var vcode = document.getElementById("vc").value;

    var f = new FormData();
    f.append("e", email);
    f.append("f", fname);
    f.append("l", lname);
    f.append("pw", pword);
    f.append("mb", mobile);
    f.append("vc", vcode);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };
    r.open("POST", "adminSignUpProcess.php", true);
    r.send(f);

    // alert(email);alert(fname);alert(lname);alert(pword);alert(mobile);
}
function adminSignin() {
    var email = document.getElementById("email").value;
    var pword = document.getElementById("pwd").value;
    var rmb = document.getElementById("rmb").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                window.location = "adminHome.php";
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "adminSignInProcess.php?e=" + email + "&pw=" + pword + "&rmb=" + rmb, true);
    r.send();
    // alert(email);alert(pword);
}
function adminForgotPassword1() {
    var amdm = document.getElementById("fpmd1");
    var m = new bootstrap.Modal(amdm);
    m.show();
}
function adminNewPassword1() {
    var email = document.getElementById("e1").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if (t == "success") {
                var amdm1 = document.getElementById("fpmd2");
                var m1 = new bootstrap.Modal(amdm1);
                m1.show();
            } else {
                alert(t);
            }

        }
    };

    r.open("GET", "adminforgotPasswordProcess1.php?e=" + email, true);
    r.send();

    // alert(email);
}
function adminNewPassword2(){
    var vcode = document.getElementById("vc").value;
    var password = document.getElementById("p").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
           alert(t);
        }
    };

    r.open("GET", "adminforgotPasswordProcess2.php?vc=" + vcode + "&pw=" + password, true);
    r.send();
    // alert(vcode);alert(password);
}
function toggleButton(){
    var passwordType = document.getElementById("pwd").type;
    if(passwordType == "password"){
        document.getElementById("pwd").type = "text";
    }else{
        document.getElementById("pwd").type = "password";
    }
    // alert(passwordType);
}
function updatingAdmin(){
    var mobile = document.getElementById("mobile").value;

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if(t=="success"){
                window.location.reload();
            }else{
                document.getElementById("alertDiv").classList = "d-block";
                document.getElementById("alert").innerHTML = t;
            }
          
        }
    };

    r.open("GET", "updateAdminProcess.php?mb=" + mobile, true);
    r.send();
    // alert(mobile);
}
function updateAdminImage(){
    var files = document.getElementById("aImage").files;

    var f = new FormData();
   
    f.append("f", files[0]);

    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if(t=="success"){
                window.location.reload();
            }else{
                alert(t);
            }
            // alert(t);

        }
    };

    r.open("POST", "updateAdminImgProcess.php", true);
    r.send(f);
    // alert(img[0]);
}
function removeAdminImage(){
    var r = new XMLHttpRequest();
    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if(t=="success"){
                window.location.reload();
            }else{
                alert(t);
            }
          
        }
    };

    r.open("GET", "removeAdminProcess.php", true);
    r.send();
}
function printInvoice(){
    var invoice = document.getElementById("invoice").innerHTML;
    var currentBody = document.body.innerHTML;
    document.body.innerHTML = invoice;
    window.print();
    document.body.innerHTML = currentBody;
}
function viewImg(){
    var img = document.getElementById("img");
    
        var length1 = img.files.length;

        if(length1>0){
            var f = img.files[0];
            var url = window.URL.createObjectURL(f);
            document.getElementById("book_img").src = url;
            // alert("ok");
        }else{
            alert("Choose a file");
        }
        
    
    // alert(length1);
    
}
function addProducts(){
    var title = document.getElementById("title").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var ct = document.getElementById("ct").value;
    var copy = document.getElementById("copy").value;
    var cg = document.getElementById("cg").value;
    var usage = document.getElementById("usage").value;
    var qty = document.getElementById("qty").value;
    var price = document.getElementById("price").value;
    var shipping = document.getElementById("shipping").value;
    var dfc = document.getElementById("dfc").value;
    var dfo = document.getElementById("dfo").value;
    var publisher = document.getElementById("pbl").value;
    var discount = document.getElementById("dsc").value;
    var seller = document.getElementById("seller").value;
    var image = document.getElementById("img");

    if(image.files.length>0){
        var image1 = document.getElementById("img").files[0];
    }else{
        echo("Choose a file");
    }

    var f = new FormData();

    f.append("title", title);
    f.append("fname", fname);
    f.append("lname", lname);
    f.append("ct", ct);
    f.append("cg", cg);
    f.append("usage", usage);
    f.append("qty", qty);
    f.append("price", price);
    f.append("shipping", shipping);
    f.append("copy", copy);
    f.append("dfc", dfc);
    f.append("dfo", dfo);
    f.append("dsc", discount);
    f.append("pbl", publisher);
    f.append("image", image1);
    f.append("seller", seller);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if(t=="success"){
                window.location.reload();
            }else{
                alert(t);
            }
           
        }
    };

    r.open("POST", "addProductProcess.php", true);
    r.send(f);

}
function uploadPdf(){
    var scopy = document.getElementById("s_copy");
    var title = document.getElementById("title").value;
    var fname = document.getElementById("fname").value;
    var lname = document.getElementById("lname").value;
    var copy = document.getElementById("copy").value;
    var cg = document.getElementById("cg").value;
    var usage = document.getElementById("usage").value;
    var price = document.getElementById("price").value;
    var publisher = document.getElementById("pbl").value;
    var discount = document.getElementById("dsc").value;
    var image = document.getElementById("img");

    if(scopy.files.length>0){
        var scopy1 = document.getElementById("s_copy").files[0];
    }else{
        echo("Choose a file");
    }

    if(image.files.length>0){
        var image1 = document.getElementById("img").files[0];
    }else{
        echo("Choose a file");
    }

    var f = new FormData();
    f.append("scopy", scopy1);
    f.append("title", title);
    f.append("fname", fname);
    f.append("lname", lname);
    f.append("cg", cg);
    f.append("usage", usage);
    f.append("price", price);
    f.append("copy", copy);
    f.append("pbl", publisher);
    f.append("dsc", discount);
    f.append("image", image1);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if(t=="success"){
                window.location.reload();
            }else{
                alert(t);
            }
           
        }
    };

    r.open("POST", "uploadPdfProcess.php", true);
    r.send(f);
}
function remove(id){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState==4){
         var t = r.responseText;
         if(t=="success"){
            window.location.reload();
         }else{
            alert(t);
         }
        }
    };

    r.open("GET", "adminRemoveBookProcess.php?id=" + id, true);
    r.send();
//    alert(id);
    
}
function adminRemoveAllBooks(){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState==4){
         var t = r.responseText;
         if(t=="success"){
            window.location.reload();
         }else{
            alert(t);
         }
        }
    };

    r.open("GET", "adminRemoveAllBooksProcess.php", true);
    r.send();
    // alert("ok");
}
function adminSeachBooks(){
    var category_id = document.getElementById("ctgy").value;
    var title = document.getElementById("title").value;
    var au = document.getElementById("au").value;

    var f = new FormData();

    f.append("c_id", category_id);
    f.append("title", title);
    f.append("au", au);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            document.getElementById("return").innerHTML = t;
        }
    };

    r.open("POST", "adminSearchBooksProcess.php", true);
    r.send(f);

    // alert("ok");
}
function adminSearch(){
    var name = document.getElementById("name").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState==4){
         var t = r.responseText;
         document.getElementById("search_result").innerHTML = t;
        
        }
    };

    r.open("GET", "adminSearchProcess.php?n="+name, true);
    r.send();
}
// function inactivateAdmin(){
//     var email = document.getElementById("email").value;

//     var r = new XMLHttpRequest();

//     r.onreadystatechange = function (){
//         if(r.readyState==4){
//          var t = r.responseText;
//          if(t=="success"){
//             window.location.reload();
//          }else{
//             alert(t);
//          }
//         }
//     };

//     r.open("GET", "adminInactivateProcess.php?e="+email, true);
//     r.send();
// }
// function activateAdmin(){
//     var email = document.getElementById("email1").value;

//     var r = new XMLHttpRequest();

//     r.onreadystatechange = function (){
//         if(r.readyState==4){
//          var t = r.responseText;
//          if(t=="success"){
//             window.location.reload();
//          }else{
//             alert(t);
//          }
//         }
//     };

//     r.open("GET", "adminActivateProcess.php?e="+email, true);
//     r.send();
// }
function removeAdmin(){
    var email = document.getElementById("email2").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState==4){
         var t = r.responseText;
         if(t=="success"){
            window.location.reload();
         }else{
            alert(t);
         }
        }
    };

    r.open("GET", "adminRemoveProcess.php?e="+email, true);
    r.send();
}
function InviteAdmin(){
    var email = document.getElementById("email3").value;

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState==4){
         var t = r.responseText;
         alert(t);
        }
    };

    r.open("GET", "adminInviteProcess.php?e="+email, true);
    r.send();
}
function editProducts(id){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState==4){
         var t = r.responseText;
        document.getElementById("return").innerHTML = t;
        }
    };

    r.open("GET", "editPoductsProcess1.php?id="+id, true);
    r.send();
}
function update1(id){
    var qty = document.getElementById("qty").value;
    var price = document.getElementById("price").value;
    var shipping = document.getElementById("shipping").value;
    var dfc = document.getElementById("dfc").value;
    var dfo = document.getElementById("dfo").value;
    var dsc = document.getElementById("dsc").value;

    var f = new FormData();

    f.append("id", id);
    f.append("qty", qty);
    f.append("prc", price);
    f.append("shipng", shipping);
    f.append("dfc", dfc);
    f.append("dfo", dfo);
    f.append("dsc", dsc);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };

    r.open("POST", "Update1BooksProcess.php", true);
    r.send(f);
}
function update2(ids2){
    var price = document.getElementById("price").value;
    var dsc = document.getElementById("dsc").value;

    var f = new FormData();

    f.append("id", ids2);
    f.append("prc", price);
    f.append("dsc", dsc);
 
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            alert(t);
        }
    };

    r.open("POST", "Update2BooksProcess.php", true);
    r.send(f);
}
function ChangeProImg(){
    var view = document.getElementById("viewImg");
    var file = document.getElementById("S_profileImg");

    file.onchange = function(){
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}


function updateStudentProfile(){
    var name = document.getElementById("usn");
    var mobile = document.getElementById("usm");
    var pass= document.getElementById("usp");
    var img = document.getElementById("S_profileImg");

    var f = new FormData();
    f.append("n",name.value);
    f.append("m",mobile.value);
    f.append("p",pass.value);
    f.append("i",img.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            alert(t);
            }
    };

    r.open("POST","./updateStudentProfile.php",true);
    r.send(f); 
    }


//payment
function studentpay(sub,fees){

    var f = new FormData();
    f.append("s",sub);
    f.append("f",fees);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if (r.readyState == 4) {
         var t = r.responseText;

        var obj = JSON.parse(t);

        var fees1=obj["fees"];
        var subId =obj["sub_id"];
        var T_id =obj["teacherId"];
        var T_name =obj["teacherName"];
        var T_sub =obj["teacherSub"];
        var S_id = obj["student_id"];
        var S_name = obj["student_name"];
        var S_email = obj["student_email"];
        var S_nic = obj["student_nic"];
        var S_mobile = obj["student_mobile"];


// Payment completed. It can be a successful failure.
payhere.onCompleted = function onCompleted(orderId) {
    console.log("Payment completed. OrderID:" + orderId);
    updatePaymemt(subId,T_id,fees1);
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
    console.log("Error:"  + error);
};

// Put the payment variables here
var payment = {
    "sandbox": true,
    "merchant_id": "1221550",    // Replace your Merchant ID
    "return_url": "http://localhost/Notes/student/student.php",     // Important
    "cancel_url": "http://localhost/Notes/student/student.php",     // Important
    "notify_url": "http://sample.com/notify",
    "order_id": T_sub+" -"+S_nic,
    "items": "Class Fees - " + T_sub +" Techer name "+T_name ,
    "amount": fees1,
    "currency": "LKR",
    "first_name": "id-"+S_id+" name- "+S_name,
    "last_name": "",
    "email": S_email,
    "phone": S_mobile ,
    "address": "",
    "city": "",
    "country": "Sri Lanka",
    "delivery_address": "",
    "delivery_city": "",
    "delivery_country": "",
    "custom_1":"",
    "custom_2": ""
};

// Show the payhere.js popup, when "PayHere Pay" is clicked
//document.getElementById('payhere-payment').onclick = function (e) {
    payhere.startPayment(payment);
//};

        }
    };

     
    r.open("POST","./studentpaymentProcess.php",true);
    r.send(f);
}



//lesson
function LessonLink(link,assi,less,mark){
    var frame = document.getElementById("ClassIframe");
    var pdf = document.getElementById("ClassAssignment");
    var name = document.getElementById("lessName");
    var div = document.getElementById("assi_download");
    var AssMark = document.getElementById("Assmark");
    
    frame.src = link;
    pdf.href = assi;
    div.className ="d-flex flex-md-row flex-column d-block my-4 mx-auto";
    name.innerHTML = less;
    AssMark.innerHTML = mark;
}

function signout(){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t == "done"){
                window.location = "../index.php";
            }else{
                alert (t);
            }
        }
    };

    r.open("GET","studentsignoutProcess.php",true);
    r.send(); 
}


function UploadAssignment(subid){
    var pdf = document.getElementById("assignmentUp");
    var lanme = document.getElementById("lessName").innerHTML;

    var f = new FormData();
    f.append("s",subid);
    f.append("l",lanme);
    f.append("p",pdf.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            alert(t);
            }
    };

    r.open("POST","./uploadAssignment.php",true);
    r.send(f); 

    
}


function updatePaymemt(subId,T_id,fees1){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function () {
        if (r.readyState == 4) {
            var t = r.responseText;
            if(t=="success"){
                window.location = "./invoice.php?subId="+subId+"&tId="+T_id+"&fees="+fees1;
            }else{
                alert(t);
            }
        }
    }
    r.open("GET", "./updatestudentPayment.php?subId="+subId, true);
    r.send();
}


/*invoice page */
function printInvoice(){
    var restorepage = document.body.innerHTML;
    var page = document.getElementById("invoice").innerHTML;
    document.body.innerHTML = page;
    window.print();
    document.body.innerHTML = restorepage;
}
//admin login
function Adminsignup(){
    var email = document.getElementById("ade").value;
    var pass = document.getElementById("adp").value;
    var rem = document.getElementById("adreM");

    var f = new FormData();
    f.append("e",email);
    f.append("p",pass);
    f.append("r",rem.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
            if(t=="done"){
                window.location = "./admin/admin.php";
            }else{
                alert(t);
            }
        }
    }
    r.open("POST","./adminsignInProccess.php",true);
    r.send(f);
}

// student login
function Studentsignup(){
    var email = document.getElementById("ste").value;
    var code = document.getElementById("stvcode").value;
    var pass = document.getElementById("stp").value;
    var rem = document.getElementById("streM");

    var f = new FormData();
    f.append("e",email);
    f.append("c",code);
    f.append("p",pass);
    f.append("r",rem.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
            if(t=="done"){
                window.location = "./student/student.php";
            }else{
                alert(t);
            }
        }
    }
    r.open("POST","./studentsignInProccess.php",true);
    r.send(f);
}

//teachers login
function Teachersignup(){
    var email = document.getElementById("ten").value;
    var code = document.getElementById("Tevcode").value;
    var pass = document.getElementById("tep").value;
    var rem = document.getElementById("Terem");

    var f = new FormData();
    f.append("e",email);
    f.append("c",code);
    f.append("p",pass);
    f.append("r",rem.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
            if(t=="done"){
                window.location = "./Teachers/Teacher.php";
            }else{
                alert(t);
            }
        }
    }
    r.open("POST","./teachersignInProccess.php",true);
    r.send(f);
}

function TeEmail(event){
    var VcodeDiv = document.getElementById("VcodeDiv");

    var f = new FormData();
    f.append("e",event.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
           if(t=="no"){
            VcodeDiv.style.display = "none";
           }else{
            VcodeDiv.style.display = "block";
           }
        }
    }
    r.open("POST","./teacherVcodeProccess.php",true);
    r.send(f);
}

//academic officer sign in 
function AcOffsignup(){
    var email = document.getElementById("ace").value;
    var code = document.getElementById("acv").value;
    var pass = document.getElementById("acp").value;
    var rem = document.getElementById("acRem");

    var f = new FormData();
    f.append("e",email);
    f.append("c",code);
    f.append("p",pass);
    f.append("r",rem.checked);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
            if(t=="done"){
                window.location = "./AcademicOfficer/academicOfficer.php";
            }else{
                alert(t);
            }
        }
    }
    r.open("POST","./acOfficersignInProccess.php",true);
    r.send(f);
}

function AcEmail(event){
    var VcodeDiv = document.getElementById("VcodeDivAc");

    var f = new FormData();
    f.append("e",event.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
           if(t=="no"){
            VcodeDiv.style.display = "none";
           }else{
            VcodeDiv.style.display = "block";
           }
        }
    }
    r.open("POST","./AcOfficerVcodeProccess.php",true);
    r.send(f);
}
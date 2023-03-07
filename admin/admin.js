//login model
var rl
function CheckResult(){
    var m = document.getElementById("checkResult");
    rl = new bootstrap.Modal(m);
    rl.show();
}

var tu
function dd(){
    var m = document.getElementById("TecherUpdate");
    tu = new bootstrap.Modal(m);
    tu.show();
}


//teacher reg
function TeacherSignup(){
    var name = document.getElementById("tn");
    var nic = document.getElementById("tnic");
    var mobile = document.getElementById("tm");
    var email = document.getElementById("te");
    var stream = document.getElementById("tstm");
    var sub = document.getElementById("tsub");
    var gender = document.getElementById("tg");
    var pass = document.getElementById("tp");

    var f = new FormData();
    f.append("n",name.value);
    f.append("nic",nic.value);
    f.append("mob",mobile.value);
    f.append("e",email.value);
    f.append("stm",stream.value);
    f.append("sub",sub.value);
    f.append("gen",gender.value);
    f.append("pass",pass.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
                alert(t);
        }
    }
    r.open("POST","./teacherRegProccess.php",true);
    r.send(f);
}


// academic officer reg
function AcOfficerSignup(){
    var name = document.getElementById("acn");
    var nic = document.getElementById("acnic");
    var mobile = document.getElementById("acm");
    var email = document.getElementById("ace");
    var gender = document.getElementById("acg");
    var pass = document.getElementById("acp");

    var f = new FormData();
    f.append("n",name.value);
    f.append("nic",nic.value);
    f.append("mob",mobile.value);
    f.append("e",email.value);
    f.append("gen",gender.value);
    f.append("pass",pass.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
                alert(t);
        }
    }
    r.open("POST","./acOfficerRegProccess.php",true);
    r.send(f);
}


function adminLogOut(){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
                if(t=="done"){
                    window.location="../adminsignIn.php";
                }else{
                    alert(t);
                }
        }
    }

    r.open("GET","./AdminSignOutProccess.php" ,true);
    r.send();
}


function stSearch(){
    var stSearch = document.getElementById("stSearch").value;

    var f = new FormData();
    f.append("s",stSearch);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            document.getElementById("table").innerHTML = t;
            }
    };

    r.open("POST","./adstudentSearch.php",true);
    r.send(f); 
}


function deleteStudent(sid){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t=="deleted"){
                window.location.reload();
            }else{
            alert (t);
            }
            
        }
    };

    r.open("GET","adDeleteStudent.php?sid="+sid,true);
    r.send();
}

function deleteTeacher(tid){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t=="deleted"){
                window.location.reload();
            }else{
            alert (t);
            }

        }
    };

    r.open("GET","adDeleteteacher.php?tid="+tid,true);
    r.send();
}

function deleteAccOfficer(aid){
   var r = new XMLHttpRequest();

   r.onreadystatechange = function (){
       if(r.readyState == 4){
           var t = r.responseText;
           if(t=="deleted"){
               window.location.reload();
           }else{
           alert (t);
           }
           
       }
   };

   r.open("GET","adDeleteAccofficer.php?aid="+aid,true);
   r.send();
}
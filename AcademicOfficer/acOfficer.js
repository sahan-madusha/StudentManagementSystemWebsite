function StudentSignup(){
    var name   = document.getElementById("sn");
    var nic    = document.getElementById("snic");
    var mobile = document.getElementById("sm");
    var email  = document.getElementById("se");
    var gender = document.getElementById("sg");
    var stream = document.getElementById("sstrm");
    var grade  = document.getElementById("sgrd");
    var sub1  = document.getElementById("ssbjct1");
    var sub2  = document.getElementById("ssbjct2");
    var sub3  = document.getElementById("ssbjct3");
    var pass  = document.getElementById("sp");


    var f = new FormData();
    f.append("n",name.value);
    f.append("nic",nic.value);
    f.append("mob",mobile.value);
    f.append("e",email.value);
    f.append("gen",gender.value)
    f.append("stm",stream.value);
    f.append("grd",grade.value);
    f.append("sub1",sub1.value);
    f.append("sub2",sub2.value);
    f.append("sub3",sub3.value);
    f.append("pass",pass.value);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
                alert(t);
        }
    }
    r.open("POST","./studentRegProccess.php",true);
    r.send(f);
}

function acOffLogOut(){
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

    r.open("GET","AccOfficersignoutProcess.php",true);
    r.send();
}

function ChangeProImg(){
    var view = document.getElementById("viewImg");
    var file = document.getElementById("Ac_profileImg");

    file.onchange = function(){
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}


function updateAccOfficerProfile(){
    var name = document.getElementById("usn");
    var mobile = document.getElementById("usm");
    var pass= document.getElementById("usp");
    var img = document.getElementById("Ac_profileImg");

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

    r.open("POST","./updateAccofficerProfile.php",true);
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

    r.open("GET","DeleteStudent.php?sid="+sid,true);
    r.send();
}

function updateGade(){
    var cgrdId = document.getElementById("cgrdId").value;
    var ugrdId = document.getElementById("ugrdId").value;
    var mark = document.getElementById("mark").value;
    
    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t=="1"){
                alert("please enter mark");
            }else if(t=="2"){
                alert("invalied input");
            }else{
                alert("done");
            }
            
        }
    };

    r.open("GET","gradeUp.php?cg="+cgrdId+"&ug="+ugrdId+"&m="+mark,true);
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

    r.open("POST","./studentSearch.php",true);
    r.send(f); 
}
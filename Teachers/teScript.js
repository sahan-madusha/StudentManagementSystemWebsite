function UploadLesson(){
    var grade = document.getElementById("TeGrd").value;
    var lesson = document.getElementById("Teless").value;
    var link = document.getElementById("Telink").value;
    var assi = document.getElementById("assignmentAdd");

    if(grade=="0"){
        alert("Please select grade");
    }else{
    var f = new FormData();
    f.append("g",grade);
    f.append("le",lesson);
    f.append("li",link);
    f.append("as",assi.files[0]);


    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            if(t=="upload"){
                window.location.reload();
            }else{
            alert(t);
            }
            }
    };

    r.open("POST","./uploadTeacherAssignment.php",true);
    r.send(f); 
    }
}


function ChangeProImg(){
    var view = document.getElementById("viewImg");
    var file = document.getElementById("Te_profileImg");

    file.onchange = function(){
        var file1 = this.files[0];
        var url = window.URL.createObjectURL(file1);
        view.src = url;
    }
}

function updateTechersProfile(){
    var name = document.getElementById("utn");
    var mobile = document.getElementById("utm");
    var fees= document.getElementById("uclzfees");
    var pass= document.getElementById("utp");
    var img = document.getElementById("Te_profileImg");

    var f = new FormData();
    f.append("n",name.value);
    f.append("m",mobile.value);
    f.append("f",fees.value);
    f.append("p",pass.value);
    f.append("i",img.files[0]);

    var r = new XMLHttpRequest();

    r.onreadystatechange = function (){
        if(r.readyState == 4){
            var t = r.responseText;
            alert(t);
            }
    };

    r.open("POST","./updateTeacherProfile.php",true);
    r.send(f); 
}
    



function addMark(aId,sId){
    var mark = document.getElementById("Assimark").value;
   
   var f = new FormData();
   f.append("sid",sId);
   f.append("assi",aId);
   f.append("mark",mark);

   var r = new XMLHttpRequest();

   r.onreadystatechange = function (){
       if(r.readyState == 4){
           var t = r.responseText;
           alert(t);
           }
   };

   r.open("POST","./AddAssignmentMark.php",true);
   r.send(f); 
}



function TeacherLogOut(){
    var r = new XMLHttpRequest();

    r.onreadystatechange = function(){
        if(r.readyState==4){
            var t = r.responseText;
                if(t=="done"){
                    window.location="../teacherSignIn.php";
                }else{
                    alert(t);
                }
        }
    }

    r.open("GET","./TeacherSignOutProccess.php" ,true);
    r.send();
}
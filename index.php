<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes.lk</title>

    <link rel="stylesheet" href="./style.css">

    <link rel="shortcut icon" href="./logo.svg" type="image/x-icon">

    <link rel="stylesheet" href="./bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>

<body class="bg-light">

    <!--navigation bar -->
    <?php require './nav.php' ;
    
    require "./dbconnection.php";
    
    ?>
    <!---->

    <!-- home page-->
    <div class="container-fluid">
        <div class="row">
            <!--homeBanner-->
            <div class="col-12 mb-2 p-0" >
            <img id="home" src="./home/banner.jpg" class="img-fluid mx-0 w-100" alt="Responsive image">
            </div>
            <!---->

            <!--About Us-->
            <div class="banner my-5 " id="About">
            <div class="container">
                <div class="row">
                    <div class="d-flex align-items-center  flex-column flex-md-row">
                        <div class="col-12 col-md-4 d-flex me-3 justify-content-center">
                            <img id="logo" class="img-fluid" src="./logo.svg" alt="">
                        </div>

                        <div class="col-md-8 col-12">
                            <h1 class="text-center fw-bold">NOTES.LK - Our Capabilities</h1>
                            <p class="mt-5 text-center mx-auto">Our courses are taught by the most recognised tutors & lecturers in the industry. You will never miss a lesson with our student dashboard with infinite opportunities.</p>
                            <ul class="list-group w-50 mx-auto mt-4">
                              <li class="list-group-item">UNLIMITED # of STUDENTS</li>
                              <li class="list-group-item">FREE & PAID SESSIONS</li>
                              <li class="list-group-item">LIVE & RECORDED SESSIONS</li>
                              <li class="list-group-item">CROSS PLATFORM COMPATIBILITY</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!---->

            <!--image teacher-->
               <div class="container mx-auto my-5" id="gallery">
               <h1 class="text-center fw-bold">Our Techers</h1>
                <div class="row ">
                    <div class="d-flex flex-column  col-12 justify-content-center align-items-center">
                        
                          <?php 
                          $teacher_rs = Database::search("SELECT `imgpath`,`name`,`email` FROM `teacher`");
                          $teacher_num = $teacher_rs->num_rows;
                          

                          for($x=0;$x<$teacher_num;$x++){
                            $teacher_data = $teacher_rs->fetch_assoc();
                            ?>
                            <div class="d-flex flex-row align-items-baseline">
                            <div class="col-4">
                                
                                <?php 
                                if(empty($teacher_data["imgpath"])){
                                  ?>
                                                                  <img
                                  src="./Teachers/profileImg/userTecher.jpg"
                                  class=" m-3 shadow-1-strong rounded mb-2" width="100%"
                                  alt="Boat on Calm Water"
                                />
                                  
                                  <?php
                                }else{
                                  ?>
                                  <img
                                  src="./Teachers/<?php  echo $teacher_data["imgpath"]?>"
                                  class=" m-3 shadow-1-strong rounded mb-2" width="100%"
                                  alt="Boat on Calm Water"
                                />
                                  <?php
                                }
                                ?>
                            </div>
                            <div class="col-8">
                                <ul class="text-center list-unstyled">
                                  <li class="fw-bold">Name - <?php  echo $teacher_data["name"]?></li>
                                  <li class="fw-bold">Email - <?php  echo $teacher_data["email"]?></li>
                                </ul>
                            </div>
                            </div>
                            <?php
                          }
                          ?>

                        
                      <hr>
                    </div>

                   
                </div>
               </div>
            <!---->
        </div>
    </div>
    <!---->

    <!--footer-->
    <?php require './footer.php' ?>
    <!---->

    <script src="./script.js"></script>
    <script src="./bootstrap.js"></script>
    <script src="./bootstrap.bundle.js"></script>

<!-- Code injected by live-server -->
<script>
	// <![CDATA[  <-- For SVG support
	if ('WebSocket' in window) {
		(function () {
			function refreshCSS() {
				var sheets = [].slice.call(document.getElementsByTagName("link"));
				var head = document.getElementsByTagName("head")[0];
				for (var i = 0; i < sheets.length; ++i) {
					var elem = sheets[i];
					var parent = elem.parentElement || head;
					parent.removeChild(elem);
					var rel = elem.rel;
					if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
						var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
						elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
					}
					parent.appendChild(elem);
				}
			}
			var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
			var address = protocol + window.location.host + window.location.pathname + '/ws';
			var socket = new WebSocket(address);
			socket.onmessage = function (msg) {
				if (msg.data == 'reload') window.location.reload();
				else if (msg.data == 'refreshcss') refreshCSS();
			};
			if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
				console.log('Live reload enabled.');
				sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
			}
		})();
	}
	else {
		console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
	}
	// ]]>
</script>
</body>
</html>
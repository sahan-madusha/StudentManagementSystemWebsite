    <!--navigation bar -->
    <nav class="navbar navbar-expand-md p-0 mt-2 maninNav sticky-top bg-light py-2">
        <div class="container d-flex justify-content-around ">

        <div class="col-6 col-md-3 d-flex flex-row justify-content-around">
           <div class="d-flex flex-column flex-md-row">
           <span><img class="w-50" src="./logo.svg" alt="uni list logo lk">&nbsp;&nbsp;</span>
           </div>
        </div>

        <div class="col-6 col-md-9">
            <button class="float-end navbar-toggler " type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="float-end">
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                    <div class="offcanvas-header text-dark menuBtn">
                        <h5 class="offcanvas-title ">Notes.lk</h5>
                        <button type="button" class="btn-close btn-close-dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body menuSlide navItems ">
                      <ul class="navbar-nav justify-content-end flex-grow-1 pe-2 align-items-baseline navSlide">
                          <li class="nav-item mt-4 mt-md-0 fs-0 fs-md-5"><a href="./student.php" class="navlink p-3">DashBoard</a></li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> Menu </a>
                            <ul class="dropdown-menu">
                            <?php
                                $sub1_rs = Database::search("SELECT subject.id,`subject` FROM `student`INNER JOIN `subject` ON 
                                student.sub1 = subject.id OR student.sub2 = subject.id OR student.sub3 = subject.id WHERE student.id='".$data["id"]."'");

                                $sub1_num = $sub1_rs->num_rows;

                                for($x=0;$x<$sub1_num;$x++){
                                  $sub1_data = $sub1_rs->fetch_assoc();
                                  ?>
                                    <li><a class="dropdown-item fw-bold" href="./studentClass.php?id=<?php echo $sub1_data["id"]?>"><?php echo $sub1_data["subject"]?></a></li>
                                  <?php
                                }
                            ?>
                              <?php 
                              //
                              ?>
                            </ul>
                          </li>
                          <li class="nav-item mt-4 mt-md-0"><button class="btn btn-sm rounded-pill fw-bold logBtn" onclick="signout();">logOut</button></li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>
    <!---->



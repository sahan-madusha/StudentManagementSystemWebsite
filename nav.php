 <!--navigation bar -->
 <nav class="navbar navbar-expand-md p-0 mt-2 maninNav sticky-top bg-light py-2">
        <div class="container d-flex justify-content-around ">

        <div class="col-5 col-md-3 d-flex flex-row justify-content-around">
           <div class="d-flex flex-column flex-md-row">
                <a href="./index.php"><img class="w-50" src="./logo.svg" alt="uni list logo lk"></a>
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
                          <li class="nav-item mt-4 mt-md-0 fs-0 fs-md-5"><a href="./index.php" class="navlink p-3">Home</a></li>
                          <li class="nav-item mt-4 mt-md-0 fs-0 fs-md-5"><a href="./index.php #About" class="navlink p-3">AboutUs</a></li>
                          <li class="nav-item mt-4 mt-md-0 fs-0 fs-md-5"><a href="./index.php #gallery" class="navlink p-3">Teachers</a></li>
                          <li class="nav-item mt-4 mt-md-0 fs-0 fs-md-5"><a href="./index.php #footer" class="navlink p-3">Contact</a></li>
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle fw-bold" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Log</a>
                            <ul class="dropdown-menu">
                              <li><a class="dropdown-item fw-bold" href="./adminsignIn.php">Admin</a></li>
                              <li><a class="dropdown-item fw-bold" href="./studentSignIn.php">Student</a></li>
                              <li><a class="dropdown-item fw-bold" href="./teacherSignIn.php">Teacher</a></li>
                              <li><a class="dropdown-item fw-bold" href="./academicOfficerLogIn.php">Academic Officer</a></li>
                            </ul>
                          </li>
                      </ul>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </nav>
    <!---->
<?php
session_start();
include_once("class/mainclass.php");
$obj = new mainClass();
if (isset($_POST['add_reservation_btn'])) {
    $log_msg = $obj->addReservation($_POST);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Jacky's Catering</title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
    <link href="css/menu.css" rel="stylesheet" />
    <link href="css/login-register.css" rel="stylesheet" />
    <script src="js/jquery-1.10.2.js" type="text/javascript"></script>
    <script src="js/login-register.js" type="text/javascript"></script>
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- Link Swiper's CSS -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css"/>
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"/>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</head>

<body id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top px-4" id="mainNav">
        <!-- <div class="container px-4 px-lg-5"> -->
        <a class="navbar-brand" href="#page-top">Jacky's Catering</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false"
            aria-label="Toggle navigation">
            Menu
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About Us</a></li>
                <li class="nav-item"><a class="nav-link" href="#menu">Menu</a></li>
                <li class="nav-item"><a class="nav-link" href="#events">Events</a></li>
                <li class="nav-item"><a class="nav-link" href="#date">Available Date</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                <li class="nav-item">

                    <?php
                    if (isset($_SESSION['email'])) {
                        echo '
                        <div class="dropdown">
                            <button class="btn btn-secondary btn-sm dropdown-toggle nav-link" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                ' . $_SESSION['email'] . '
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                        ';
                    } else {
                        echo '<a class="nav-link btn btn-dark" data-toggle="modal" href="javascript:void(0)" onclick="openRegisterModal();">Register</a>';
                    }
                    ?>

                </li>
            </ul>
        </div>
        <!-- </div> -->
    </nav>
    <?php
    if (isset($log_msg)):
        if (is_array($log_msg)) {
            foreach ($log_msg as $key => $errors):
                ?>
                <div class="alert alert-danger" role="alert">
                    <?= $errors ?>
                </div>
                <?php
            endforeach;
        } else {
            echo $log_msg;
        }

    endif;
    ?>
    <!-- Masthead-->
    <div class="modal fade login" id="loginModal">
        <div class="modal-dialog login animated">
            <div class="modal-content">
                <div class="modal-header justify-content-center">
                    <h5 class="modal-title"></h5>
                    <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                </div>
                <div class="modal-body">
                    <div class="box">
                        <div class="content">
                            <div class="error"></div>
                            <div class="error2"></div>
                            <div class="success"></div>
                            <div class="form loginBox">
                                <form method="" action="" accept-charset="UTF-8">
                                    <input id="email" class="form-control" type="text" placeholder="Email" name="email">
                                    <input id="password" class="form-control" type="password" placeholder="Password"
                                        name="password">
                                    <input class="btn btn-default btn-login" type="button" value="Login"
                                        onclick="loginAjax()">
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="box">
                        <div class="content registerBox" style="display:none;">
                            <div class="form">
                                <form method="" html="{:multipart=>true}" data-remote="true" action=""
                                    accept-charset="UTF-8">
                                    <input id="re_email" class="form-control" type="text" placeholder="Email"
                                        name="email" required>
                                    <input id="re_password" class="form-control" type="password" placeholder="Password"
                                        name="password" required>
                                    <input id="re_password_confirmation" class="form-control" type="password"
                                        placeholder="Repeat Password" name="password_confirmation" required>
                                    <input class="btn btn-default btn-register" type="button" value="Create account"
                                        name="commit" onclick="registerAjax()">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="forgot login-footer">
                        <span>Looking to
                            <a href="javascript: showRegisterForm();">create an account</a>
                            ?</span>
                    </div>
                    <div class="forgot register-footer" style="display:none">
                        <span>Already have an account?</span>
                        <a href="javascript: showLoginForm();">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <header class="masthead" id="home">
        <div class="container px-4 px-lg-5 d-flex h-100 align-items-center justify-content-center">
            <div class="d-flex justify-content-center">
                <div class="text-center">
                    <h1 class="mx-auto my-0 text-uppercase">Jacky's Catering</h1>
                    <h2 class="text-white-50 mx-auto mt-2 mb-5">
                        Party trays and Catering Services
                    </h2>
                    <a class="btn btn-primary" href="#about">Read More</a>
                </div>
            </div>
        </div>
    </header>
    <!-- About -->
    <section class="about-section text-center" id="about">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">About Us</h2>
                    <p class="text-white-50">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                    </p>
                </div>
            </div>

            <!-- FAQ Section (inside About Us) -->
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-lg-8">
                    <h2 class="text-white mb-4">Frequently Asked Questions</h2>
                    <div class="accordion" id="faqAccordion">
                        <!-- Question 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                    What services do you offer?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    We offer a variety of catering services including weddings, corporate events, and special occasions.
                                </div>
                            </div>
                        </div>
                        <!-- Question 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingTwo">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    How can I make a reservation?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    You can make a reservation online through our website or by calling our customer service team.
                                </div>
                            </div>
                        </div>
                        <!-- Question 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingThree">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    Do you accommodate dietary restrictions?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Yes, we offer customized menus that accommodate various dietary restrictions and preferences.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Menu-->
    <section class="about-section text-center" id="menu">
        <h2 class="text-white mb-4">Our Menu</h2>
            <div class="main-scroll-div">
                <div>
                    <button class="icon" onclick="scrolll()"> <i class="fas fa-angle-double-left"></i></button>
                </div>
                    <div class="cover">
                        <div class="scroll-images">
                        <div class="child"><img class="child-img" src="assets/img/Meal_1.jpg" alt="image"></div>
                        <div class="child"><img class="child-img" src="assets/img/Meal_2.jpg" alt="image"></div>
                        <div class="child"><img class="child-img" src="assets/img/Meal_3.jpg" alt="image"></div>
                        <div class="child"><img class="child-img" src="assets/img/Meal_4.jpg" alt="image"></div>
                        <div class="child"><img class="child-img" src="assets/img/Meal_1.jpg" alt="image"></div>
                        <div class="child"><img class="child-img" src="assets/img/Meal_2.jpg" alt="image"></div>
                    </div>
                </div>
                <div>
                    <button class="icon" onclick="scrollr()"> <i class="fas fa-angle-double-right"></i></button>
                </div>
            </div>
    </section>

    <!-- events-->
    <section class="projects-section bg-light" id="events">
        <div class="container px-4 px-lg-5">
            <!-- Featured Project Row-->
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center"></div>
            <!-- Project One Row-->
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/event1.jpg" alt="..." /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">Birthday</h4>
                                <p class="mb-0 text-white-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Two Row-->
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/event2.jpg" alt="..." /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">Debut</h4>
                                <p class="mb-0 text-white-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project third Row-->
            <div class="row gx-0 mb-5 mb-lg-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/event3.jpg" alt="..." /></div>
                <div class="col-lg-6">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-left">
                                <h4 class="text-white">Wedding</h4>
                                <p class="mb-0 text-white-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Project Fourth Row-->
            <div class="row gx-0 justify-content-center">
                <div class="col-lg-6"><img class="img-fluid" src="assets/img/event4.jpg" alt="..." /></div>
                <div class="col-lg-6 order-lg-first">
                    <div class="bg-black text-center h-100 project">
                        <div class="d-flex h-100">
                            <div class="project-text w-100 my-auto text-center text-lg-right">
                                <h4 class="text-white">Holidays</h4>
                                <p class="mb-0 text-white-50">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- date-->
    <section class="projects-section bg-light" style="padding: 5rem 0;" id="date">
        <div class="container px-4 px-lg-5">
            <!-- Featured Project Row-->
            <div class="row gx-0 mb-4 mb-lg-5 align-items-center">
                <div class="col-xl-12 col-lg-12">
                    <input type="hidden" value="<?= isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '' ?>"
                        id="clientID">
                    <?php
                    $dateComponents = getdate();
                    $month = isset($_REQUEST['month']) ? $_REQUEST['month'] : $dateComponents['mon'];
                    $year = isset($_REQUEST['year']) ? $_REQUEST['year'] : $dateComponents['year'];
                    echo $obj->build_calendar($month, $year);
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="myModal2" role="dialog" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><strong>Book an Reservation for <span
                                class="dateLabel"></span></strong></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="timeslotContainer">

                </div>
            </div>
        </div>
    </div>
    <!-- Contact-->
    <section class="contact-section bg-black">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Address</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">
                                <a href="https://www.google.com/maps/search/?api=1&query=Jacky's+food+hall,+Cainta,+Philippines" target="_blank">
                                    Jacky's food hall, Cainta, Philippines
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-envelope text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Email</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">
                                <a href="mailto:Jackyscateringservices@gmail.com">Jackyscateringservices@gmail.com</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-mobile-alt text-primary mb-2"></i>
                            <h4 class="text-uppercase m-0">Viber</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">09173167473</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="social d-flex justify-content-center">
                <a class="mx-2" href="https://www.instagram.com/jackyscatering/" target="_blank"><i class="fab fa-instagram"></i></a>
                <a class="mx-2" href="https://www.facebook.com/JackysCateringServices" target="_blank"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
    </section>
    <!-- Footer-->
    <footer class="footer bg-black small text-center text-white-50">
        <div class="container px-4 px-lg-5">Copyright &copy; Your Website 2024</div>
    </footer>
    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>
    <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {

            $('.aView').on('click', function () {
                var date = $(this).data('bs-date');
                $(".dateLabel").html(date);
                var clientID = $('#clientID').val();
                console.log(date);
                if (clientID != "") {
                    $.ajax({
                        url: 'ajax/availSchedAjax.php',
                        type: 'post',
                        data: { date: date, clientID: clientID },
                        success: function (response) {
                            // Add response in Modal body
                            // console.log(response)
                            $('#timeslotContainer').html(response);
                        }
                    });
                    console.log("y")
                } else {
                    console.log("n")
                    $('#timeslotContainer').html("Please Login first or signup if don't have an account.");
                }

            });

        });
    </script>
     <script src="https://kit.fontawesome.com/032d11eac3.js" crossorigin="anonymous"></script>

`    <script>
    function scrolll() {
        var container = document.querySelector(".scroll-images");
        container.scrollBy(-350, 0); // Scroll to the left
    }

    function scrollr() {
        var container = document.querySelector(".scroll-images");
        container.scrollBy(350, 0); // Scroll to the right
    }
    </script>`
</body>
</html>
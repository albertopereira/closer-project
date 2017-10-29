<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Sofbox - Responsive Software Landing Page" />
    <meta name="author" content="iqonicthemes.in" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />

    <title>CLOSER Project</title>
    
    <!-- Favicon -->
    <link rel="shortcut icon" href="/landing/images/favicon.png" />
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800&amp;Raleway:300,400,500,600,700,800,900" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link rel="stylesheet" href="/landing/css/bootstrap.min.css">
    
    <!-- owl-carousel -->
    <link rel="stylesheet" type="text/css" href="/landing/css/owl-carousel/owl.carousel.css" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" type="text/css" href="/landing/css/font-awesome.css" />

    <!-- Magnific Popup -->
    <link rel="stylesheet" type="text/css" href="/landing/css/magnific-popup/magnific-popup.css" />

    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="/landing/css/animate.css" />
    
    <!-- Ionicons -->
    <link rel="stylesheet" href="/landing/css/ionicons.min.css">
    
    <!-- Style -->
    <link rel="stylesheet" href="/landing/css/style.css">

    <!-- Responsive -->
    <link rel="stylesheet" href="/landing/css/responsive.css">

    <!-- Style customizer (Remove these two lines please) -->

    <!-- custom style -->
    <link rel="stylesheet" href="/landing/css/custom.css" />

</head>

<body data-spy="scroll" data-offset="80">

<?php
if(isset($_POST["action"])) {
  $name = $_POST['name'];                 // Sender's name
  $email = $_POST['email'];     // Sender's email address
  $phone  = $_POST['phone'];     // Sender's email address
  $message = $_POST['message'];    // Sender's message
  $from = 'Closer form';    
  $to = 'albertopereira@gmail.com';     // Recipient's email address
  $subject = 'Message from closer ';

 $body ="From: $name \n E-Mail: $email \n Phone : $phone \n Message : $message"  ;
    
    // init error message 
    $errmsg='';
  // Check if name has been entered
  if (!$_POST['name']) {
   $errmsg = 'Please enter your name';
  }

  
  // Check if email has been entered and is valid
  if (!$_POST['email'] || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
   $errmsg = 'Please enter a valid email address';
  }
  
  //Check if message has been entered
  if (!$_POST['message']) {
   $errmsg = 'Please enter your message';
  }
 
    $result='';
  // If there are no errors, send the email
  if (!$errmsg) {
        if (mail ($to, $subject, $body, $from)) {
            $result='<div class="alert alert-success">TThank you for contacting us. Your message has been successfully sent. We will contact you very soon!</div>'; 
        } 
        else {
          $result='<div class="alert alert-danger">Sorry there was an error sending your message. Please try again later.</div>';
        }
    }
    else{
        $result='<div class="alert alert-danger">'.$errmsg.'</div>';
    }
    echo $result;
 }
?>

    <!-- loading -->

    <div id="loading">
        <div id="loading-center">
            <div class="loader">
              <div id="largeBox"></div>
              <div id="smallBox"></div>
            </div>
        </div>
    </div>

    <!-- loading End -->

    <!-- Header -->

    <header id="header-wrap">
        <div class="navbar navbar-default navbar-fixed-top menu-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a href="index.html" class="navbar-brand">
                        <img class="img-responsive" src="/landing/images/logo.png" alt="logo">
                    </a>
                </div>
                <div class="navbar-collapse collapse">
                    <a href="/register" class="button bt-black pull-right visible-lg">Register</a>
                    <nav>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="active"><a class="page-scroll" href="#iq-home">Home</a></li>
                            <li><a class="page-scroll" href="#how-it-works">About</a></li>
                            <li><a class="page-scroll" href="#software-features">Service</a></li>
                            <li><a class="page-scroll" href="#great-screenshots">Screenshots</a></li>
                            <li><a class="page-scroll" href="#contact">Contact</a></li>
                            <li><a href="/login">Login</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </header>

    <!-- Header End -->


    <!-- Banner -->

    <section id="iq-home" class="iq-banner overview-block-pt iq-bg iq-bg-fixed iq-over-blue-90" style="background: url(/landing/images/bg/01.jpg);">
        <div class="container-fluid">
            <div class="banner-text">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="text-uppercase iq-font-white iq-tw-3">We are building <b class="iq-tw-7">software</b> to help</h1>
                        <p class="iq-font-white iq-pt-15 iq-mb-40">The project seeks to enhance the inclusiveness of budgetary policies in local public governance, increasing the participation of citizens, and to test the incorporation, in local news agencies practices, of the monitoring of public policies, by making publicly available a platform for translating municipal budgets into visual news objects.</p>
                        <a href="/register" class="button bt-black iq-mt-10 iq-ml-40">Register</a>
                    </div>
                    <div class="col-md-6">
                        <img class="banner-img" src="/landing/images/banner/01.png" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="banner-objects">
            <span class="banner-objects-01" data-bottom="transform:translatey(50px)" data-top="transform:translatey(-50px);">
                    <img src="/landing/images/drive/03.png" alt="drive02">
                </span>
            <span class="banner-objects-02 iq-fadebounce">
                    <span class="iq-round"></span>
                </span>
            <span class="banner-objects-03 iq-fadebounce">
                    <span class="iq-round"></span>
            </span>
        </div>
    </section>

    <!-- Banner End -->


    <!-- Main Content -->

    <div class="main-content">

        <!-- How it Works -->

        <section id="how-it-works" class="overview-block-ptb it-works re4-mt-50">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="heading-title">
                            <h3 class="title iq-tw-7">How it Works</h3>
                            <p>You just have to register, create a budget, and a set of graphical visualizations will be automatically generated for that data.</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-4">
                        <div class="iq-works-box text-left">
                            <div class="step">1</div>
                            <div class="icon-bg text-center">
                                <img src="/landing/images/services/icon1.png" class="img-responsive" alt="#">
                            </div>
                            <h5 class="iq-tw-7 text-uppercase iq-mt-25 iq-mb-15">Easy to Setup</h5>
                            <p>The backoffice will alow you to easily create budgets, with an interface similar to an excel sheet, making for a gentle learning curve.</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 re-mt-50">
                        <div class="iq-works-box text-left">
                            <div class="step">2</div>
                            <div class="icon-bg text-center">
                                <img src="/landing/images/services/icon2.png" class="img-responsive" alt="#">
                            </div>
                            <h5 class="iq-tw-7 text-uppercase iq-mt-25 iq-mb-15">Versatile</h5>
                            <p>You don't have to restrict the data to a pre-determined restrict structure. It allows you latitude with your data.</p>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-4 re-mt-50">
                        <div class="iq-works-box text-left">
                            <div class="step">3</div>
                            <div class="icon-bg text-center">
                            <img src="/landing/images/services/icon3.png" class="img-responsive" alt="#"></div>
                            <h5 class="iq-tw-7 text-uppercase iq-mt-25 iq-mb-15">Multi Visualizations</h5>
                            <p>For the visualization of your data there are several unique ways through which you see it translated.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- How it Works END -->


        <!-- Who is Sofbox ? -->

        <section id="how-works" class="overview-block-ptb how-works">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="iq-tw-6 iq-mb-25">What is the CLOSER project?</h1>
                        <p class="iq-font-15">At a time when voter turnout in Europe is lagging and public institutions struggle to maintain trust and legitimacy within a framework of a growing gap between citizens and public governance, it is imperative to shorten that gap, and the simplification of the communication of public governance decisions is one of the most important factors in accomplishing this.</p><p class="iq-font-15">
In the context of local communities, the key organisations that are able to mediate the process of creating readable and trustworthy content from public decisions are local news agencies. They have the stability, the proximity, and the ingrained DNA to provide unbiased information, and can work as public enforcers of transparency in the democratic processes.</p><p class="iq-font-15">
The CLOSER project seeks to enhance the inclusiveness of budgetary policies, increasing the participation of citizens, and to test the incorporation, in local news agencies practices, of the monitoring of public policies, by designing, evaluating and making publicly available a platform for translating municipal budgets into distinct visual news objects.</p>
                    </div>
                    <div class="col-md-6">
                        <img class="iq-works-img" src="/landing/images/drive/01.png" alt="drive01">
                    </div>
                </div>
            </div>
            <div class="iq-objects">
                <span class="iq-objects-01">
                        <img src="/landing/images/drive/02.png" alt="drive02">
                    </span>
                <span class="iq-objects-02" data-bottom="transform:translatey(50px)" data-top="transform:translatey(-100px);">
                        <img src="/landing/images/drive/03.png" alt="drive02">
                    </span>
                <span class="iq-objects-03" data-bottom="transform:translatex(50px)" data-top="transform:translatex(-100px);">
                        <img src="/landing/images/drive/04.png" alt="drive02">
                    </span>
                <span class="iq-objects-04 iq-fadebounce">
                        <span class="iq-round"></span>
                    </span>
            </div>
        </section>

        <!-- Who is Sofbox ? END -->


        <!-- Software Features -->

        <section id="software-features" class="overview-block-ptb iq-mt-50 software">
            <div class="iq-software-demo">
                <img class="img-responsive" src="/landing/images/drive/05.png" alt="drive05">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-md-offset-6">
                        <h1 class="iq-tw-6 iq-mb-25">Graphical representations</h1>
                        <p class="iq-font-15">There are several components, translated into graphical representations, that allow distinct ways to look at data.</p>
                        <ul class="iq-mt-40 iq-list">
                            <li class="iq-tw-6"><i class="ion-android-done-all iq-mr-10 iq-font-blue iq-font-30"></i><span class="iq-font-black"><strong>Cards</strong> <br/> A summary of the statistical information.</span></li>
                            <li class="iq-tw-6"><i class="ion-android-done-all iq-mr-10 iq-font-blue iq-font-30"></i><span class="iq-font-black"><strong>Treemap</strong> <br/> A treemap represents data hierarchically using nested rectangles.</span></li>
                            <li class="iq-tw-6"><i class="ion-android-done-all iq-mr-10 iq-font-blue iq-font-30"></i><span class="iq-font-black"><strong>Line Chart</strong> <br/> A line chart represents data using lines within a x*y axis.</span></li>
                            <li class="iq-tw-6"><i class="ion-android-done-all iq-mr-10 iq-font-blue iq-font-30"></i><span class="iq-font-black"><strong>Tabular view</strong> <br/> Displays a main set of data using a table with the values.</span></li>
                            <li class="iq-tw-6"><i class="ion-android-done-all iq-mr-10 iq-font-blue iq-font-30"></i><span class="iq-font-black"><strong>Heatmap</strong> <br/> Displays a main set of data using maps with its geographical distribution.</span></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="iq-objects-software">
                <span class="iq-objects-01">
                        <img src="/landing/images/drive/03.png" alt="drive02">
                    </span>
                <span class="iq-objects-02">
                        <img src="/landing/images/drive/04.png" alt="drive02">
                    </span>
                <span class="iq-objects-03 iq-fadebounce">
                        <span class="iq-round"></span>
                    </span>
            </div>
        </section>

        <!-- Software Features END -->


        <!-- Great Screenshots -->

        <section id="great-screenshots" class="overview-block-ptb iq-bg iq-bg-fixed iq-over-blue-80 iq-screenshots" style="background: url(/landing/images/bg/01.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="heading-title white">
                            <h3 class="title iq-tw-7">Components Available</h3>
                            <p class="iq-font-white">These are the components available at the moment. Several more are being added. Check back often!</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-10 col-sm-offset-1 text-center">
                            <div class="screenshots-slider popup-gallery">
                                <div class="slider-container">
                                    <div class="slider-content">
                                        <div class="slider-single">
                                            <a href="images/screenshots/01.jpg" class="popup-img"><img class="slider-single-image" src="/landing/images/screenshots/01.jpg" alt="1" /></a>
                                        </div>
                                        <div class="slider-single">
                                            <a href="images/screenshots/01.jpg" class="popup-img"><img class="slider-single-image" src="/landing/images/screenshots/02.jpg" alt="2" /></a>
                                        </div>
                                        <div class="slider-single">
                                            <a href="images/screenshots/01.jpg" class="popup-img"><img class="slider-single-image" src="/landing/images/screenshots/03.jpg" alt="3" /></a>
                                        </div>
                                        <div class="slider-single">
                                            <a href="images/screenshots/01.jpg" class="popup-img"><img class="slider-single-image" src="/landing/images/screenshots/04.jpg" alt="4" /></a>
                                        </div>
                                        <div class="slider-single">
                                            <a href="images/screenshots/01.jpg" class="popup-img"><img class="slider-single-image" src="/landing/images/screenshots/05.jpg" alt="5" /></a>
                                        </div>
                                    <a class="slider-left" href="javascript:void(0);"><i class="fa fa-angle-left"></i></a>
                                    <a class="slider-right" href="javascript:void(0);"><i class="fa fa-angle-right"></i></a>
                                    </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Great Screenshots END -->



        <!-- Frequently Asked Questions -->

        <section class="overview-block-ptb white-bg iq-asked">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="heading-title">
                            <h3 class="title iq-tw-7">Frequently Asked Questions</h3>
                            <p></p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12 col-md-6">
                        <img class="img-responsive center-block" src="/landing/images/drive/10.png" alt="drive10" style="z-index: 9; position: relative;">
                    </div>
                    <div class="col-sm-12 col-md-6">
                        <div class="iq-accordion iq-mt-50">
                            <div class="ad-block ad-active"> <a href="#" class="ad-title iq-tw-6 iq-font-grey">Can I try it out?</a>
                                <div class="ad-details">
                                    <div class="row">
                                        <div class="col-sm-12">Yes. Head up to the <a href="/login">Login page</a> and login with the following credentials:<br/>
                                            <strong>Email:</strong> demo@demo.com<br/>
                                            <strong>Passwod:</strong> demopass<br/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="ad-block"> <a href="#" class="ad-title iq-tw-6 iq-font-grey">Can I see what it looks like?</a>
                                <div class="ad-details">Yes. There's a demo <a href="/view/1">here</a>.</div>
                            </div>
                            <div class="ad-block"> <a href="#" class="ad-title iq-tw-6 iq-font-grey">Are there any fees or hidden charges?</a>
                                <div class="ad-details">
                                    <div class="row">
                                        <div class="col-sm-12">No. This project is absolutely free and open source.</div>
                                    </div>
                                </div>
                            </div>
                            <div class="ad-block"> <a href="#" class="ad-title iq-tw-6 iq-font-grey">Ca I use this project in a commercial project?</a>
                                <div class="ad-details">Sure.</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="iq-objects-asked">
                <span class="iq-objects-01">
                    <img src="/landing/images/drive/02.png" alt="drive02">
                </span>
                <span class="iq-objects-02">
                    <img src="/landing/images/drive/04.png" alt="drive02">
                </span>
                <span class="iq-objects-03 iq-fadebounce">
                    <span class="iq-round"></span>
                </span>
            </div>
        </section>

        <!-- Frequently Asked Questions END -->



        <!-- Clients END -->
    </div>

    <!-- Main Content END -->


    <!-- Footer -->

    <footer>
        <!-- Subscribe Our Newsletter -->

        <section class="iq-ptb-80 iq-newsletter iq-bg iq-bg-fixed iq-over-blue-80" style="background: url(/landing/images/bg/01.jpg);">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="heading-title white iq-mb-40">
                            <h3 class="title iq-tw-7">Subscribe Our Newsletter</h3>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <form class="form-inline">
                            <div class="form-group">
                                <input type="text" class="form-control" id="exampleInputName2" placeholder="Enter Your Email Here">
                            </div>
                            <a class="button bt-white iq-ml-25" href="#">subscribe</a>
                        </form>
                    </div>
                </div>
            </div>
        </section>

        <!-- Subscribe Our Newsletter END -->


        <!-- Footer Info -->

        <section id="contact" class="footer-info white-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-8">
                        <div class="iq-get-in">
                            <h4 class="iq-tw-7 iq-mb-20">Get in Touch</h4>
                            <div id="formmessage">Success/Error Message Goes Here</div>
                            <!-- <form class="form-horizontal" id="contactform" method="post" action=""> -->
                                <div class="contact-form">
                                    <div class="section-field">
                                        <input id="name" type="text" placeholder="Name*" name="name">
                                    </div>
                                    <div class="section-field">
                                        <input type="email" placeholder="Email*" name="email">
                                    </div>
                                    <div class="section-field">
                                        <input type="text" placeholder="Phone*" name="phone">
                                    </div>
                                    <div class="section-field textarea">
                                        <textarea class="input-message" placeholder="Comment*" rows="6" name="message"></textarea>
                                    </div>
                                    <input type="hidden" name="action" value="sendEmail" />
                                    <button id="submit" name="submit" type="submit" value="Send" class="button iq-mt-30">Send Message</button>
                                </div>
                            <!-- </form> -->
                            <div id="ajaxloader" style="display:none"><img class="center-block mt-30 mb-30" src="/landing/images/ajax-loader.gif" alt="#"></div>
                        </div>
                    </div>
                </div>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3113.127267320613!2d-9.153157784809457!3d38.71488696528686!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd19337e7c4c6f4f%3A0x63011c8caeda7e0d!2zUi4gU8OjbyBNYXLDp2FsLCBMaXNib2E!5e0!3m2!1spt-PT!2spt!4v1509301816281" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
        </section>
        <section class="footer-info iq-pt-60">
            <div class="container">
                <div class="row">
<!--                     <div class="col-sm-6 col-md-3">
                        <div class="iq-footer-box text-left">
                            <div class="iq-icon">
                                <i aria-hidden="true" class="ion-ios-location-outline"></i>
                            </div>
                            <div class="footer-content">
                                <h4 class="iq-tw-6 iq-pb-10">Address</h4>
                                <p>1234 North Avenue Luke Lane, South Bend, IN 360001</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-4 re4-mt-30">
                        <div class="iq-footer-box text-left">
                            <div class="iq-icon">
                                <i aria-hidden="true" class="ion-ios-telephone-outline"></i>
                            </div>
                            <div class="footer-content">
                                <h4 class="iq-tw-6 iq-pb-10">Phone</h4>
                                <p>+0123 456 789 <br>Mon-Fri 8:00am - 8:00pm<br></p>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-sm-6 col-md-6 re-mt-30">
                        <div class="iq-footer-box text-left">
                            <div class="iq-icon">
                                <i aria-hidden="true" class="ion-ios-email-outline"></i>
                            </div>
                            <div class="footer-content">
                                <h4 class="iq-tw-6 iq-pb-10">Mail</h4>
                                <p>albertopereira@gmail.com <br></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-md-6 re-mt-30">
                        <ul class="info-share">
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-google"></i></a></li>
                            <li><a href="#"><i class="fa fa-github"></i></a></li>
                        </ul>
                    </div>
                </div>
                <div class="row iq-mt-40">
                    <div class="col-sm-12 text-center">
                        <div class="footer-copyright iq-ptb-20">Copyright @<span id="copyright"> <script>document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))</script></span> <a href="#" class="text-green">CLOSER Project.</a> All Rights Reserved </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer Info END -->

    </footer>

    <!-- Footer END -->

    <!-- back-to-top -->

    <div id="back-to-top">
        <a class="top" id="top" href="#top"> <i class="ion-ios-upload-outline"></i> </a>
    </div>

    <!-- back-to-top End -->

    <!-- style-customizer -->
<!--     <div class="iq-customizer closed">
        <div class="buy-button"> <a class="opener" href="#"><i class="fa fa-spinner fa-spin"></i></a> </div>
        <div class="clearfix content-chooser">
            <h3 class="iq-font-black">Appino Awesome Color</h3>
            <p>This color combo available inside whole template. You can change on your wish, Even you can create your own with limitless possibilities! </p>
            <ul class="iq-colorChange clearfix">
                <li class="color-1 selected" data-style="color-1"></li>
                <li class="color-2" data-style="color-2"></li>
                <li class="color-3" data-style="color-3"></li>
                <li class="color-4" data-style="color-4"></li>
                <li class="color-5" data-style="color-5"></li>
                <li class="color-6" data-style="color-6"></li>
                <li class="color-7" data-style="color-7"></li>
                <li class="color-8" data-style="color-8"></li>
            </ul>
            <a target="_blank" class="button" href="">Purchase Now</a>
        </div>
    </div> -->
    <!-- style-customizer END -->


    <!-- jQuery -->
    <script type="text/javascript" src="/landing/js/jquery.min.js"></script>

    <!-- bootstrap -->
    <script type="text/javascript" src="/landing/js/bootstrap.min.js"></script>

    <!-- owl-carousel -->
    <script type="text/javascript" src="/landing/js/owl-carousel/owl.carousel.min.js"></script>

    <!-- Counter -->
    <script type="text/javascript" src="/landing/js/counter/jquery.countTo.js"></script>

    <!-- Jquery Appear -->
    <script type="text/javascript" src="/landing/js/jquery.appear.js"></script>

    <!-- Magnific Popup -->
    <script type="text/javascript" src="/landing/js/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Retina -->
    <script type="text/javascript" src="/landing/js/retina.min.js"></script>

    <!-- wow -->
    <script type="text/javascript" src="/landing/js/wow.min.js"></script>

    <!-- Countdown -->
    <script type="text/javascript" src="/landing/js/jquery.countdown.min.js"></script>

    <!-- Skrollr -->
    <script type="text/javascript" src="/landing/js/skrollr.min.js"></script>

    <!-- Style Customizer -->
    <script type="text/javascript" src="/landing/js/style-customizer.js"></script>

    <!-- Custom -->
    <script type="text/javascript" src="/landing/js/custom.js"></script>

</body>

</html>
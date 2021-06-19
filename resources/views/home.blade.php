<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{URL::asset('assets/img/brand/favicon.png')}}" type="image/x-icon"/>
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">

    <title>Khaled Cars</title>

    <link rel="stylesheet" type="text/css" href="{{asset('landing_sources/assets/css/bootstrap.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('landing_sources/assets/css/font-awesome.css')}}">

    <link rel="stylesheet" href="{{asset('landing_sources/assets/css/templatemo-training-studio.css')}}">

</head>

<body>

<!-- ***** Preloader Start ***** -->
<div id="js-preloader" class="js-preloader">
    <div class="preloader-inner">
        <span class="dot"></span>
        <div class="dots">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</div>
<!-- ***** Preloader End ***** -->


<!-- ***** Header Area Start ***** -->

<!-- ***** Header Area End ***** -->

<!-- ***** Main Banner Area Start ***** -->
<div class="main-banner" id="top">
    <video autoplay muted loop id="bg-video">
        <source src="{{asset('landing_sources/assets/images/gym-video.mp4')}}" type="video/mp4" />
    </video>

    <div class="video-overlay header-text">
        <div class="caption">
            <h2 style="">Khaled <em>Cars</em></h2>
            <div class="main-button scroll-to-section">
                <a href="{{route('employee.show_login_form')}}"><strong>لوحة تحكم الموظفين</strong></a>
                <a href="{{route('trader.show_login_form')}}"><strong>لوحة تحكم التجار</strong></a>
                <a href="{{route('admin.show_login_form')}}"><strong>لوحة تحكم المدراء</strong></a>

            </div>
        </div>
    </div>
</div>
<!-- ***** Main Banner Area End ***** -->

<!-- jQuery -->
<script src="{{asset('landing_sources/assets/js/jquery-2.1.0.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{asset('landing_sources/assets/js/popper.js')}}"></script>
<script src="{{asset('landing_sources/assets/js/bootstrap.min.js')}}"></script>

<!-- Plugins -->
<script src="{{asset('landing_sources/assets/js/scrollreveal.min.js')}}"></script>
<script src="{{asset('landing_sources/assets/js/waypoints.min.js')}}"></script>
<script src="{{asset('landing_sources/assets/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('landing_sources/assets/js/imgfix.min.js')}}"></script>
<script src="{{asset('landing_sources/assets/js/mixitup.js')}}"></script>
<script src="{{asset('landing_sources/assets/js/accordions.js')}}"></script>

<!-- Global Init -->
<script src="{{asset('landing_sources/assets/js/custom.js')}}"></script>

</body>
</html>

<!doctype html>
<html lang="en">

<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<!-- /Added by HTTrack -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Adwaa</title>
    <!--favicon-->
    <!--<link rel="icon" href="assests/img/index/favicon.png" sizes="32x32">-->
    <!--style-->
    <link href="assests/css/style-3.css" rel="stylesheet" type="text/css">

    <link href="assests/css/style.css" rel="stylesheet" type="text/css">
    <!--font-awesome-->
    <link href="font/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!--font-online-->
    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,900" rel="stylesheet">
    <!--Bootstrap-->
    <link href="assests/css/bootstrap.css" rel="stylesheet" type="text/css">
    <!--slider-->
    <link href="assests/css/owl.carousel.min.css" rel="stylesheet">
    <link href="assests/css/theme.css" rel="stylesheet">
    <!--Slick-slider-->
    <link href="assests/css/slick.css" rel="stylesheet" type="text/css">
    <!--thumbnail-slider-->
    <link rel="stylesheet" href="assests/css/lightslider.html" />
    <!--Checkbox-->
    <!--fonts-->
    <link href="font/flaticon.css" rel="stylesheet" type="text/css">

    <link href="assests/css/castome.css" rel="stylesheet" type="text/css">

    <link rel="stylesheet" type="text/css" href="assests/css/input-effect.css" />

</head>

<body>
    <!--Logo-bar-->
    <?php include ('header.php')?>
    <!--main-slider-->

    <!--Link-row-->
    <div class="container-fluid link-row">
        <div class="container">
            <div class="col-md-12">
                <h2>Page Cart</h2>
                <div class="link-sec"> <a href="#">Home</a> &nbsp; <i class="fa fa-angle-right" aria-hidden="true"></i> &nbsp; <a href="#">Page Cart</a> </div>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <div class="container top-sec">
        <!--main-container-->
        <div class="row">
            <!--row-->

            <div class="col-md-12 padd-50">
                <!--right-sec-->

                
  <div class="col-md-12 element-table tbcart">
    <table>
      <tr>
        <th>Items</th>
        <th>Prices</th>
        <th>Quantity</th>
        <th>Remove</th>
      </tr>
      <tr>
        <td class="item-col"><img src="assests/img/product/Product-10.jpg" alt="" /> Gatasmay Black Havey Leather Jacket</td>
        <td class="price-col">£20.90</td>
        <td><input class="text-center" type="number">
          <a href="#" class="update-cart">UPDATE CART</a>
          </td>
        <td class="text-center"><a href="#"><i class="fa fa-times content-subhead" aria-hidden="true"></i></a></td>
      </tr>
      <tr>
        <td class="item-col"><img src="assests/img/product/Product-1.jpg" alt="" /> Confit de Canard</td>
        <td class="price-col">£21.95</td>
        <td><input class="text-center" type="number">
          <a href="#" class="update-cart">UPDATE CART</a></td>
        <td class="text-center"><a href="#"><i class="fa fa-times content-subhead" aria-hidden="true"></i></a></td>
      </tr>
      <tr>
        <td colspan="5" class="coupon-row">
          <a href="#" class="add-cart-btn">Order Request</a> </td>
      </tr>
    </table>
  </div>
  <div class="clearfix"></div>

            </div>
            <div class="col-md-offset-0 col-md-0 padd-60 padd-btn-none">
                <!--left-sec-->
            </div>
            <div class="clearfix"></div>
        </div>
    </div>

    <!--footer-->
    <?php include ('footer.php')?>

    <!--Ajax-->
    <script src="assests/js/ajax.js"></script>
    <!--bootstrap.min-->
    <script src="assests/js/bootstrap.min.js"></script>
    <script src="assests/js/bx-slider.js"></script>
    <script>
        $('.bxslider').bxSlider({
            minSlides: 1,
            pager: false,
            maxSlides: 5,
            nextText: '<i class="fa fa-angle-right" aria-hidden="true"></i>',
            prevText: '<i class="fa fa-angle-left" aria-hidden="true"></i>',
            controls: true,
            slideWidth: 234,
            slideMargin: 0,
            auto: true
        });

    </script>
    <script>
        $(window).scroll(function() {
            if ($(window).scrollTop() >= 80) {
                $('.fix-nav').addClass('fixed-header');
            } else {
                $('.fix-nav').removeClass('fixed-header');
            }

        });
        //modal
        $(".for-1").on("click", function() {
            $('#myModal').modal('hide');
        });

        $(".for-1").on("click", function() {
            $('#myModal2').modal('hide');
        });

    </script>
    <!-- JS Global-slider -->
    <script src="assests/js/owl.carousel.min.js"></script>
    <script src="assests/js/theme.js"></script>
    <!--Select-custom-->
    <script src="assests/js/classie.js"></script>
    <script src="assests/js/selectFx.js"></script>
    <!--<script>-->
    <!--    (function () {-->
    <!--        [].slice.call(document.querySelectorAll('select.cs-select')).forEach(function (el) {-->
    <!--            new SelectFx(el);-->
    <!--        });-->
    <!--    })();-->
    <!--</script>-->
    <!--count-down-->
    <script>
        // function getTimeRemaining(endtime) {
        //     var t = Date.parse(endtime) - Date.parse(new Date());
        //     var seconds = Math.floor((t / 1000) % 60);
        //     var minutes = Math.floor((t / 1000 / 60) % 60);
        //     var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
        //
        //     return {
        //         'total': t,
        //
        //         'hours': hours,
        //         'minutes': minutes,
        //         'seconds': seconds
        //     };
        // }

        // function initializeClock(id, endtime) {
        //     var clock = document.getElementById(id);
        //     var hoursSpan = clock.querySelector('.hours');
        //     var minutesSpan = clock.querySelector('.minutes');
        //     var secondsSpan = clock.querySelector('.seconds');
        //
        //     function updateClock() {
        //         var t = getTimeRemaining(endtime);
        //
        //
        //         hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
        //         minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
        //         secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);
        //
        //         if (t.total <= 0) {
        //             clearInterval(timeinterval);
        //         }
        //     }
        //
        //     updateClock();
        //     var timeinterval = setInterval(updateClock, 1000);
        // }

        // var deadline = new Date(Date.parse(new Date()) + 104 * 24 * 60 * 60 * 1000);
        //initializeClock('clockdiv', deadline);

    </script>
    <!--Slick-slider-->
    <script src="assests/js/slick.js"></script>
    <script>
        $('.quotes').slick({
            dots: false,
            infinite: true,
            autoplay: true,
            autoplaySpeed: 6000,
            speed: 800,
            slidesToShow: 1,
            adaptiveHeight: false
        });

    </script>
    <!--Quantity-box-->
    <script>
        var unit = 0;
        var total;
        // if user changes value in field
        $('.field').change(function() {
            unit = this.value;
        });
        $('.add').click(function() {
            unit++;
            var $input = $(this).prevUntil('.sub');
            $input.val(unit);
            unit = unit;
        });
        $('.sub').click(function() {
            if (unit > 0) {
                unit--;
                var $input = $(this).nextUntil('.add');
                $input.val(unit);
            }
        });

    </script>
    <script language=JavaScript>
        $(document).keydown(function(event) {
            if (event.keyCode == 123) { // Prevent F12
                return false;
            } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I
                return false;
            }
        });

    </script>
    <script>
        //$('.sub-menu ul').hide();<!--for-default-open-->
        $(".sub-menu a").click(function() {
            $(this).parent(".sub-menu").children("ul").slideToggle("200");
            $(this).find("i.fa").toggleClass("fa-angle-up fa-angle-down");
        });

    </script>

</body>

</html>

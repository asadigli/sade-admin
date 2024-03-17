<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">

<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>SadeStore</title>
<meta name="description" content="SadeStore online satış xidməti">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo.png')}}" />
<link href='//fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/font-awesome.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{ asset('css/simple-line-icons.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{ asset('css/owl.carousel.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/owl.theme.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/owl.transitions.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/animate.css')}}" media="all">
<link rel="stylesheet" type="text/css" href="{{ asset('css/flexslider.css')}}" >
<link rel="stylesheet" type="text/css" href="{{ asset('css/jquery-ui.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/meanmenu.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/nivo-slider.css')}}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/style.css')}}" media="all">
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
</head>

<body class="cms-index-index cms-home-page">
  <style media="screen">
  .no-js #loader { display: none;  }
      .js #loader { display: block; position: absolute; left: 100px; top: 0; }
      .se-pre-con {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url("{{ asset('images/loading3.gif')}}") center no-repeat #fff;
      }
  </style>
  <div class="se-pre-con"></div>

@section('body')

@show
<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>

<script type="text/javascript">
$(window).load(function() {
  $(".se-pre-con").fadeOut("slow");;
});
</script>
<script type="text/javascript" src="{{ asset('js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.meanmenu.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/owl.carousel.min.js')}}"></script>
<!-- <script type="text/javascript" src="../../10.64.42.17_8080/n/72996caae7abec50d9b77194a0eef1802e91.js"></script> -->
<script type="text/javascript" src="{{ asset('js/jquery-ui.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/countdown.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/wow.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/main.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.nivo.slider.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/jquery.flexslider.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/cloud-zoom.js')}}"></script>

<script type="text/javascript">
      var dthen1 = new Date("12/25/16 11:59:00 PM");
      start = "08/04/15 03:02:11 AM";
      start_date = Date.parse(start);
      var dnow1 = new Date(start_date);
      if(CountStepper>0)
          ddiff= new Date((dnow1)-(dthen1));
      else
          ddiff = new Date((dthen1)-(dnow1));
      gsecs1 = Math.floor(ddiff.valueOf()/1000);

      var iid1 = "countbox_1";
      CountBack_slider(gsecs1,"countbox_1", 1);
  </script>
</body>
</html>

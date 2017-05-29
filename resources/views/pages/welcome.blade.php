@extends('layouts.master')

@section('title', 'Home')

@section('list_nav')
  @if (Auth::guest())
      <li class="active"><a href="{{ url('/') }}">Home</a></li>
      <li><a href="{{ url('/about') }}">About</a></li>
      <li><a href="{{ url('/contact') }}">Contact</a></li>
      <li><a href="{{ url('/login') }}">Login</a></li>
      <li><a href="{{ url('/register') }}">Register</a></li>
  @else
      <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
          </a>

          <ul class="dropdown-menu" role="menu">
              <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
          </ul>
      </li>
  @endif
@endsection

@section('before_container')
  <!-- Carousel -->
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img class="first-slide" src="{{ asset('uploads/1495990144whitney_houston_obit_P1.jpg') }}" alt="First slide">
        <div class="container">
          <div class="carousel-caption">
            <h1>Whitney Houston Timeline<br>(1963 - 2012)</h1>
            {{-- <p>ย้อนดูเหตุการณ์ล้อมปราบนักศึกษา ประชาชน อันน่าสลดใจที่สุดของเมืองไทย</p> --}}
            <p><a class="btn btn-lg btn-primary" href="{{ url('timeline/16') }}" role="button">View more...</a></p>
          </div>
        </div>
      </div>
      {{-- <div class="item">
        <img class="second-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Second slide">
        <div class="container">
          <div class="carousel-caption">
            <h1>Another example headline.</h1>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Learn more</a></p>
          </div>
        </div>
      </div> --}}
      {{-- <div class="item">
        <img class="third-slide" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Third slide">
        <div class="container">
          <div class="carousel-caption">
            <h1>One more for good measure.</h1>
            <p><a class="btn btn-lg btn-primary" href="#" role="button">Browse gallery</a></p>
          </div>
        </div>
      </div> --}}
    </div>
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div><!-- /.carousel -->

<!-- Main jumbotron for a primary marketing message or call to action -->
  <div class="jumbotron">
    <div class="container">
      <h1 class="text-center">สร้างไทม์ไลน์ง่ายนิดเดียว!</h1>
      <p class="text-center">เราขอแนะนำรูปแบบการเสนอข้อมูลด้วย 'ไทม์ไลน์'
        <br>'ไทม์ไลน์' จะช่วยให้เข้าใจในข่าว หรือเหตุการณ์สำคัญ ๆ ทางประวัติศาสตร์ ได้อย่างชัดเจนและเข้าใจง่ายยิ่งขึ้น</p>
      <p class="text-center">Event Timeline Creation System จะช่วยให้สร้างไทม์ไลน์ได้ภายใน 2 ขั้นตอน และแชร์ได้ทันที</p>
      <br><br>
      <!-- <p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more &raquo;</a></p> -->

      <!-- Three columns of text below the carousel -->
      <div class="row text-center">
        <div class="col-lg-4">
          <img class="img-circle" src="{{ asset('images/icon-1.png') }}" alt="Generic placeholder image" width="140" height="140">
          <h2>เพิ่มเหตุการณ์</h2>
          <p>เพิ่มเหตุการณ์ต่างๆ ลงในไทม์ไลน์ สามารถแทรกรูปภาพ, ลิงค์, YouTube, Facebook, Twitter ประกอบได้</p>
          {{-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> --}}
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="{{ asset('images/icon-2.png') }}" alt="Generic placeholder image" width="140" height="140">
          <h2>สร้างไทม์ไลน์</h2>
          <p>กรอกข้อมูลพื้นฐานอย่างชื่อไทม์ไลน์ รายละเอียดไทม์ไลน์ หมวดหมู่ และรูปหน้าปกให้เรียบร้อย</p>
          {{-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> --}}
        </div><!-- /.col-lg-4 -->
        <div class="col-lg-4">
          <img class="img-circle" src="{{ asset('images/icon-3.png') }}" alt="Generic placeholder image" width="140" height="140">
          <h2>แชร์!</h2>
          <p>แบ่งปันไทม์ไลน์ที่คุณสร้างขึ้น ให้ผู้ได้รับรู้และเข้าใจกับเหตุการณ์ต่าง ๆ บนโลกใบนี้</p>
          {{-- <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p> --}}
        </div><!-- /.col-lg-4 -->
      </div><!-- /.row -->

    </div>

  </div>
@endsection

@section('content')
<div class="container marketing">


    <!-- <hr class="featurette-divider"> -->

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">เพิ่มเหตุการณ์<span class="text-muted">ลงในไทม์ไลน์</span></h2>
        <p class="lead">เพิ่มเหตุการณ์ต่างๆ ลงในไทม์ไลน์ สามารถแทรกรูปภาพ, ลิงค์, YouTube, Facebook, Twitter ประกอบได้ (แนะนำให้ใส่ไม่เกิน 25 เหตุการณ์ต่อ 1 ไทม์ไลน์)</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-responsive center-block" src="{{ asset('images/step-1.png') }}" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7 col-md-push-5">
        <h2 class="featurette-heading">สร้างไทม์ไลน์<span class="text-muted">ง่ายจริง ๆ</span></h2>
        <p class="lead">หลังจากสร้างเหตุการณ์เพิ่มไว้เรียบร้อยแล้ว ต่อมาเราก็กรอกข้อมูลพื้นฐานอย่างชื่อไทม์ไลน์ รายละเอียดไทม์ไลน์ หมวดหมู่ และรูปหน้าปกให้เรียบร้อย แล้วกด Create Timeline เพื่องสร้างไทม์ไลน์ได้เลย!</p>
      </div>
      <div class="col-md-5 col-md-pull-7">
        <img class="featurette-image img-responsive center-block" src="{{ asset('images/step-2.png') }}" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-7">
        <h2 class="featurette-heading">ได้ไทม์ไลน์ไว้แชร์<span class="text-muted">บนออนไลน์</span></h2>
        <p class="lead">ไทม์ไลน์ที่สร้างขึ้นใช้ <a href="//timeline.knightlab.com/">TimelineJS</a> เข้ามาช่วยในการแสดงผล ทำให้เข้าใจข้อมูลที่แสดงบนไทม์ไลน์ได้ง่ายยิ่งขึ้น นอกจากนี้ยังสามารถกดแชร์สู่โซเชียลมีเดีย หรือนำ embed code ไปแปะในเว็บไซต์ได้อีกด้วย</p>
      </div>
      <div class="col-md-5">
        <img class="featurette-image img-responsive center-block" src="{{ asset('images/step-3.png') }}" alt="Generic placeholder image">
      </div>
    </div>

    <hr class="featurette-divider">

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


@endsection

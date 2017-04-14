@extends('layouts.master')

@section('title', 'Feed')

@section('before_container')
<div class="jumbotron">
  <div class="container">
    <h1>Timeline ที่น่าสนใจ</h1>
    <div class="row text-center">
      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
            <div class="caption">
              <h3>Feature Label</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-default">More Info</a></p>
            </div>
          </div>
        </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
            <div class="caption">
              <h3>Feature Label</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-default">More Info</a></p>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 hero-feature">
          <div class="thumbnail">
            <img src="http://placehold.it/800x500" alt="">
            <div class="caption">
              <h3>Feature Label</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-default">More Info</a></p>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 hero-feature">
          <div class="thumbnail">
            <img src="http://placehold.it/800x500" alt="">
              <div class="caption">
                <h3>Feature Label</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                <p><a href="#" class="btn btn-default">More Info</a></p>
              </div>
          </div>
        </div>
    </div>
    <p class="text-right"><a class="btn btn-primary btn-lg" href="#" role="button">ดู Timeline ที่น่าสนใจทั้งหมด &raquo;</a></p>
  </div>
</div>
@endsection

@section('content')
<div class="container">
  <div class="panel panel-info">
    <div class="panel-heading">
      <h3 class="panel-title">ข่าวจากผู้พัฒนาระบบ</h3>
    </div>
    <div class="panel-body">
      <p>test test ทดสอบ 1 2 3 4</p>
    </div>
  </div>


  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>Timeline ล่าสุดในระบบ <small></small></h1>
      </div>
    </div>

    @foreach($posts as $post)
    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>{{$post->title}}</h3>
            <p>{{str_limit($post->body, 30)}}</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>
    @endforeach

    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
            <div class="caption">
              <h3>Feature Label</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-default">More Info</a></p>
            </div>
        </div>
      </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>Timeline ที่เคยดูล่าสุด <small>อ้างอิงจากข้อมูลผู้ใช้</small></h1>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
            <div class="caption">
              <h3>Feature Label</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-default">More Info</a></p>
            </div>
        </div>
      </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>Timeline ที่เคยดูล่าสุด <small>อ้างอิงจากข้อมูลผู้ใช้</small></h1>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
            <div class="caption">
              <h3>Feature Label</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-default">More Info</a></p>
            </div>
        </div>
      </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>Timeline ที่เคยดูล่าสุด <small>อ้างอิงจากข้อมูลผู้ใช้</small></h1>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
            <div class="caption">
              <h3>Feature Label</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-default">More Info</a></p>
            </div>
        </div>
      </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>Timeline ที่เคยดูล่าสุด <small>อ้างอิงจากข้อมูลผู้ใช้</small></h1>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

    <div class="col-md-3 col-sm-6 hero-feature">
      <div class="thumbnail">
        <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
          <div class="caption">
            <h3>Feature Label</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
            <p><a href="#" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="http://placehold.it/800x500" alt="">
            <div class="caption">
              <h3>Feature Label</h3>
              <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
              <p><a href="#" class="btn btn-default">More Info</a></p>
            </div>
        </div>
      </div>
  </div>
@endsection

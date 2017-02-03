@extends('layouts.master')

@section('title', 'Login')

@section('list_nav')
  <li><a href="/">Home</a></li>
  <li><a href="/about">About</a></li>
  <li><a href="/contact">Contact</a></li>
  <li class="active"><a href="/login">Login</a></li>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-6">
      <h2>สมัครสมาชิก</h2>
      <div class="panel panel-default">
        <div class="panel-body">
        <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
        <form class="form-register">
          <div class="form-group">
            <label for="inputEmail">อีเมล</label>
            <input type="email" id="inputEmail" class="form-control" placeholder="อีเมล" required autofocus>
          </div>
          <div class="form-group">
            <label for="inputUsername">ชื่อผู้ใช้</label>
            <input type="username" id="inputUsername" class="form-control" placeholder="ชื่อผู้ใช้" required autofocus>
          </div>
          <div class="form-group">
            <label for="inputUsername">รหัสผ่าน</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="รหัสผ่าน" required autofocus>
          </div>
          <button class="btn btn-primary" type="submit">สมัครสมาชิก</button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <h2>เข้าสู่ระบบ</h2>

          <p>Donec id elit non mi porta gravida at eget metus.</p>
          <form class="form-signin">
            <div class="input-group input-group-lg">
              <!-- <label for="Username" class="sr-only">ชื่อผู้ใช้</label> -->
              <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-user"></i></span>
              <input type="username" id="inputUsername" class="form-control" placeholder="ชื่อผู้ใช้" aria-describedby="sizing-addon1" required autofocus>
            </div>
            <div class="input-group input-group-lg">
              <!-- <label for="inputPassword" class="sr-only">รหัสผ่าน</label> -->
              <span class="input-group-addon" id="sizing-addon2"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="password" id="inputPassword" class="form-control" placeholder="รหัสผ่าน" aria-describedby="sizing-addon2" required>
            </div>
            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me">จดจำชื่อผู้ใช้ไว้
              </label>
            </div>
            <button class="btn btn-success btn-lg btn-primary" type="submit">เข้าสู่ระบบ</button>
          </form>

   </div>
  </div>
</div>
@endsection

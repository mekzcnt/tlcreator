@extends('layouts.master')

@section('title', 'Contact')

@section('before_container')
@endsection

@section('content')
<div class="row">
  <div class="col-md-8 col-md-offset-2">
    <h1 id="title-page" class="text-center">Contact</h1>
    <hr>
    <iframe
      width="100%"
      height="450"
      frameborder="0" style="border:0"
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyDsgad9q61ijgIcWxvNcd93tvPqp-rknnc
        &q=Faculty+of+Information+Technology,+Lat+Krabang,+Bangkok" allowfullscreen>
    </iframe>
    <h2 class="text-center">ที่อยู่</h2>
    <p class="text-center">คณะเทคโนโลยีสารสนเทศ สถาบันเทคโนโลยีพระจอมเกล้าเจ้าคุณทหารลาดกระบัง, เลขที่ 1 ซอยฉลองกรุง 1, แขวง ลาดกระบัง เขต ลาดกระบัง กรุงเทพมหานคร 10520</p>
    <h2 class="text-center">ติดต่อผ่านทางอีเมล</h2>
    <form class="form-horizontal" action="" method="post">
          <fieldset>
            <!-- <legend class="text-center">Contact us</legend> -->

            <!-- Name input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="name">Name</label>
              <div class="col-md-9">
                <input id="name" name="name" type="text" placeholder="Your name" class="form-control">
              </div>
            </div>

            <!-- Email input-->
            <div class="form-group">
              <label class="col-md-3 control-label" for="email">Your E-mail</label>
              <div class="col-md-9">
                <input id="email" name="email" type="text" placeholder="Your email" class="form-control">
              </div>
            </div>

            <!-- Message body -->
            <div class="form-group">
              <label class="col-md-3 control-label" for="message">Your message</label>
              <div class="col-md-9">
                <textarea class="form-control" id="message" name="message" placeholder="Please enter your message here..." rows="5"></textarea>
              </div>
            </div>

            <!-- Form actions -->
            <div class="form-group">
              <div class="col-md-12 text-right">
                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
              </div>
            </div>
          </fieldset>
      </form>
  </div>
</div>
@endsection

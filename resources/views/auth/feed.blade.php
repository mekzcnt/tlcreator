@extends('layouts.master')

@section('title', 'Feed')

@section('code_head')
@endsection

@section('before_container')
<div class="jumbotron">

  <div class="container">
    <h1>Timeline ที่น่าสนใจ</h1>
    {{-- <div class="row equal-height">

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="{{$recommend_1->photo->file}}" alt="{{$recommend_1->title}}">
          <div class="caption">
            <h3><a href="{{route('feed.timeline', $recommend_1->id)}}">{{str_limit($recommend_1->title, 30)}}</a></h3>
            <p>{{str_limit($recommend_1->description, 60)}}</p>
            <p><a href="{{route('feed.timeline', $recommend_1->id)}}" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="{{$recommend_2->photo->file}}" alt="{{$recommend_2->title}}">
          <div class="caption">
            <h3><a href="{{route('feed.timeline', $recommend_2->id)}}">{{str_limit($recommend_2->title, 30)}}</a></h3>
            <p>{{str_limit($recommend_2->description, 60)}}</p>
            <p><a href="{{route('feed.timeline', $recommend_2->id)}}" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="{{$recommend_3->photo->file}}" alt="{{$recommend_3->title}}">
          <div class="caption">
            <h3><a href="{{route('feed.timeline', $recommend_3->id)}}">{{str_limit($recommend_3->title, 30)}}</a></h3>
            <p>{{str_limit($recommend_3->description, 60)}}</p>
            <p><a href="{{route('feed.timeline', $recommend_3->id)}}" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

      <div class="col-md-3 col-sm-6 hero-feature">
        <div class="thumbnail">
          <img src="{{$recommend_4->photo->file}}" alt="{{$recommend_4->title}}">
          <div class="caption">
            <h3><a href="{{route('feed.timeline', $recommend_4->id)}}">{{str_limit($recommend_4->title, 30)}}</a></h3>
            <p>{{str_limit($recommend_4->description, 60)}}</p>
            <p><a href="{{route('feed.timeline', $recommend_4->id)}}" class="btn btn-default">More Info</a></p>
          </div>
        </div>
      </div>

    </div> --}}

    {{-- <p class="text-right"><a class="btn btn-primary btn-lg" href="#" role="button">ดู Timeline ที่น่าสนใจทั้งหมด &raquo;</a></p> --}}

  </div>
</div>
@stop

@section('content')


  <div class="row">
    <div class="col-md-12">
      <div class="page-header">
        <h1>Timeline ล่าสุดในระบบ <small></small></h1>
      </div>
    </div>
  </div>

  <div class="row equal-height">
      @if(count($lastestPosts) > 0)
          @foreach($lastestPosts as $post)
          <div class="col-md-3 col-sm-6 hero-feature">
            <div class="thumbnail">
              <img src="{{$post->photo->file}}" alt="{{$post->title}}">
              <div class="caption">
                <h3><a href="{{route('feed.timeline', $post->id)}}">{{str_limit($post->title, 30)}}</a></h3>
                <p>{{str_limit($post->description, 60)}}</p>
                <p><a href="{{route('feed.timeline', $post->id)}}" class="btn btn-default">More Info</a></p>
              </div>
            </div>
          </div>
          @endforeach
      @endif
  </div>

  @if(count($categories) > 0)
      @foreach($categories as $category)
          <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                  <h1>{{$category->name}} <a href="{{ url('/category', $category->id)}}" class="pull-right"><small>View All &raquo;</small></a></h1>

                </div>
            </div>
          </div>

          <div class="row equal-height">
            @foreach($category->posts->take(4) as $post)
            <div class="col-md-3 col-sm-6 hero-feature">
              <div class="thumbnail">
                <img src="{{$post->photo->file}}" alt="{{$post->title}}">
                <div class="caption">
                  <h3><a href="{{route('feed.timeline', $post->id)}}">{{str_limit($post->title, 30)}}</a></h3>
                  <p>{{str_limit($post->description, 60)}}</p>
                  <p><a href="{{route('feed.timeline', $post->id)}}" class="btn btn-default">More Info</a></p>
                </div>
              </div>
            </div>
            @endforeach
          </div>

    @endforeach
  @endif







@stop

@extends('layouts.master')

@section('title', 'Create your timeline')

@section('code_head')
    <link title="timeline-styles" rel="stylesheet" href="//cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
@stop

@section('before_container')
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">
    <h1 id="title-page" class="text-center">Create a timeline</h1>
    <hr>

    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <div class="panel panel-default">
            <div class="panel-heading" role="tab" id="headingOne">
              <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  Click here for show/hide timeline preview.
                </a>
              </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse out" role="tabpanel" aria-labelledby="headingOne">
              <div class="panel-body">
                <div id='timeline-embed' style="width: 100%; height: 600px"></div>
              </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="col-md-8">
      <div class="well">

        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <strong>{{ $message }}</strong>
          </div>
        @endif

        <div class="form-group">
          <div class="pull-left">
            {!! Form::submit('Add Event', ['class'=>'btn btn-primary', 'data-toggle'=>'modal', 'data-target'=>'#add-event']) !!}
          </div>
          <div class="pull-right">
            {!! Form::submit('Delete All Events', ['class'=>'btn btn-danger', 'onclick'=>'timeline/posts/create/deleteAll']) !!}
          </div>
        </div>


        <table id="eventTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                 <th width="150px">Date</th>
                 <th>Title</th>
                 <th>Actions</th>
               </tr>
          </thead>

          {{-- dd(Session::all()) --}}
          <tbody>
            @if(Session::has('event'))
                @foreach(Session::get('event') as $sEvent)
                  <tr>
                   <td>
                    {{ $sEvent['start_date']['day'] }}-{{ $sEvent['start_date']['month'] }}-{{ $sEvent['start_date']['year'] }}
                   </td>
                   <td>{{ $sEvent['text']['headline'] }}</td>
                   <td>
                     {!! Form::submit('Edit', ['class'=>'btn btn-warning btn-xs', 'data-toggle'=>'modal', 'data-target'=>'#edit-event']) !!}
                     {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-xs', 'data-toggle'=>'modal', 'data-target'=>'#delete-event']) !!}
                   </td>
                  </tr>
                @endforeach
            @endif

          </tbody>
        </table>
      </div>
    </div>

    <input type="hidden" name="hidden_view" id="hidden_view" value="{{url('timeline/posts/create/view')}}">
    <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('timeline/posts/create/delete')}}">

    <!-- Add modal start -->
    <div class="modal fade" id="add-event" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          <form action="{{ url('/timeline/posts/create/add') }}" method="post">

          {{ csrf_field() }}

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Event</h4>
          </div>

          <div class="modal-body">
                <div class="form-group">

                  <div class="row">

                    <div class="col-md-4">
                      <h4>Date</h4>
                    </div>

                    <div class="col-md-8">
                      <div class="row">
                        <div class="col-md-6">
                          <label for="day">Day:</label>
                          <input type="text" class="form-control" id="event_day" name="event_day">
                        </div>
                        <div class="col-md-6">
                          <label for="month">Month:</label>
                          <input type="text" class="form-control" id="event_month" name="event_month">
                        </div>
                        <div class="col-md-6">
                          <label for="year">Year:</label>
                          <input type="text" class="form-control" id="event_year" name="event_year">
                        </div>
                      </div>
                    </div>

                </div>


                <hr>

                <h4>Details</h4>
                <hr>

                <div class="form-group">
                  <label for="event_title">Event Title:</label>
                  <input type="text" class="form-control" id="event_title" name="event_title">
                </div>

                <div class="form-group">
                  <label for="event_description">Event Description:</label>
                  <input type="text" class="form-control" id="event_description" name="event_description" rows="3">
                </div>

                <hr>

                <h4>Media</h4>
                <hr>

                <div class="form-group">
                  <div class="form-group">
                    <label for="event_media_url">URL:</label>
                    <input type="text" class="form-control" id="event_media_url" name="event_media_url" placeholder="Type Image URL, YouTube Link or Twitter Link">
                  </div>

                  <div class="form-group">
                    <label for="event_media_caption">Caption:</label>
                    <input type="text" class="form-control" id="event_media_caption" name="event_media_caption">
                  </div>

                  <div class="form-group">
                    <label for="event_media_credit">Credit:</label>
                    <input type="text" class="form-control" id="event_media_credit" name="event_media_credit">
                  </div>
                </div>

                <hr>

              </div>
          </div>

          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>

          </form>

        </div>

      </div>

    </div>
    <!-- Add modal ends -->



    @include('includes.form_error')

    {!! Form::open(['method'=>'POST', 'action'=>'UserPostsController@store', 'files'=>true]) !!}

    <div class="col-md-4">
      <div class="well">
        <div class="form-group">
              {!! Form::label('title', 'Title:') !!}
              {!! Form::text('title', null, ['class'=>'form-control'])!!}
        </div>

         <div class="form-group">
             {!! Form::label('category_id', 'Category:') !!}
             {!! Form::select('category_id', [''=>'Choose Categories'] + $categories, null, ['class'=>'form-control']) !!}
         </div>


         <div class="form-group">
             {!! Form::label('photo_id', 'Photo:') !!}
             {!! Form::file('photo_id', null, ['class'=>'form-control'])!!}
          </div>


         <div class="form-group">
             {!! Form::label('description', 'Description:') !!}
             {!! Form::textarea('description', null, ['class'=>'form-control', 'rows'=>2])!!}
         </div>

          <div class="form-group">
             {!! Form::submit('Create Timeline', ['class'=>'btn btn-success btn-lg']) !!}
          </div>
      </div>
    </div>

    {!! Form::close() !!}

  </div>
</div>

@stop

@section('code_foot')
    <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>
    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript">
      function make_the_json() {
        var obj = { };
        return obj;
      }
      var timeline_json = make_the_json(); // you write this part
      // two arguments: the id of the Timeline container (no '#')
      // and the JSON object or an instance of TL.TimelineConfig created from
      // a suitable JSON object
      window.timeline = new TL.Timeline('timeline-embed', timeline_json);
    </script>

    <script>
      $(document).ready(function(){
        $('#eventTable').DataTable({
          "paging":   false,
          "searching":   false
        });
      });
    </script>

@stop

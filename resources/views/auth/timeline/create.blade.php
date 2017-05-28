@extends('layouts.master')

@section('title', request()->route()->getAction()['as'] == 'auth.timeline.edit' ? 'Edit your timeline' : 'Create your timeline')

@section('code_head')
    <link title="timeline-styles" rel="stylesheet" href="//cdn.knightlab.com/libs/timeline3/latest/css/timeline.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/css/bootstrap-datepicker.min.css" />
@stop

@section('before_container')
@stop

@section('content')
<div class="row">
  <div class="col-lg-12">

    @if (request()->route()->getAction()['as'] == 'auth.timeline.edit')
      <h1 id="title-page" class="text-center">Edit a timeline</h1>
    @else
      <h1 id="title-page" class="text-center">Create a timeline</h1>
    @endif

    {{-- dd(Session::get('event'.$postId)) --}}
    <div class="panel panel-default {{ count(Session::get('event'.$postId)) == 0 ? 'hidden' : '' }}">
      <div class="panel-body">
        <div id="timeline-embed" style="width: 100%; height: 600px"></div>
      </div>
    </div>
    {{-- <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
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
                  <div id="timeline-embed" style="width: 100%; height: 600px"></div>
              </div>
            </div>
        </div>
    </div> --}}

    <hr>

    <div class="col-md-8">
      <div class="well">

        @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>  <strong>{{ $message }}</strong>
          </div>
        @endif

        @include('includes.form_error')

        <div class="form-group">
          <div class="pull-left">
            {!! Form::button('<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Event', ['class'=>'btn btn-primary', 'data-toggle'=>'modal', 'data-target'=>'#add-event']) !!}
          </div>
          <div class="pull-right">
            {!! Form::open(['method'=>'DELETE', 'action'=>['UserPostsController@deleteAllEvent', $postId]]) !!}
                {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"></span> Delete All Events', ['class'=>'btn btn-danger']) !!}
            {!! Form::close() !!}
          </div>
        </div>

        <table id="eventTable" class="table table-striped table-bordered">
          <thead>
              <tr>
                 <th>Date</th>
                 <th>Title</th>
                 <th>Actions</th>
               </tr>
          </thead>


          <tbody>
            @if(Session::has('event'.$postId))
                @foreach(Session::get('event'.$postId) as $id => $sEvent)

                  <tr>
                   <td>
                      {{ empty($sEvent['start_date']['day']) ? '' : $sEvent['start_date']['day'].'-' }}{{ empty($sEvent['start_date']['month']) ? '' : $sEvent['start_date']['month'].'-' }}{{ empty($sEvent['start_date']['year']) ? '' : $sEvent['start_date']['year'] }}
                   </td>
                   <td>{{ $sEvent['text']['headline'] or '' }}</td>
                   <td>
                        <button class="btn btn-warning btn-xs col-md-6" type="button" name="button" data-toggle="modal" data-target="#edit-event-{{$id}}">Edit</button>

                       {!! Form::open(['method'=>'DELETE', 'action'=>['UserPostsController@deleteEvent', $postId, $id]]) !!}
                          {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-xs col-md-6', 'data-toggle'=>'modal', 'data-target'=>'#delete-event']) !!}
                       {!! Form::close() !!}
                   </td>
                  </tr>

                  <!-- Edit modal start -->
                  <div class="modal fade" id="edit-event-{{$id}}" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">

                        {{-- <form action="{{ url('/timeline/posts/create/update') }}" method="post"> --}}
                        {!! Form::open(['method'=>'POST', 'action'=>['UserPostsController@updateEvent', $postId, $id]]) !!}

                        {{ csrf_field() }}

                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Edit Event</h4>
                        </div>

                        <div class="modal-body">

                              <div class="row">
                                  <div class="col-md-4 text-right">
                                    <h4>Date</h4>
                                  </div>
                                  <div class="col-md-8">

                                    <div class="row">

                                      <div class="col-md-6">
                                        <div class="dropdown">
                                          <div class="form-group">
                                               <select autocomplete="off" class="form-control" id="selectDateDisplay" name="selectDateDisplay" onchange="selectCheck(this);">
                                                 <option value="">Select Date Display</option>
                                                 <option id="yOption" value="y" {{ empty($sEvent['start_date']['month']) ? 'selected' : '' }}>Year only</option>
                                                 <option id="ymOption" value="ym" {{ (empty($sEvent['start_date']['day']) and !empty($sEvent['start_date']['month'])) ? 'selected' : '' }}>Month and Year</option>
                                                 <option id="ymdOption" value="ymd" {{ !empty($sEvent['start_date']['day']) ? 'selected' : '' }}>Day, Month and Year</option>
                                               </select>
                                          </div>
                                        </div>
                                      </div>

                                      <div class="col-md-6">
                                        <div class="input-group yDate yDivCheck {{ empty($sEvent['start_date']['month']) ? '' : 'hidden' }}">
                                            <span class="input-group-addon">
                                              <i class="glyphicon glyphicon-calendar"></i>
                                            </span>
                                            <input autocomplete="off" type="text" name="event_year" class="form-control event_year" value="{{ empty($sEvent['start_date']['year']) ? '' : $sEvent['start_date']['year'] }}" placeholder="yyyy">
                                        </div>
                                        <div class="input-group ymDate ymDivCheck {{ (empty($sEvent['start_date']['day']) and !empty($sEvent['start_date']['month'])) ? '' : 'hidden' }}">
                                            <span class="input-group-addon">
                                              <i class="glyphicon glyphicon-calendar"></i>
                                            </span>
                                            <input autocomplete="off" type="text"  name="event_year_month" class="form-control event_year_month" value="{{ empty($sEvent['start_date']['month']) ? '' : $sEvent['start_date']['month'].'-'.$sEvent['start_date']['year'] }}" placeholder="mm-yyyy">
                                        </div>
                                        <div  class="input-group ymdDate ymdDivCheck {{ !empty($sEvent['start_date']['day']) ? '' : 'hidden' }}">
                                            <span class="input-group-addon">
                                              <i class="glyphicon glyphicon-calendar"></i>
                                            </span>
                                            <input autocomplete="off" type="text" name="event_year_month_date" class="form-control event_year_month_date" value="{{ empty($sEvent['start_date']['day']) ? '' : $sEvent['start_date']['day'].'-'.$sEvent['start_date']['month'].'-'.$sEvent['start_date']['year'] }}" placeholder="dd-mm-yyyy">
                                        </div>
                                      </div>

                                    </div>

                                  </div>
                              </div>

                              <hr>

                              <div class="row">
                                  <div class="col-md-4 text-right">
                                    <h4>Details</h4>
                                  </div>

                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <label for="event_title">Event Title:</label>
                                      <input type="text" class="form-control" id="event_title" name="event_title" value="{{ $sEvent['text']['headline'] or '' }}">
                                    </div>

                                    <div class="form-group">
                                      <label for="event_description">Event Description:</label>
                                      <input type="text" class="form-control" id="event_description" name="event_description" value="{{ $sEvent['text']['text'] or '' }}">
                                    </div>
                                  </div>
                              </div>

                              <hr>

                              <div class="row">
                                  <div class="col-md-4 text-right">
                                    <h4>Media</h4>
                                  </div>
                                  <div class="col-md-8">
                                    <div class="form-group">
                                      <div class="form-group">
                                        <label for="event_media_url">URL:</label>
                                        <input type="text" class="form-control" id="event_media_url" name="event_media_url" placeholder="Type Image URL, YouTube Link or Twitter Link" value="{{ $sEvent['media']['url'] or '' }}">
                                      </div>

                                      <div class="form-group">
                                        <label for="event_media_caption">Caption:</label>
                                        <input type="text" class="form-control" id="event_media_caption" name="event_media_caption" value="{{ $sEvent['media']['caption'] or '' }}">
                                      </div>

                                      <div class="form-group">
                                        <label for="event_media_credit">Credit:</label>
                                        <input type="text" class="form-control" id="event_media_credit" name="event_media_credit" value="{{ $sEvent['media']['credit'] or '' }}">
                                      </div>
                                    </div>
                                  </div>
                              </div>

                        </div>

                        <div class="modal-footer">
                          <!-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> -->
                          <button type="submit" class="btn btn-primary">Edit Event</button>
                        </div>

                        {{-- </form> --}}
                        {!! Form::close() !!}

                      </div>

                    </div>

                  </div>
                  <!-- Edit modal ends -->

                @endforeach
            @endif

          </tbody>
        </table>
      </div>
    </div>

    {{-- <input type="hidden" name="hidden_delete" id="hidden_delete" value="{{url('timeline/posts/create/delete')}}"> --}}

    <!-- Add modal start -->
    <div class="modal fade" id="add-event" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">

          <form action="{{ route('addEvent', $postId) }}" method="post">

          {{ csrf_field() }}

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add Event</h4>
          </div>

          <div class="modal-body">

                <div class="row">
                    <div class="col-md-4 text-right">
                      <h4>Date</h4>
                    </div>
                    <div class="col-md-8">

                      <div class="row">

                        <div class="col-md-6">
                          <div class="dropdown">
                            <div class="form-group">
                                 <select autocomplete="off" class="form-control" id="selectDateDisplay" name="selectDateDisplay" onchange="selectCheck(this);">
                                   <option value="" selected="selected">Select Date Display</option>
                                   <option id="yOption" value="y">Year only</option>
                                   <option id="ymOption" value="ym">Month and Year</option>
                                   <option id="ymdOption" value="ymd">Day, Month and Year</option>
                                 </select>
                            </div>
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="input-group yDate hidden yDivCheck">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input autocomplete="off" type="text" name="event_year" class="form-control event_year" value="{{ old("event_date") }}" placeholder="yyyy">
                          </div>
                          <div class="input-group ymDate hidden ymDivCheck">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input autocomplete="off" type="text" name="event_year_month" class="form-control event_year_month" value="{{ old("event_date") }}" placeholder="mm-yyyy">
                          </div>
                          <div class="input-group ymdDate hidden ymdDivCheck">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span><input autocomplete="off" type="text" name="event_year_month_date" class="form-control event_year_month_date" value="{{ old("event_date") }}" placeholder="dd-mm-yyyy">
                          </div>
                        </div>

                      </div>

                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-4 text-right">
                      <h4>Details</h4>
                    </div>

                    <div class="col-md-8">
                      <div class="form-group">
                        <label for="event_title">Event Title:</label>
                        <input type="text" class="form-control" id="event_title" name="event_title">
                      </div>

                      <div class="form-group">
                        <label for="event_description">Event Description:</label>
                        <input type="text" class="form-control" id="event_description" name="event_description" rows="3">
                      </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-4 text-right">
                      <h4>Media</h4>
                    </div>
                    <div class="col-md-8">
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
                    </div>
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

    @if (request()->route()->getAction()['as'] == 'auth.timeline.edit')
      {!! Form::model($post, ['method'=>'PATCH', 'action'=>['UserPostsController@update', $post->id], 'files'=>true]) !!}

      <div class="col-md-4">
        <div class="well">
          <div class="form-group">
                {!! Form::label('title', 'Title:') !!}
                {!! Form::text('title', null, ['class'=>'form-control', 'value'=>'{{ $post->title }}'])!!}
          </div>

           <div class="form-group">
               {!! Form::label('category_id', 'Category:') !!}
               {!! Form::select('category_id', [''=>'Choose Categories'] + $categories, null, ['class'=>'form-control', 'value'=>'{{ $post->category->name }}']) !!}
           </div>

           <div class="form-group">
               {!! Form::label('photo_id', 'Photo:') !!}
               <label class="btn btn-default btn-file btn-block">
                 {!! Form::file('photo_id', null, ['class'=>'form-control'])!!}
               </label>
            </div>

           <div class="form-group">
               {!! Form::label('description', 'Description:') !!}
               {!! Form::textarea('description', null, ['class'=>'form-control', 'value'=>'{{ $post->description }}', 'rows'=>2])!!}
           </div>

            <div class="form-group">
               {!! Form::submit('Edit Timeline', ['class'=>'btn btn-primary btn-lg']) !!}
            </div>

        </div>
      </div>

      {!! Form::close() !!}
    @else
      {!! Form::open(['method'=>'POST', 'action'=>['UserPostsController@store', $postId], 'files'=>true]) !!}

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
               <label class="btn btn-default btn-file btn-block">
                 {!! Form::file('photo_id', null, ['class'=>'form-control'])!!}
               </label>
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
    @endif



  </div>
</div>

@stop

@section('code_foot')

    <script src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
    <script src="//cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.knightlab.com/libs/timeline3/latest/js/timeline.js"></script>

    {{-- TimelineJS3 JavaScript Settings --}}
    <script type="text/javascript">
      function make_the_json() {
        @if(Session::has('event'.$postId))
          var obj = {
            "title": {
                "media": {
                  "url": "",
                  "caption": "",
                  "credit": ""
                },
                "text": {
                  "headline": "",
                  "text": ""
                }
            },
            "events":
                  {{-- dd(json_encode(Session::get('event'.$postId)) --}}
                  @if (request()->route()->getAction()['as'] == 'auth.timeline.edit')
                    {!! json_encode(Session::get('event'.$postId)) !!}
                  @else
                    {!! json_encode(Session::get('event'.$postId), JSON_UNESCAPED_SLASHES) !!}
                  @endif
          };
          return obj;
        @endif
      }

      var timeline_json = make_the_json();

      var additionalOptions = {
          start_at_end: true
      }

      window.timeline = new TL.Timeline('timeline-embed', timeline_json, additionalOptions);
    </script>

    {{-- DateTables JavaScript Settings --}}
    <script>
      $(document).ready(function(){
        $('#eventTable').DataTable({
          "paging":   false,
          "searching":   false,
          "columnDefs": [
            { "width": "20%", "targets": 0 },
            { "width": "20%", "orderable": false, "targets": 2 }
          ]
        });
      });
    </script>

    {{-- bootstrap-datepicker JavaScript Settings --}}
    <script>

      $('.event_year').datepicker({
          endDate: "+100d",
          format: "yyyy",
          viewMode: "years",
          minViewMode: "years",
      });
      $('.event_year_month').datepicker({
          endDate: "+100d",
          format: "mm-yyyy",
          startView: "months",
          minViewMode: "months",
      });
      $('.event_year_month_date').datepicker({
          endDate: "+100d",
          format: "dd-mm-yyyy"
      });

      function selectCheck(nameSelect)
      {
          if(nameSelect){
              yValue = document.getElementById("yOption").value;
              ymValue = document.getElementById("ymOption").value;
              ymdValue = document.getElementById("ymdOption").value;

              if(yValue == nameSelect.value){
                  $('.yDivCheck').removeClass('hidden');
                  $('.ymDivCheck').addClass('hidden');
                  $('.ymdDivCheck').addClass('hidden');
              }
              else if(ymValue == nameSelect.value){
                  $('.yDivCheck').addClass('hidden');
                  $('.ymDivCheck').removeClass('hidden');
                  $('.ymdDivCheck').addClass('hidden');
              }
              else if(ymdValue == nameSelect.value){
                  $('.yDivCheck').addClass('hidden');
                  $('.ymDivCheck').addClass('hidden');
                  $('.ymdDivCheck').removeClass('hidden');
              }
          }
      }
    </script>
@stop

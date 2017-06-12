<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Category;
use App\Post;
use App\User;
use App\Like;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class UserPostsController extends Controller
{

    public function __construct()
    {
          $this->arr =
            array('title' =>
              array('media' =>
                    array(
                      'url' => '',
                      'caption' => '',
                      'credit' => '',
                    ),
                  'text' =>
                    array(
                      'headline' => '',
                      'text' => '',
                    ),
                ),
            )+
            array('events' => array(


              )
            );
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $postId = 0;
        $categories = Category::pluck('name','id')->all();
        return view('auth.timeline.create', compact('postId', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $input = $request->all();

      $this->validate($request, [
          'title'         =>  'required',
          'category_id'   =>  'required',
          'photo_id'      =>  'required',
          'description'   =>  'required'
      ]);

      $user = Auth::user();

      if($file = $request->file('photo_id')){
          $name = time() . $file->getClientOriginalName();

          $file->move('uploads', $name);
          $photo = Photo::create(['file'=>$name]);

          $input['photo_id'] = $photo->id;
      }

      $arr['title']['media']['url'] = $photo->file;
      $arr['title']['text']['headline'] = $request->title;
      $arr['title']['text']['text'] = $request->description;

      $arr['events'] = $request->session()->get('event0');

      $postInfoInput = json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      $input['timeline'] = $postInfoInput;

      $user->posts()->create($input);

      $request->session()->forget('event0');

      return redirect('/'.$user->username);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {

      $post = Post::findOrFail($id);
      $postId = $post->id;
      $timelineDecoded = json_decode($post->timeline, true);
      $event = $timelineDecoded['events'];

      if (!$request->session()->has('event'.$id)) {
        $request->session()->put('event'.$post->id, $event);
      }

      $categories = Category::pluck('name','id')->all();

      return view('auth.timeline.create', compact('post','categories','postId'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $input = $request->all();
      $post = Post::findOrFail($id);

      if($file = $request->file('photo_id')){
            $name = time() . $file->getClientOriginalName();

            $file->move('uploads', $name);
            $photo = Photo::create(['file'=>$name]);

            $input['photo_id'] = $photo->id;
            $arr['title']['media']['url'] = $photo->file;
      }
      else {
        $arr['title']['media']['url'] = $post->photo->file;
      }


      $arr['title']['text']['headline'] = $request->title;
      $arr['title']['text']['text'] = $request->description;

      $arr['events'] = $request->session()->get('event'.$id);

      $postInfoInput = json_encode($arr, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      $input['timeline'] = $postInfoInput;

      //Updata data which you edit them in forms
      Auth::user()->posts()->whereId($id)->first()->update($input);

      // $request->session()->forget('event'.$id);

      return redirect('/'.Auth::user()->username);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrFail($id);

      // Check if the post has a photo:
      if(isset($post->photo->file)) {
        unlink(public_path() . $post->photo->file);
      }

      //Delete a photo when delete a post
      $posts = DB::select('SELECT * FROM posts WHERE user_id = ?', [$id]);
      foreach ($posts as $post) {
        if ($post->photo_id) {
          $photo = Photo::findOrFail($post->photo_id);
          unlink(public_path() . $photo->file);
          $photo->delete();
        }
      }

      $post->delete();

      return redirect('/'.Auth::user()->username);
    }


    /**
     * Add event in add timeline page
     */
    public function addEvent(Request $request, $postId)
    {
      $this->validate($request, [
          'event_title' => 'required|max:255'
      ]);

      $event = array(
        "media" => array(
            "url"     => $request->event_media_url,
            "caption" => $request->event_media_caption,
            "credit"  => $request->event_media_credit
          ),
        "start_date" => array(),
        "text" => array(
            "headline" => $request->event_title,
            "text" => $request->event_description
          )
        );

      if($request->selectDateDisplay == 'y'){
        $this->validate($request, [
            'event_year' => 'required'
        ]);

        $event['start_date'] = array(
            "year"    => $request->event_year
          );
      }

      else if($request->selectDateDisplay == 'ym'){
        $this->validate($request, [
            'event_year_month' => 'required'
        ]);

        $day = $request->event_year_month;
        $date = explode("-", $day);
        $event_month = $date[0];
        $event_year = $date[1];
        $event['start_date'] = array(
            "month"   => $event_month,
            "year"    => $event_year
          );
      }

      else if($request->selectDateDisplay == 'ymd'){
        $this->validate($request, [
            'event_year_month_date' => 'required'
        ]);

        $day = $request->event_year_month_date;
        $date = explode("-", $day);
        $event_day = $date[0];
        $event_month = $date[1];
        $event_year = $date[2];

        $event['start_date'] = array(
            "day"     => $event_day,
            "month"   => $event_month,
            "year"    => $event_year
          );
      }

      else {
        $this->validate($request, [
            'event_year' => 'required',
            'event_year_month' => 'required',
            'event_year_month_date' => 'required'
        ]);
      }


      $request->session()->push('event'.$postId, $event);

      return back()->with('success','Event Added successfully.');
    }

    /**
     * Update timeline events in add timeline page
     */
    public function updateEvent(Request $request, $postId, $id)
     {
         $this->validate($request, [
             'event_title' => 'required|max:255'
         ]);

         $eventUpdate = array(
           "media" => array(
               "url"     => $request->event_media_url,
               "caption" => $request->event_media_caption,
               "credit"  => $request->event_media_credit
             ),
           "start_date" => array(),
           "text" => array(
               "headline" => $request->event_title,
               "text" => $request->event_description
             )
           );

         if($request->selectDateDisplay == 'y'){
           $eventUpdate['start_date'] = array(
               "year"    => $request->event_year
             );
         }

         else if($request->selectDateDisplay == 'ym'){
           $day = $request->event_year_month;
           $date = explode("-", $day);
           $event_month = $date[0];
           $event_year = $date[1];
           $eventUpdate['start_date'] = array(
               "month"   => $event_month,
               "year"    => $event_year
             );
         }

         else if($request->selectDateDisplay == 'ymd'){
           $day = $request->event_year_month_date;
           $date = explode("-", $day);
           $event_day = $date[0];
           $event_month = $date[1];
           $event_year = $date[2];

           $eventUpdate['start_date'] = array(
               "day"     => $event_day,
               "month"   => $event_month,
               "year"    => $event_year
             );
         }

         else {
           $this->validate($request, [
               'event_year' => 'required',
               'event_year_month' => 'required',
               'event_year_month_date' => 'required'
           ]);
         }

         $event = $request->session()->get('event'.$postId);

         $event[$id] = $eventUpdate;

         $request->session()->put('event'.$postId, $event);

         return back()->with('success','Events updated successfully.');
     }

     /**
      * Delete timeline event in add timeline page
      */
    public function deleteEvent(Request $request, $postId, $id)
      {
          $event = $request->session()->get('event'.$postId);
          unset($event[$id]);
          $event2 = array_values($event);
          $request->session()->put('event'.$postId, $event2);


          return back()->with('success','Events deleted successfully.');
      }

      /**
       * Delete all timeline event in add timeline page
       */
     public function deleteAllEvent(Request $request, $postId)
       {
          $request->session()->forget('event'.$postId);

          return back()->with('success','All Events deleted successfully.');
       }



       /**
        * show timeline post
        */
       public function post($id){
           $post = Post::findOrFail($id);
           $comments = $post->comments()->whereIsActive(1)->get();
           $countLikes = Like::where('likeable_id', '=', $id)->count();
           return view('web.timeline-post', compact('post','comments', 'countLikes'));
       }

       public function embed($id){
           $post = Post::findOrFail($id);
           return view('auth.timeline.embed', compact('post'));
       }


}

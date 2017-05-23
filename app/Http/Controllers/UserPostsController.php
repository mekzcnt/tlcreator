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
        $ss_event = Session::get('event');
        $categories = Category::pluck('name','id')->all();
        return view('auth.timeline.create', compact('ss_event', 'categories'));
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

      $arr['events'] = Session::get('event');

      $postInfoInput = json_encode($arr, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
      $input['timeline'] = $postInfoInput;

      $user->posts()->create($input);

      $request->session()->forget('event');

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
    public function edit($id)
    {

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
     * Add event to timeline
     */
    public function addEvent(Request $request)
    {
      $day = $request->event_date;
      $date = explode("-", $day);
      $event_day = $date[0];
      $event_month = $date[1];
      $event_year = $date[2];

      $event = array(
      "media" => array(
          "url"     => $request->event_media_url,
          "caption" => $request->event_media_caption,
          "credit"  => $request->event_media_credit
        ),
      "start_date" => array(
          "month"   => $event_month,
          "day"     => $event_day,
          "year"    => $event_year
        ),
      "text" => array(
          "headline" => $request->event_title,
          "text" => $request->event_description
        )
      );

      $request->session()->push('event', $event);


      return back()->with('success','Event Added successfully.');
    }

    /**
     * Update timeline events
     */
    public function updateEvent(Request $request, $id)
     {
       $day = $request->event_date;
       $date = explode("-", $day);
       $event_day = $date[0];
       $event_month = $date[1];
       $event_year = $date[2];
       
       $newEvent = array(
       "media" => array(
           "url"     => $request->event_media_url,
           "caption" => $request->event_media_caption,
           "credit"  => $request->event_media_credit
         ),
       "start_date" => array(
           "month"   => $event_month,
           "day"     => $event_day,
           "year"    => $event_year
         ),
       "text" => array(
           "headline" => $request->event_title,
           "text" => $request->event_description
         )
       );
        $event = $request->session()->get('event');
        $event[$id] = $newEvent;
        $request->session()->put('event', $event);

        return back()->with('success','Events updated successfully.');
     }

     /**
      * Delete timeline event
      */
    public function deleteEvent(Request $request, $id)
      {
          $event = $request->session()->get('event');
          unset($event[$id]);
          $request->session()->put('event', $event);

          return back()->with('success','Events deleted successfully.');
      }

      /**
       * Delete all timeline event
       */
     public function deleteAllEvent(Request $request)
       {
          $request->session()->forget('event');

          return back()->with('success','All Events deleted successfully.');
       }

       public function post($id){
           $post = Post::findOrFail($id);
           $comments = $post->comments()->whereIsActive(1)->get();
           $countLikes = Like::where('likeable_id', '=', $id)->count();
           return view('web.timeline-post', compact('post','comments', 'countLikes'));
       }

}

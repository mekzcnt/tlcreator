<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Photo;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      // event after the photo was deleted in the db
      Photo::deleted(function($photo) {
          File::delete(public_path() . $photo->path);
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

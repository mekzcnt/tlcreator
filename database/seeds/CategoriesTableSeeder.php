<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roles = [
        [
          'name' => 'Thai History'
        ],
        [
          'name' => 'World History'
        ],
        [
          'name' => 'Thailand News'
        ],
        [
          'name' => 'World News'
        ],
      ];

      foreach ($role as $key => $value) {
         Permission::create($value);
      }
    }
}

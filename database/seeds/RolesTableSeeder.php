<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesTableSeeder extends Seeder
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
            'name' => 'Admistrator'
          ],
          [
            'name' => 'Author'
          ],
          [
            'name' => 'Subscriber'
          ],
        ];

        foreach ($role as $key => $value) {
        	 Permission::create($value);
        }
    }
}

<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       for ($i=0 ; $i<3; $i++){
          $team =  Team::create([
                 'name'=> 'Walter White',
                  'job'=>'Chief Executive Officer',
                  'description'=>'Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis quaerat qui aut aut aut'

               ]);
          $team->file()->create(['file'=>'team-1.jpg']);
       }

       Contact::create([
          'phone'=> '+1 5589 55488 55',
          'email'=> 'info@example.com',
       ]);
    }
}

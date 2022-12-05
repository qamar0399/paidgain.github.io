<?php

namespace Database\Seeders;

use App\Models\Term;
use Illuminate\Database\Seeder;

class TermSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $terms = array(
            array('id' => '1','user_id' => '1','title' => 'What\'s new in 2022 Tech','slug' => 'whats-new-in-2022-tech','type' => 'blog','status' => '1','featured' => '1','lang' => 'en','comment_status' => '1','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-08 19:30:43'),
            array('id' => '2','user_id' => '1','title' => 'The new in 2022 Tech','slug' => 'the-new-in-2022-tech','type' => 'blog','status' => '1','featured' => '1','lang' => 'en','comment_status' => '1','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-08 19:30:43'),
            array('id' => '3','user_id' => '1','title' => 'What\'s new in 2022 Tech','slug' => 'whats-new-in-2022','type' => 'blog','status' => '1','featured' => '1','lang' => 'en','comment_status' => '1','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-08 19:30:43'),
            array('id' => '4','user_id' => '1','title' => 'Terms','slug' => 'terms','type' => 'page','status' => '1','featured' => '1','lang' => 'en','comment_status' => '0','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-08 19:30:43'),
            array('id' => '5','user_id' => '1','title' => 'Our Facilities','slug' => 'our-facilities','type' => 'page','status' => '1','featured' => '1','lang' => 'en','comment_status' => '0','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-13 08:02:25'),
            array('id' => '16','user_id' => '1','title' => 'Complete Online Tasks & Offers To Make Money','slug' => '','type' => 'about','status' => '1','featured' => '0','lang' => 'en','comment_status' => '0','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-08 19:30:43')
        );

        Term::insert($terms);
    }
}

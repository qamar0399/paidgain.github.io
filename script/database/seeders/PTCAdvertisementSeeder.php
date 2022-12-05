<?php

namespace Database\Seeders;

use App\Models\Ptc;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PTCAdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ptcs = array(
            array('id' => '3','user_id' => '1','title' => 'Link','ads_type' => 'link_url','ads_body' => 'https://wecodea.com','slug' => 'link-2022-06-07-063948','amount' => '0.8','duration' => '5','max_limit' => '9','is_clickable' => '0','status' => '1','created_at' => '2022-06-07 06:39:48','updated_at' => '2022-06-07 06:39:48'),
            array('id' => '4','user_id' => '1','title' => 'Hello World','ads_type' => 'banner_image','ads_body' => '/uploads/1/22/06/629ef3440f7b20706221654584132.png','slug' => 'hello-world-2022-06-07-064242','amount' => '0.5','duration' => '10','max_limit' => '2','is_clickable' => '0','status' => '1','created_at' => '2022-06-07 06:42:42','updated_at' => '2022-06-07 06:42:42'),
            array('id' => '5','user_id' => '1','title' => 'Clickable Image','ads_type' => 'clickable_image','ads_body' => 'https://wecodea.com','slug' => 'clickable-image-2022-06-07-064417','amount' => '0.6','duration' => '10','max_limit' => '100','is_clickable' => '0','status' => '1','created_at' => '2022-06-07 06:44:17','updated_at' => '2022-06-07 06:44:17'),
            array('id' => '6','user_id' => '1','title' => 'Script Code','ads_type' => 'script_code','ads_body' => '','slug' => 'script-code-2022-06-07-065319','amount' => '0.7','duration' => '10','max_limit' => '100','is_clickable' => '0','status' => '1','created_at' => '2022-06-07 06:53:19','updated_at' => '2022-06-07 06:53:19')
        );

        Ptc::insert($ptcs);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Ptcmeta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PTCAdvertisementMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ptcmetas = array(
            array('id' => '2','ptc_id' => '3','key' => 'image','value' => '/uploads/1/22/06/629eec7291fed0706221654582386.png','created_at' => '2022-06-07 06:39:48','updated_at' => '2022-06-07 06:39:48'),
            array('id' => '3','ptc_id' => '4','key' => 'image','value' => '/uploads/1/22/06/629ef3440f7b20706221654584132.png','created_at' => '2022-06-07 06:42:42','updated_at' => '2022-06-07 06:42:42'),
            array('id' => '4','ptc_id' => '5','key' => 'image','value' => '/uploads/1/22/06/629eec7291fed0706221654582386.png','created_at' => '2022-06-07 06:44:17','updated_at' => '2022-06-07 06:44:17'),
            array('id' => '5','ptc_id' => '6','key' => 'image','value' => '/uploads/1/22/06/629ef5d74d95f0706221654584791.png','created_at' => '2022-06-07 06:53:19','updated_at' => '2022-06-07 06:53:19')
        );

        Ptcmeta::insert($ptcmetas);
    }
}

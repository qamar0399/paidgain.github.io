<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = array(
            array('id' => '1','name' => 'Investment Plan','position' => 'footer_left_menu','data' => '[{"text":"Investor","icon":"empty","href":"/top-investors","target":"_self","title":""},{"text":"Earn Money","icon":"","href":"/earn-money","target":"_self","title":""},{"text":"Terms & Condition","href":"/page/terms","icon":"empty","target":"_self","title":""},{"text":"Contact","href":"/contact","icon":"empty","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-08 19:30:43'),
            array('id' => '2','name' => 'Marketplace','position' => 'footer','data' => '[{"text":"About","icon":"empty","href":"/about","target":"_self","title":""},{"text":"Price Plans","icon":"","href":"/pricing","target":"_self","title":""},{"text":"FAQ","icon":"empty","href":"/faq","target":"_self","title":""},{"text":"Clients","icon":"empty","href":"/clients","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-08 19:30:43'),
            array('id' => '3','name' => 'Company','position' => 'footer_right_menu','data' => '[{"text":"Login","href":"/login","icon":"empty","target":"_self","title":""},{"text":"Blog Lists","href":"/blog","icon":"empty","target":"_self","title":""},{"text":"Blog Details","href":"/blog/whats-new-in-2022-tech","icon":"empty","target":"_self","title":""},{"text":"Facilities","href":"/page/our-facilities","icon":"empty","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-08 19:30:43'),
            array('id' => '4','name' => 'Navbar','position' => 'header','data' => '[{"text":"Home","icon":"","href":"/","target":"_self","title":""},{"text":"About","icon":"empty","href":"/about","target":"_self","title":""},{"text":"Earn Money","icon":"empty","href":"/earn-money","target":"_self","title":""},{"text":"Pages","icon":"empty","href":"javascript:void(0)","target":"_self","title":"","children":[{"text":"Top Investors","icon":"empty","href":"/top-investors","target":"_self","title":""},{"text":"Price Plans","icon":"empty","href":"/pricing","target":"_self","title":""},{"text":"FAQ","icon":"empty","href":"/faq","target":"_self","title":""},{"text":"Clients","icon":"empty","href":"/clients","target":"_self","title":""}]},{"text":"Blog","icon":"empty","href":"/blog","target":"_self","title":""},{"text":"Contact","icon":"empty","href":"/contact","target":"_self","title":""}]','lang' => 'en','status' => '1','created_at' => '2022-06-08 19:30:43','updated_at' => '2022-06-08 19:30:43')
        );

        Menu::insert($menus);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Option;
use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $options = array(
            array('id' => '1','key' => 'seo_home','value' => '{"site_name":"ptc","matatag":"ptc","twitter_site_title":"@ptc","matadescription":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since"}','lang' => 'en'),
            array('id' => '2','key' => 'seo_blog','value' => '{"site_name":"Blog","matatag":"Blog","twitter_site_title":"Blog","matadescription":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since"}','lang' => 'en'),
            
            array('id' => '4','key' => 'seo_contract','value' => '{"site_name":"Contact Us","matatag":"Contract","twitter_site_title":"Contact Us","matadescription":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since"}','lang' => 'en'),
            array('id' => '5','key' => 'seo_pricing','value' => '{"site_name":"Pricing","matatag":"Pricing","twitter_site_title":"Pricing","matadescription":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since"}','lang' => 'en'),

            array('id' => '6','key' => 'languages','value' => '{"en":"English"}','lang' => 'en'),
            array('id' => '7','key' => 'currency_info','value' => '{"icon":"$","name":"USD","position":"left"}','lang' => 'en'),
            array('id' => '8','key' => 'cron_option','value' => '{"days":10,"expirable_message":"Hi, your plan will expire soon","expired_message":"Your plan is expired!","trial_expired_message":"Your free trial is expired!"}','lang' => 'en'),

            array('id' => '9','key' => 'footer_setting','value' => '{"address":"New York, 1850","email":"vevoqypiw@mailinator.com","phone":"+1 (696) 295-4243","copyright":"Copyright \\u00a9 2022. All Rights Reserved","social":[{"icon":"fab fa-facebook","link":"https:\\/\\/www.facebook.com\\/"},{"icon":"fab fa-twitter","link":"https:\\/\\/twitter.com\\/"},{"icon":"fab fa-instagram","link":"https:\\/\\/instagram.com\\/"},{"icon":"fab fa-linkedin","link":"https:\\/\\/linkedin.com\\/"},{"icon":"fab fa-youtube","link":"https:\\/\\/youtube.com\\/"}]}','lang' => 'en'),

            array('id' => '10','key' => 'logo_setting','value' => '{"logo":"/uploads\\/1\\/22\\/05\\/628c721e2159e2405221653371422.png","favicon":"/uploads\\/1\\/22\\/05\\/628c721e8fa612405221653371422.png"}','lang' => 'en'),

            

            array('id' => '12','key' => 'twilio_info','value' => '{"twilio_sid":"","twilio_auth_token":"","twilio_number":"","message":""}','lang' => 'en'),

            array('id' => '13','key' => 'seo_about','value' => '{"site_name":"About","matatag":"About","twitter_site_title":"About","matadescription":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since"}','lang' => 'en'),
            array('id' => '14','key' => 'seo_earn-money','value' => '{"site_name":"earn-money","matatag":"earn-money","twitter_site_title":"earn-money","matadescription":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since"}','lang' => 'en'),
            array('id' => '15','key' => 'seo_top-investors','value' => '{"site_name":"top-investors","matatag":"top-investors","twitter_site_title":"top-investors","matadescription":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since"}','lang' => 'en'),
           
            array('id' => '17','key' => 'seo_faq','value' => '{"site_name":"faq","matatag":"faq","twitter_site_title":"faq","matadescription":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since"}','lang' => 'en'),
            array('id' => '18','key' => 'seo_clients','value' => '{"site_name":"clients","matatag":"clients","twitter_site_title":"clients","matadescription":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since"}','lang' => 'en'),
          );


        Option::insert($options);

       

        


    }
}

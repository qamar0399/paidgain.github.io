<?php

namespace Database\Seeders;

use App\Models\Categorymeta;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryMetaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categorymetas = array(
            array('id' => '1','category_id' => '4','type' => 'info','value' => '{"button_text":"LET\'S START","button_url":"/earn-money","welcome_description":"For Enhanced performance we use LiteSpeed Web Server, HTTP\\/2, PHP7. We make your website faster, which will help you to increase search ranking!","background_image":"/uploads\\/1\\/22\\/05\\/628c72091a4b02405221653371401.jpg","shape_image":"/uploads\\/1\\/22\\/05\\/628c72064097b2405221653371398.png","thumb_image":"/uploads\\/1\\/22\\/06\\/629b95a257e8f0406221654363554.png"}'),
            array('id' => '2','category_id' => '5','type' => 'info','value' => '{"button_text":"u0644u0646u0628u062fu0623","button_url":"/","welcome_description":"u0647u0646u0627u0643 u062du0642u064au0642u0629 u0645u062bu0628u062au0629 u0645u0646u0630 u0632u0645u0646 u0637u0648u064au0644 u0648u0647u064a u0623u0646 u0627u0644u0645u062du062au0648u0649 u0627u0644u0645u0642u0631u0648u0621 u0644u0635u0641u062du0629 u0645u0627 u0633u064au0644u0647u064a u0627u0644u0642u0627u0631u0626 u0639u0646 u0627u0644u062au0631u0643u064au0632 u0639u0644u0649 u0627u0644u0634u0643u0644 u0627u0644u062eu0627u0631u062cu064a u0644u0644u0646u0635 u0623u0648 u0634u0643u0644 u062au0648u0636u0639 u0627u0644u0641u0642u0631u0627u062a u0641u064a u0627u0644u0635u0641u062du0629 u0627u0644u062au064a u064au0642u0631u0623u0647u0627","background_image":"/uploads/1/22/04/625dc4ef5bb4a1904221650312431.jpeg","shape_image":"/uploads/1/22/04/625dc78211fd61904221650313090.png","thumb_image":"/uploads/1/22/04/625dc4391ad6d1904221650312249.png"}'),
            array('id' => '3','category_id' => '6','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c75b3e211d2405221653372339.png"}'),
            array('id' => '4','category_id' => '7','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/06\\/629b88cd64ec00406221654360269.png"}'),
            array('id' => '5','category_id' => '8','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c75b3aae952405221653372339.png"}'),
            array('id' => '6','category_id' => '11','type' => 'info','value' => '{"image":"/uploads/1/22/04/625f152b419922004221650398507.png"}'),
            array('id' => '7','category_id' => '12','type' => 'info','value' => '{"image":"/uploads/1/22/04/625f1582d35762004221650398594.png"}'),
            array('id' => '8','category_id' => '13','type' => 'info','value' => '{"image":"/uploads/1/22/04/625f15a3c8ea22004221650398627.png"}'),
            array('id' => '10','category_id' => '14','type' => 'info','value' => '{"background_image":"/uploads\\/1\\/22\\/05\\/628c72064097b2405221653371398.png","title":"Your account in online and just in a few minutes.","description":"Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s"}'),
            array('id' => '11','category_id' => '15','type' => 'info','value' => '{"background_image":"/uploads/1/22/04/625dc78211fd61904221650313090.png","title":"u062du0633u0627u0628u0643 u0639u0644u0649 u0627u0644u0625u0646u062au0631u0646u062a u0648u0641u064a u063au0636u0648u0646 u062fu0642u0627u0626u0642 u0642u0644u064au0644u0629.","description":"u0647u0646u0627u0643 u062du0642u064au0642u0629 u0645u062bu0628u062au0629 u0645u0646u0630 u0632u0645u0646 u0637u0648u064au0644 u0648u0647u064a u0623u0646 u0627u0644u0645u062du062au0648u0649 u0627u0644u0645u0642u0631u0648u0621 u0644u0635u0641u062du0629 u0645u0627 u0633u064au0644u0647u064a u0627u0644u0642u0627u0631u0626 u0639u0646 u0627u0644u062au0631u0643u064au0632 u0639u0644u0649 u0627u0644u0634u0643u0644 u0627u0644u062eu0627u0631u062cu064a u0644u0644u0646u0635 u0623u0648 u0634u0643u0644 u062au0648u0636u0639 u0627u0644u0641u0642u0631u0627u062a u0641u064a u0627u0644u0635u0641u062du0629 u0627u0644u062au064a u064au0642u0631u0623u0647u0627"}'),
            array('id' => '12','category_id' => '31','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c75b382adf2405221653372339.png"}'),
            array('id' => '13','category_id' => '32','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c75b39627f2405221653372339.png"}'),
            array('id' => '14','category_id' => '33','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c75b382adf2405221653372339.png"}'),
            array('id' => '15','category_id' => '35','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c72069c0b22405221653371398.jpg"}'),
            array('id' => '16','category_id' => '36','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c72074c9692405221653371399.jpg"}'),
            array('id' => '17','category_id' => '37','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c72066625f2405221653371398.jpg"}'),
            array('id' => '18','category_id' => '38','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c7206e5f4c2405221653371398.jpg"}'),
            array('id' => '19','category_id' => '39','type' => 'referral_code','value' => '#11'),
            array('id' => '20','category_id' => '47','type' => 'info','value' => '{"phone":"+1 (696) 295-4243","email":"example@gmail.com","address":"New York, 1850","code":"<iframe src=\\"https:\\/\\/www.google.com\\/maps\\/embed?pb=!1m18!1m12!1m3!1d14047.882048906753!2d-0.14268817855593444!3d51.50701170390822!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47d8a00baf21de75%3A0x52963a5addd52a99!2sLondon%2C%20UK!5e0!3m2!1sen!2sbd!4v1570696571917!5m2!1sen!2sbd\\" allowfullscreen=\\"\\"><\\/iframe>"}'),
            array('id' => '21','category_id' => '34','type' => 'info','value' => '{"image":"/uploads\\/1\\/22\\/05\\/628c720a3469a2405221653371402.png"}'),
            array('id' => '22','category_id' => '50','type' => 'description','value' => 'Suspendisse dis bibendum malesuada turpis pellentesque laoreet suscipit aliquet convallis aliquam semper fusce consequat consectetur orci urna dui curae maecenas mi elit lacus senectus enim feugiat ut vestibulum fringilla volutpat ultricies purus dictum donec ligula est nec felis sociosqu nisi justo condimentum euismod vivamus cursus lorem ad habitant mauris'),
            array('id' => '23','category_id' => '50','type' => 'preview','value' => '/uploads/1/22/05/628c72069c0b22405221653371398.jpg'),
            array('id' => '24','category_id' => '51','type' => 'description','value' => 'Diam proin condimentum nec torquent ex facilisis consequat facilisi volutpat phasellus sodales sapien ridiculus curabitur finibus nullam fermentum hendrerit mattis velit accumsan bibendum per auctor class senectus elementum ligula maximus nisi interdum cursus mauris placerat eleifend metus si aliquet morbi lobortis quis ullamcorper donec orci viverra mus convallis maecenas'),
            array('id' => '25','category_id' => '51','type' => 'preview','value' => '/uploads/1/22/05/628c7204b82622405221653371396.jpg'),
            array('id' => '26','category_id' => '52','type' => 'description','value' => 'Eros ligula maximus per fringilla ultrices non congue aenean mauris parturient interdum mollis felis donec si senectus netus nullam augue nec lacus amet eget fermentum nulla sociosqu consectetur volutpat euismod rutrum metus duis massa sit vitae magna facilisi viverra tempor aptent vehicula finibus platea purus suspendisse efficitur tortor enim'),
            array('id' => '27','category_id' => '52','type' => 'preview','value' => '/uploads/1/22/05/628c72074c9692405221653371399.jpg'),
            array('id' => '28','category_id' => '53','type' => 'description','value' => 'Laboriosam omnis ev'),
            array('id' => '29','category_id' => '53','type' => 'preview','value' => '/uploads/1/22/05/628c72039e0f62405221653371395.jpg'),
            array('id' => '30','category_id' => '54','type' => 'description','value' => 'Nibh nostra curae donec lacus dignissim parturient consectetuer cras ante duis nunc justo etiam neque ut nec erat mus torquent viverra praesent ipsum pellentesque senectus gravida dictum orci sodales feugiat morbi luctus hac suspendisse lectus velit consequat mauris venenatis ex natoque et facilisi dictumst vulputate placerat nulla dui bibendum'),
            array('id' => '31','category_id' => '54','type' => 'preview','value' => '/uploads/1/22/05/628c7206e5f4c2405221653371398.jpg'),
            array('id' => '32','category_id' => '55','type' => 'description','value' => 'Nibh nostra curae donec lacus dignissim parturient consectetuer cras ante duis nunc justo etiam neque ut nec erat mus torquent viverra praesent ipsum pellentesque senectus gravida dictum orci sodales feugiat morbi luctus hac suspendisse lectus velit consequat mauris venenatis ex natoque et facilisi dictumst vulputate placerat nulla dui bibendum'),
            array('id' => '33','category_id' => '55','type' => 'preview','value' => '/uploads/1/22/05/628c72069c0b22405221653371398.jpg'),
            array('id' => '34','category_id' => '56','type' => 'description','value' => 'Sint aliqua Qui iuSint aliqua Qui iuSint aliqua Qui iuSint aliqua Qui iuSint aliqua Qui iuSint aliqua Qui iuSint aliqua Qui iu'),
            array('id' => '35','category_id' => '56','type' => 'preview','value' => '/uploads/1/22/05/628c72066625f2405221653371398.jpg'),
            array('id' => '36','category_id' => '57','type' => 'info','value' => '{"photo":"/uploads\\/1\\/22\\/05\\/628c72066625f2405221653371398.jpg"}'),
            array('id' => '37','category_id' => '58','type' => 'info','value' => '{"photo":"/uploads\\/1\\/22\\/05\\/628c72069c0b22405221653371398.jpg"}'),
            array('id' => '38','category_id' => '59','type' => 'info','value' => '{"photo":"/uploads\\/1\\/22\\/05\\/628c72066625f2405221653371398.jpg"}'),
            array('id' => '39','category_id' => '60','type' => 'info','value' => '{"photo":"/uploads\\/1\\/22\\/05\\/628c7206e5f4c2405221653371398.jpg"}'),
            array('id' => '40','category_id' => '61','type' => 'info','value' => '{"photo":"/uploads\\/1\\/22\\/05\\/628c72074c9692405221653371399.jpg"}'),
            array('id' => '41','category_id' => '62','type' => 'info','value' => '{"photo":"/uploads\\/1\\/22\\/05\\/628c72066625f2405221653371398.jpg"}')
          );



        Categorymeta::insert($categorymetas);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Getway;
use Illuminate\Database\Seeder;

class PaymentGatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $getways = array(
            array('id' => '1',"min_amount"=> 100,
            "max_amount"=> 1000,'name' => 'paypal','logo' => 'uploads/paypal.png','rate' => '1','charge' => '2','namespace' => 'App\\Lib\\Paypal','currency_name' => 'USD','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '0','data' => '{"client_id":"","client_secret":""}','created_at' => now(),'updated_at' => now()),


            array('id' => '2','name' => 'stripe',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/stripe.png','rate' => '10','charge' => '2','namespace' => 'App\\Lib\\Stripe','currency_name' => 'usd','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '0','data' => '{"publishable_key":"","secret_key":""}','created_at' => now(),'updated_at' => now()),

            array('id' => '3','name' => 'mollie',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/mollie.png','rate' => '10','charge' => '2','namespace' => 'App\\Lib\\Mollie','currency_name' => 'usd','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '0','data' => '{"api_key":""}','created_at' => now(),'updated_at' => now()),

            array('id' => '4','name' => 'paystack',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/paystack.png','rate' => '10','charge' => '2','namespace' => 'App\\Lib\\Paystack','currency_name' => 'NGN','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '0','data' => '{"public_key":"","secret_key":""}','created_at' => now(),'updated_at' => now()),

            array('id' => '5','name' => 'razorpay',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/razorpay.png','rate' => '10','charge' => '2','namespace' => 'App\\Lib\\Razorpay','currency_name' => 'INR','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '0','data' => '{"key_id":"","key_secret":""}','created_at' => now(),'updated_at' => now()),

            array('id' => '6','name' => 'instamojo',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/instamojo.png','rate' => '54','charge' => '2','namespace' => 'App\\Lib\\Instamojo','currency_name' => 'INR','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '1','data' => '{"x_api_key":"","x_auth_token":""}','created_at' => now(),'updated_at' => now()),

            array('id' => '7','name' => 'toyyibpay',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/toyyibpay.png','rate' => '54','charge' => '2','namespace' => 'App\\Lib\\Toyyibpay','currency_name' => 'MR','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '1','data' => '{"user_secret_key":"","cateogry_code":""}','created_at' => now(),'updated_at' => now()),

            array('id' => '8','name' => 'flutterwave',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/flutterwave.png','rate' => '54','charge' => '2','namespace' => 'App\\Lib\\Flutterwave','currency_name' => 'NGN','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '1','data' => '{"public_key":"","secret_key":,"encryption_key":"F","payment_options":"card"}','created_at' => now(),'updated_at' => now()),


            array('id' => '9','name' => 'payu',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/payu.png','rate' => '54','charge' => '2','namespace' => 'App\\Lib\\Payu','currency_name' => 'INR','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '1','data' => '{"merchant_key":"","merchant_salt":"","auth_header":""}','created_at' => now(),'updated_at' => now()),

            array('id' => '10','name' => 'thawani',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/thawani.png','rate' => '0.38','charge' => '1','namespace' => 'App\\Lib\\Thawani','currency_name' => 'OMR','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '1','data' => '{"secret_key":"","publishable_key":""}','created_at' => now(),'updated_at' => now()),

            array('id' => '12','name' => 'mercadopago',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/mercadopago.png','rate' => '1.2','charge' => '1','namespace' => 'App\\Lib\\Mercado','currency_name' => 'USD','is_auto' => '1','image_accept' => '0','test_mode' => '1','status' => '0','phone_required' => '0','data' => '{"secret_key":"","public_key":""}','created_at' => now(),'updated_at' => now()),

            array('id' => '13','name' => 'IBBL',"min_amount"=> 100,
            "max_amount"=> 1000,'logo' => 'uploads/cash.png','rate' => '1','charge' => '1','namespace' => 'App\Lib\CustomGetway','currency_name' => 'USD','is_auto' => '0','image_accept' => '1','test_mode' => '1','status' => '0','phone_required' => '0','data' => 'test','created_at' => now(),'updated_at' => now())
        );
        Getway::insert($getways);
    }
}

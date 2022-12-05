<?php

use Illuminate\Support\Facades\Route;


Route::group(['as' => 'user.', 'prefix' => 'user', 'namespace' => 'User', 'middleware' => ['auth', 'verified','active']], function () {
	Route::get('/dashboard','DashboardController@dashboard')->name('dashboard');
	Route::resource('deposit','DepositController');
	Route::post('make-payment/{id}','DepositController@payment')->name('make-payment');
	Route::get('payment/success', 'DepositController@success')->name('payment.success');
    Route::get('payment/failed', 'DepositController@failed')->name('payment.failed');
    Route::get('ads','AdsController@index')->name('ads.index')->middleware('subscription');
    Route::get('ads/{id}','AdsController@show')->name('ads.show')->middleware('subscription');
    Route::post('ads/confirm','AdsController@confirm')->name('ads.confirm')->middleware('subscription');
    Route::get('ads/click/show','AdsController@ads_show')->name('ads.click')->middleware('subscription');
    Route::resource('support', 'SupportController');
    Route::resource('methods', 'WithdrawalMethodController')->only('index');
    Route::resource('withdraws', 'WithdrawController')->only('index', 'create', 'store');
    Route::resource('referrals', 'ReferralController')->only('index')->middleware('subscription');
    Route::resource('ptc-ads', 'PTCAdController')->except('show')->middleware('subscription');
    Route::resource('plans', 'PlanController')->only('index');
    Route::resource('transactions', 'TransactionController')->only('index');

    Route::get('profile', 'ProfileController@index')->name('profile.index');
    Route::put('profile', 'ProfileController@update')->name('profile.update');
    Route::get('profile/password', 'ProfileController@password')->name('profile.password');
    Route::put('profile/password', 'ProfileController@passwordUpdate')->name('profile.password.update');

    Route::group(['prefix' => 'common', 'as' => 'common.'], function (){
        Route::controller('CommonController')->group(function (){
            Route::put('subscribe', 'subscribe')->name('subscribe');
        });
    });

});

Route::group(['middleware' => ['auth', 'verified','active']], function () {
// Phone Verification Routes
Route::get('phone-verification', 'Auth\Phoneverification@phone_verification')->name('phone.verification')->middleware('auth');
Route::post('phone-verification-check', 'Auth\Phoneverification@phone_verification')->name('phone.verification.check');
Route::get('phone-verification-view', 'Auth\Phoneverification@otp_view')->name('phone.verification.view');
Route::get('phone-verification-show', 'Auth\Phoneverification@otp_view')->name('phone.verification.show')->middleware('auth');
Route::post('phone-verification-resend', 'Auth\Phoneverification@phone_verification_resend')->name('phone.verification.resend')->middleware('auth');
});



//**======================== Payment Gateway Route Group for user ====================**//
Route::group(['as' => 'user.', 'prefix' => 'user', 'middleware' => ['auth','verified']], function () {
    Route::get('/payment/paypal', '\App\Lib\Paypal@status');
    Route::post('/stripe/payment', '\App\Lib\Stripe@status')->name('stripe.payment');
    Route::get('/stripe', '\App\Lib\Stripe@view')->name('stripe.view');
    Route::get('/payment/mollie', '\App\Lib\Mollie@status');
    Route::post('/payment/paystack', '\App\Lib\Paystack@status');
    Route::get('/paystack', '\App\Lib\Paystack@view')->name('paystack.view');
    Route::get('/mercadopago/pay', '\App\Lib\Mercado@status')->name('mercadopago.status');
    Route::get('/tap/view/{from}', '\App\Lib\Tap@view')->name('tap.view');
    Route::get('/payment/tap/', '\App\Lib\Tap@status')->name('tap.status');
    Route::post('/payment/tap/authorize', '\App\Lib\Tap@authorize')->name('tap.authorize');
    Route::get('/razorpay/payment', '\App\Lib\Razorpay@view')->name('razorpay.view');
    Route::post('/razorpay/status', '\App\Lib\Razorpay@status');
    Route::get('/payment/flutterwave', '\App\Lib\Flutterwave@status');
    Route::get('/payment/thawani', '\App\Lib\Thawani@status');
    Route::get('/payment/instamojo', '\App\Lib\Instamojo@status');
    Route::get('/payment/toyyibpay', '\App\Lib\Toyyibpay@status');
    Route::get('/manual/payment', '\App\Lib\CustomGetway@status')->name('manual.payment');
    Route::get('payu/payment', '\App\Lib\Payu@view')->name('payu.view');
    Route::post('/payu/status', '\App\Lib\Payu@status')->name('payu.status');


});

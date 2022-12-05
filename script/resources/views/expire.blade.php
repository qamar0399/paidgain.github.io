<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __("You can't leave the ads page.") }}</title>
    <link rel="icon" type="image/png" href="{{ get_option('logo_setting', true)->favicon ?? null }}"/>
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/css/ads.css?v=2.2.5') }}">
</head>
<body class="bg-color">
    
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3">
                <div class="expire-area text-center">
                    <img class="img-fluid" src="{{ asset('frontend/img/403.png') }}" alt="">
                    <h4>{{ __("You can't leave the ads page.") }}</h4>
                </div>
            </div>
        </div>
    </div>
    

</body>
</html>
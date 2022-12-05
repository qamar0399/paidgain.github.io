<!-- Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container h-100">
        <div class="row  h-100 align-items-center">
            <div class="col-lg-8">
                <div class="breadcrumb-content">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            @foreach(request()->segments() as $segment)
                                <li class="breadcrumb-item"><a href="#">{{ ucwords(str($segment)->replace('-', ' ')) }}</a></li>
                            @endforeach
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- Shape Image -->
    <div class="faq-shape-img welcome-thumb">
        <img src="{{ asset('frontend/img/bg-img/money-2.png') }}" alt="">
    </div>
    <!-- Shape Image 2 -->
    <div class="faq-shape-img two">
        <img src="{{ asset('frontend/img/bg-img/money-3.png') }}" alt="">
    </div>
</div>
<!-- Breadcrumb Area -->

<!-- Preloader -->
<div id="preloader">
    <div id="ctn-preloader" class="ont-preloader">
        <div class="animation-preloader">
            <div class="spinner"></div>
            <div class="txt-loading">
                @php
                    $word = explode(" ", config('app.name'))
                @endphp
                @foreach($word as $letter)
                    <span data-text-preloader="{{ strtoupper($letter) }}" class="letters-loading">
                            {{ strtoupper($letter) }}
                        </span>
                @endforeach
            </div>
            <p class="text-center">Loading</p>
        </div>

        <div class="loader">
            <div class="row">
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-left">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
                <div class="col-3 loader-section section-right">
                    <div class="bg"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Preloader-->

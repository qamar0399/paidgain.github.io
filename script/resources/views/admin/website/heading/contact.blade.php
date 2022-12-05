<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-contact-tab" data-toggle="tab" href="#{{ $key }}-contact" role="tab" aria-controls="{{ $key }}-contact" aria-selected="true">{{ $value }}</a>
                </li>
                @php
                    $i++;
                @endphp
            @endforeach
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content tab-bordered" id="myTab3Content">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-contact" role="tabpanel" aria-labelledby="{{ $key }}-contact-tab">
                    <form class="ajaxform" action="{{ route('admin.website.heading.update-contact') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="contact_text">{{ __('Contact Text') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="contact_text" id="contact_text" value="{{ $data['heading.contact'][$key]->name ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="contact_description">{{ __('Contact Description') }} ({{ $key }})</label>
                            <textarea class="form-control" name="contact_description" id="contact_description">{{ $data['heading.contact'][$key]->other ?? null }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">{{ __('Phone Number') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="phone" id="phone_number" value="{{ $data['heading.contact'][$key]->info['phone'] ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }} ({{ $key }})</label>
                            <input type="email" class="form-control" name="email" id="email" value="{{ $data['heading.contact'][$key]->info['email'] ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="address">{{ __('Address') }} ({{ $key }})</label>
                            <textarea class="form-control" name="address" id="address">{{ $data['heading.contact'][$key]->info['address'] ?? null }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="code">{{ __('Iframe Code') }} ({{ $key }})</label>
                            <textarea class="form-control" name="code" id="code" placeholder="{{ __('Enter Map Iframe Code') }}">{{ $data['heading.contact'][$key]->info['code'] ?? null }}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                {{ __('Save') }}
                            </button>
                        </div>
                    </form>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
    </div>
</div>

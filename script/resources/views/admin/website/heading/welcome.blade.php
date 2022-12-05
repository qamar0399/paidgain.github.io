<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-welcome-tab" data-toggle="tab" href="#{{ $key }}-welcome" role="tab" aria-controls="{{ $key }}-welcome" aria-selected="true">{{ $value }}</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-welcome" role="tabpanel" aria-labelledby="{{ $key }}-welcome-tab">
                    <form class="ajaxform" action="{{ route('admin.website.heading.update-welcome') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="lang" value="{{ $key }}">
                        <div class="form-group">
                            <label for="welcome_text">{{ __('Welcome Text') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="welcome_text" id="welcome_text" value="{{ $data['heading.welcome'][$key]->name ?? null }}">
                        </div>
                        <div class="form-group">
                            <label for="welcome_description">{{ __('Welcome Description') }} ({{ $key }})</label>
                            <textarea class="form-control" name="welcome_description" id="welcome_description">{{ $data['heading.welcome'][$key]->other ?? null }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="button_text">{{ __('Button Text') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="button_text" id="button_text" value="{{ $data['heading.welcome'][$key]->info['button_text'] ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="button_url">{{ __('Button URL') }} ({{ $key }})</label>
                            <input type="url" class="form-control" name="button_url" id="button_url" value="{{ $data['heading.welcome'][$key]->info['button_url'] ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="background_image">{{ __('Background Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_id' => 'background_image_'.$key,
                                'input_name' => 'background_image',
                                'preview_class' => 'background_image_'.$key,
                                'preview' => $data['heading.welcome'][$key]->info['background_image'] ?? null,
                                'value' => $data['heading.welcome'][$key]->info['background_image'] ?? null
                            ]) }}
                        </div>

                        <div class="form-group">
                            <label for="shape_image">{{ __('Shape Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_id' => 'shape_image_'.$key,
                                'input_name' => 'shape_image',
                                'preview_class' => 'shape_image_'.$key,
                                'preview' => $data['heading.welcome'][$key]->info['shape_image'] ?? null,
                                'value' => $data['heading.welcome'][$key]->info['shape_image'] ?? null,
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="shape_image">{{ __('Thumb Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_id' => 'thumb_image_'.$key,
                                'input_name' => 'thumb_image',
                                'preview_class' => 'thumb_image_'.$key,
                                'preview' => $data['heading.welcome'][$key]->info['thumb_image'] ?? null,
                                'value' => $data['heading.welcome'][$key]->info['thumb_image'] ?? null,
                            ]) }}
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

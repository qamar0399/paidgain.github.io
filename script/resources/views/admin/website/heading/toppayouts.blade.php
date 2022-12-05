<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-payouts_tab" data-toggle="tab" href="#{{ $key }}-payouts" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $value }}</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-payouts" role="tabpanel" aria-labelledby="{{ $key }}-payouts-tab">
                    <form class="ajaxform" action="{{ route('admin.website.heading.update-payouts') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="lang" value="{{ $key }}">
                        <div class="form-group">
                            <label for="top_payout_title">{{ __('Top Payout Title') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="top_payout_title" id="top_payout_title" value="{{ $data['heading.payouts'][$key]->name ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="top_payout_description">{{ __('Top Payout Description') }} ({{ $key }})</label>
                            <textarea class="form-control" name="top_payout_description" id="top_payout_description">{{ $data['heading.payouts'][$key]->other ?? null }}</textarea>
                        </div>

                        <div class="form-group">
                            <label for="image">{{ __('Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_id' => 'image_'.$key,
                                'input_name' => 'image',
                                'preview_class' => 'image_'.$key,
                                'preview' => $data['heading.payouts'][$key]->info['image'] ?? null,
                                'value' => $data['heading.payouts'][$key]->info['image'] ?? null
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

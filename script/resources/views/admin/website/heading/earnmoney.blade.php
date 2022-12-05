<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-earn_money_tab" data-toggle="tab" href="#{{ $key }}-earn_money" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $value }}</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-earn_money" role="tabpanel" aria-labelledby="{{ $key }}-earn_money-tab">
                    <form class="ajaxform" action="{{ route('admin.website.heading.update-earn-money') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="lang" value="{{ $key }}">
                        <div class="form-group">
                            <label for="title">{{ __('Title') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="title" id="title" value="{{ $data['heading.earn_money'][$key]->name ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="description">{{ __('Description') }} ({{ $key }})</label>
                            <textarea class="form-control" name="description" id="description">{{ $data['heading.earn_money'][$key]->other ?? null }}</textarea>
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

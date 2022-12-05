<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-member-info-tab" data-toggle="tab" href="#{{ $key }}-member-info" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $value }}</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-member-info" role="tabpanel" aria-labelledby="{{ $key }}-member-info-tab">
                    <form class="ajaxform" action="{{ route('admin.website.heading.update-member-info') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="lang" value="{{ $key }}">
                        <div class="form-group">
                            <label for="member_info_title">{{ __('Member Info Title') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="member_info_title" id="member_info_title" value="{{ $data['heading.member_info'][$key]->name ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="member_info_description">{{ __('Member Info Description') }} ({{ $key }})</label>
                            <textarea class="form-control" name="member_info_description" id="member_info_description">{{ $data['heading.member_info'][$key]->other ?? null }}</textarea>
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

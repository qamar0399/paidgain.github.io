<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-feature-tab" data-toggle="tab" href="#{{ $key }}-feature" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $value }}</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-feature" role="tabpanel" aria-labelledby="{{ $key }}-feature-tab">
                    <form class="ajaxform" action="{{ route('admin.website.heading.update-features') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <input type="hidden" name="lang" value="{{ $key }}">

                        <div class="form-group">
                            <label for="feature_title">{{ __('Feature Title') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="feature_title" id="feature_title" value="{{ $data['heading.features'][$key]->name ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="feature_description">{{ __('Feature Description') }} ({{ $key }})</label>
                            <textarea class="form-control" name="feature_description" id="feature_description">{{ $data['heading.features'][$key]->other ?? null }}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                {{ __('Save') }}
                            </button>
                            <a class="btn btn-dark float-right" href="{{ route('admin.website.heading.add-feature') }}">
                                <i class="fas fa-plus"></i>
                                {{ __('Add New Feature') }}
                            </a>
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

<!-- table -->

<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2Table" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-feature-tab-table" data-toggle="tab" href="#{{ $key }}-feature-table" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $value }}</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-feature-table" role="tabpanel" aria-labelledby="{{ $key }}-feature-tab-table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>
                                <th>{{ __('Icon') }}</th>
                                <th>{{ __('Description') }}</th>
                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($tableData['features'][$key]))
                                @foreach($tableData['features'][$key] as $row)
                                    <tr>
                                        <td class="align-middle">{{ $row->name }}</td>
                                        <td class="align-middle">
                                            <img src="{{ $row->info['image'] ?? null }}" alt="icon" width="40">
                                        </td>
                                        <td class="align-middle">{{ $row->other }}</td>
                                        <td class="align-middle">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.website.heading.edit-feature', $row->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                <button href="#" class="btn btn-danger delete-confirm" data-id={{ $row->id }}><i class="fas fa-trash"></i></button>
                                                <!-- Delete Form -->
                                                <form class="d-none" id="delete_form_{{ $row->id }}" action="{{ route('admin.website.heading.delete-feature', $row->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                @php
                    $i++;
                @endphp
            @endforeach
        </div>
    </div>
</div>

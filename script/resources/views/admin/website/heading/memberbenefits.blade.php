<div class="card">
    <div class="card-header">
        <ul class="nav nav-pills" id="myTab2" role="tablist">
            @php
                $i = 0;
            @endphp
            @foreach($languages->value as $key => $value)
                <li class="nav-item">
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-member-benefit-tab" data-toggle="tab" href="#{{ $key }}-member-benefit" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $value }}</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-member-benefit" role="tabpanel" aria-labelledby="{{ $key }}-member-benefit-tab">
                    <form class="ajaxform" action="{{ route('admin.website.heading.update-member-benefits') }}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="lang" value="{{ $key }}">
                        <div class="form-group">
                            <label for="member_benefit_title">{{ __('Member Benefit Section Title') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="member_benefit_title" id="member_benefit_title" value="{{ $data['heading.member_benefits'][$key]->name ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="member_benefit_description">{{ __('Member Benefit Section Description') }} ({{ $key }})</label>
                            <textarea class="form-control" name="member_benefit_description" id="member_benefit_description">{{ $data['heading.member_benefits'][$key]->other ?? null }}</textarea>
                        </div>

                         <div class="form-group">
                            <label for="background_image">{{ __('Background Image') }} ({{ $key }})</label>
                            {{ mediasection([
                                'input_id' => 'member_benifit'.$key,
                                'input_name' => 'meta[background_image]',
                                'preview_class' => 'member_benifit'.$key,
                                'preview' => $data['heading.member_benefits'][$key]->info['background_image'] ?? null,
                                'value' => $data['heading.member_benefits'][$key]->info['background_image'] ?? null
                            ]) }}
                        </div>
                        <div class="form-group">
                            <label for="member_benefit_title">{{ __('Member Benefit Title') }} ({{ $key }})</label>
                            <input type="text" class="form-control" name="meta[title]"  value="{{ $data['heading.member_benefits'][$key]->info['title'] ?? null }}">
                        </div>

                        <div class="form-group">
                            <label for="member_benefit_description">{{ __('Member Benefit Description') }} ({{ $key }})</label>
                            <textarea class="form-control" name="meta[description]" >{{ $data['heading.member_benefits'][$key]->info['description'] ?? null }}</textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary">
                                <i class="fas fa-save"></i>
                                {{ __('Save') }}
                            </button>
                            <a class="btn btn-dark float-right" href="{{ route('admin.website.heading.add-member-benefit') }}">
                                <i class="fas fa-plus"></i>
                                {{ __('Add New Benefit') }}
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
                    <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-member-benefit-tab-table" data-toggle="tab" href="#{{ $key }}-member-benefit-table" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $value }}</a>
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
                <div class="tab-pane fade {{ $i == 0 ? 'active' : null }} show" id="{{ $key }}-member-benefit-table" role="tabpanel" aria-labelledby="{{ $key }}-member-benefit-tab-table">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm">
                            <thead>
                            <tr>
                                <th>{{ __('Title') }}</th>

                                <th>{{ __('Action') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(isset($tableData['member_benefits'][$key]))
                                @foreach($tableData['member_benefits'][$key] as $row)
                                    <tr>
                                        <td class="align-middle">{{ $row->name }}</td>

                                        <td class="align-right">
                                            <div class="btn-group btn-group-sm">
                                                <a href="{{ route('admin.website.heading.edit-member-benefit', $row->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                <button href="#" class="btn btn-danger delete-confirm" data-id={{ $row->id }}><i class="fas fa-trash"></i></button>
                                                <!-- Delete Form -->
                                                <form class="d-none" id="delete_form_{{ $row->id }}" action="{{ route('admin.website.heading.delete-member-benefit', $row->id) }}" method="POST">
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

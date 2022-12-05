@extends('layouts.backend.app')

@section('title','PTC Ads')

@section('head')
    @include('layouts.backend.partials.headersection',['title'=>'PTC Ads','button_name'=>'Add New','button_link'=>route('admin.ptc-ads.create')])
@endsection

@section('content')
<div class="card">
    <form action="{{ url('admin/ads-multi-delete') }}" method="POST" class="ajaxform_with_reload">
        @csrf
        @method('DELETE')
        <div class="card-body">
            <div class="float-left">
                <div class="input-group align-items-center">
                    <select class="form-control selectric mr-3" tabindex="-1" name="status" required>
                        <option selected disabled>{{ __('Select Action') }}</option>
                        <option value="delete">{{ __('Delete Permanently') }}</option>
                    </select>
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary btn-lg basicbtn">{{ __('Submit') }}</button>
                    </div>
                </div>
            </div>
            <div class="clearfix mb-3"></div>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="text-center pt-2">
                            <div class="custom-checkbox custom-checkbox-table custom-control">
                                <input type="checkbox" data-checkboxes="mygroup" data-checkbox-role="dad" class="custom-control-input" id="checkbox-all">
                                <label for="checkbox-all" class="custom-control-label">&nbsp;</label>
                            </div>
                        </th>
                        <th>{{ __('Title') }}</th>
                        <th class="text-center">{{ __('Type') }}</th>
                        <th>{{ __('Duration') }}</th>
                        <th>{{ __('Max View') }}</th>
                        <th>{{ __('Viewed') }}</th>
                        <th>{{ __('Remain') }}</th>
                        <th>{{ __('Amount') }}</th>
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($ads as $ptcAd)
                        <tr>
                            <td class="text-center">
                                <div class="custom-checkbox custom-control">
                                    <input type="checkbox" data-checkboxes="mygroup" name="id[]" class="custom-control-input" value="{{ $ptcAd->id }}" id="media-{{ $ptcAd->id }}">
                                    <label for="media-{{ $ptcAd->id }}" class="custom-control-label">&nbsp;</label>
                                </div>
                            </td>
                            <td>{{ $ptcAd->title }}</td>
                            <td class="text-center">
                                @if($ptcAd->ads_type == 'link_url')
                                    <span class="font-weight-normal badge badge-primary badge-pill">
                                            <i class="fas fa-link"></i> {{ __('Link / URL') }}
                                        </span>
                                @elseif(in_array($ptcAd->ads_type, ['banner_image', 'clickable_image']))
                                    <span class="font-weight-normal badge badge-light badge-pill">
                                            <i class="fas fa-file-image"></i> {{ ucwords(str($ptcAd->ads_type)->replace(['_', '-'], ' ')) }}
                                        </span>
                                @elseif($ptcAd->ads_type == 'script_code')
                                    <span class="font-weight-normal badge badge-primary badge-pill">
                                            <i class="fa fa-code"></i> {{ __('Script / Code') }}
                                        </span>
                                @elseif($ptcAd->ads_type == 'embedded')
                                    <span class="font-weight-normal badge badge-primary badge-pill">
                                            <i class="fas fa-code"></i> {{ __('Embedded') }}
                                        </span>
                                @elseif($ptcAd->ads_type == 'youtube_subscriber')
                                    <span class="font-weight-normal badge badge-danger badge-pill">
                                            <i class="fab fa-youtube"></i> {{ __('YouTube') }}
                                        </span>
                                @elseif($ptcAd->ads_type == 'facebook_follower')
                                    <span class="font-weight-normal badge badge-info badge-pill">
                                            <i class="fab fa-facebook"></i> {{ __('Facebook') }}
                                        </span>
                                @elseif($ptcAd->ads_type == 'twitter_follower')
                                    <span class="font-weight-normal badge badge-info badge-pill">
                                            <i class="fab fa-twitter"></i> {{ __('Twitter') }}
                                        </span>
                                @elseif($ptcAd->ads_type == 'instagram_follower')
                                    <span class="font-weight-normal badge badge-info badge-pill">
                                            <i class="fab fa-instagram"></i> {{ __('Instagram') }}
                                        </span>
                                @endif
                            </td>
                            <td>{{ \Carbon\CarbonInterval::seconds($ptcAd->duration)->cascade()->forHumans() }}</td>
                            <td>{{ $ptcAd->max_limit }} {{ __('Times') }}</td>
                            <td>{{ $ptcAd->viewed }}</td>
                            <td>{{ $ptcAd->remains }}</td>
                            <td>{{ number_format($ptcAd->amount, 2) }} {{ defaultcurrency('currency') }}</td>
                            <td>
                                @if($ptcAd->status)
                                    <span class="badge badge-success">{{ __('Active') }}</span>
                                @else
                                    <span class="badge badge-dark">{{ __('Inactive') }}</span>
                                @endif
                            </td>
                            <td class="text-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle"
                                            data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                        {{ __('Action') }}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu">
                                        <a class="dropdown-item has-icon text-warning"
                                            href="{{ route('admin.ptc-ads.edit', $ptcAd->id) }}">
                                            <i class="fa fa-edit"></i>{{ __('Edit') }}
                                        </a>
                                        <a class="dropdown-item has-icon delete-confirm text-danger"
                                            href="javascript:void(0)" data-id="{{ $ptcAd->id }}">
                                            <i class="fa fa-trash"></i>{{ __('Delete') }}
                                        </a>
                                        
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    
                    </tbody>
                </table>
                {{ $ads->links('vendor.pagination.bootstrap-5') }}
            </div>
        </div>
    </form>
    @foreach($ads as $ptcAd)
    <form class="d-none" id="delete_form_{{ $ptcAd->id }}"
        action="{{ route('admin.ptc-ads.destroy', $ptcAd->id) }}"
        method="POST">
        @csrf
        @method('DELETE')
    </form>
    @endforeach
</div>
@endsection

@extends('layouts.backend.app')

@section('title', __('Top Investors'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Top Investors'),
        'button_name' => '<i class="fas fa-plus"></i> ' .__('Add New Top Investor'),
        'button_link' => route('admin.website.top-investors.add')
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th>{{ __('Photo') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Total Invest') }}</th>
                        <th>{{ __('Featured') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($top_investors as $top_investor)
                        <tr>
                            <td>
                                <figure class="avatar mr-2 avatar-lg">
                                    <img src="{{ $top_investor->info['photo'] ?? null}}" alt="{{ $top_investor->name }}">
                                </figure>
                            </td>
                            <td>{{ $top_investor->name }}</td>
                            <td>{{ $top_investor->other }}</td>
                            <td>
                                @if($top_investor->featured)
                                    <span class="badge badge-pill badge-success">Yes</span>
                                @else
                                    <span class="badge badge-pill badge-dark">No</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group btn-group-sm">
                                    <a href="{{ route('admin.website.top-investors.edit', $top_investor->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-danger delete-confirm" data-id={{ $top_investor->id }}><i class="fas fa-trash"></i></button>
                                </div>
                                <!-- Delete Form -->
                                <form class="d-none" id="delete_form_{{ $top_investor->id }}" action="{{ route('admin.website.top-investors.delete', $top_investor->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

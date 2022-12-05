@extends('layouts.backend.app')

@section('title', __('Frequently asked Questions'))

@section('head')
    @include('layouts.backend.partials.headersection', [
        'title'=> __('Frequently asked Questions'),
        'button_name' => '<i class="fas fa-plus"></i> ' .__('Add New FAQ'),
        'button_link' => route('admin.website.faq.add')
    ])
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills" id="myTab2Table" role="tablist">
                @php
                    $i = 0;
                @endphp
                @foreach($languages->value as $key => $value)
                    <li class="nav-item">
                        <a class="nav-link {{ $i == 0 ? 'active' : null }}" id="{{ $key }}-feature-tab-table" data-toggle="tab" href="#{{ $key }}-feature-table" role="tab" aria-controls="{{ $key }}" aria-selected="true">{{ $value }} ({{ count(($faqs[$key] ?? [])) }})</a>
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
                                    <th>{{ __('Question') }}</th>
                                    <th>{{ __('Answer') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(isset($faqs[$key]))
                                    @foreach($faqs[$key] as $row)
                                        <tr>
                                            <td class="align-middle">{{ $row->name }}</td>
                                            <td class="align-middle">{{ $row->other }}</td>
                                            <td class="align-middle">
                                                <div class="btn-group btn-group-sm">
                                                    <a href="{{ route('admin.website.faq.edit', $row->id) }}" class="btn btn-warning"><i class="fas fa-edit"></i></a>
                                                    <button href="#" class="btn btn-danger delete-confirm" data-id={{ $row->id }}><i class="fas fa-trash"></i></button>
                                                    <!-- Delete Form -->
                                                    <form class="d-none" id="delete_form_{{ $row->id }}" action="{{ route('admin.website.faq.delete', $row->id) }}" method="POST">
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
@endsection

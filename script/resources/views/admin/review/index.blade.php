@extends('layouts.backend.app')

@section('title','Categories')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Review','button_name'=> 'Create New','button_link'=> url('admin/review/create')])
@endsection

@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="float-left">
                  <h6 class="text-primary">{{ __('Reviews') }}</h6>
               </div>
               <div class="float-right">
                  <form method="get">
                     <div class="input-group">
                        <input name="src" type="text" value="{{ $request->src ?? '' }}" class="form-control" placeholder="search...">
                        <div class="input-group-append">
                           <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                     </div>
                  </form>
               </div>
               <div class="clearfix mb-3"></div>
               <div class="table-responsive">
                  <table class="table table-striped">
                     <thead>
                        <tr>
                           <th>{{ __('Name') }}</th>
                           <th>{{ __('Rating') }}</th>
                           <th>{{ __('Preview') }}</th>
                           <th>{{ __('Created At') }}</th>
                           <th class="text-right">{{ __('Action') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($posts as $row)
                        <tr>
                           <td>{{ $row->name }}</td>
                           <td>{{ $row->slug }} / 5</td>
                           <td><img src="{{ asset($row->preview->value ?? '') }}" alt="" height="50"></td>
                           <td>{{ formatted_date($row->created_at) }}</td>
                           <td class="float-right">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ __('Action') }}
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start">
                                 <a class="dropdown-item has-icon text-warning" href="{{ route('admin.review.edit', $row->id) }}"><i class="fa fa-edit"></i>{{ __('Edit') }}</a>
                                 <a class="dropdown-item has-icon delete-confirm text-danger" href="javascript:void(0)" data-id="{{$row->id}}"><i class="fa fa-trash"></i>{{ __('Delete') }}</a>
                                 <!-- Delete Form -->
                                 <form class="d-none" id="delete_form_{{ $row->id }}" action="{{ route('admin.review.destroy', $row->id) }}" method="POST">
                                    @csrf
                                    @method('delete')
                                 </form>
                              </div>
                           </td>
                        </tr>
                        @endforeach
                     </tbody>
                  </table>
                  {{ $posts->links('vendor.pagination.bootstrap-5') }}
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
@endsection

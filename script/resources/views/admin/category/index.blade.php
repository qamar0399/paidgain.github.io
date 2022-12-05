@extends('layouts.backend.app')

@section('title','Categories')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Categories','button_name'=> 'Create New','button_link'=> url('admin/category/create')])
@endsection

@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <div class="card">
            <div class="card-body">
               <div class="float-left">
                  <h6 class="text-primary">{{ __('Categories') }}</h6>
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
                           <th>{{ __('Link') }}</th>
                           <th>{{ __('Created At') }}</th>
                           <th class="text-right">{{ __('Action') }}</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach($posts as $row)
                        <tr>
                           <td><a href="{{ url('category',$row->slug) }}">{{ $row->name }}</a></td>
                           <td><a href="{{ url('category',$row->slug) }}">{{ url('category',$row->slug) }}</a></td>
                           <td>{{ date('d-m-Y', strtotime($row->created_at)) }}</td>
                           <td class="text-right">
                              <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              {{ __('Action') }}
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start">
                                 <a class="dropdown-item has-icon text-warning" href="{{ route('admin.category.edit', $row->id) }}"><i class="fa fa-edit"></i>{{ __('Edit') }}</a>
                                 <a class="dropdown-item has-icon delete-confirm text-danger" href="javascript:void(0)" data-id="{{$row->id}}"><i class="fa fa-trash"></i>{{ __('Delete') }}</a>
                                 <!-- Delete Form -->
                                 <form class="d-none" id="delete_form_{{ $row->id }}" action="{{ route('admin.category.destroy', $row->id) }}" method="POST">
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

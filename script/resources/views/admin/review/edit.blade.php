@extends('layouts.backend.app')

@section('title','Dashboard')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Review','prev'=> route('admin.review.index')])
@endsection

@push('css')
<!-- CSS Libraries -->
  <link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
@endpush

@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
        <form class="ajaxform" method="post" action="{{ route('admin.review.update',$info->id) }}">
         @csrf
         @method('PUT')
            <div class="row">
               {{-- left side --}}
               <div class="col-lg-5">
                  <strong>{{ __('Image') }}</strong>
                  <p>{{ __('Upload User image here') }}</p>
               </div>
               {{-- /left side --}}
               {{-- right side --}}
               <div class="col-lg-7">
                  <div class="card">
                     <div class="card-body">
                        {{mediasection(['title'=>'User Avatar','value'=>$info->preview->value ?? '',
                  'preview'=> $info->preview->value ?? 'admin/img/img/placeholder.png'])}}
                     </div>
                  </div>
               </div>
               {{-- /right side --}}
            </div>
            <div class="row">
               {{-- left side --}}
               <div class="col-lg-5">
                  <strong>{{ __('Description') }}</strong>
                  <p>{{ __('Add your Review details and necessary information from here') }}</p>
               </div>
               {{-- /left side --}}
               {{-- right side --}}
               <div class="col-lg-7">
                  <div class="card">
                     <div class="card-body">
                        <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Customer Name :') }} </label>
                           <div class="col-lg-12">
                              <input type="text" required="" name="name" class="form-control" placeholder="Enter Customer Name" value="{{ $info->name }}">
                           </div>
                        </div>
                        <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Customer Position :') }} </label>
                           <div class="col-lg-12">
                             <input type="text" required="" name="slug" class="form-control" placeholder="Enter Position" value="{{ $info->slug }}">
                           </div>
                        </div>
                        <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Comment :') }} </label>
                           <div class="col-lg-12">
                              <textarea  name="description" class="form-control h-150">{{ $info->description->value ?? '' }}</textarea>
                           </div>
                        </div>
                         <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Status :') }} </label>
                           <div class="col-lg-12">
                            <select name="status" class="form-control">
                               <option value="1" @if($info->status == 1) selected @endif>{{ __('Active') }}</option>
                               <option value="0" @if($info->status == 0) selected @endif>{{ __('Inactive') }}</option>
                            </select>
                           </div>
                        </div>
                        
                        <input type="hidden" name="type" value="review">
                        <div class="row">
                           <div class="col-lg-12">
                              <button class="btn btn-primary basicbtn" type="submit">{{ __('Save') }}</button>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </form>
      </div>
   </div>
</section>
{{ mediasingle() }} 
@endsection

@push('script')
<!-- JS Libraies -->
<script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
<!-- Page Specific JS File -->
<script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
<script src="{{ asset('admin/js/media.js') }}"></script>
@endpush

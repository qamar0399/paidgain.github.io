@extends('layouts.backend.app')

@section('title','Create Blog')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Add New Blog','prev'=> route('admin.blog.index')])
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('admin/plugins/dropzone/dropzone.css') }}">
<link rel="stylesheet" href="{{ asset('admin/assets/css/summernote/summernote-bs4.css') }}">
<link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}">
@endsection

@section('content')
<section class="section">
   <div class="row">
      <div class="col-lg-12">
         <form class="ajaxform_with_reset" method="post" action="{{ route('admin.blog.store') }}">
            @csrf
            <div class="row">
               {{-- left side --}}
               <div class="col-lg-5">
                  <strong>{{ __('Image') }}</strong>
                  <p>{{ __('Upload Blog image here') }}</p>
               </div>
               {{-- /left side --}}
               {{-- right side --}}
               <div class="col-lg-7">
                  <div class="card">
                     <div class="card-body">
                        {{mediasection()}}
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
                           <label for="" class="col-lg-12">{{ __('Title :') }} </label>
                           <div class="col-lg-12">
                              <input type="text" class="form-control" placeholder="{{ __('Title') }}" required name="name">
                           </div>
                        </div>
                        <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Short Description :') }} </label>
                           <div class="col-lg-12">
                              <textarea name="excerpt" cols="30" rows="10" class="form-control"></textarea>
                           </div>
                        </div>
                        <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Content :') }} </label>
                           <div class="col-lg-12">
                              <textarea name="description" class="summernote"></textarea>
                           </div>
                        </div>
                         <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Select Category :') }} </label>
                           <div class="col-lg-12">
                            <select name="categories[]" multiple="" class="select2 form-control">

                              {{NastedCategoryList('blog_category')}}
                            </select>
                           </div>
                        </div>
                         <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Select Tags :') }} </label>
                           <div class="col-lg-12">
                            <select name="categories[]" multiple="" class="select2 form-control">
                              {{NastedCategoryList('tag')}}
                            </select>
                           </div>
                        </div>
                        <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Status :') }} </label>
                           <div class="col-lg-12">
                              <select name="status" class="form-control">
                                 <option value="1">{{ __('Active') }}</option>
                                 <option value="0">{{ __('Inactive') }}</option>
                              </select>
                           </div>
                        </div>
                        <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Is Featured ? :') }} </label>
                           <div class="col-lg-12">
                             <select name="featured" class="form-control">
                              <option value="1">{{ __('Active') }}</option>
                              <option value="0">{{ __('Inactive') }}</option>
                            </select>
                           </div>
                        </div>
                         <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Comment Status :') }} </label>
                           <div class="col-lg-12">
                            <select name="comment_status" class="form-control">
                              <option value="1">{{ __('Active') }}</option>
                              <option value="0">{{ __('Inactive') }}</option>
                            </select>
                           </div>
                        </div>
                         <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Select Language :') }} </label>
                           <div class="col-lg-12">
                            <select name="lang" class="form-control">
                              @php
                              $languages=get_option('languages',true);
                              @endphp
                              @foreach($languages as $key => $row)
                              <option value="{{ $key }}" @if(env('DEFAULT_LANG') == $key) selected="" @endif>{{ __($row) }}</option>
                              @endforeach
                            </select>
                           </div>
                        </div>
                        <input type="hidden" name="type" value="blog">
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
<script src="{{ asset('admin/plugins/dropzone/dropzone.min.js') }}"></script>
<script src="{{ asset('admin/plugins/dropzone/components-multiple-upload.js') }}"></script>
<script src="{{ asset('admin/js/media.js') }}"></script>
<script src="{{ asset('admin/js/select2.min.js') }}"></script>
<script src="{{ asset('admin/assets/js/summernote-bs4.js') }}"></script>
<script src="{{ asset('admin/assets/js/summernote.js') }}"></script>
@endpush

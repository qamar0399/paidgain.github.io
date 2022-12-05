@extends('layouts.backend.app')


@section('title','Dashboard')

@section('content')
<section class="section">
{{-- section title --}}
<div class="section-header">
   <a href="{{ url('admin/tag') }}" class="btn btn-primary mr-2">
   <i class="fas fa-arrow-left"></i>
   </a>
   <h1>{{ __('Edit Category') }}</h1>
</div>
{{-- /section title --}}
<div class="row">
   <div class="col-lg-9">
      <form class="ajaxform" method="post" action="{{ route('admin.tag.update',$info->id) }}">
            @csrf
            @method("PUT")
            <div class="row">
               <div class="col-lg-12">
                  <div class="card">
                     <div class="card-body">
                        <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Name') }} : </label>
                              <div class="col-lg-12">
                                 <input value="{{ $info->name }}" type="text" name="name" class="form-control" placeholder="Enter Category Name">
                              </div>
                        </div>
                        <div class="from-group row mb-2">
                           <label for="" class="col-lg-12">{{ __('Slug') }} : </label>
                              <div class="col-lg-12">
                              <input value="{{ $info->slug }}" type="text" name="slug" class="form-control" placeholder="Enter Category Slug">
                              </div>
                        </div>
                     <div class="from-group row mb-2">
                        <label for="" class="col-lg-12">{{ __('Is Featured ?') }} : </label>
                        <div class="col-lg-12">
                           <select name="featured"  class="form-control selectric">
                              <option value="1" @if($info->featured == 1) selected @endif>{{ __('Yes') }}</option>
                              <option value="0" @if($info->featured == 0) selected @endif>{{ __('No') }}</option>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
     <div class="col-lg-3">
      <div class="single-area">
        <div class="card">
          <div class="card-body">
            <div class="btn-publish">
              <button type="submit" class="btn btn-primary col-12 basicbtn"><i class="fa fa-save"></i> {{ __('Save') }}</button>
            </div>
          </div>
        </div>
        <div class="card">
          <div class="card-body">
            <div class="btn-publish">
              <div class="form-group">
                  <label>{{ __('Status') }}</label>
                  <select name="status" class="form-control">
                    <option value="1" @if($info->status == 1) selected @endif>{{ __('Active') }}</option>
                    <option value="0" @if($info->status == 0) selected @endif>{{ __('Inactive') }}</option>
                  </select>
              </div>
              <div class="form-group">
                <label>{{ __('Select Language') }}</label>
                <select name="lang" class="form-control">
                  @php
                  $languages=get_option('languages',true);
                  @endphp
                  @foreach($languages as $key => $row)
                  <option value="{{ $key }}" @if($info->lang == $key) selected="" @endif>{{ __($row) }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
   </div>
   </form>
</div>
</section>
@endsection


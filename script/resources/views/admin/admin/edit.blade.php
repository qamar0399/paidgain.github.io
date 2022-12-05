@extends('layouts.backend.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}">
@endsection

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Edit Admin','prev'=> route('admin.admin.index')])
@endsection

@section('content')
<div class="row">
	<div class="col-lg-9">
		<div class="card">
			<div class="card-body">
				<div class="card-header">
					<h4>{{ __('Edit Admin') }}</h4>
				</div>
				<form method="post" action="{{ route('admin.admin.update',$user->id) }}" id="ajaxform">
                    @csrf
                    @method('PUT')
					<div class="pt-20">
                        <div class="form-group">
							<label>{{ __('Name') }}</label>
							<input type="text" name="name" class="form-control" required="" value="{{ $user->name }}">
						</div>
						<div class="form-group">
							<label>{{ __('Email') }}</label>
							<input type="email" name="email" class="form-control" required="" value="{{ $user->email }}">
						</div>
						<div class="form-group">
							<label>{{ __('Password') }}</label>
							<input type="password" name="password" class="form-control" required="">
						</div>
						<div class="form-group">
							<label>{{ __('Confirm Password') }}</label>
							<input type="password" name="password_confirmation" class="form-control" required="">
						</div>

						<div class="form-group">
							<label for="roles">{{ __('Assign Roles') }}</label>
							<select required name="roles[]" id="roles" class="form-control select2" multiple>
								@foreach ($roles as $role)
								<option value="{{ $role->name }}" {{ $user->hasRole($role->name) ? 'selected' : '' }}>{{ $role->name }}</option>
								@endforeach
							</select>
						</div>
                        <div class="form-group">
                        <label>{{ __('Status') }}</label>
                        <select name="status" class="form-control">
                            <option value="1" @if($user->status==1) selected @endif>{{ __('Active') }}</option>
                            <option value="0"  @if($user->status==0) selected @endif>{{ __('Deactive') }}</option>
                        </select>
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
						<button type="submit" class="btn btn-primary col-12"><i class="fa fa-save"></i> {{ __('Save') }}</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
@endsection

@section('script')
<script src="{{ asset('admin/js/select2.min.js') }}"></script>
@endsection

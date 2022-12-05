@extends('layouts.backend.app')

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create Admin','prev'=> route('admin.admin.index')])
@endsection

@section('style')
<link rel="stylesheet" href="{{ asset('admin/css/select2.min.css') }}">
@endsection

@section('content')
<div class="row">
	<div class="col-lg-9">
		<div class="card">
			<div class="card-header">
				<h4>{{ __('Add Admin') }}</h4>
			</div>
			<div class="card-body">
				<form method="post" action="{{ route('admin.admin.store') }}" class="ajaxform_with_reload">
					@csrf
					<div class="pt-20">
						<div class="form-group">
							<label>{{ __('Name') }}</label>
							<input type="text" name="name" class="form-control" required="">
						</div>
						<div class="form-group">
							<label>{{ __('Email') }}</label>
							<input type="email" name="email" class="form-control" required="">
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
							<label>{{ __('Assign Roles') }}</label>
							<select required name="roles[]" id="roles" class="form-control select2" multiple>
								@foreach ($roles as $role)
								<option value="{{ $role->name }}">{{ $role->name }}</option>
								@endforeach
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

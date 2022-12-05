@extends('layouts.backend.app')

@section('style')
<link rel="stylesheet" href="{{ asset('admin/assets/css/selectric.css') }}">
@endsection

@section('head')
@include('layouts.backend.partials.headersection',['title'=>'Create Language','prev'=> route('admin.language.index')])
@endsection

@section('content')
<div class="row">
	<div class="col-sm-9">
		<div class="card">
			<div class="card-body">
				<form action="{{ route('admin.language.store') }}" method="POST" class="ajaxform_with_reset">
					@csrf
					<div class="form-group">
						<label>{{ __('Language Name') }}</label>
						<input type="text" name="name" class="form-control" required>
					</div>
					<div class="form-group">
						<label>{{ __('Select Language') }}</label>
						<select name="language_code" class="form-control selectric">
							@foreach($countries as $row)
							<option value="{{ $row['code'] }}">{{ $row['name'] }}  -- {{ $row['nativeName'] }} -- ( {{ $row['code'] }})</option>
							@endforeach
						</select>
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
			</div>
		</div>
	</form>	
</div>
@endsection

@section('script')
<script src="{{ asset('admin/assets/js/jquery.selectric.min.js') }}"></script>
@endsection


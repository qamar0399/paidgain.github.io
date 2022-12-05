@if(!empty($menus))
	@foreach ($menus['data'] ?? [] as $row) 
	<li  class="nav-item">
		@if (isset($row->children)) 
		<a class="nav-link" href="{{ $row->href }}">{{ $row->text }}
			<span class="sub-nav-toggler">
			</span>
		</a>
		<ul class="sub-menu">
			@foreach($row->children as $childrens)
			 @include('components.menu.child', ['childrens' => $childrens])
			@endforeach
		</ul>
		@else
		<a class="nav-link @if(url()->current() == url($row->href)) active @endif"  href="{{ url($row->href) }}" @if(!empty($row->target)) target="{{ $row->target }}" @endif>{{ $row->text }}</a>
		@endif
	</li>		
	@endforeach
@endif

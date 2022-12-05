@if(!empty($menus))
<h4>{{ $menus['name'] ?? '' }}</h4>
<ul>
   <li>
      @foreach ($menus['data'] ?? [] as $row)
      <a class="nav-link @if(url()->current() == url($row->href)) active @endif"  href="{{ url($row->href) }}" @if(!empty($row->target)) target="{{ $row->target }}" @endif>{{ $row->text }}</a>
      @endforeach
   </li>
</ul>
@endif

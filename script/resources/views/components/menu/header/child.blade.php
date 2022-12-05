@if ($childrens)
    <li>
  		<a href="{{ url($childrens->href) }}" class="nav-link-item" @if(!empty($childrens->target)) target="{{ $childrens->target }}" @endif>{{ $childrens->text }}</a>
    </li>
    @if (isset($childrens->children))
        <li class="nav-item nav-item-has-children">
            <a href="{{ $row->href }}" class="nav-link-item drop-trigger">
                {{ $row->text }}
                <i class="fas fa-angle-down"></i>
            </a>
            <ul class="sub-menu" id="submenu-00">
                @foreach($childrens->children ?? [] as $row)
                    @include('components.menu.header.child', ['childrens' => $row])
                @endforeach
            </ul>
        </li>
    @endif
@endif

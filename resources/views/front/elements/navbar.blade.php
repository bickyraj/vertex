<nav class="navbar navbar-expand-lg">
  <div id="navbarContent" class="collapse navbar-collapse" data-sm-optons="{bootstrapHighlightClasses: 'ola' }">
    <ul class="navbar-nav">
      @if($menus)
      @foreach($menus as $menu)
      <li class="nav-item dropdown">
        <a href="{!! ($menu->link)?$menu->link:'javascript:;' !!}" class="nav-link {!! (!iterator_count($menu->children))?'':'dropdown-toggle' !!}">{{ $menu->name }}</a>
        @if(iterator_count($menu->children))
        <ul class="dropdown-menu shadow-sm">
          <!-- Level two dropdown-->
          @foreach($menu->children as $child)
            <li class="{{ (iterator_count($child->children))? 'dropdown-submenu': '' }}">
              <a id="dropdownMenu2" href="{!! ($child->link)?$child->link:'javascript:;' !!}" role="button" data-toggle="dropdown" aria-haspopup="{!! ($child->link)?false:true !!}"
                aria-expanded="false" class="dropdown-item {{ (iterator_count($child->children))? 'dropdown-toggle': 'nav-link' }}"><span>{{ $child->name }}</span></a>
                @if(iterator_count($child->children))
                  @include('front.elements.child-menu', ['children' => $child->children, 'n_count' => 2])
                @endif
          </li>
          @endforeach
        </ul>
        @endif
      </li>
      @endforeach
      @endif
    </ul>
  </div>
</nav>
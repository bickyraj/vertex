  <ul aria-labelledby="dropdownMenu{{ $n_count }}" class="dropdown-menu shadow">
    <!-- Level three dropdown-->
    @foreach($children as $child)
    <li class="{{ (iterator_count($child->children))? 'dropdown-submenu': '' }}">
      <a id="dropdownMenu{{ $n_count++ }}" href="{!! ($child->link)?$child->link:'javascript:;' !!}" role="button" data-toggle="{!! ($child->link)?'':'toggle' !!}" aria-haspopup="{!! ($child->link)?false:true !!}"
        aria-expanded="false" class="dropdown-item {{ (iterator_count($child->children))? 'dropdown-toggle': 'nav-link' }}">{{ $child->name }}</a>
        @if(iterator_count($child->children))
            @include('front.elements.child-menu', ['children' => $child->children, 'n_count' => $n_count++])
        @endif
    </li>
    @endforeach
  </ul>

  <!-- <ul aria-labelledby="dropdownMenu2" class="dropdown-menu shadow">
    <li>
      <a tabindex="-1" href="#" class="dropdown-item"><span>Everest Base Camp Trek</span></a>
    </li>
    <li>
      <a tabindex="-1" href="#" class="dropdown-item">Everest Gokyo Valley Trek</a>
    </li>
    <li>
      <a tabindex="-1" href="#" class="dropdown-item">Everest Three Passes Trek</a>
    </li>
    <li>
      <a tabindex="-1" href="#" class="dropdown-item">Everest Panoramic Trek</a>
    </li>
    <li>
      <a tabindex="-1" href="#" class="dropdown-item">Everest Base Camp Trek with Island Peak Summit</a>
    </li>
    <li>
      <a tabindex="-1" href="#" class="dropdown-item">Everest Base Camp Trek with Mera Peak Summit</a>
    </li>
  </ul> -->
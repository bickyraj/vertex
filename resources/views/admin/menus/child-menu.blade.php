<ol class="dd-list">
	@foreach($children as $child)
	<li class="dd-item" data-link="{{ $child->link }}" data-type="{{ $child->type }}" data-name="<?= $child->name; ?>" data-id="<?= $child->menu_itemable_id; ?>">
	  <div class="dd-handle">{{ $child->name }}</div>
	  @if($child->children)
        @include('admin.menus.child-menu', ['children' => $child->children])
	  @endif
	</li>
	@endforeach
</ol>
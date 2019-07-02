<li class="{{ Request::is('users*') ? 'active' : '' }}">
	<a href="{!! route('users.index') !!}"><i class="glyphicon glyphicon-user"></i><span>Users</span></a>
</li>
{{-- <li>
	<a href="{!! url('dashboard/index') !!}"><i class="glyphicon glyphicon-cog"></i><span>Permission</span></a>
</li> --}}

<li class="{{ Request::is('products*') ? 'active' : '' }}">
	<a href="{!! route('products.index') !!}"><i class="glyphicon glyphicon-list-alt
		"></i><span>Products</span></a>
	</li>

<li class="{{ Request::is('permissions*') ? 'active' : '' }}">
    <a href="{!! route('permissions.index') !!}"><i class="glyphicon glyphicon-cog"></i><span>Permissions</span></a>
</li>
<li class="{{ Request::is('roles*') ? 'active' : '' }}">
    <a href="{!! route('roles.index') !!}"><i class="fa fa-edit"></i><span>Roles</span></a>
</li>


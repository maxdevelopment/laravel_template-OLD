<li class="active">{{ link_to_route('main', 'Home') }}
<li>{{ link_to_route('products', 'Products') }}
@if (!Auth::check())
    <li>{{ link_to_route('auth', 'Registration') }}
@endif
@if (Auth::check())
    @if (Crypt::decrypt(Session::get('role')) === 'user')
        <li>{{ link_to_route('user.main', 'Profile') }}
    @elseif (Crypt::decrypt(Session::get('role')) === 'admin')
        <li>{{ link_to_route('admin.main', 'Admin') }}
    @endif
@endif
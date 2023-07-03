<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Home</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('conveniences.index') }}" class="nav-link {{ Request::is('conveniences*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Conveniences</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('service-types.index') }}" class="nav-link {{ Request::is('service-types*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Service Types</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('services.index') }}" class="nav-link {{ Request::is('services*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Services</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salons.index') }}" class="nav-link {{ Request::is('salons*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salons</p>
    </a>
</li>

{{-- <li class="nav-item">
    <a href="{{ route('userddresses.index') }}" class="nav-link {{ Request::is('user-addresses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>User Addresses</p>
    </a>
</li> --}}

<li class="nav-item">
    <a href="{{ route('userAddresses.index') }}" class="nav-link {{ Request::is('userAddresses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>User Addresses</p>
    </a>
</li>


<li class="nav-item">
    <a href="{{ route('salonAddresses.index') }}" class="nav-link {{ Request::is('salonAddresses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Addresses</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('appointements.index') }}" class="nav-link {{ Request::is('appointements*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Appointements</p>
<li class="nav-item">
    <a href="{{ route('userTypes.index') }}" class="nav-link {{ Request::is('userTypes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>User Types</p>
    </a>
</li>

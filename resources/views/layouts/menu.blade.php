<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Tableau de Bord</p>
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
        <p> Type de Services </p>
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

{{-- <li class="nav-item">
    <a href="{{ route('user-addresses.index') }}" class="nav-link {{ Request::is('user-addresses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>User Addresses</p>
    </a>
</li> --}}


{{-- <li class="nav-item">
    <a href="{{ route('salon-addresses.index') }}" class="nav-link {{ Request::is('salon-addresses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Addresses</p>
    </a>
</li> --}}

<li class="nav-item">
    <a href="{{ route('appointements.index') }}" class="nav-link {{ Request::is('appointements*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>RDV</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('user-types.index') }}" class="nav-link {{ Request::is('userTypes*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Type d'utilisateur</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-type-accounts.index') }}" class="nav-link {{ Request::is('salon-type-accounts*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p> Type de Compte Salon</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-service-types.index') }}" class="nav-link {{ Request::is('salon-service-types*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Types de Service </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('service-place-types.index') }}" class="nav-link {{ Request::is('service-place-types*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p> Types de Lieu</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-services.index') }}" class="nav-link {{ Request::is('salon-services*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Services</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-pictures.index') }}" class="nav-link {{ Request::is('salon-pictures*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Image des salons </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('quick-services.index') }}" class="nav-link {{ Request::is('quick-services*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p> Services Rapide </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('quick-services.index') }}" class="nav-link {{ Request::is('quick-services*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p> Methodes de paiements</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('payment-types.index') }}" class="nav-link {{ Request::is('payment-types*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Mode de Paiement </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('service-types.index') }}" class="nav-link {{ Request::is('service-types*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Service Types</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('services-salons.index') }}" class="nav-link {{ Request::is('services-salons*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Services Salons</p>
    </a>
</li>

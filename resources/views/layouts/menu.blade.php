<!-- need to remove -->
<li class="nav-item">
    <a href="{{ route('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Tableau de Bord</p>
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
    <a href="{{ route('salon-type-accounts.index') }}"
        class="nav-link {{ Request::is('salon-type-accounts*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p> Type de Compte Salon</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-service-types.index') }}"
        class="nav-link {{ Request::is('salon-service-types*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Types de Service </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('service-place-types.index') }}"
        class="nav-link {{ Request::is('service-place-types*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p> Types de Lieu</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-services.index') }}"
        class="nav-link {{ Request::is('salon-services*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Services</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-pictures.index') }}"
        class="nav-link {{ Request::is('salon-pictures*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Image des salons </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('quick-services.index') }}"
        class="nav-link {{ Request::is('quick-services*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p> Services Rapide </p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('quick-services.index') }}"
        class="nav-link {{ Request::is('quick-services*') ? 'active' : '' }}">
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
    <a href="{{ route('services-salons.index') }}"
        class="nav-link {{ Request::is('services-salons*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Services Salons</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-schedules.index') }}"
        class="nav-link {{ Request::is('salon-schedules*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Schedules</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-availabilies.index') }}"
        class="nav-link {{ Request::is('salon-availabilies*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Availabilies</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-un-availabilies.index') }}"
        class="nav-link {{ Request::is('salon-un-availabilies*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Un Availabilies</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('extras.index') }}" class="nav-link {{ Request::is('extras*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Extras</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('conversations.index') }}" class="nav-link {{ Request::is('conversations*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Conversations</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('messages.index') }}" class="nav-link {{ Request::is('messages*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Messages</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('appointment-statuses.index') }}"
        class="nav-link {{ Request::is('appointmentStatuses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Appointment Statuses</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('salon-types.index') }}" class="nav-link {{ Request::is('salon-types*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Salon Types</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('artists.index') }}" class="nav-link {{ Request::is('artists*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Artists</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('commodities.index') }}" class="nav-link {{ Request::is('commodities*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Commodities</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('artist-pictures.index') }}"
        class="nav-link {{ Request::is('artist-ictures*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Artist Pictures</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('artist-porfolios.index') }}"
        class="nav-link {{ Request::is('artist-porfolios*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Artist Porfolios</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('artist-addresses.index') }}"
        class="nav-link {{ Request::is('artist-addresses*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Artist Addresses</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('artist-services.index') }}" class="nav-link {{ Request::is('artist-services*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Artist Services</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('type-pieces.index') }}" class="nav-link {{ Request::is('type-pieces*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Type Pieces</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('user-pieces.index') }}" class="nav-link {{ Request::is('*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>User Pieces</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('category-pros.index') }}" class="nav-link {{ Request::is('category-pros*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Category Pros</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('certification-pros.index') }}" class="nav-link {{ Request::is('certification-pros*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Certification Pros</p>
    </a>
</li>

<li class="nav-item">
    <a href="{{ route('bank-infos.index') }}" class="nav-link {{ Request::is('bank-infos*') ? 'active' : '' }}">
        <i class="nav-icon fas fa-home"></i>
        <p>Bank Infos</p>
    </a>
</li>

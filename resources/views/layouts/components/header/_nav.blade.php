<nav class="nav-extended row">
    <div class="col s12">
        <div class="nav-wrapper">
            <a href="#" class="brand-logo">Invoice</a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>

            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="#">Logout</a></li>
            </ul>
        </div>
        <div class="nav-content">
            <ul class="tabs tabs-transparent">
                <li class="tab"><a @if($request->route()->getName() == 'dashboard') class="active" @endif href="{{ route('dashboard') }}">Dashboard</a></li>
                <li class="tab"><a @if($request->route()->getName() == 'clients') class="active" @endif href="{{ route('clients') }}">Clients</a></li>
                <li class="tab"><a href="{{ route('quotes') }}">Quotes</a></li>
                <li class="tab"><a @if($request->route()->getName() == 'invoices') class="active" @endif href="{{ route('invoices') }}">Invoices</a></li>
                <li class="tab"><a href="{{ route('payments') }}">Payments</a></li>
                <li class="tab"><a href="{{ route('products') }}">Products</a></li>
                <li class="tab disabled"><a href="#tasks">Tasks</a></li>
                <li class="tab disabled"><a href="#reports">Reports</a></li>
            </ul>
            @stack('nav-extra')
        </div>
    </div>
</nav>

<ul class="sidenav" id="mobile-demo">
    <li><a href="sass.html">Sass</a></li>
    <li><a href="badges.html">Components</a></li>
    <li><a href="collapsible.html">JavaScript</a></li>
</ul>

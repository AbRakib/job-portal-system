@php
    $sidebarUser = Auth::user();
@endphp

<div class="dashboard-menu">
    <div class="open-work-card">
        <div>
            <strong>Premium Employer</strong>
            <span>Job posting enabled</span>
        </div>
        <button type="button" aria-label="Employer posting is enabled"></button>
    </div>

    <div class="menu-identity">
        <h2>{{ $sidebarUser->name ?: 'Employer' }}</h2>
        <p>{{ $sidebarUser->email }}</p>
    </div>

    <nav class="dashboard-nav" aria-label="Account navigation">
        <a class="active" href="{{ route('account.profile') }}"><i class="fa fa-tachometer"></i> Dashboard</a>
        <a href="{{ route('account.profile') }}"><i class="fa fa-user"></i> Edit Account Details</a>
        <a href="#"><i class="fa fa-building"></i> Company Public Profile</a>
        <a href="{{ route('account.create.job') }}"><i class="fa fa-plus"></i> Post a Job</a>
        <a href="{{ route('account.my.jobs') }}"><i class="fa fa-briefcase"></i> Manage Jobs</a>
        <a href="#"><i class="fa fa-database"></i> CV Search Packages</a>
        <a href="#"><i class="fa fa-credit-card"></i> Payment History</a>
        <a href="#"><i class="fa fa-envelope"></i> Company Messages</a>
        <a href="#"><i class="fa fa-users"></i> Company Followers</a>
        <a href="{{ route('account.logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
    </nav>
</div>

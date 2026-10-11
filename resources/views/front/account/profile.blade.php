@extends('front.layouts.app')

@php
    $packageCards = [
        ['icon' => 'cog', 'label' => 'Package Name', 'value' => 'Gold', 'tone' => 'orange'],
        ['icon' => 'dollar', 'label' => 'Price', 'value' => 'USD 50', 'tone' => 'cyan'],
        ['icon' => 'check-square', 'label' => 'Available Quota', 'value' => $openJobsCount.' / 24', 'tone' => 'green'],
        ['icon' => 'calendar-o', 'label' => 'Purchased On', 'value' => '08 Apr, 2025', 'tone' => 'blue'],
        ['icon' => 'calendar-times-o', 'label' => 'Package Expires', 'value' => '05 Dec, 2026', 'tone' => 'pink'],
    ];
    $plans = [
        ['name' => 'Starter', 'icon' => 'leaf', 'price' => '15', 'features' => ['10 applications / month', '2 resume scans', 'Email support', 'Basic analytics'], 'button' => 'Downgrade to Starter', 'current' => false, 'tone' => 'muted'],
        ['name' => 'Pro', 'icon' => 'diamond', 'price' => '29', 'features' => ['40 applications / month', '10 resume scans', 'AI rewrites + recruiter boost', 'Concierge interview nudges'], 'button' => 'Current plan', 'current' => true, 'tone' => 'blue'],
        ['name' => 'Elite', 'icon' => 'crown', 'price' => '79', 'features' => ['Unlimited applications', 'Concierge career coach', 'Spotlight placement', 'Invite-only events'], 'button' => 'Upgrade to Elite', 'current' => false, 'tone' => 'orange'],
    ];
@endphp

@section('content')
    <section class="employer-dashboard">
        <div class="employer-hero-bar">
            <div class="container employer-hero-inner">
                <div>
                    <h1>Welcome to Employer Dashboard</h1>
                    <p>Track job postings, packages, and CV views in one place.</p>
                </div>
                <a class="btn btn-primary" href="{{ route('account.create.job') }}"><i class="fa fa-plus"></i> Post a Job</a>
            </div>
        </div>

        <div class="container employer-shell">
            <aside class="seeker-sidebar">
                @include('front.account.sidebar')
            </aside>

            <main class="employer-main">
                <div class="seeker-stats employer-stats">
                    <div class="stat-card purple"><i class="fa fa-clock-o"></i><span>Open Jobs</span><strong>{{ $openJobsCount }}</strong></div>
                    <div class="stat-card orange"><i class="fa fa-users"></i><span>Followers</span><strong>2</strong></div>
                    <div class="stat-card blue"><i class="fa fa-envelope-o"></i><span>Messages</span><strong>0</strong></div>
                </div>

                <section class="dashboard-panel employer-panel">
                    <div class="panel-heading-with-icon">
                        <span><i class="fa fa-cube"></i></span>
                        <h2>Purchased Job Package Details</h2>
                    </div>
                    <div class="package-detail-grid">
                        @foreach ($packageCards as $card)
                            <article class="package-detail-card">
                                <span class="package-icon {{ $card['tone'] }}"><i class="fa fa-{{ $card['icon'] }}"></i></span>
                                <small>{{ $card['label'] }}</small>
                                <strong>{{ $card['value'] }}</strong>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="dashboard-panel employer-panel">
                    <div class="panel-title">
                        <h2>Upgrade Job Packages</h2>
                        <a href="#">Compare all</a>
                    </div>
                    <div class="plan-grid">
                        @foreach ($plans as $plan)
                            <article class="plan-card {{ $plan['current'] ? 'current' : '' }}">
                                <span class="plan-icon {{ $plan['tone'] }}"><i class="fa fa-{{ $plan['icon'] }}"></i></span>
                                <h3>{{ $plan['name'] }}{{ $plan['current'] ? ' (Current)' : '' }}</h3>
                                <p><strong>$ {{ $plan['price'] }}</strong> /month</p>
                                <ul>
                                    @foreach ($plan['features'] as $feature)
                                        <li><i class="fa fa-check"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <a class="plan-action {{ $plan['current'] ? 'disabled' : '' }}" href="#">{{ $plan['button'] }}</a>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section class="dashboard-panel employer-panel">
                    <div class="panel-title">
                        <h2>Recent Posted Jobs</h2>
                        <a href="{{ route('account.my.jobs') }}">Manage jobs</a>
                    </div>
                    <div class="recent-job-list">
                        @forelse ($recentJobs as $job)
                            <article>
                                <div>
                                    <h3>{{ $job->title }}</h3>
                                    <p>{{ optional($job->category)->name ?: 'General' }} &middot; {{ optional($job->jobType)->name ?: 'Job' }} &middot; {{ $job->location }}</p>
                                </div>
                                <span>{{ $job->status == 1 ? 'Active' : 'Paused' }}</span>
                            </article>
                        @empty
                            <div class="empty-employer-state">
                                <h3>No jobs posted yet</h3>
                                <p>Create your first listing and start receiving applicants.</p>
                                <a class="btn btn-primary" href="{{ route('account.create.job') }}">Post a Job</a>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="dashboard-panel employer-panel compact-panel">
                    <div class="panel-title">
                        <h2>Purchased CVs Package Details</h2>
                        <a href="#">View invoices</a>
                    </div>
                    <div class="cv-package-grid">
                        <div><span>Package Name</span><strong>Startup</strong></div>
                        <div><span>Price</span><strong>USD 30</strong></div>
                        <div><span>Available CVs</span><strong>3 / 30</strong></div>
                        <div><span>Purchased On</span><strong>06 Nov, 2025</strong></div>
                        <div class="danger"><span>Expires On</span><strong>06 Dec, 2025</strong></div>
                    </div>
                </section>

                <section class="dashboard-panel employer-panel">
                    <h2>Upgrade CV Search Package</h2>
                    <div class="plan-grid mt-3">
                        @foreach ($plans as $plan)
                            <article class="plan-card {{ $plan['current'] ? 'current' : '' }}">
                                <span class="plan-icon {{ $plan['tone'] }}"><i class="fa fa-{{ $plan['icon'] }}"></i></span>
                                <h3>{{ $plan['name'] }}{{ $plan['current'] ? ' (Current)' : '' }}</h3>
                                <p><strong>$ {{ $plan['price'] }}</strong> /month</p>
                                <ul>
                                    @foreach ($plan['features'] as $feature)
                                        <li><i class="fa fa-check"></i>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                                <a class="plan-action {{ $plan['current'] ? 'disabled' : '' }}" href="#">{{ $plan['button'] }}</a>
                            </article>
                        @endforeach
                    </div>
                </section>
            </main>
        </div>
    </section>
@endsection

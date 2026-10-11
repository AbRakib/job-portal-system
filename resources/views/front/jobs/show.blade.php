@extends('front.layouts.app')

@section('content')
@php
    $jobType = data_get($job, 'jobType.name', data_get($job, 'job_type', 'Full Time'));
    $category = data_get($job, 'category.name', data_get($job, 'category', 'Product & Engineering'));
    $company = data_get($job, 'company_name', 'Forum International');
    $location = data_get($job, 'location', data_get($job, 'company_location', 'Dubai, United Arab Emirates'));
    $salary = data_get($job, 'salary') ?: '$500 - $3000';
    $posted = optional(data_get($job, 'created_at'))->format('M d, Y') ?? 'May 19, 2025';
    $experience = data_get($job, 'experience') ?: 'Lead / Manager';
    $description = trim(strip_tags(data_get($job, 'description', '')));
    $responsibilities = trim(strip_tags(data_get($job, 'responsibility', '')));
    $qualifications = trim(strip_tags(data_get($job, 'qualifications', '')));
    $benefits = collect(explode(',', data_get($job, 'benefits') ?: 'Annual bonus,Hybrid work flexibility,Private medical cover,Learning stipend,Wellness allowance,Visa sponsorship'))
        ->map(fn ($benefit) => trim($benefit))
        ->filter()
        ->values();
    $icons = ['paper-plane', 'paint-brush', 'code', 'connectdevelop'];
@endphp

<main class="job-detail-page">
    <section class="job-detail-hero">
        <div class="container">
            <article class="detail-title-card">
                <span class="detail-company-logo"><i class="fa fa-paper-plane"></i></span>
                <div class="detail-title-copy">
                    <span class="detail-kicker">{{ Str::upper($category) }}</span>
                    <h1>{{ $job->title }}</h1>
                    <div class="detail-meta-row">
                        <span><i class="fa fa-map-marker"></i> {{ $location }}</span>
                        <span><i class="fa fa-briefcase"></i> {{ $jobType }}</span>
                        <span>{{ $salary }} / month</span>
                    </div>
                </div>
                <div class="detail-actions">
                    <a class="detail-apply" href="{{ route('account.login') }}"><i class="fa fa-paper-plane"></i> Apply Now</a>
                    <button type="button"><i class="fa fa-bookmark-o"></i> Save Job</button>
                    <a href="#"><i class="fa fa-share-alt"></i> Share</a>
                </div>
            </article>

            <div class="detail-stats">
                <div><i class="fa fa-calendar"></i><span>Posted On</span><strong>{{ $posted }}</strong></div>
                <div><i class="fa fa-user"></i><span>Seniority</span><strong>{{ $experience }}</strong></div>
                <div><i class="fa fa-building"></i><span>Company</span><strong>{{ $company }}</strong></div>
                <div><i class="fa fa-clock-o"></i><span>Working Time</span><strong>Monday - Friday · 9am-5pm</strong></div>
            </div>
        </div>
    </section>

    <section class="job-detail-body">
        <div class="container detail-layout">
            <div class="detail-main">
                <article class="detail-panel">
                    <h2>Role Overview</h2>
                    <p>{{ $description ?: 'We are looking for a strategic delivery manager who can lead cross-functional teams, ship important initiatives on schedule, and keep stakeholders aligned every step of the way.' }}</p>
                    <p>Working closely with product, operations, and leadership, you will create clear workflows, surface useful metrics, and help teams deliver with confidence.</p>
                </article>

                <article class="detail-panel">
                    <h2>What You'll Do</h2>
                    <p>{{ $responsibilities ?: 'Own the roadmap, coordinate delivery ceremonies, partner with internal teams, present delivery status, and continuously refine workflows through practical data and quality signals.' }}</p>
                </article>

                <article class="detail-panel">
                    <h2>Skills & Experience</h2>
                    <p>{{ $qualifications ?: '5+ years leading software implementation or technical program management. Strong communication, stakeholder management, agile delivery, and cross-functional leadership experience preferred.' }}</p>
                </article>

                <article class="detail-panel">
                    <h2>Benefits & Perks</h2>
                    <div class="benefit-list">
                        @foreach($benefits as $benefit)
                            <span>{{ $benefit }}</span>
                        @endforeach
                    </div>
                </article>

                <article class="detail-panel">
                    <h2>How to Apply</h2>
                    <p>Attach your updated resume, share 2-3 project highlights, and tell us how your work improved delivery quality in your previous role.</p>
                    <a class="submit-application" href="{{ route('account.login') }}"><i class="fa fa-cloud-upload"></i> Submit Application</a>
                </article>
            </div>

            <aside class="detail-sidebar">
                <article class="detail-side-card">
                    <h2>Job Snapshot</h2>
                    <dl>
                        <dt><i class="fa fa-hashtag"></i> Job ID</dt><dd>JB{{ str_pad($job->id, 5, '0', STR_PAD_LEFT) }}</dd>
                        <dt><i class="fa fa-map-pin"></i> Location</dt><dd>{{ $location }}</dd>
                        <dt><i class="fa fa-users"></i> Team Size</dt><dd>25+ collaborators</dd>
                        <dt><i class="fa fa-money"></i> Compensation</dt><dd>{{ $salary }}</dd>
                        <dt><i class="fa fa-briefcase"></i> Employment</dt><dd>{{ $jobType }}</dd>
                        <dt><i class="fa fa-graduation-cap"></i> Education</dt><dd>Master's preferred</dd>
                    </dl>
                </article>

                <article class="detail-side-card">
                    <h2>Talk to {{ $company }}</h2>
                    <form class="detail-contact-form">
                        <label>Full name<input type="text" placeholder="Alex Morgan"></label>
                        <label>Email address<input type="email" placeholder="you@email.com"></label>
                        <label>Message<textarea placeholder="Share a short note..."></textarea></label>
                        <button type="button">Send Message</button>
                    </form>
                </article>

                <article class="detail-side-card">
                    <h2>Office Location</h2>
                    <div class="detail-map">
                        <iframe title="Office location map" src="https://maps.google.com/maps?q={{ urlencode($location) }}&output=embed" loading="lazy"></iframe>
                    </div>
                </article>
            </aside>
        </div>
    </section>

    <section class="related-opportunities">
        <div class="container">
            <div class="detail-section-heading">
                <span>Explore More Roles</span>
                <h2>Related Opportunities</h2>
            </div>
            <div class="related-grid">
                @foreach($relatedJobs as $index => $related)
                    @php
                        $relatedType = data_get($related, 'jobType.name', data_get($related, 'job_type', 'Full Time'));
                    @endphp
                    <article class="related-card">
                        <span class="job-badge {{ Str::contains(Str::lower($relatedType), 'contract') ? 'contract' : 'green' }}">{{ $relatedType }}</span>
                        @if($index === 1)<b class="related-hot"><i class="fa fa-bolt"></i></b>@endif
                        <h3><a href="{{ route('frontend.jobs.show', $related->id) }}">{{ $related->title }}</a></h3>
                        <p>Salary: {{ $related->salary ?: 'Negotiable' }}</p>
                        <p><i class="fa fa-map-marker"></i> {{ $related->location }}</p>
                        <div>
                            <span class="company-mark mark-{{ $index % 4 }}"><i class="fa fa-{{ $icons[$index % count($icons)] }}"></i></span>
                            <small>Posted<br><strong>{{ optional($related->created_at)->format('M d, Y') ?? 'May 11, 2025' }}</strong></small>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
</main>
@endsection

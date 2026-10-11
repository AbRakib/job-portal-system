@extends('front.layouts.app')
@section('content')
@php
    $icons = ['paper-plane', 'paint-brush', 'code', 'connectdevelop', 'leaf', 'bullseye', 'tint', 'bar-chart'];
@endphp
<main class="job-list-page">
    <section class="job-list-hero">
        <div class="container">
            <span class="job-list-kicker">Browse Opportunities</span>
            <h1>Find a role that matches your ambition</h1>
            <p>Search thousands of curated openings across industries, experience levels, and locations.</p>
            <form class="job-list-search" action="{{ route('frontend.jobs') }}" method="GET">
                <label>
                    <i class="fa fa-search"></i>
                    <input type="search" name="keyword" placeholder="Job title, keyword or company" aria-label="Job title, keyword or company">
                </label>
                <label>
                    <i class="fa fa-map-marker"></i>
                    <select name="location" aria-label="Location">
                        <option value="">Location</option>
                        @foreach($filters['Location'] as $location => $count)
                            <option value="{{ $location }}">{{ $location }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <i class="fa fa-briefcase"></i>
                    <select name="category" aria-label="Category">
                        <option value="">Category</option>
                        @foreach($filters['Industry'] as $industry => $count)
                            <option value="{{ $industry }}">{{ $industry }}</option>
                        @endforeach
                    </select>
                </label>
                <button type="submit" aria-label="Search jobs"><i class="fa fa-search"></i></button>
            </form>
        </div>
    </section>

    <section class="job-list-content">
        <div class="container job-list-grid">
            <aside class="job-filter-panel" aria-label="Job filters">
                @foreach($filters as $title => $items)
                    <div class="filter-card">
                        <h2>{{ $title }}</h2>
                        @foreach($items as $label => $count)
                            <label>
                                <input type="checkbox" name="{{ Str::slug($title) }}[]" value="{{ $label }}">
                                <span>{{ $label }}</span>
                                <b>{{ $count }}</b>
                            </label>
                        @endforeach
                    </div>
                @endforeach
            </aside>

            <div class="job-results">
                <div class="job-results-toolbar">
                    <div>
                        <h2>{{ $jobs->count() }} Jobs Found</h2>
                        <p>Showing 1 - {{ $jobs->count() }} of {{ $jobs->count() }} results</p>
                    </div>
                    <div class="toolbar-actions">
                        <button type="button" aria-label="Grid view"><i class="fa fa-th-large"></i></button>
                        <button type="button" class="active" aria-label="List view"><i class="fa fa-list"></i></button>
                        <select aria-label="Sort jobs">
                            <option>Most recent</option>
                            <option>Salary high to low</option>
                            <option>Featured first</option>
                        </select>
                    </div>
                </div>

                <div class="job-card-stack">
                    @foreach($jobs as $index => $job)
                        @php
                            $jobType = $job->jobType->name ?? $job->job_type ?? 'Full Time/Permanent';
                            $isContract = Str::contains(Str::lower($jobType), 'contract');
                            $company = $job->company_name ?? 'JobsPortal';
                            $description = Str::limit(strip_tags($job->description ?? 'Explore this opportunity and connect with a hiring team that matches your goals.'), 145);
                        @endphp
                        <article class="job-list-card">
                            <div class="job-card-main">
                                <span class="job-badge {{ $isContract ? 'contract' : '' }}">{{ $jobType }}</span>
                                <div class="job-card-row">
                                    <span class="company-mark mark-{{ $index % 4 }}"><i class="fa fa-{{ $icons[$index % count($icons)] }}"></i></span>
                                    <div class="job-card-copy">
                                        <h3>{{ $job->title }}</h3>
                                        <div class="job-meta">
                                            <span><i class="fa fa-briefcase"></i> {{ $company }}</span>
                                            <span><i class="fa fa-map-marker"></i> {{ $job->location }}</span>
                                            <span>{{ $job->salary ?: 'Negotiable' }}</span>
                                        </div>
                                        <p>{{ $description }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="job-card-actions">
                                @if($index % 3 === 0)
                                    <span class="hot-job" aria-label="Featured job"><i class="fa fa-bolt"></i></span>
                                @endif
                                <a href="{{ route('frontend.jobs.show', $job->id) }}">View Details</a>
                                <button type="button" aria-label="Save job"><i class="fa fa-bookmark-o"></i></button>
                            </div>
                            <div class="job-card-footer">
                                <span>Posted {{ optional($job->created_at)->format('M d, Y') ?? 'Mar 07, 2025' }}</span>
                                <span>ID: JP-{{ $job->id }}</span>
                            </div>
                        </article>
                    @endforeach
                </div>

                <nav class="job-pagination" aria-label="Job pages">
                    <span>Previous</span>
                    <a class="active" href="#">1</a>
                    <a href="#">2</a>
                    <a href="#">3</a>
                    <a href="#">Next</a>
                </nav>
            </div>
        </div>
    </section>
</main>
@endsection

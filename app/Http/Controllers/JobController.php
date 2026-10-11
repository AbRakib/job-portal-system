<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Throwable;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $jobs = Job::with(['category', 'jobType'])
                ->where('status', 1)
                ->where('deleted', false)
                ->latest('id')
                ->take(18)
                ->get();
        } catch (Throwable $exception) {
            $jobs = collect();
        }

        if ($jobs->isEmpty()) {
            $jobs = $this->sampleJobs();
        }

        return view('front.jobs.index', [
            'jobs' => $jobs,
            'filters' => $this->filters(),
        ]);
    }

    private function sampleJobs(): Collection
    {
        return collect([
            ['title' => 'UI UX Designer Required', 'company_name' => 'Multimedia Design', 'location' => 'Fairbanks', 'salary' => '$2500 - $3000', 'description' => 'We are seeking a multi-disciplinary designer to ship intuitive product experiences for our expanding SaaS platform.', 'job_type' => 'Full Time/Permanent', 'category' => 'Information Technology'],
            ['title' => 'Graphic Designer Required', 'company_name' => 'Multimedia Design', 'location' => 'Bessemer', 'salary' => '$10,000 - $20,000', 'description' => 'Contract opportunity to create compelling digital and print assets for global brand launches.', 'job_type' => 'Contract', 'category' => 'Advertising/PR'],
            ['title' => 'Full Stack Developer', 'company_name' => 'Multimedia Design', 'location' => 'Bessemer', 'salary' => '$10,000 - $20,000', 'description' => 'Join our remote engineering pod to build new customer journeys using React, Node, and GraphQL.', 'job_type' => 'Contract', 'category' => 'Information Technology'],
            ['title' => 'Full Stack Designer', 'company_name' => 'Connect People', 'location' => 'Barrington', 'salary' => '$6,000 - $8,000', 'description' => 'Lead design systems that power mobile and web apps for our fast-growing HR solutions suite.', 'job_type' => 'Full Time/Permanent', 'category' => 'Media & Communications'],
            ['title' => 'Dot Developer', 'company_name' => 'Power Wave', 'location' => 'Durant', 'salary' => '$6,000 - $12,000', 'description' => 'Modernize enterprise dashboards and microservices in .NET for a national logistics brand.', 'job_type' => 'Contract', 'category' => 'Information Technology'],
            ['title' => 'SEO Expert', 'company_name' => 'Mayan Design Studios', 'location' => 'Blaine', 'salary' => '$4,000 - $8,000', 'description' => 'Drive technical SEO, link-building, and content experiments for our portfolio of ecommerce brands.', 'job_type' => 'Full Time/Permanent', 'category' => 'Health & Fitness'],
            ['title' => 'Digital Product Designer', 'company_name' => 'Multimedia Design', 'location' => 'Bessemer', 'salary' => '$6,500 - $9,000', 'description' => 'Craft high-fidelity prototypes, user flows, and interaction patterns for fintech experiences.', 'job_type' => 'Contract', 'category' => 'Fashion'],
            ['title' => 'Marketing Analyst', 'company_name' => 'Media Wave', 'location' => 'Fairbanks', 'salary' => '$5,000 - $10,000', 'description' => 'Measure campaign performance and build dashboards that surface high-impact growth insights.', 'job_type' => 'Full Time/Permanent', 'category' => 'Advertising/PR'],
        ])->map(function ($job, $index) {
            return (object) array_merge($job, [
                'id' => 2183 + $index,
                'created_at' => now()->subDays(7),
                'category' => (object) ['name' => $job['category']],
                'jobType' => (object) ['name' => $job['job_type']],
            ]);
        });
    }

    private function filters(): array
    {
        return [
            'Job Type' => ['Full Time/Permanent' => 12, 'Contract' => 33, 'Part Time' => 18, 'Internship' => 11, 'Freelance' => 9],
            'Location' => ['Fairbanks' => 8, 'Bessemer' => 6, 'Barrington' => 4, 'Durant' => 3, 'Blaine' => 2],
            'Industry' => ['Information Technology' => 22, 'Advertising/PR' => 15, 'Media & Communications' => 13, 'Fashion' => 9, 'Health & Fitness' => 7],
            'Salary Range' => ['$2k - $4k' => 12, '$4k - $6k' => 9, '$6k - $10k' => 6, '$10k - $15k' => 4, '$15k+' => 3],
        ];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($job)
    {
        try {
            $job = Job::with(['category', 'jobType'])
                ->where('status', 1)
                ->where('deleted', false)
                ->find($job);

            $relatedJobs = Job::with(['category', 'jobType'])
                ->where('status', 1)
                ->where('deleted', false)
                ->when($job, fn ($query) => $query->where('id', '!=', $job->id))
                ->latest('id')
                ->take(3)
                ->get();
        } catch (Throwable $exception) {
            $job = null;
            $relatedJobs = collect();
        }

        if (! $job) {
            $job = $this->sampleJobs()->firstWhere('id', (int) request()->route('job')) ?? $this->sampleJobs()->first();
        }

        if ($relatedJobs->isEmpty()) {
            $relatedJobs = $this->sampleJobs()
                ->reject(fn ($item) => (int) $item->id === (int) $job->id)
                ->take(3)
                ->values();
        }

        return view('front.jobs.show', [
            'job' => $job,
            'relatedJobs' => $relatedJobs,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}

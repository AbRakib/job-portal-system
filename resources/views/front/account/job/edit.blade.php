@extends('front.layouts.app')
@section('content')
    <section class="section-5 bg-2">
        <div class="container py-5">
            <div class="row">
                <div class="col">
                    <nav aria-label="breadcrumb" class=" rounded-3 p-3 mb-4">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Account Settings</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    @include('front.account.sidebar') 
                </div>
                <div class="col-lg-9">
                    <form action="{{ route('account.update.job', $job->id) }}" method="post" id="createJobForm" name="createJobForm">
                        @csrf 
                        <div class="card border-0 shadow mb-4 ">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Job Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="title" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" 
                                            placeholder="Job Title" 
                                            id="title" 
                                            name="title" 
                                            class="form-control @error('title') is-invalid @enderror" 
                                            value="{{ old('title', $job->title) }}">
                                            @error('title')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="category" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" 
                                            id="category" 
                                            class="form-control @error('category') is-invalid @enderror">
                                            <option value="">Select a Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}"
                                                    @if($item->id == $job->category->id) selected @endif>
                                                    {{ $item->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select class="form-select @error('job_type') is-invalid @enderror" 
                                            name="job_type" 
                                            id="job_type">
                                            <option value="">Select Job Nature</option>
                                            @foreach ($jobTypes as $item)
                                                <option value="{{ $item->id }}"
                                                    @if($item->id == $job->jobType->id) selected @endif>
                                                    {{ $item->name }}
                                                </option> 
                                            @endforeach
                                        </select>
                                        @error('job_type')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="vacancy" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" 
                                            min="1" 
                                            placeholder="Vacancy" 
                                            id="vacancy" 
                                            name="vacancy" 
                                            class="form-control @error('vacancy') is-invalid @enderror" 
                                            value="{{ old('vacancy', $job->vacancy) }}">
                                        @error('vacancy')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="salary" class="mb-2">Salary</label>
                                        <input type="text" 
                                            placeholder="Salary" 
                                            id="salary" 
                                            name="salary" 
                                            class="form-control @error('salary') is-invalid @enderror" 
                                            value="{{ old('salary', $job->salary) }}">
                                        @error('salary')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
        
                                    <div class="mb-4 col-md-6">
                                        <label for="location" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" 
                                            placeholder="Location" 
                                            id="location" 
                                            name="location" 
                                            class="form-control @error('location') is-invalid @enderror" 
                                            value="{{ old('location', $job->location) }}">
                                        @error('location')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="mb-4">
                                    <label for="description" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                        name="description" 
                                        id="description" 
                                        cols="5" 
                                        rows="5" 
                                        placeholder="Description">{{ old('description', $job->description) }}</textarea>
                                    @error('description')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="benefits" class="mb-2">Benefits</label>
                                    <textarea class="form-control @error('website') is-invalid @enderror" 
                                        name="benefits" 
                                        id="benefits" 
                                        cols="5" 
                                        rows="5" 
                                        placeholder="Benefits">{{ old('benefits', $job->benefits) }}</textarea>
                                    @error('benefits')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="responsibility" class="mb-2">Responsibility</label>
                                    <textarea class="form-control @error('responsibility') is-invalid @enderror" 
                                        name="responsibility" 
                                        id="responsibility" 
                                        cols="5" 
                                        rows="5" 
                                        placeholder="Responsibility">{{ old('responsibility', $job->responsibility) }}</textarea>
                                    @error('responsibility')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="qualifications" class="mb-2">Qualifications</label>
                                    <textarea class="form-control @error('qualifications') is-invalid @enderror"
                                        name="qualifications" 
                                        id="qualifications" 
                                        cols="5" 
                                        rows="5" 
                                        placeholder="Qualifications">{{ old('qualifications', $job->qualifications) }}</textarea>
                                    @error('qualifications')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="mb-4">
                                    <label for="experience" class="mb-2">Experience</label>
                                    <select class="form-control @error('experience') is-invalid @enderror" 
                                        name="experience" 
                                        id="experience">
                                        <option value="">Select Experience</option>
                                        <option value="1" @if($job->experience == 1) selected @endif>1 Year</option>
                                        <option value="2" @if($job->experience == 2) selected @endif>2 Years</option>
                                        <option value="3" @if($job->experience == 3) selected @endif>3 Years</option>
                                        <option value="4" @if($job->experience == 4) selected @endif>4 Years</option>
                                        <option value="5" @if($job->experience == 5) selected @endif>5 Years</option>
                                        <option value="6" @if($job->experience == 6) selected @endif>6 Years</option>
                                        <option value="7" @if($job->experience == 7) selected @endif>7 Years</option>
                                        <option value="8" @if($job->experience == 8) selected @endif>8 Years</option>
                                        <option value="9" @if($job->experience == 9) selected @endif>9 Years</option>
                                        <option value="10" @if($job->experience == 10) selected @endif>10 Years</option>
                                        <option value="10_plus" @if($job->experience == '10_plus') selected @endif>10+ Years</option>
                                    </select>
                                    @error('experience')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>                                
        
                                <div class="mb-4">
                                    <label for="keywords" class="mb-2">Keywords<span class="req">*</span></label>
                                    <input type="text" 
                                        placeholder="keywords" 
                                        id="keywords" 
                                        name="keywords" 
                                        class="form-control @error('keywords') is-invalid @enderror" 
                                        value="{{ old('keywords', $job->keywords) }}">
                                    @error('keywords')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
        
                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>
        
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="company_name" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" 
                                            placeholder="Company Name" 
                                            id="company_name" 
                                            name="company_name" 
                                            class="form-control @error('company_name') is-invalid @enderror" 
                                            value="{{ old('company_name', $job->company_name) }}">
                                        @error('company_name')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
        
                                    <div class="mb-4 col-md-6">
                                        <label for="company_location" class="mb-2">Location</label>
                                        <input type="text" 
                                            placeholder="Company Location" 
                                            id="company_location" 
                                            name="company_location" 
                                            class="form-control @error('company_location') is-invalid @enderror" 
                                            value="{{ old('company_location', $job->company_location) }}">
                                        @error('company_location')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
        
                                <div class="mb-4">
                                    <label for="company_location" class="mb-2">Website</label>
                                    <input type="text" 
                                        placeholder="Company Website" 
                                        id="company_location" 
                                        name="company_location" 
                                        class="form-control @error('company_location') is-invalid @enderror" 
                                        value="{{ old('company_location', $job->company_location) }}">
                                    @error('company_location')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                            </div> 
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Update Job</button>
                            </div>
                        </div>
                    </form>           
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')

@endsection
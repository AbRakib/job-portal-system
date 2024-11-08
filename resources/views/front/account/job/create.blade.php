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
                    <form action="{{ route('account.save.job') }}" method="post" id="createJobForm" name="createJobForm">
                        @csrf 
                        <div class="card border-0 shadow mb-4 ">
                            <div class="card-body card-form p-4">
                                <h3 class="fs-4 mb-1">Job Details</h3>
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="title" class="mb-2">Title<span class="req">*</span></label>
                                        <input type="text" placeholder="Job Title" id="title" name="title" class="form-control" value="{{ old('title') }}">
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="category" class="mb-2">Category<span class="req">*</span></label>
                                        <select name="category" id="category" class="form-control">
                                            <option value="">Select a Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <p></p>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-4">
                                        <label for="" class="mb-2">Job Nature<span class="req">*</span></label>
                                        <select class="form-select" name="job_type" id="job_type">
                                            <option value="">Select Job Nature</option>
                                            @foreach ($jobTypes as $item)
                                               <option value="{{ $item->id }}">{{ $item->name }}</option> 
                                            @endforeach
                                        </select>
                                        <p></p>
                                    </div>
                                    <div class="col-md-6  mb-4">
                                        <label for="vacancy" class="mb-2">Vacancy<span class="req">*</span></label>
                                        <input type="number" min="1" placeholder="Vacancy" id="vacancy" name="vacancy" class="form-control" value="{{ old('vacancy') }}">
                                        <p></p>
                                    </div>
                                </div>
        
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="salary" class="mb-2">Salary</label>
                                        <input type="text" placeholder="Salary" id="salary" name="salary" class="form-control" value="{{ old('salary') }}">
                                        <p></p>
                                    </div>
        
                                    <div class="mb-4 col-md-6">
                                        <label for="location" class="mb-2">Location<span class="req">*</span></label>
                                        <input type="text" placeholder="Location" id="location" name="location" class="form-control" value="{{ old('location') }}">
                                        <p></p>
                                    </div>
                                </div>
        
                                <div class="mb-4">
                                    <label for="description" class="mb-2">Description<span class="req">*</span></label>
                                    <textarea class="form-control" name="description" id="description" cols="5" rows="5" placeholder="Description">{{ old('description') }}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="benefits" class="mb-2">Benefits</label>
                                    <textarea class="form-control" name="benefits" id="benefits" cols="5" rows="5" placeholder="Benefits">{{ old('benefits') }}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="responsibility" class="mb-2">Responsibility</label>
                                    <textarea class="form-control" name="responsibility" id="responsibility" cols="5" rows="5" placeholder="Responsibility">{{ old('responsibility') }}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="qualifications" class="mb-2">Qualifications</label>
                                    <textarea class="form-control" name="qualifications" id="qualifications" cols="5" rows="5" placeholder="Qualifications">{{ old('qualifications') }}</textarea>
                                    <p></p>
                                </div>
                                <div class="mb-4">
                                    <label for="experience" class="mb-2">Experience</label>
                                    <select class="form-control" name="experience" id="experience">
                                        <option value="">Select Experience</option>
                                        <option value="1">1 Year</option>
                                        <option value="2">2 Years</option>
                                        <option value="3">3 Years</option>
                                        <option value="4">4 Years</option>
                                        <option value="5">5 Years</option>
                                        <option value="6">6 Years</option>
                                        <option value="7">7 Years</option>
                                        <option value="8">8 Years</option>
                                        <option value="9">9 Years</option>
                                        <option value="10">10 Years</option>
                                        <option value="10_plus">10+ Years</option>
                                    </select>
                                    <p></p>
                                </div>                                
        
                                <div class="mb-4">
                                    <label for="keywords" class="mb-2">Keywords<span class="req">*</span></label>
                                    <input type="text" placeholder="keywords" id="keywords" name="keywords" class="form-control" value="{{ old('keywords') }}">
                                    <p></p>
                                </div>
        
                                <h3 class="fs-4 mb-1 mt-5 border-top pt-5">Company Details</h3>
        
                                <div class="row">
                                    <div class="mb-4 col-md-6">
                                        <label for="company_name" class="mb-2">Name<span class="req">*</span></label>
                                        <input type="text" placeholder="Company Name" id="company_name" name="company_name" class="form-control" value="{{ old('company_name') }}">
                                        <p></p>
                                    </div>
        
                                    <div class="mb-4 col-md-6">
                                        <label for="location" class="mb-2">Location</label>
                                        <input type="text" placeholder="Location" id="location" name="location" class="form-control" value="{{ old('location') }}">
                                        <p></p>
                                    </div>
                                </div>
        
                                <div class="mb-4">
                                    <label for="website" class="mb-2">Website</label>
                                    <input type="text" placeholder="Website" id="website" name="website" class="form-control" value="{{ old('website') }}">
                                    <p></p>
                                </div>
                            </div> 
                            <div class="card-footer  p-4">
                                <button type="submit" class="btn btn-primary">Save Job</button>
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
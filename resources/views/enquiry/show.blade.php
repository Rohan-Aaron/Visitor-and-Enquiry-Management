@extends("layouts.admin")

@section('title')
Enquiry
@endsection

@section('content')
<div class="card form-body">
<div class="card-body">
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="form-label text-end col-md-3">First Name:</label>
                <div class="col-md-9">
                    <p>{{ $enquiry->name }}</p> <!-- Display the name -->
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group row">
                <label class="form-label text-end col-md-3">Email:</label>
                <div class="col-md-9">
                    <p>{{ $enquiry->email }}</p> <!-- Display the email -->
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="form-label text-end col-md-3">Gender:</label>
                <div class="col-md-9">
                    <p>{{ $enquiry->gender }}</p> <!-- Display the gender -->
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group row">
                <label class="form-label text-end col-md-3">Country:</label>
                <div class="col-md-9">
                    <p>{{ $enquiry->country }}</p> <!-- Display the country -->
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="form-label text-end col-md-3">State:</label>
                <div class="col-md-9">
                    <p>{{ $enquiry->state }}</p> <!-- Display the state -->
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group row">
                <label class="form-label text-end col-md-3">Is NRI:</label>
                <div class="col-md-9">
                    <p>{{ $enquiry->is_nri ? 'Yes' : 'No' }}</p> <!-- Display if NRI -->
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
    <div class="row">
        <div class="col-md-6">
            <div class="form-group row">
                <label class="form-label text-end col-md-3">Program:</label>
                <div class="col-md-9">
                    <p>{{ $enquiry->program->title }}</p> <!-- Display the program -->
                </div>
            </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
            <div class="form-group row">
                <label class="form-label text-end col-md-3">Course:</label>
                <div class="col-md-9">
                    <p>{{ $enquiry->course->title }}</p> <!-- Display the course -->
                </div>
            </div>
        </div>
        <!--/span-->
    </div>
    <!--/row-->
</div>
</div>

@endsection
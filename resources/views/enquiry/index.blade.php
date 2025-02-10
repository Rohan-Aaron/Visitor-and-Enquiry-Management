@extends('layouts.admin')

@section('title')
    Enquiry Report
@endsection

@section('content')
<div class="card">
    <div class="card-body">
    
    <!-- Search Input -->
    <div class="d-flex flex-wrap flex-grow-1 justify-content-between my-2">
        <form method="GET" action="{{ route('enquiry.index') }}" class="d-flex  w-50 mb-2">
            <input type="text" name="search" value="{{ request('search') }}" id="searchInput" class="form-control" placeholder="Search for records...">
            
            <button type="submit" class="btn btn-primary ms-2">Search</button>
        </form>
    </div>
    
    @if($enquiries->isEmpty())
        <h6 class="text-center mt-5">No enquiries at the moment</h6>
    @else
    <!-- Table -->
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="header-item">
              <tr>
                <th>SL NO</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone No</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <!-- Loop through visitors and populate rows -->
                @foreach ($enquiries as $index => $enquiry)
                    <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $enquiry->name }}</td>
                    <td>{{ $enquiry->email }}</td>
                    <td>{{ $enquiry->phone }}</td>
                    <td>
                        <a href="{{ route('enquiry.show', $enquiry->id) }}" class="btn btn-primary m-1">
                        <i class="ti ti-eye fs-5"></i> View
                        </a>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Pagination -->
    <div class="d-flex flex-column justify-content-center mt-3">
        {{ $enquiries->links('pagination::bootstrap-5') }}
    </div>
    
    @endif
</div>
</div>

@endsection

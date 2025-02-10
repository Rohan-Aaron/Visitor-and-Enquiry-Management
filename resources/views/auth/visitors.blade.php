@extends("layouts.admin")

@section('title')
    Visitors
@endsection

@section('content')

    <div class="card">
        <div class="card-body">
        
        <!-- Search Input -->
        <div class="d-flex flex-wrap flex-grow-1 justify-content-between my-2">
            <form method="GET" action="{{ route('visitors.index') }}" class="d-flex  w-50 mb-2">
                <input type="text" name="search" value="{{ request('search') }}" id="searchInput" class="form-control" placeholder="Search for records...">
                
                <button type="submit" class="btn btn-primary ms-2">Search</button>
            </form>
            <!-- Button to open Add New Visitor Modal -->
            <button type="button" class="btn btn-success mb-2" data-bs-toggle="modal" data-bs-target="#addVisitorModal">+ Add New</button>
        </div>
        
        @if($visitors->isEmpty())
            <h6 class="text-center mt-5">No visitors at the moment</h6>
        @else
        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="header-item">
                  <tr>
                    <th>Visitor ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone No</th>
                    <th>Visit Count</th>
                    <th>Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop through visitors and populate rows -->
                  @foreach ($visitors as $visitor)
                    <tr>
                      <td>{{ $visitor->visitor_id }}</td>
                      <td>{{ $visitor->name }}</td>
                      <td>{{ $visitor->email }}</td>
                      <td>{{ $visitor->phone }}</td>
                      <td>{{ $visitor->visit_count }}</td>
                      <td>
                        <a href="{{ route('visitors.show', $visitor->visitor_id) }}" class="btn btn-primary m-1">
                          <i class="ti ti-eye fs-5"></i> View
                        </a>
                      </td>
                    </tr>
                  @endforeach
                </tbody>
            </table>
        </div>
        @endif
        <!-- Pagination -->
        <div class="d-flex flex-column justify-content-center mt-3">
            {{ $visitors->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>

<!-- Add Visitor Modal -->
<div class="modal fade" id="addVisitorModal" tabindex="-1" aria-labelledby="addVisitorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addVisitorModalLabel">Add New Visitor</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('visitors.store') }}" method="POST">
              @csrf
              <div class="modal-body">
                  <div class="row">
                      <!-- Name -->
                      <div class="col-md-6">
                          <div class="form-floating mb-3">
                              <input type="text" class="form-control @error('Name') is-invalid @enderror" name="Name" id="name" placeholder="Enter Name here" required>
                              <label for="name">Name</label>
                              @error('Name')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                      
                      <!-- Email -->
                      <div class="col-md-6">
                          <div class="form-floating mb-3">
                              <input type="email" class="form-control @error('Email') is-invalid @enderror" name="Email" id="email" placeholder="name@example.com" required>
                              <label for="email">Email Address</label>
                              @error('Email')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
          
                      <!-- Phone -->
                      <div class="col-md-6">
                          <div class="form-floating mb-3">
                              <input type="text" class="form-control @error('Phone') is-invalid @enderror" name="Phone" id="phone" placeholder="Phone Number" required>
                              <label for="phone">Phone Number</label>
                              @error('Phone')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
          
                      <!-- Visit Count -->
                      <div class="col-md-6">
                          <div class="form-floating mb-3">
                              <input type="number" class="form-control @error('visit_count') is-invalid @enderror" name="visit_count" id="visit_count" value="1" required>
                              <label for="visit_count">Visit Count</label>
                              @error('visit_count')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
          
                      <!-- Category -->
                      <div class="col-md-6">
                          <div class="form-floating mb-3">
                              <input type="text" class="form-control @error('category') is-invalid @enderror" name="category" id="category" placeholder="Enter Category" required>
                              <label for="category">Category</label>
                              @error('category')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
          
                      <!-- Reason -->
                      <div class="col-md-6">
                          <div class="form-floating mb-3">
                              <input type="text" class="form-control @error('reason') is-invalid @enderror" name="reason" id="reason" placeholder="Enter Reason" required>
                              <label for="reason">Reason</label>
                              @error('reason')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
          
                      <!-- Description -->
                      <div class="col-md-12">
                          <div class="form-floating mb-3">
                              <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" id="description" placeholder="Enter Description" required>
                              <label for="description">Description</label>
                              @error('description')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
          
                      <!-- Visit Date -->
                      <div class="col-md-6">
                          <div class="form-floating mb-3">
                              <input type="date" class="form-control @error('visit_date') is-invalid @enderror" name="visit_date" id="visit_date" required>
                              <label for="visit_date">Visit Date</label>
                              @error('visit_date')
                                  <div class="invalid-feedback">{{ $message }}</div>
                              @enderror
                          </div>
                      </div>
                  </div>
              </div>
          
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Add Visitor</button>
              </div>
          </form>
          
        </div>
    </div>
  </div>
  

@endsection

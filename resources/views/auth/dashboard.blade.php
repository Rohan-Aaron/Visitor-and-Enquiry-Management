@extends("layouts.admin")

@section('title')
 Dashboard
@endsection

@section('content')
<div class="row">
  <!-- Card 1: Today -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-start border-primary">
      <div class="card-body">
        <div class="d-flex  align-items-center">
          <div>
            <span class="text-primary display-6">
              <i class="ti ti-users"></i>
            </span>
          </div>
          <div class="ms-auto">
            <h2 class="fs-7">{{ $todayCount }}</h2>
            <p class="fw-medium text-primary mb-0">Today</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Card 2: Last 7 Days -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-start border-success">
      <div class="card-body">
        <div class="d-flex  align-items-center">
          <div>
            <span class="text-success display-6">
              <i class="ti ti-users"></i>
            </span>
          </div>
          <div class="ms-auto">
            <h2 class="fs-7">{{ $last7Days }}</h2>
            <p class="fw-medium text-success mb-0">Last 7 Days</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Card 3: Last Month -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-start border-info">
      <div class="card-body">
        <div class="d-flex  align-items-center">
          <div>
            <span class="text-info display-6">
              <i class="ti ti-users"></i>
            </span>
          </div>
          <div class="ms-auto">
            <h2 class="fs-7">{{ $lastMonth }}</h2>
            <p class="fw-medium text-info mb-0">Last Month</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Card 4: Total -->
  <div class="col-lg-3 col-md-6">
    <div class="card border-start border-danger">
      <div class="card-body">
        <div class="d-flex  align-items-center">
          <div>
            <span class="text-danger display-6">
              <i class="ti ti-users"></i>
            </span>
          </div>
          <div class="ms-auto">
            <h2 class="fs-7">{{ $totalVisitors }}</h2>
            <p class="fw-medium text-danger mb-0">Total visitors</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

        
      </div>
@endsection
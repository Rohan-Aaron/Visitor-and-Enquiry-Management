@extends("layouts.admin")

@section('title')
 Visitors
@endsection

@section('content')
<div class="card form-body">
    <div class=" card-body">
      <h5 class="card-title mb-0">Person Info</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group row">
            <label class="form-label text-end col-md-3">Name:</label>
            <div class="col-md-9">
              <p>{{$visitor[0]->name}} </p>
            </div>
          </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
          <div class="form-group row">
            <label class="form-label text-end col-md-3">Phone no:</label>
            <div class="col-md-9">
              <p>{{$visitor[0]->phone}}</p>
            </div>
          </div>
        </div>
        <!--/span-->
      </div>
      <!--/row-->
      <div class="row">
        <div class="col-md-6">
          <div class="form-group row">
            <label class="form-label text-end col-md-3">Email:</label>
            <div class="col-md-9">
              <p>{{$visitor[0]->email}}</p>
            </div>
          </div>
        </div>
        <!--/span-->
        <div class="col-md-6">
          <div class="form-group row">
            <label class="form-label text-end col-md-3">First visited:</label>
            <div class="col-md-9">
              <p>{{$visitor[0]->created_at}}</p>
            </div>
          </div>
        </div>
        <!--/span-->
      </div>
    </div>
  </div>
    <div class="card">
        <div class="card-body">
            <!-- Table -->
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Visit No</th>
                            <th>Reason</th>
                            <th>Description</th>
                            <th>Visit Date</th>
                            <th>Visit Time</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                      @foreach ($queries as $index => $query)
                          <tr>
                              <td>{{ $index + 1 }}</td> <!-- Serial number -->
                              <td>{{ isset($query->category) && $query->category == 'other' ? 'Other - ' . $query->othercategory : $query->category }}</td>
                              <td>{{ $query->description }}</td>
                              <td>{{ \Carbon\Carbon::parse($query->arrived_at)->format('Y-m-d') }}</td> <!-- Date -->
                              <td>{{ \Carbon\Carbon::parse($query->arrived_at)->format('H:i:s') }}</td> <!-- Time -->
                          </tr>
                      @endforeach
                  </tbody>                
                </table>
            </div>
            <div class="d-flex flex-column justify-content-center mt-3">
                {{ $queries->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
@extends("layouts.app")

@section('title')
    Visitor Pass
@endsection

@section('css')
<style>
/* General body setup */
body {
  font-family: Poppins, sans-serif;
  padding: 20px;
  background: #f1f1f1;
  margin: 0;
}

.wrapper {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 100vh;
}

.container {
  background-color: #000000;
  width: 90%;
  max-width: 600px;
  margin: 0 auto;
}

.inner_container {
  background-color: #ffffff;
  padding: 40px 50px;
}

/* Header and footer */
header, footer {
  text-align: center;
}

.email_content {
  padding: 20px 0;
}

hr {
  height: 5px;
  background-color: #0A2581;
  border-color: #0A2581;
}

/* Title styles */
h1 {
  color: #0A2581;
}

h4 {
  font-size: 18px;
  text-align: center;
}

p {
  font-size: 16px;
  text-align: center;
}

.enquiry_submission table {
  width: 100%;
  margin-top: 20px;
  text-align: left;
}

.enquiry_submission th,
.enquiry_submission td {
  padding: 8px;
}

.enquiry_submission th {
  color: #0A2581;
  font-weight: bold;
}

.enquiry_submission td {
  font-weight: normal;
}

/* Pass ID section */
.pass-id {
  display: flex;
  justify-content: center;
  margin-top: 30px;
}

.card {
  width: 100%;
  max-width: 400px;
}

.card-header {
  background-color: #0A2581;
  border: 1px solid #ddd;
  text-align: center;
  border-radius: 24px 24px 0px 0px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-header h2 {
  font-size: 40px;
  font-weight: bolder;
  color: #ffffff;
}

.card-footer {
  background-color: #0A2581;
  padding: 15px;
  text-align: center;
  border-radius: 0px 0px 24px 24px;
  border: 1px solid #ddd;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-footer p {
  color: #ffffff;
  font-size: small;
}

.card-body {
  padding: 20px;
  text-align: center;
  justify-content: center;
  align-items: center;
  border: 1px solid #ddd;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.card-body h3 {
  font-size: 2rem;
  margin-top: 20px;
  color: #007bff;
}

.card-body strong {
  color: #007bff;
}

/* Footer styles */
.email_footer {
  font-size: 12px;
  color: #ffffff;
  padding: 20px 0;
}

.email_footer a {
  color: #ffffff;
  text-decoration: none;
}

/* Mobile responsive styles */
@media only screen and (max-width: 768px) {
  .container {
    padding: 20px;
    width: 100%;
    max-width: none;
  }

  .inner_container {
    padding: 20px;
  }

  .card-header h2 {
    font-size: 30px;
  }

  .card-body h3 {
    font-size: 2rem;
  }

  .enquiry_submission table {
    font-size: 14px;
  }

  .card {
    max-width: 90%;
  }
}

/* Mobile styles for very small screens */
@media only screen and (max-width: 500px) {
  .enquiry_submission th, .enquiry_submission td {
    display: block;
    width: 100% !important;
  }

  .pass-id {
    margin-top: 20px;
    flex-direction: column;
  }

  .card {
    max-width: 90%;
  }

  .card-body h3 {
    font-size: 2.5rem;
  }
}
</style>
@endsection

@section('content')
<div class="wrapper">
    <div class="container">
      <div class="inner_container">
        @if(session()->has('visitor') && session()->has('visit'))
        @php
            $visitor = session('visitor');
            $visit = session('visit');
            $categoryName = session('categoryName');
        @endphp

        <header>
          <img src="{{asset('images/college logo.png')}}" width="250px" />
          <h1>Visitor Pass</h1>
        </header>
        <hr>
        <div class="email_content">
          <div class="email_inner_section">
            <section>
              <h4>Welcome to St. Aloysius (Deemed to be <span style="font-weight: bold;">University</span>)</h4>
              <p>We are glad to have you visit our campus.</p>
            </section>
            <section class="enquiry_submission">
              <div class="pass-id">
                <div class="card">
                  <div class="card-header">
                    <h2>Visitor <br> Pass </h2>
                  </div>
                  <div class="card-body ">
                    <table style="margin: 0px auto;">
                      <tbody>
                        <tr>
                          <th>Name</th>
                          <td>{{$visitor->name}} </td>
                        </tr>
                        <tr>
                          <th>Reason</th>
                          <td>{{ $categoryName == 'other' ? $visit->other_category : $categoryName }}</td>                        </tr>
                        <tr>
                          <th>Description</th>
                          <td>{{ $visit->description }}</td>
                        </tr>
                        <tr>
                          <th>Date</th>
                          <td>{{ \Carbon\Carbon::parse($visit->arrived_at)->format('d/ m/ Y') }}</td>
                        </tr>
                        <tr>
                          <th>Time</th>
                          <td>{{ \Carbon\Carbon::parse($visit->arrived_at)->format('H:i:s') }}</td>
                        </tr>
                      </tbody>
                    </table>
                    <h3>SAU{{ \Carbon\Carbon::parse($visit->arrived_at)->format('y - m') }} : {{$visitor->id}}</h3>
                  </div>
                  <footer class="card-footer">
                    <img src="{{asset('images/logo-with-name.png')}}" style="width: 200px ;">
                    <p>St Aloysius College Rd, Kodailbail, Mangaluru, Karnataka 575003</p>
                  </footer>
                </div>
              </div>
              
            </section>
          </div>
        </div>
        @endif
      </div>

      
    </div>
  </div>
@endsection
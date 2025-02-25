@extends('layouts.app')

@section('title')
    Visitor Pass
@endsection

@section('css')
    <style>
        .header {
            position: sticky;
            top: 0;
            z-index: 1050;
            /* Makes sure the header stays on top of other elements */
            background-color: white;
            /* Optional: change the background color */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            /* Optional shadow for better visibility */
        }
    </style>
@endsection

@section('content')
    <header class="header sticky-top">
        <nav class="navbar navbar-expand-lg py-0">
            <div class="container d-flex justify-content-center">
                <a class="navbar-brand me-0 py-0">
                    <img src="{{ asset('images/St Aloysius Deemed to Be University .png') }}"
                        alt="St. Aloysius Deemed to Be University Logo" class="img-fluid"
                        style="max-width: 300px; height: auto;"> <!-- Adjust max-width as needed -->
                </a>
            </div>
        </nav>
    </header>


    <div class="body-wrapper-inner ">
        <div class="container d-flex justify-content-center mt-5">
            <div class="card shadow-sm border-0" style="border-radius: 12px; width: 500px;">
                <div class="card-body">
                    <h5 class="card-title fw-semibold mb-4 text-center">Visitor Form</h5>
                    <form method="POST" action="{{ route('form.submit') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email address</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                name="email">
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="phoneNumber"
                                oninput="this.value = this.value.replace(/\D/g, '')" name="phoneNumber" required>
                        </div>
                        <div class="mb-3">
                          <label for="gender" class="form-label">Gender</label>
                          <select class="form-control" id="gender" name="gender" required>
                              <option value="">Select Gender</option>
                              <option value="male">Male</option>
                              <option value="female">Female</option>
                              <option value="other">Other</option>
                          </select>
                      </div>

                        <div class="mb-3">
                            <label for="reasonForVisit" class="form-label">Reason for Visit</label>
                            <select class="form-select" name="reasonForVisit" id="reasonForVisit"
                                onchange="showOtherField()">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->Category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3" id="otherField" style="display: none;">

                            <input type="text" class="form-control" name="other" id="other"
                                placeholder="Please provide more details"></textarea>
                        </div>
                        <div class="mb-3" id="descriptionField">
                            <label for="description" class="form-label">Description</label>
                            <input type="text" name="description" class="form-control" id="description">
                        </div>


                        <button type="submit" class="btn btn-primary " style="border-radius: 24px;">Submit</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('js')
    <script>
        function showOtherField() {
            var reasonSelect = document.getElementById("reasonForVisit");
            var otherField = document.getElementById("otherField");

            if (reasonSelect.value === "other") {
                otherField.style.display = "block"; // Show description field
            } else {
                otherField.style.display = "none"; // Hide description field
            }
        }
    </script>
@endsection

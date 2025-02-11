@include('sweetalert::alert')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Enquiry Form</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('css/styles.min.css') }}" />
    <!-- Include intl-tel-input CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/css/intlTelInput.css" />
    <style>
        .iti--allow-dropdown input,
        .iti--allow-dropdown input[type=text],
        .iti--allow-dropdown input[type=tel],
        .iti--separate-dial-code input,
        .iti--separate-dial-code input[type=text],
        .iti--separate-dial-code input[type=tel] {
            opacity: 50%;
            padding-right: 6px;
            padding-left: 52px;
            margin-left: 0;
        }

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
</head>

<body class="bg-body-secondary">
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
    <div class="body-wrapper">
        <div class="container-fluid mw-70 ">
            <div class="card">
                <div class="card-header align-items-center text-bg-primary">

                    <h4 class="mb-0 text-white text-center">Admission Enquiry Form</h4>
                </div>
                <form action="{{ route('enquiry.submit') }}" id="userForm" method="post">
                    @csrf
                    <div>
                        <div class="card-body">
                            <div class="row pt-3">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Name</label>
                                        <input type="text" id="name" name="name" class="form-control"
                                            placeholder="John Doe">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Email</label>
                                        <input type="email" id="email" name="email" class="form-control"
                                            placeholder="example@gmail.com">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Gender</label>
                                        <select name="gender" class="form-select">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="mb-3 d-flex flex-column">
                                        <label class="form-label">Phone No</label>
                                        <input type="tel" id="phone" name="phone" class="form-control"
                                            oninput="this.value = this.value.replace(/\D/g, '')"
                                            placeholder="Mobile Number">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Country</label>
                                        <select name="country" class="form-select" id="country">
                                            <option selected disabled>--Select your Country--</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6" id="state-container">
                                    <div class="mb-3">
                                        <label class="form-label">State</label>
                                        <select name="state" id="state" class="form-select">
                                            <option selected disabled>--Select your State--</option>
                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3 d-flex gap-4">
                                        <label class="form-label">Is NRI?</label>
                                        <div class="form-check py-1">
                                            <input type="radio" name="isnri" value="1" id="nriYes"
                                                name="nri" class="form-check-input">
                                            <label class="form-check-label" for="nriYes">Yes</label>
                                        </div>
                                        <div class="form-check py-1">
                                            <input type="radio" name="isnri" value="0" id="nriNo"
                                                name="nri" class="form-check-input">
                                            <label class="form-check-label" for="nriNo">No</label>
                                        </div>
                                    </div>
                                </div>
                                <!--/span-->

                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Program</label>
                                        <select onchange="fetchCourses(event)" name="program" class="form-select">
                                            <option selected disabled>--Select Program--</option>
                                            @foreach ($programs as $program)
                                                <option value="{{ $program->id }}">{{ $program->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Course</label>
                                        <select name="course" id="course-selection" class="form-select">
                                            <option selected disabled>--Select Course--</option>

                                        </select>
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="form-check">
                                <input type="checkbox" name="agreement" class="form-check-input" id="agree"
                                    value="1">
                                <label class="form-check-label" for="sf6">I agree to receive information
                                    regarding about my Enquiry of admission by submitting it on St. Aloysius (Deemed to
                                    be University) via Email/ SMS/ Whatsapp</label>
                            </div>
                            <button type="submit" class="btn btn-primary d-flex align-items-center gap-2 mt-4">
                                <i class="ti ti-send fs-4"></i>
                                Submit
                            </button>
                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
    <!-- Success/Error Modal -->

    <!-- Bootstrap Modal -->
    <div class="modal fade" id="responseModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTitle">Alert</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalMessage">
                    <!-- Message will be inserted dynamically -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <!-- solar icons -->
    <script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
    <!-- Include intl-tel-input JS -->
    <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/intlTelInput.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/countries-states-cities-database/1.2.0/js/countries.js"></script>



    @if (session('error'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                showModal("{{ session('error') }}", "error");
            });
        </script>
    @endif

    <script>
        // Initialize Phone Input
        const phoneInput = document.querySelector("#phone");
        const iti = window.intlTelInput(phoneInput, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@17.0.8/build/js/utils.js",
            separateDialCode: true,
            initialCountry: "in"
        });

        document.addEventListener("DOMContentLoaded", function() {
            const countrySelect = document.getElementById("country");
            const stateSelect = document.getElementById("state");

            // Function to fetch data
            async function fetchData(url, options = {}) {
                try {
                    const response = await fetch(url, options);
                    const data = await response.json();
                    return data;
                } catch (error) {
                    console.error("Error fetching data:", error);
                }
            }

            // Fetch Countries
            async function loadCountries() {


                fetch(`/fetch-countries`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            console.error('Error fetching countries:', data.error);
                            return;
                        }

                        const select = document.getElementById('country');
                        select.innerHTML = '<option selected disabled>--Select Country--</option>';

                        data.countries.forEach(country => {
                            const option = document.createElement('option');
                            option.value = country;
                            option.text = country;
                            select.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Failed to fetch countries:', error));

            }

            // Fetch States When State is India
            async function loadStates() {
                fetch(`/fetch-states`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            console.error('Error fetching states:', data.error);
                            return;
                        }

                        const select = document.getElementById('state');
                        select.innerHTML = '<option selected disabled>--Select State--</option>';

                        data.states.forEach(state => {
                            const option = document.createElement('option');
                            option.value = state;
                            option.text = state;
                            select.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Failed to fetch states:', error));
            }

            // Event Listeners
            countrySelect.addEventListener("change", loadStates);

            // Load countries on page load
            loadCountries();
        });



        document.getElementById("userForm").addEventListener("submit", function(event) {
            let agreementChecked = document.getElementById("agree").checked;

            if (!agreementChecked) {
                event.preventDefault(); // Prevent form submission

                // Show Bootstrap modal with an error message
                showModal("You must agree to the terms before submitting.", "error");
            }
        });

        // Function to show a Bootstrap modal with a custom message
        function showModal(message, type) {
            let modalMessage = document.getElementById("modalMessage");
            modalMessage.innerHTML = message;
            modalMessage.style.color = type === "success" ? "green" : "red";

            let responseModal = new bootstrap.Modal(document.getElementById("responseModal"));
            responseModal.show();
        }

        function fetchCourses(e) {
            let programId = e.target.value;
            fetch(`/fetch-courses?program_id=${programId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        console.error('Error fetching courses:', data.error);
                        return;
                    }

                    const select = document.getElementById('course-selection');
                    select.innerHTML = '<option selected disabled>--Select Course--</option>';

                    data.courses.forEach(course => {
                        const option = document.createElement('option');
                        option.value = course.id;
                        option.text = course.title;
                        select.appendChild(option);
                    });
                })
                .catch(error => console.error('Failed to fetch courses:', error));
        }
    </script>
</body>

</html>

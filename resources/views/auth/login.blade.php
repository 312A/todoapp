@extends('layouts.default')
@section('style')
    <style>
        html, body {
            height: 100%;
        }
        .form-signin {
            max-width: 330px;
            padding: 1rem;
        }
        .form-signin .form-floating:focus-within {
            z-index: 2;
        }
        .form-signin input[type="email"] {
            margin-bottom: -1px;
            border-bottom-right-radius: 0;
            border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }
        #errors-list .alert {
            margin-bottom: 5px;
            font-size: 0.9rem;
        }
    </style>
@endsection

@section('content')
    <main class="form-signin w-100 m-auto">
        <form id="ajaxLoginForm" method="POST" action="{{ route('login.post') }}">
            @csrf
            <img class="mb-4" src="{{ asset('assets/img/l1.png') }}" alt="logo" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            {{-- Error messages --}}
            <div id="errors-list"></div>

            {{-- Email --}}
            <div class="form-floating">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>

            {{-- Password --}}
            <div class="form-floating mb-3">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>

            {{-- Submit Button --}}
            <button class="btn btn-primary w-100 py-2" type="submit">Sign In</button>
            <a href="{{ route('register') }}" class="text-center d-block mt-3">Create New Account</a>
            <p class="mt-5 mb-3 text-body-secondary">&copy; 2024</p>
        </form>
    </main>
@endsection

@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        $("#ajaxLoginForm").on("submit", function (e) {
            e.preventDefault(); // Stop the form from submitting normally

            console.log("Submitting form..."); // Debugging line

            var form = $(this);
            var submitButton = form.find("[type='submit']");
            submitButton.html("Logging in...").attr("disabled", true);

            $.ajax({
                url: form.attr("action"), // Get the form action URL
                type: "POST",
                data: form.serialize(), // Serialize the form data
                dataType: "json",
                success: function (response) {
                    submitButton.html("Sign In").attr("disabled", false);

                    // Clear old error messages
                    $("#errors-list").empty();

                    if (response.status) {
                        // If login is successful
                        $("#errors-list").html(
                            `<div class="alert alert-success">Login successful! Redirecting...</div>`
                        );
                        // setTimeout(() => {
                        //     window.location.href = response.redirect || "/";
                        // }, 1500);
                    } else {
                        // If validation or login fails
                        if (response.errors) {
                            response.errors.forEach(function (error) {
                                $("#errors-list").append(
                                    `<div class="alert alert-danger">${error}</div>`
                                );
                            });
                        } else {
                            $("#errors-list").append(
                                `<div class="alert alert-danger">Invalid email or password.</div>`
                            );
                        }
                    }
                },
                error: function (xhr) {
                    // Handle unexpected errors
                    console.error("AJAX Error:", xhr.responseText);
                    submitButton.html("Sign In").attr("disabled", false);
                    $("#errors-list").html(
                        `<div class="alert alert-danger">An error occurred (${xhr.status}): ${xhr.statusText}</div>`
                    );
                },
            });
        });
    });
</script>
@endsection

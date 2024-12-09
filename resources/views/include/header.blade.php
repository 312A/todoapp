<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="{{ asset('assets/js/scripts.js') }}"></script>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Fixed navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                        </li>
                    </ul>
                    <a href="javascript:void(0)" id="create-todo" class="btn btn-outline-success">Add Task</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="modal fade" id="todo-modal" tabindex="-1" aria-labelledby="todoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="todoModalLabel">Add New Task</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="task-form" class="from-prevent-multiple-submits" method="POST"
                        action="{{ route('task.add.post') }}">
                        @csrf
                        <div class="mb-3 mt-1">
                            <input type="text" name="title" class="form-control">
                        </div>
                        <div class="mb-3">
                            <input type="datetime-local" name="deadline">
                        </div>
                        <div class="mb-3">
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>
                        @if (session()->has('success'))
                            <div class="alert alert-success">
                                {{ session()->get('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <button class="btn btn-success rounded-pill" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            }
        });

        $(document).ready(function () {
            // Show the modal when the "Add Task" button is clicked
            $('#create-todo').click(function (e) {
                e.preventDefault();
                $('#todo-modal').modal("toggle");
            });

            // Intercept the form submission
            $('#task-form').on('submit', function (e) {
                e.preventDefault(); // Prevent the form's default submission

                // Disable submit button to prevent multiple submissions
                const submitButton = $(this).find('button[type="submit"]');
                submitButton.prop('disabled', true);

                // Send form data via AJAX
                $.ajax({
                    url: $(this).attr('action'), // Use the form's action attribute
                    method: $(this).attr('method'), // Use the form's method attribute
                    data: $(this).serialize(), // Serialize the form data
                    success: function (response) {
                        // Handle success response
                        console.log('Success:', response);
                        alert('Task added successfully!');
                        $.get('{{ route("task.list") }}', function(data) {
                            $('#task-list').html(data);
                        });
                        $('#todo-modal').modal('hide'); // Close the modal
                        $('#task-form')[0].reset(); // Reset the form

                        // Optionally update the page to show the new task
                        // e.g., location.reload(); // If you want to refresh the page
                    },
                    error: function (xhr, status, error) {
                        // Handle error response
                        console.error('Error:', xhr.responseText);
                        alert('An error occurred while adding the task.');
                    },
                    complete: function () {
                        // Re-enable the submit button
                        submitButton.prop('disabled', false);
                    }
                });
            });
        });
    </script>
</body>

@extends('layouts.default')
@section('content')
    {{-- <div class="d-flex align-items-center " id="todo-modal">
        <div class="container card shadow-sm " style="margin-top:100px; max-width:500px">
            <div class="fs-3 fw-bold text-center">Add New Task</div>
            <form id ="task-form" class="p-3 from-prevent-multiple-submits" method="POST" action="{{ route('task.add.post') }}">
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
    </div> --}}
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@endsection

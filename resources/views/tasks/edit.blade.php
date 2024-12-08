@extends('layouts.default')

@section('content')
   <main class="flex-shrink-0 mt-5">
    <div class="container" style="max-width:600px">
        @if (session()->has('success'))
            <div class="alert alert success">
                {{ session()->get('success')}}
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger">
                {{session('error')}}
            </div>
        @endif
        <form action="{{route('task.update',$task->id)}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" id="title" name="title" class="form-control"
                    value="{{old('title',$task->title)}}" required
                >
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" id="description"  rows="4" required>{{old('description',$task->description)}}</textarea>
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">deadline</label>
                <textarea name="deadline" id="deadline" class="form-control"  rows="3" required>{{old('description',$task->deadline)}}</textarea>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select id="status" name="status" class="form-select" required>
                    <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Completed</option>
                    <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Not Completed</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
   </main>
@endsection

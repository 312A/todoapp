@extends('layouts.default')

@section('content')
    <main class="flex-shrink-0 mt-5">
        <div class="container" style="max-width: 600px">
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

            <div class="my-3 p-3 bg-body rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0">List of Tasks</h6>
                <div>{{auth()->user()->name}}</div>

                @foreach ($tasks as $task)
                    <div class="d-flex text-body-secondary pt-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-arrow-narrow-right">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M5 12l14 0" />
                            <path d="M15 16l4 -4" />
                            <path d="M15 8l4 4" />
                        </svg>
                        <div class="pb-3 mb-0 small lh-sm border-bottom w-100">
                            <div class="d-flex justify-content-between">
                                <strong class="text-gray-dark {{$task->status ==1 ? 'text-decoration-line-through' :''}}">{{ $task->title}} || {{ $task->deadline}}</strong>
                                <a href="{{ route('task.status.update', $task->id) }}" class="btn btn-success">
                                    <td>
                                        @if ($task->status ==1)
                                            <span class=" btn btn-success text-white">Active</span>
                                        @else
                                            <span class="  btn-danger text-white">Pending</span>
                                        @endif
                                    </td>
                                    {{-- <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M5 12l5 5l10 -10" />
                                    </svg> --}}
                                </a>
                                <a href="{{ route('task.edit', $task->id) }}" class="btn btn-warning">
                                    <span class=" btn-primary">Edit</span>
                                </a>
                                <a href="{{ route('task.delete', $task->id) }}" class="btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M4 7l16 0" />
                                        <path d="M10 11l0 6" />
                                        <path d="M14 11l0 6" />
                                        <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                        <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                </a>
                            </div>
                            <span class="d-block">{{ $task->description }}</span>
                        </div>
                    </div>
                @endforeach

                <div class="mt-3">
                    {{$tasks->links()}}
                </div>
            </div>
        </div>
    </main>
@endsection

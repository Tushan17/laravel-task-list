@extends('layouts.app')

@section('title', 'list of task')


@section('content')




    <div>
        <a class="btn btn-primary" href="{{ route('tasks.create') }}">Add Task</a>
        <a href="{{ route('graph.test1') }}" class="btn btn-primary">graph</a>
    </div>

    <br>


    <div class="row row-cols-3 g-3">
        @forelse ($tasks as $task)
            <div class="col">
                <div class="card h-100">
                    <div class="card-header">
                        <h5 class="card-title">{{ $task->title }}</h5>
                    </div>
                    <div class="card-body">
                        <img src="https://picsum.photos/1920/1080" class="card-img" alt="...">
                        <br>
                        <p class="card-text">{{ $task->description }}</p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('tasks.show', ['task' => $task->id]) }}" class="btn btn-primary">view</a>
                        {{-- <a href="#" class="btn btn-primary position-relative start-50 translate-middle-x">HI</a> --}}
                        {{-- <a href="#" class="btn btn-primary position-relative start-0 translate-middle-x">HI</a> --}}
                        <a href="#" class="btn btn-primary position-absolute start-50 translate-middle-x">HI</a>
                        <a href="#" class="btn btn-primary position-absolute end-0 translate-middle-x">HI</a>


                    </div>

                </div>
            </div>



            <br>

        @empty
            <div>there are no tasks</div>
        @endforelse


    </div>



    <div>
        @if ($tasks->count())
            <nav>
                {{-- class="pagination" --}}
                {{ $tasks->links() }}

            </nav>
        @endif

    </div>



@endsection

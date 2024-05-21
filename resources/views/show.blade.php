@extends('layouts.app')

@section('title',$task->title)



@section('content')


<div class="card">
    <div class="card-header">
        <div class="card-title text-center">{{$task->description}}</div>
    </div>
    <div class="card-body">

        <div class="row">
            <div class="col text-center">
                <p>Description: {{$task->description}}</p>

                @if ($task->long_description)
                <p>Long description: {{$task->long_description}}</p>

                <p>{{$task->created_at}}</p>
                <p>{{$task->updated_at}}</p>

                <p>
                    @if ($task->completed)
                        Completed
                    @else
                        Not completed
                    @endif
                </p>
            </div>
            <div class="col-2 g-3 items-center">

                {{-- edit button --}}
                <a class="btn btn-warning w-100" href="{{route('tasks.edit',['task'=>$task])}}">Edit</a>
                <br>
                <br>

                {{-- mark as complete --}}
                <form method="POST" action="{{ route('tasks.toggle-complete', ['task'=>$task]) }}">
                    @csrf
                    @method('PUT')

                    <button class="btn btn-primary w-100" type="submit">
                        Mark as {{ $task->completed ? 'not completed':'completed'}}
                    </button>
                </form>
                <br>

                {{-- delete --}}
                <form action="{{route('tasks.destroy',['task'=>$task])}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger w-100" type="submit">Delete</button>
                </form>

            </div>

        </div>

    </div>


</div>






@endif





<div>
    <a class="btn btn-warning" href="{{route('tasks.edit',['task'=>$task])}}">Edit</a>
</div>

<div>
    <form method="POST" action="{{ route('tasks.toggle-complete', ['task'=>$task]) }}">
        @csrf
        @method('PUT')
        <button class="btn btn-primary" type="submit">
            Mark as {{ $task->completed ? 'not completed':'completed'}}
        </button>
    </form>
</div>

<div>
   <form action="{{route('tasks.destroy',['task'=>$task])}}" method="post">
    @csrf
    @method('DELETE')
    <button class="btn btn-danger" type="submit">Delete</button>
   </form>
</div>


@endsection

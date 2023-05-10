<head>
    <script>
        function submitTaskStatus(taskId)
        {
            const chkbx = document.getElementById('taskCheckbox' + taskId);
            const form = document.getElementById('cbitem' + taskId);
            const checkInput = document.getElementById('checkInput' + taskId);

            if(chkbx.checked)
            {
                checkInput.value = 'true';
            }else{
                checkInput.value = 'false';
            }

            form.submit();
        }
    </script>
</head>

@extends('admin.layouts.main')
@section('main-content')
    <h2>{{$order->title}}</h2>
    <h3 href='#'>{{$client->id.' '.$client->fname.' '.$client->lname}}</h3>
    <p>{{$order->created_at}}</p>
    <p>{{$order->order_status}}</p>
    
    @php
        echo $order->description;
        @endphp

    <p>{{$order->status}}</p>

    <h2>Taches</h2>
    <form action="{{route('addTask', $order)}}" method="post">
        @csrf
        <input type="text" name="title" id="" placeholder="Task Title">
        <input type="text" name="group" id="" placeholder="Task Group">
        <input type="number" name="cost" id="" placeholder="Task Cost">
        <input type="submit" value="Add">
    </form>
    @foreach ($taskGroups as $group)
    <h4>{{$group}}</h4>
    @foreach ($tasks as $task)
        @if ($task->group == $group)
        <form action="{{route('editTask', compact('order', 'task'))}}" method="post" id='cbitem{{$task->id}}'>
            @csrf
            <p>
                {{$task->title}} .......... {{$task->cost}}
            </p>
            <input type="checkbox" id="taskCheckbox{{$task->id}}" onclick="submitTaskStatus({{$task->id}})"
                @if ($task->is_done)
                    checked
                @endif
            >
            <input type="text" name="isChecked" value="" id="checkInput{{$task->id}}" hidden>
        </form>
        @endif
    @endforeach
    @endforeach
        
@endsection
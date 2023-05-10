<head>
    <script src="{{URL::asset('script/ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" href="{{ URL::asset('style/orders-style.css')}}">
</head>

@extends('user.user-dashboard')

@section('section-content')
    <div class="order-header">
        <h2>{{$order->title}}</h2>
        <p class="created_at">{{$order->created_at}}</p>
    </div>
    <p>{{$order->order_status}}</p>
    <br><h3>Description: </h3>
    @php
        echo $order->description;
    @endphp
    <br><h3>Statut</h3>
    <progress value="{{$order->status / 100}}" >8888</progress>
    <br><br><h3>Taches</h3><br>
    @foreach ($taskGroups as $group)
        <h4 class="task-group">{{$group}}</h4>
        @foreach ($tasks as $task)
            @if ($task->group == $group)
            <div class="task-item">
                <p class="task-title">{{$task->title}}</p>
                <div class="line"></div>
                @if ($task->is_done)
                    <p class="status">Complete</p>
                @else
                    <p class="status">En Attend </p>
                @endif
            </div>
            @endif
        @endforeach
    @endforeach
@endsection
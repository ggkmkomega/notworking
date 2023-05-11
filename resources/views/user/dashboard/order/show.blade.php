<head>
    <link rel="stylesheet" href="{{ URL::asset('style/orders-style.css')}}">
</head>
      
      

@extends('user.user-dashboard')

@section('section-content')
    <div class="order-header">
        <h2>{{$order->title}}</h2>
        <p class="created_at">{{$order->created_at}}</p>
    </div>
    <br>
    <p class="order-status">Statut:
        <span class="{{$order->order_status}}">
            @switch($order->order_status)
                @case('pending')
                    en attente
                    @break
                @case('delivering')
                    en livraison
                    @break
                @case('completed')
                    terminé
                    @break
                @default
                    ...
            @endswitch
        </span>
    </p>
    <div class="description">
        <br><h3 class="db-h3">Description: </h3><br>
        @php
            echo $order->description;
        @endphp
    </div>
    <br><h3 class="db-h3">Statut</h3>
    <div class="progress">
        <div id="myBar" class="bar" style="width:10%" >0</div>
    </div>

    <script defer>

        initPB({{$order->status}});
        function initPB(maxValue) {
        var elem = document.getElementById("myBar");
        var id = setInterval(frame, 15);
        var width = 0;
        function frame() {
          if (width >= 100) {
            clearInterval(id);
          } else {
            if(width < maxValue)
            {
                width++; 
                elem.style.width = width + '%'; 
                elem.innerHTML = width * 1  + '%';
            }
          }
        }
      }
      </script>



    <br><br><h3 class="db-h3">Taches</h3><br>
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
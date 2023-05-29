<head>
    <link rel="stylesheet" href="{{ URL::asset('style/showOrderAdm.css')}}">
    
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
    <style>
        .prod-list td a.btn{
            color: white;
            background-color: rgb(78, 145, 233);
            padding: 10px;
            border-radius: 2px;
        }
        .prod-list-t td img{
            height: 60px;
            border-radius: 2px;
        }

        .prod-list-t, .prod-list-t th, .prod-list-t td{
            padding: 10px;
            border-collapse: collapse;
        }

        .prod-list-t td.option{
            text-align: center;
        }

        .prod-list-t thead tr{
            border-bottom: 10px solid var(--bg);
        }
        .prod-list-t tr{
            background-color: rgb(231, 231, 231);
            border-bottom: 3px solid var(--bg);
            border-radius: 10px;
        }
    </style>
</head>

@extends('admin.layouts.main')
@section('main-content')
<div id="order-container">

    <h1 id="order-name">Commande N° {{$order->id}}: {{$order->title}}</h1>
    <h2 id="order-client" href='#'>Par le Client: {{$client->fname.' '.$client->lname}}</h2>
    <p class="created_at">{{$order->created_at}}</p>
    <div>Statut: <span>
        @switch($order->order_status)
                            @case('pending')
                            En Attente
                                @break
                            @case('delivering')
                            En Livraison
                                @break
                            @case('completed')
                            Complèté
                            @break
                        @endswitch
    </span>
    </div>
    <p>état d'avancement: {{$order->status}}%</p>
    <br>
    
    <div class="desc">

    @php
        echo $order->description;
    @endphp
    </div>

    <br>
    <h2>Tâches</h2>

    <form action="{{route('addTask', $order)}}" method="post">
        @csrf
        <input type="text" name="title" id="" placeholder="tâche titre">
        <input type="text" name="group" id="" placeholder="tâche groupe">
        <input type="number" name="cost" id="" placeholder="tâche coût">
        <input type="checkbox" name="is_paid" id="is_paid"> <label for="is_paid">Tach Facturer ?</label>
        <input type="submit" value="Ajouter">
    </form>

    @foreach ($taskGroups as $group)
    <h4>{{$group}}</h4>
    @foreach ($tasks as $task)
        @if ($task->group == $group)
        <form style="display: flex;" action="{{route('editTask', compact('order', 'task'))}}" method="post" id='cbitem{{$task->id}}'>
            @csrf
            <p>
                {{$task->title}} .......... {{$task->cost}}  .
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

    <br><h3 class="db-h3">Liste de Produits</h3>
    <div class="prod-list">
        <table class='prod-list-t'>
            <thead>
                <tr>
                    <th></th>
                    <th>Type</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Qté</th>
                    <th>Option</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderList as $item)
                    @php
                        $product = $item->Product($item->prod_category)->get()[0];
                        $img = $product->prod_images()->get();
                            $imgPath = '';
                            if(count($img) > 0){
                                $imgPath = $img[0]->path;
                            }else{
                                $imgPath = 'pre_assets/img/empty-img.png';
                            }
                    @endphp
                
                    <tr class="prod-item">
                        <td>
                            <img src="{{URL::asset('storage/' . $imgPath)}}" alt="">
                        </td>
                        <td>
                            @switch($product->prod_category)
                            @case('software')
                            Logiciel
                                @break
                            @case('hardware')
                            Matériel
                                @break
                            @case('service')
                            Service
                            @break
                            @case('course')
                            Formation
                                
                                @break
                                
                        @endswitch
                        </td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->category}}</td>
                        <td>{{$item->volume}}</td>
                        <td class="option">
                            <a class="btn " href="{{url('cp/'.$product->prod_category.'s?search='.$product->name)}}">Afficher</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
        
@endsection
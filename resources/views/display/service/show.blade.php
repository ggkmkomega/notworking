@extends('layouts.website-main')
@section('content')
    @php
        echo $service->page;

        $category = $service->prod_category;
        $id = $service->id;
    @endphp
    
    <style>
        .order-section{
            background-color: rgb(50, 120, 205);
            height: 360px;
            display: flex;
            justify-content: space-between;
            border-radius: 10px;
        }

        .sep{
            height: 300px;
            width: 7px;
            border-radius: 0 0 5px 5px;
            background-color: var(--bg);
        }

        .order-form, .reviews-area{
            width: 45%;
            padding: 30px;
            
        }

        .order-form p{
            font-size: 20px;
            margin: 30px;
            color: var(--bg);
        }

        .order-form input{
            margin: 0 30px;
            width: 220px;
            height: 36px;
            background-color: rgb(52, 57, 149);
            color: var(--bg);
            border-style: none;
            border-radius: 3px;
            cursor: pointer;

        }

        .order-form input:hover{
            background-color: rgb(42, 45, 97);
        }

        .reviews-area h2{
            margin: 25px 0;
            color: var(--bg);
        }
        .reviews-area .content{
            height: 60%;
            width: 86%;
            background-color: var(--bg);
            border-radius: 10px;
        }

    </style>
    <div id='addToList' class="order-section">
        <div class="order-form">
            <p>{{$service->header}}</p>
            <form action="{{route('addProductToList', compact('category', 'id'))}}" method="get">
                <input type="number" name="volume" value="0" hidden>
                <input type="submit" value="DEMANDEZ CONSEIL">
            </form>
        </div>
        <div class="sep"></div>
        <div class="reviews-area">
            <h2>Reviews</h2>
            <div class="content">

            </div>
        </div>
    </div>
@endsection
<head>
    <link rel="stylesheet" href="{{URL::asset('style/users-tab-style.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
<div class="items-container">
    <div class="index-header">
        <div class="search-bar">
            <form action="{{route('indexPendingOrders')}}" method="get">
                <input type="search" name="search" id="search-bar" value="{{old('search')}}">
                <button type="submit">Rechercher</button>
                <a href="{{route('indexPendingOrders')}}">Omettre</a>
            </form>
        </div>
    </div>

    <table border="1">
        <tr>
            <th>ID</th>
            <th>Client</th>
            <th>Titre</th>
            <th>Date Création</th>
            <th>Status</th>
            <th>Options</th>
        </tr>
    @if (($searching && $isFound) || (!$searching))
        @foreach ($orders as $item)
        <tr>
            <td class="col_id">{{$item->id}}</td>
            <td class="col_name">{{$item->client_id}}</td>
            <td class="col_name">{{$item->title}}</td>
            <td class="col_created_at">{{$item->created_at}}</td>
            <td class="col_role">{{$item->status}}</td>
            <td class="col_options">
                <a href="{{route('showOrder', $item)}}">Afficher</a>
                @php
                    $status = 'delivering';
                    $order = $item;
                @endphp
                <a href="{{route('changeOrderStatus', compact('order', 'status'))}}">Accepter</a>
                <a href="{{route('archiveOrder', $item)}}">Archive</a>
            </td>
        </tr>
        @endforeach
    </table>
    @else
    </table>
    <br>
    <h1>Not found</h1>
    @endif
    @if (($searching && $isFound) || (!$searching))
        {{$orders->links('vendor.pagination.default')}}
    @endif
</div>
@endsection
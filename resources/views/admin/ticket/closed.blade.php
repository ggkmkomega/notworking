<head>
    <link rel="stylesheet" href="{{ URL::asset('style/ticket-style.css')}}">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@extends('admin.layouts.main')
@section('main-content')
<style>
    th, td{
        text-align: left;
        padding: 10px;
        vertical-align:bottom;
    }
</style>
<div class="index-wrapper">
    <table>
        <tr>
            <th>Date</th>
            <th>Titre</th>
            <th>Type</th>
            <th>Statut</th>
            <th>Option</th>
        </tr>
        
    @foreach ($tickets as $ticket)
        <tr class="item-container">
            <div class="item">
                <td style="width: 15%; font-size: 15px; color:rgb(126, 126, 126);"><p>{{$ticket->created_at}}</p></td> 
                <td><p>{{$ticket->title}}</p></td>
                <td>{{$ticket->type}}</td>
                <td>    
                    <select name="status" onchange="updateStatus(this.value, '{{route('updateTicketStatus', $ticket)}}')">
                        <option value="ongoing"
                            @if ($ticket->status == 'ongoing')
                                selected
                            @endif
                        >Ongoing</option>

                        <option value="resolved"
                            @if ($ticket->status == 'resolved')
                                selected
                            @endif
                        >Resolved</option>

                        <option value="not resolved"
                            @if ($ticket->status == 'not resolved')
                                selected
                            @endif
                        >Not Resolved</option>
                    </select>
                </td>
                <td>
                    <a href="{{route('adminShowTicket', $ticket)}}">Afficher</a>
                    <a href="{{route('archiveTicket', $ticket)}}">Archiver</a>
                </td>
            </div>
        </tr>
    @endforeach
    </table>
    <script defer>
        function updateStatus(statusVal, route){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: route,
                data:  {status: statusVal},
                success: function (data) {
                    console.log('status changed');
                }
            });
        }
    </script>
</div>
@endsection
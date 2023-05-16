<head>
    <link rel="stylesheet" href="{{ URL::asset('style/ticket-style.css')}}">
</head>

@extends('user.user-dashboard')

@section('section-content')
    <div class="ticket-wrapper">
        <form action="{{route('newTicket')}}" method="get">
            @csrf
            <label>Titre: </label>
            <input type="text" name="title"><br><br>
            <label>Type: </label>
            <select name="type">
                <option selected disabled>select your issue type</option>
                <option value="question">Question</option>
                <option value="help">Assistance</option>
                <option value="issue">Problème</option>
            </select>

            <input type="submit" value="Send">
        </form>
    </div>
@endsection
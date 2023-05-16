<head>
    <link rel="stylesheet" href="{{ URL::asset('style/dashboard.css')}}">
</head>
@extends('layouts.website-main')
@section('content')
    <h1 class="title">Tableau de Bord Utilisateur</h1>
    <hr>
    <div class="db-wrapper">
        <div class="left-panel">

            <br>
            <h3 class="db-h3">Compte</h3>
            <ul>
                <a href="{{route('userAccountSettings')}}"><li>Paramètres du Compte</li></a>
                <a href="#"><li>Vérifier l'E-mail</li></a>
                <a href="#"><li>Paramètres de Notification</li></a>
            </ul>
            <br>

            <h3 class="db-h3">Commands</h3>
            <ul>
                <a href="{{route('newOrderForm')}}"><li>Nouvelle Commande</li></a>
                <a href="{{route('displayAllOrders')}}"><li>Suivi les Commandes</li></a>
            </ul>
            <br>

            <a href=""><h3 class="db-h3">Abonnement</h3></a>
            <br>

            <h3 class="db-h3">Assistance</h3>
            <ul>
                <a href="{{route('newTicketForm')}}"><li>Nouveau Ticket</li></a>
                <a href="{{route('userIndexOngoingTickets')}}"><li>En Cours</li></a>
                <a href="{{route('userIndexClosedTickets')}}"><li>Ticket Résolu</li></a>
            </ul>
            <br>

            <a href="{{route('indexForUser')}}"><h3 class="db-h3">Your Reviews</h3></a>
            <br>

        </div>
        <div class="content">
            @yield('section-content')   
        </div>
    </div>
@endsection
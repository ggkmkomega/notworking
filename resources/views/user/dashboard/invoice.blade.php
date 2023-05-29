

@extends('user.user-dashboard')
@section('section-content')

<style>
    #inv-wrapper{
        height: 100%;
        width: 100%;
    }
    #inv-header{
        width: 100%;
        background-color: #2e86d2;
        color: white;
        display: flex;
        justify-content: space-between;
        padding: 30px;
        border-radius: 20px 20px 0 0;
    }
    #inv-body{
        display: flex;
        justify-content: space-between;
    }
    #inv-info{
        text-align: right;
    }

    #inv-info .hinv ,th{
        margin-top: 30px;
        font-size: 18px;
        color: #2e86d2;
    }

    #inv-total{
        font-size: 40px;
    }
    #inv-info .inv-sub{
        color: gray;
    }

    .h2inv{
        margin-top: 30px;
    }

    table th{
        text-align: left;
        padding-right: 50px;
    }
    table td{
        padding-right: 20px;
    }
</style>

<div class="inv_wrapper">
    <div id="inv-header">
        <div class="company">
            <h1>U-Tech</h1>
            <p>05524562184</p>
        </div>
        <div class="adress">
            <p>
                245 Babe Ezouar, 8 Mai <br>
                Alger <br>
                16000 <br>
                Algerie
            </p>
        </div>
    </div>
    <div id="inv-body">
        <div id="inv-detailed">
            <h2 class="h2inv">Tâches Payées</h2>
            <table>
                <tr>
                    <th>description</th>
                    <th>prix</th>
                </tr>
                @foreach ($tasks as $item)
                @if ($item->is_paid)
                <tr>
                    <td>{{$item->title}}</td>
                    <td>{{$item->cost}} DA</td>
                </tr>
                @endif
                @endforeach


            </table>
            <h2 class="h2inv">Produits</h2>
            <table>
                <tr>
                    <th>description</th>
                    <th>prix unit</th>
                    <th>qté</th>
                    <th>prix totale</th>
                </tr>
                @foreach ($orderList as $item)
                @php
                    $prod = $item->Product($item->prod_category)->get()[0];
                    $total = $prod->price * $item->volume;
                @endphp
                <tr>
                    <td>{{$prod->name}}</td>
                    @if ($prod->prod_category == 'service')
                    <td>-</td>
                    <td>-</td>
                    <td>{{$prod->price}} DA</td>
                    @else

                    <td>{{$prod->price}} DA</td>
                    <td>{{$item->volume}}</td>
                    <td>{{$total}} DA</td>
                    @endif
                </tr>
               
                @endforeach
            </table>
        </div>
        <div id="inv-info">
            <h1 class="hinv">montant total à payer</h1>
            <p id="inv-total">{{$invoice->total_price}} DA</p>
            <p class="inv-sub">+tva: {{$invoice->fees}}%</p>
            <p class="inv-sub">-réduction: {{$invoice->discount_percentage}}%</p>
            <h1 class="hinv">renfloué à</h1>
            <p>{{$user->fname . $user->lname}} <br> {{$user->company}}</p>
            <h1 class="hinv">numéro de facture</h1>
            <p>#{{$invoice->id}}</p>
            <h1 class="hinv">date d'émission</h1>
            <p>{{$invoice->created_at}}</p>
        </div>
    </div>
</div>

@endsection
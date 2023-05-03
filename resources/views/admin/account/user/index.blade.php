<head>

</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="items-container">
        <div class="index-header">
            <div class="search-bar">
                <form action="{{route('users.index')}}" method="get">
                    <input type="search" name="search" id="search-bar">
                    <input type="submit" value="search">
                </form>
            </div>
        </div>
            <table border="1">
                <tr>
                    <th>Nom et Prenom</th>
                    <th>Entreprise</th>
                    <th>Date Création</th>
                    <th>Date Vérification d'email</th>
                    <th>Option</th>
                </tr>
                @foreach ($users as $item)
                <tr>
                    <td>{{$item->fname . ' ' . $item->lname}}</td>
                    <td>{{$item->company}}</td>
                    <td>{{$item->created_at}}</td>
                    <td>
                        @if ($item->email_verified_at)
                            {{$item->email_verified_at}}
                        @else
                            <p class="not verifyed">not ver</p>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('users.edit' , $item) }}">Modifier</a>
                        <form action="{{ route('users.destroy', $item) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Suprimer">
                        </form>
                    </td>
                </tr>
                @endforeach

                {{$users->links('vendor.pagination.default')}}
            </table>
    </div>
@endsection
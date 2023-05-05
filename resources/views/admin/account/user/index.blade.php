<head>
    <link rel="stylesheet" href="{{URL::asset('style/users-tab-style.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="items-container">
        <div class="index-header">
            <div class="search-bar">
                <form action="{{route('users.index')}}" method="get">
                    <input type="search" name="search" id="search-bar" value="{{old('search')}}">
                    <button type="submit">Rechercher</button>
                    <a href="{{route('users.index')}}">Omettre</a>
                </form>
            </div>
        </div>
            <table border="1">
                <tr>
                    <th>ID</th>
                    <th>Nom et Prenom</th>
                    <th>Entreprise</th>
                    <th>Date Création</th>
                    <th>Date Vérification d'email</th>
                    <th>Option</th>
                </tr>
            @if (($searching && $isFound) || (!$searching))
                @foreach ($users as $item)
                <tr>
                    <td class="col_id">{{$item->id}}</td>
                    <td class="col_name">{{$item->fname . ' ' . $item->lname}}</td>
                    <td class="col_company">{{$item->company}}</td>
                    <td class="col_created_at">{{$item->created_at}}</td>
                    <td class="col_verified_at">
                        @if ($item->email_verified_at)
                            {{$item->email_verified_at}}
                        @else
                            <p class="not_verified">not verified</p>
                        @endif
                    </td>
                    <td class="col_options">
                        <a href="{{ route('admins.show' , $item) }}">Afficher</a>
                        <a href="{{ route('users.edit' , $item) }}">Modifier</a>
                        <form action="{{ route('users.destroy', $item) }}" method="POST">
                            @csrf
                            @method('delete')
                            <input type="submit" value="Suprimer">
                        </form>
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
                {{$users->links('vendor.pagination.default')}}
            @endif
            </table>
    </div>
@endsection
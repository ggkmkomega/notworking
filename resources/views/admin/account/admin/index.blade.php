<head>
    <link rel="stylesheet" href="{{URL::asset('style/users-tab-style.css')}}">
</head>

@extends('admin.layouts.main')
@section('main-content')
    <div class="items-container">
        <div class="index-header">
            <div class="search-bar">
                <form action="{{route('admins.index')}}" method="get">
                    <input type="search" name="search" id="search-bar" value="{{old('search')}}">
                    <button type="submit">Rechercher</button>
                    <a href="{{route('admins.index')}}">Omettre</a>
                </form>
            </div>
            <button id="modalAddBtn">Ajouter</button>
        </div>

        <!----------------- Modal ---------------->
        <div id="myModal" class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <span class="close">&times;</span>
                    <h2>Ajouter un compte Administrateur</h2>
                </div>
                <div class="modal-body">
                    <form action="{{route('admins.index')}}" method="post">
                        @csrf
                        <div class="inputc">
                            <label for="fname">Nom:</label><br>
                            <input type="text" name="fname">
                        </div>
                        <div class="inputc">
                            <label for="fname">Prénom:</label><br>
                            <input type="text" name="lname">
                        </div>
                        <div class="inputc">
                            <label for="fname">Nom d'authentification:</label><br>
                            <input type="text" name="authname" >
                        </div>
                        <div class="inputc">
                            <label for="fname">Role:</label><br>
                            <input type="text" name="role" >
                        </div>
                        <div class="inputc">

                            <label for="fname">Adress email:</label><br>
                            <input type="email" name="email" >
                        </div>
                        <div class="inputc">
                            <label for="fname">Mot de Pass:</label><br>
                            <input type="password" name="password" >
                        </div>
                        
                        
                        <input type="submit" class="submit" value="Ajouter">
                    </form>
                </div>
            </div>
        </div>
        <script>
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the button that opens the modal
            var btn = document.getElementById("modalAddBtn");

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on the button, open the modal
            btn.onclick = function() {
                modal.style.display = "block";
            }

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
                modal.style.display = "none";
            }

            // When the user clicks anywhere outside of the modal, close it
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.style.display = "none";
                }
            }
        </script>
        <!----------------- End Modal ---------------->

        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nom et Prenom</th>
                <th>Role</th>
                <th>Date Création</th>
                <th>Options</th>
            </tr>
        @if (($searching && $isFound) || (!$searching))
            @foreach ($admins as $item)
            <tr>
                <td class="col_id">{{$item->id}}</td>
                <td class="col_name">{{$item->fname . ' ' . $item->lname}}</td>
                <td class="col_role">{{$item->role}}</td>
                <td class="col_created_at">{{$item->created_at}}</td>
                <td class="col_options">
                    <a href="{{ route('admins.show' , $item) }}">Afficher</a>
                    <a href="{{ route('admins.edit' , $item) }}">Modifier</a>
                    <form action="{{ route('admins.destroy', $item) }}" method="POST">
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
            {{$admins->links('vendor.pagination.default')}}
        @endif
    </div>
@endsection
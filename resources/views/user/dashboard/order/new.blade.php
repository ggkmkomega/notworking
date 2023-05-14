<head>
    <script src="{{URL::asset('script/ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" href="{{ URL::asset('style/orders-style.css')}}">
</head>

@extends('user.user-dashboard')

@section('section-content')

<h3 class="db-h3">Send New Order:</h3><br>
<form action="{{route('newOrder')}}" method="post">
    @csrf
    <label for="title">Titre</label>
    <input type="text" name="title"><br><br>

    <label for="desc">Description:</label><br><br>
    <textarea name="description" class="ckeditor" cols="30" rows="10">{{ old('description') }}</textarea><br><br>

        <script>
            const editors = document.querySelectorAll( '.ckeditor' );
            
            for (const editorItem of editors) {
                ClassicEditor
                        .create( editorItem, {
                            
                            licenseKey: '',
                        } )
                        .then( editor => {
                            window.editor = editor; 
                        } );
            }
        </script>

    <br><h3 class="db-h3">Products List</h3><br>
    <div class="prod-list">
        <table class='prod-list-t'>
            <thead>
                <tr>
                    <th></th>
                    <th>Type</th>
                    <th>Nom</th>
                    <th>Catégorie</th>
                    <th>Volume</th>
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
                        <td>{{$product->prod_category}}</td>
                        <td>{{$product->name}}</td>
                        <td>{{$product->category}}</td>
                        <td>{{$item->volume}}</td>
                        <td class="option">
                            <a class="btn " href="{{route('removeProductFromList', $item)}}">delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <input class="submit-btn" type="submit" value="Send">
</form>
@endsection
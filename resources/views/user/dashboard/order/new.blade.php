<head>
    <script src="{{URL::asset('script/ckeditor/ckeditor.js')}}"></script>
    <link rel="stylesheet" href="{{ URL::asset('style/orders-style.css')}}">
</head>

@extends('user.user-dashboard')

@section('section-content')
<form action="{{route('newOrder')}}" method="post">
    @csrf
    <label for="title">Titre</label>
    <input type="text" name="title"><br><br>

    <label for="desc">Description:</label><br>
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
    
    <input type="submit" value="Send">
</form>
@endsection
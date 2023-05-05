 <head>
    <link rel="stylesheet" href="{{URL::asset('style/edit-prod-style.css')}}">
 </head>
 @extends('admin.layouts.main')
 @section('main-content')
 <div class="form-container edit">
    <form action="{{ route('softwares.update', $software) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <label for="name">nom:</label><br>
        <input type="text" name="name" value="{{ old('name', $software->name) }}"><br><br>
        <label for="name">en tete:</label><br>
        <input type="text" name="header" value="{{ old('header', $software->header) }}"><br><br>
        <label for="name">description:</label><br>
        <textarea name="desc" id="" cols="30" rows="10">{{ old('desc', $software->desc) }}</textarea><br><br>
        <label for="name">paiement:</label><br>

        <select name="payment" id="payment">
            <option value="" selected disabled hidden>sélectioner un type</option>
            @if ($software->payment == 'subscription')
                <option value="subscription" selected>Abonnement</option>
                <option value="one-time">Paiement Unique </option>
            @else
                <option value="subscription">Abonnement</option>
                <option value="one-time" selected>Paiement Unique </option>
            @endif
        </select><br><br>

        <label for="name">prix:</label><br>
        <input type="number" step="0.01" name="price" placeholder="0.00" min="0" max="9999999999" value="{{ old('desc', $software->price) }}"><br><br>
        

        <label for="img">sélectionner une liste d'images:</label><br><br>
        <label for="img-input" class="custom-file-upload">Sélectionner</label>
        <input type="file" id="img-input" name="imgs[]" multiple accept="image/*" onchange="test()"><br><br>
        <div id="img-container">
            @foreach ($content as $img)
                <div class="img-item-db">
                    <a href="{{ route('swdeleteImg', compact('software', 'img'))}}"><div class="delete-hover"><i class="uil uil-minus"></i></div></a>
                    <img src="{{URL::asset('storage/' . $img->path)}}">
                </div>
            @endforeach
        </div>
        <script src="{{URL::asset('script/imgUploadPreview.js')}}"></script>

        <label for="name">catégorie:</label><br>
        <input type="text" name="category" value="{{ old('category', $software->category) }}"><br><br>

        <div class="submit-btn">
            <input class="btn" type="submit" value="Enregistrer">
        </div>
    </form>
 </div>
 @endsection

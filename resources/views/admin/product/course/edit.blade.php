 <head>
    <link rel="stylesheet" href="{{URL::asset('style/edit-prod-style.css')}}">
 </head>
 @extends('admin.layouts.main')
 @section('main-content')
 <div class="form-container edit">
    <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')

        <label for="name">nom:</label><br>
        <input type="text" name="name" value="{{ old('name', $course->name) }}"><br><br>

        <label for="name">catégorie:</label><br>
        <input type="text" name="category" value="{{ old('category', $course->category) }}"><br><br>

        <label for="name">en tete:</label><br>
        <input type="text" name="header" value="{{ old('header', $course->header) }}"><br><br>

        <label for="name">description:</label><br>
        <textarea name="desc" id="" cols="30" rows="10">{{ old('desc', $course->desc) }}</textarea><br><br>

        <label for="name">prof:</label><br>
        <input type="text" name="prof" value="{{ old('name', $course->name) }}"><br><br>

        <label for="name">period:</label><br>
        <input type="text" name="period" value="{{ old('name', $course->name) }}"><br><br>

        <label for="name">prix:</label><br>
        <input type="number" step="0.01" name="price" placeholder="0.00" min="0" max="9999999999" value="{{ old('desc', $course->price) }}"><br><br>

        <label for="img">sélectionner une liste d'images:</label><br><br>
        <label for="img-input" class="custom-file-upload">Sélectionner</label>
        <input type="file" id="img-input" name="imgs[]" multiple accept="image/*" onchange="test()"><br><br>
        <div id="img-container">
            @foreach ($content as $img)
                <div class="img-item-db">
                    <a href="{{ route('crdeleteImg', compact('course', 'img'))}}"><div class="delete-hover"><i class="uil uil-minus"></i></div></a>
                    <img src="{{URL::asset('storage/' . $img->path)}}">
                </div>
            @endforeach
        </div>
        <script src="{{URL::asset('script/imgUploadPreview.js')}}"></script>

        <div class="submit-btn">
            <input class="btn" type="submit" value="Enregistrer">
        </div>
    </form>
 </div>
 @endsection

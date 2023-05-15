<head>
    <link rel="stylesheet" href="{{ URL::asset('style/reviewstyle.css')}}">
</head>

@extends('layouts.website-main')
@section('content')
    @php
        echo $service->page;

        $category = $service->prod_category;
        $id = $service->id;
    @endphp
    <div id='addToList' class="order-section">
        <div class="order-form">
            <p>{{$service->header}}</p>
            <form action="{{route('addProductToList', compact('category', 'id'))}}" method="get">
                <input type="number" name="volume" value="0" hidden>
                <input type="submit" value="DEMANDEZ CONSEIL">
            </form>
        </div>
        <div class="sep"></div>
        <div class="reviews-area">
            <h2>Reviews</h2>
            <div class="content">
                @foreach ($reviews as $item)
                <div class="rev-container">
                    @php
                        $accountName = $item->Client()->get()[0]->fname .' '. $item->Client()->get()[0]->lname;
                    @endphp
                    <div class="rev-header">
                        <p><strong>{{$accountName}}</strong></p>
                        <div class="stars">
                            {{$item->stars}}
                            <svg width="20px" height="20px" viewBox="0 0 66.251022 63.154472" version="1.1" id="svg5" inkscape:export-filename="bitmap.svg" inkscape:export-xdpi="96" inkscape:export-ydpi="96" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                <defs id="defs2"/>
                                <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(-75.254076,-43.96511)">
                                    <path
                                    sodipodi:type="star"
                                    style="fill:#ddb919;stroke-width:0.264583"
                                    id="path390"
                                    inkscape:flatsided="false"
                                    sodipodi:sides="5"
                                    sodipodi:cx="82.229591"
                                    sodipodi:cy="153.99998"
                                    sodipodi:r1="34.831116"
                                    sodipodi:r2="17.679899"
                                    sodipodi:arg1="0.93534701"
                                    sodipodi:arg2="1.5696164"
                                    inkscape:rounded="0"
                                    inkscape:randomized="0"
                                    d="m 102.90322,182.03224 -20.652768,-10.35237 -20.29262,10.64435 3.463634,-22.84101 -16.394143,-16.01014 22.793415,-3.76415 10.160482,-20.53917 10.623471,20.51464 22.673669,3.31625 -16.227751,16.44289 z"
                                    inkscape:transform-center-x="-0.63292671"
                                    inkscape:transform-center-y="-2.5647159"
                                    transform="translate(26.226755,-75.204647)" />
                                </g>
                            </svg>
                        </div>
                    </div>
                    <p class="review">{{$item->review}}</p>
                </div>
                @endforeach
                <div class="browse">

                </div>
            </div>
            <button id="modalAddBtn">Post Review</button>
        </div>
    </div>
    <!----------------- Modal ---------------->
    <div id="myModal" class="modal">
        <!-- Modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <span class="close">&times;</span>
                <h2>Ajouter votre avis</h2>
            </div>
            <div class="modal-body">
                @php
                    $prod_category = $service->prod_category;
                    $prod_id = $service->id;
                @endphp
                <form action="{{ route('addNewReview', compact('prod_category', 'prod_id'))}}" method="POST">
                    @csrf
                    
                    <label>Rate:</label>
                    <div class="stars-widget">
                        <input type="radio" name="stars" id="rate-5" value="5">
                        <label for="rate-5">
                            <svg width="20px" height="20px" viewBox="0 0 66.251022 63.154472" version="1.1" id="svg5" inkscape:export-filename="bitmap.svg" inkscape:export-xdpi="96" inkscape:export-ydpi="96" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                <defs id="defs2"/>
                                <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(-75.254076,-43.96511)">
                                    <path
                                    sodipodi:type="star"
                                    style="fill:currentcolor;stroke-width:0.264583"
                                    id="path390"
                                    inkscape:flatsided="false"
                                    sodipodi:sides="5"
                                    sodipodi:cx="82.229591"
                                    sodipodi:cy="153.99998"
                                    sodipodi:r1="34.831116"
                                    sodipodi:r2="17.679899"
                                    sodipodi:arg1="0.93534701"
                                    sodipodi:arg2="1.5696164"
                                    inkscape:rounded="0"
                                    inkscape:randomized="0"
                                    d="m 102.90322,182.03224 -20.652768,-10.35237 -20.29262,10.64435 3.463634,-22.84101 -16.394143,-16.01014 22.793415,-3.76415 10.160482,-20.53917 10.623471,20.51464 22.673669,3.31625 -16.227751,16.44289 z"
                                    inkscape:transform-center-x="-0.63292671"
                                    inkscape:transform-center-y="-2.5647159"
                                    transform="translate(26.226755,-75.204647)" />
                                </g>
                            </svg>
                        </label>

                        <input type="radio" name="stars" id="rate-4" value="4">
                        <label for="rate-4">
                            <svg width="20px" height="20px" viewBox="0 0 66.251022 63.154472" version="1.1" id="svg5" inkscape:export-filename="bitmap.svg" inkscape:export-xdpi="96" inkscape:export-ydpi="96" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                <defs id="defs2"/>
                                <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(-75.254076,-43.96511)">
                                    <path
                                    sodipodi:type="star"
                                    style="fill:currentcolor;stroke-width:0.264583"
                                    id="path390"
                                    inkscape:flatsided="false"
                                    sodipodi:sides="5"
                                    sodipodi:cx="82.229591"
                                    sodipodi:cy="153.99998"
                                    sodipodi:r1="34.831116"
                                    sodipodi:r2="17.679899"
                                    sodipodi:arg1="0.93534701"
                                    sodipodi:arg2="1.5696164"
                                    inkscape:rounded="0"
                                    inkscape:randomized="0"
                                    d="m 102.90322,182.03224 -20.652768,-10.35237 -20.29262,10.64435 3.463634,-22.84101 -16.394143,-16.01014 22.793415,-3.76415 10.160482,-20.53917 10.623471,20.51464 22.673669,3.31625 -16.227751,16.44289 z"
                                    inkscape:transform-center-x="-0.63292671"
                                    inkscape:transform-center-y="-2.5647159"
                                    transform="translate(26.226755,-75.204647)" />
                                </g>
                            </svg>
                        </label>

                        <input type="radio" name="stars" id="rate-3" value="3">
                        <label for="rate-3">
                            <svg width="20px" height="20px" viewBox="0 0 66.251022 63.154472" version="1.1" id="svg5" inkscape:export-filename="bitmap.svg" inkscape:export-xdpi="96" inkscape:export-ydpi="96" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                <defs id="defs2"/>
                                <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(-75.254076,-43.96511)">
                                    <path
                                    sodipodi:type="star"
                                    style="fill:currentcolor;stroke-width:0.264583"
                                    id="path390"
                                    inkscape:flatsided="false"
                                    sodipodi:sides="5"
                                    sodipodi:cx="82.229591"
                                    sodipodi:cy="153.99998"
                                    sodipodi:r1="34.831116"
                                    sodipodi:r2="17.679899"
                                    sodipodi:arg1="0.93534701"
                                    sodipodi:arg2="1.5696164"
                                    inkscape:rounded="0"
                                    inkscape:randomized="0"
                                    d="m 102.90322,182.03224 -20.652768,-10.35237 -20.29262,10.64435 3.463634,-22.84101 -16.394143,-16.01014 22.793415,-3.76415 10.160482,-20.53917 10.623471,20.51464 22.673669,3.31625 -16.227751,16.44289 z"
                                    inkscape:transform-center-x="-0.63292671"
                                    inkscape:transform-center-y="-2.5647159"
                                    transform="translate(26.226755,-75.204647)" />
                                </g>
                            </svg>
                        </label>

                        <input type="radio" name="stars" id="rate-2" value="2">
                        <label for="rate-2">
                            <svg width="20px" height="20px" viewBox="0 0 66.251022 63.154472" version="1.1" id="svg5" inkscape:export-filename="bitmap.svg" inkscape:export-xdpi="96" inkscape:export-ydpi="96" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                <defs id="defs2"/>
                                <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(-75.254076,-43.96511)">
                                    <path
                                    sodipodi:type="star"
                                    style="fill:currentcolor;stroke-width:0.264583"
                                    id="path390"
                                    inkscape:flatsided="false"
                                    sodipodi:sides="5"
                                    sodipodi:cx="82.229591"
                                    sodipodi:cy="153.99998"
                                    sodipodi:r1="34.831116"
                                    sodipodi:r2="17.679899"
                                    sodipodi:arg1="0.93534701"
                                    sodipodi:arg2="1.5696164"
                                    inkscape:rounded="0"
                                    inkscape:randomized="0"
                                    d="m 102.90322,182.03224 -20.652768,-10.35237 -20.29262,10.64435 3.463634,-22.84101 -16.394143,-16.01014 22.793415,-3.76415 10.160482,-20.53917 10.623471,20.51464 22.673669,3.31625 -16.227751,16.44289 z"
                                    inkscape:transform-center-x="-0.63292671"
                                    inkscape:transform-center-y="-2.5647159"
                                    transform="translate(26.226755,-75.204647)" />
                                </g>
                            </svg>
                        </label>

                        <input type="radio" name="stars" id="rate-1" value="1">
                        <label for="rate-1">
                            <svg width="20px" height="20px" viewBox="0 0 66.251022 63.154472" version="1.1" id="svg5" inkscape:export-filename="bitmap.svg" inkscape:export-xdpi="96" inkscape:export-ydpi="96" xmlns:inkscape="http://www.inkscape.org/namespaces/inkscape" xmlns:sodipodi="http://sodipodi.sourceforge.net/DTD/sodipodi-0.dtd" xmlns="http://www.w3.org/2000/svg" xmlns:svg="http://www.w3.org/2000/svg">
                                <defs id="defs2"/>
                                <g inkscape:label="Layer 1" inkscape:groupmode="layer" id="layer1" transform="translate(-75.254076,-43.96511)">
                                    <path
                                    sodipodi:type="star"
                                    style="fill:currentcolor;stroke-width:0.264583"
                                    id="path390"
                                    inkscape:flatsided="false"
                                    sodipodi:sides="5"
                                    sodipodi:cx="82.229591"
                                    sodipodi:cy="153.99998"
                                    sodipodi:r1="34.831116"
                                    sodipodi:r2="17.679899"
                                    sodipodi:arg1="0.93534701"
                                    sodipodi:arg2="1.5696164"
                                    inkscape:rounded="0"
                                    inkscape:randomized="0"
                                    d="m 102.90322,182.03224 -20.652768,-10.35237 -20.29262,10.64435 3.463634,-22.84101 -16.394143,-16.01014 22.793415,-3.76415 10.160482,-20.53917 10.623471,20.51464 22.673669,3.31625 -16.227751,16.44289 z"
                                    inkscape:transform-center-x="-0.63292671"
                                    inkscape:transform-center-y="-2.5647159"
                                    transform="translate(26.226755,-75.204647)" />
                                </g>
                            </svg>   
                        </label>

                    </div>
                    <label>Votre avis:</label><br>
                    <textarea name="review" cols="80" rows="10" placeholder="Write Anything ..."></textarea><br><br>
                    <input type="submit" value="Post Review">
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
@endsection
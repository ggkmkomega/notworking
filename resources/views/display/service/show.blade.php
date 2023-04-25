@extends('layouts.website-main')
@section('content')

    <iframe id="idIframe" onload="iframeLoaded();" scrolling="no" style="width: 100%;" srcdoc="{{$service->page}}" frameborder="0"></iframe>
    <script type="text/javascript">
        function iframeLoaded() {
            var iFrameID = document.getElementById('idIframe');
            if(iFrameID) {
                    // here you can make the height, I delete it first, then I make it again
                    iFrameID.height = "";
                    iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
            }   
        }
    </script> 

    
@endsection
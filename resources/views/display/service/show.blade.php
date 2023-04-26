@extends('layouts.website-main')
@section('content')
    <iframe id="idIframe" onload="iframeLoaded();" scrolling="no" style="width: 100%;" srcdoc="{{$service->page}}" frameborder="0" sandbox="allow-forms"></iframe>
    <script type="text/javascript">
        function iframeLoaded() {
            var iFrameID = document.getElementById('idIframe');
            if(iFrameID) {
                    iFrameID.height = "";
                    iFrameID.height = iFrameID.contentWindow.document.body.scrollHeight + "px";
            }   
        }
    </script> 
@endsection
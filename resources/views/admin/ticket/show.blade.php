<head>
    <link rel="stylesheet" href="{{ URL::asset('style/ticket-style.css')}}">
    <script src="{{URL::asset('script/ckeditor/ckeditor.js')}}"></script>
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

@extends('admin.layouts.main')
@section('main-content')


    <div class="ticket-wrapper">


        <div class="messages-container">
        </div>
        <textarea name="body" id="msgBody" class="ckeditor"></textarea>
        <button onclick="sendMessage()">Enovoyer</button>
    </div>

    <script>

        const editorItem = document.querySelector( '.ckeditor' );
        ClassicEditor
            .create( editorItem, {
                licenseKey: '',
            })
            .then( editor => {
                window.editor = editor; 
            });


        function sendMessage() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                }
            });
            var formData = {
                body: editor.getData(),
            }
        
            console.log(formData);
            $.ajax({
                type: "POST",
                url: '{{route("adminSendMessage", $ticket)}}',
                data: formData,
                dataType: 'json',
                success:function(data) {
                    var msg = '<div class="message-container right"><strong>'+ data.sender_name +'</strong><p>' + data.created_at.replace('T', ' ').replace('.000000Z', '') +'</p><div class="msg-body">'+ data.body +'</div</div>';
                    $('.messages-container').append(msg);
                    editor.setData('');
                }

            });
        }
    </script>

    <script>
        function updatePage() {
            $.ajax({
                url: "{{route('updateMessageData', $ticket)}}",
                type: 'GET',
                dataType: 'json',
                success: function (data) {

                    $('.messages-container').empty();
                    if(!jQuery.isEmptyObject(data)){
                        for (i = 0; i < data.length; i++) {
                            
                            var msg = '<div class="message-container right"><strong>'+ data[i].sender_name +'</strong><p>' + data[i].created_at.replace('T', ' ').replace('.000000Z', '') +'</p><div class="msg-body">'+ data[i].body +'</div</div>';
                            $('.messages-container').append(msg);
                        }
                    }else{
                        console.log('no new messages.');
                    }
                }
            });
        }
        updatePage();
        setInterval(() => {
            updatePage();
        }, 5000);
    </script>
@endsection
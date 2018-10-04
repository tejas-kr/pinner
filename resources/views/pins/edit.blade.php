@extends('layouts.app')

@section('title')
Create new Pin
@endsection

@section('extra_style')

@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Add Pin</div>
                <div class="card-body">
                    
                    <div class="form-horizontal">
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" value="{{ $pin->title }}">
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" name="url" id="url" class="form-control" value="{{ $pin->url }}">
                        </div>
                        
                        <div class="well">
                        </div>
                        
                        <button class="btn btn-primary" onclick="edit_pin({{ $pin->id }})">Edit Pin</button>
                        <a href="{{ url('pins') }}" class="btn btn-success">Go Back</a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_script')
    <script type="text/javascript">
        $(document).ready(function (data) {
            // TO Make A PHP WEB SCRAPER...
            /*$("#url").keyup(function (e) {
                var url = 'https://allorigins.me/get?url=' + encodeURIComponent(''+$(this).val()+'');
                $.get(url, function (data) {
                    console.log(data.contents);
                });
            });*/
        });
    </script>

    <script type="text/javascript">
        function edit_pin (id) {
            var title = $("#title").val();
            var url = $("#url").val();
            if (title && url && id) {
                $.ajax({
                    url: "{{ url('pins' . '/' . $pin->id) }}",
                    method: "put",
                    data: {
                        id: id,
                        title: title,
                        url: url
                    },
                    dataType: "json"
                })
                .done(function (data) {
                    if (data.success == 1) {
                        toast({
                            type: 'success', 
                            title: 'Pin Insert'
                        });
                        
                        $.ajax({
                            url: "{{ url('pins/save_link_data') }}",
                            method: "post",
                            data: {
                                id: id
                            },
                            dataType: "JSON"
                        }).done(function (data) {
                        });


                    } else {
                        toast({
                            type: 'error', 
                            title: data.errors[Object.keys(data.errors)[0]][0]
                        });
                    }
                })
                .fail(function (data) {
                    toast({
                        type: 'error', 
                        title: 'Error Occured'
                    });
                });
            } else {
                toast({
                    type: 'error', 
                    title: 'Error Occured'
                });
            }
        }
    </script>
@endsection
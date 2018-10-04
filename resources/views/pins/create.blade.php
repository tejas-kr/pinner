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
                            <input type="text" name="title" id="title" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="url">URL</label>
                            <input type="text" name="url" id="url" class="form-control">
                        </div>
                        
                        <div class="well">
                        </div>
                        
                        <button class="btn btn-primary" onclick="save_pin()">Save Pin</button>
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
        function save_pin () {
            var title = $("#title").val();
            var url = $("#url").val();
            if (title && url) {
                $.ajax({
                    url: "{{ url('pins') }}",
                    method: "post",
                    data: {
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
                            url: {{ url('pins/save_link_data') }},
                            method: "post",
                            data: {
                                id: data.id
                            },
                            dataType: "JSON"
                        }).done(function (data) {
                        });

                        $("#title").val("");
                        $("#url").val("");
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
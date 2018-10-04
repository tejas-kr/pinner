@extends('layouts.app')

@section('title')
{{ $pin->title }}
@endsection

@section('extra_style')
    <style type="text/css">
        .grid-item { 
            width: 200px;
            margin-bottom: 20px;
        }
        .grid-item--width2 { width: 400px; }
    </style>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pin</div>
                <div class="card-body">
                    <div class="well">
                        <h3 class="page-header"><a href="{{ url('pins/' . $pin->id) }}">{{ $pin->title }}</a></h3>
                        <p class="text-justify">
                            {{ strip_tags($pin->text) }}
                        </p>
                        @if ($pin->img != "")
                            <img class="img-thumbnail" src="{{ $pin->img }}">
                        @endif
                        <hr>
                    </div>
                    @if (Auth::user()->id == $pin->user_id)
                        <a href="{{ url('pins' . '/' . $pin->id . '/edit') }}" class="btn btn-primary pull-left">Edit</a>
                        <button class="btn btn-danger pull-right" onclick="delete_pin({{ $pin->id }})">Delete</button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_script')
    <script type="text/javascript">

        function delete_pin (id) {
            if (id) {
                swal({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        $.ajax({
                            url: "{{ url('pins'.'/'.$pin->id) }}",
                            method: "delete",
                            data: {
                                id: {{ $pin->id }}
                            },
                            dataType: "json"
                        })
                        .done(function (data) {
                            if (data == 1) {
                                window.location.href = "{{ url('pins') }}";
                            } else {
                                toast({
                                    type: 'error', 
                                    title: 'Error Occured'
                                });
                            }
                        })
                        .fail(function (data) {
                            toast({
                                type: 'error', 
                                title: 'Error Occured'
                            });
                        });
                    }
                })
            }
        }

    </script>
@endsection
@extends('layouts.app')

@section('title')
All Pins of {{ Auth::user()->name }}
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
                <div class="card-header">All Pins</div>
                <div class="card-body">
                    
                    <div class="grid">
                        @if (!empty($pins))
                            @foreach ($pins as $pin)
                                <div class="grid-item">
                                    <h3><a href="{{ url('pins/' . $pin->id) }}">{{ $pin->title }}</a></h3>
                                    <p>
                                        {{ strip_tags($pin->text) }}
                                    </p>
                                    @if ($pin->img != "")
                                        <img class="img-thumbnail" src="{{ $pin->img }}">
                                    @endif
                                    <hr>
                                </div>
                            @endforeach
                        @endif
                    </div>

                    <div class="center-block">
                        {{ $pins->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('extra_script')
    <script src="https://unpkg.com/masonry-layout@4/dist/masonry.pkgd.min.js"></script>
    <script type="text/javascript">
        $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
            columnWidth: 200,
            gutter: 20
        });
    </script>
@endsection
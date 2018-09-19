@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Films 
                    <span style="float: right;">                 
                        <a class="navbar-brand" href="{{route('film.create')}}">
                            Add Film
                        </a>
                    </span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p> Click on a Film to View Details</p>
                    @foreach($films as $film)
                        <p><a href="films/{{$film['slug']}}">{{$film['name']}}</a></p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

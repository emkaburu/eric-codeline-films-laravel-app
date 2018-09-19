@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$film->name}} 
                    &nbsp; &nbsp; &nbsp; <i class="fa fa-calendar film_date"></i>&nbsp; {{$film->realease_date}}  
                    <span style="float:right">
                        @php $rating = $film->rating; @endphp  

                            @foreach(range(1,5) as $i)

                                    @if($rating > 0)
                                         <i class="fa fa-star rating"></i>
                                    @else
                                        <i class="fa fa-star"></i>
                                    @endif
                                    @php $rating--; @endphp
                                
                            @endforeach
                    </span></div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-4">
                                <img 
                                src="/image/{{$film->photo_url}}" 
                                class="img-responsive" 
                                style="max-height: 100px; min-height: 100px;">
                        </div>
                        <div class="col-md-8">{{$film->description}}</div>
                    </div>

                    <div class="row space-top ">
                        <div class="col-md-4">Genre: {{$film->genre}}</div>
                        <div class="col-md-4">Country: {{$film->country}}</div>
                        <div class="col-md-4">Ticket: {{$film->ticket_price}}</div>
                    </div>

                    <div class="row space-top ">
                        <div class="col-md-12">
                            <h5>Comments</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <ul>
                                @foreach($comments as $comment)
                                <li style="border-bottom: 1px solid #EEE; margin-bottom: 1.5em; list-style: none">
                                    {{$comment['comment']}} 

                                    <span style="display: block; margin-top: 1em;"> 
                                        <i class="fa fa-user"></i>
                                        {{$comment['user_name']}}
                                    </span>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    @if($user == null)
                        <p>You must be logged in to add a comment</p>
                    @else
                        <div class="row space-top">
                            <div class="col-md-8">
                                <h5>Add Comment</h5>
                                <form method="post" action='{{ url("comments/create") }}' role="form">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="user_id" value="{{$user->id}}">
                                    <input type="hidden" name="film_id" value="{{$film->id}}">

                                    <input class="form-control" type="text" name="user_name" name="user_name" placeholder="Your Name" required>
                                    <br/>
                                    <textarea class="form-control" name="comment" placeholder="Your Comment" required></textarea>
                                    <br>
                                    <button type="submit" class="btn btn-success btn-sm">Submit</button>
                                </form>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

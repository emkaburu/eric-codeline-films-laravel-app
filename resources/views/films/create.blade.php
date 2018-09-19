@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$page_title}}</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            @if (Session::has('success'))
                                <div class="alert alert-micro alert-border-left alert-success pastel alert-dismissable">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    <i class="fa fa-info pr10"></i>
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <form method="post" action='{{ url("films/create") }}' role="form" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                          <div class="col-md-12">
                            <div class="form-group">
                                <Label for="name" class="control-label col-sm-4">Name</Label>
                                <div class="col-sm-8">
                                    <input type="text" name="name" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <Label for="description" class="control-label col-sm-4">Description</Label>
                                <div class="col-sm-8">
                                    <textarea class="form-control" name="description" required></textarea>
                                </div>
                            </div>

                            <div class="form-group">                      
                                <Label for="realease_date" class="control-label col-sm-4">Release Date</Label>
                                <div class="col-sm-8">
                                    <input type="date" name="realease_date" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">                      
                                <Label for="ticket_price" class="control-label col-sm-4">Ticket Price</Label>
                                <div class="col-sm-8">
                                    <input type="number" name="ticket_price" class="form-control" required>
                                </div>
                            </div>

                            <div class="form-group">                      
                                <Label for="country" class="control-label col-sm-4">Country</Label>
                                <div class="col-sm-8">
                                    <select name="country" class="form-control" required>
                                        @foreach($countries as $country)
                                            <option value="{{$country}}">{{$country}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">                      
                                <Label for="genre_id" class="control-label col-sm-4">Genre</Label>
                                <div class="col-sm-8">
                                    <select name="genre_id" class="form-control" required>
                                        @foreach($genres as $genre)
                                            <option value="{{$genre['id']}}">{{$genre['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">                      
                                <Label for="photo_url" class="control-label col-sm-4">Photo</Label>
                                <div class="col-sm-8">
                                    <input type="file" name="photo_url" class="form-control" required>
                                </div>
                            </div>
                          </div>

                          <button type="submit" class="btn btn-success">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

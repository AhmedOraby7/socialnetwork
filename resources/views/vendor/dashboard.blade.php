@extends('layouts.master')

@section('content')
    @include('includes.errorCheck')
    <section class="row new-post">
        <div class="col-md6">
            <header><h3>What do you want to say?</h3></header>
            <form action="{{route('post.create')}}" method="post">
                <div class="form-group">
                    <textarea class="form-control" name="body" id="new-post" cols="30" rows="10"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Post</button>
                <input type="hidden" name="_token" value="{{Session::token()}}">
            </form>
        </div>
    </section>

    <section class="row posts">
        <div class="col-md-6">
            <header><h3>What Other People Say..</h3></header>
            @foreach($posts as $post)
                <article class="post" data-postid="{{$post->id}}">
                    <p>{{$post->body}}</p>
                    <div class="info">
                        Posted by {{$post->user->first_name}} on {{$post->created_at}}
                    </div>
                    <div class="interaction">
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id' , $post->id)->first()  ?
                         Auth::user()->likes()->where('post_id' , $post->id)->first()->like == 1 ? 'You Like This' : 'Like' : 'Like' }}</a> |
                        <a href="#" class="like">{{ Auth::user()->likes()->where('post_id' , $post->id)->first()  ?
                         Auth::user()->likes()->where('post_id' , $post->id)->first()->like == 0 ? 'You DisLike This' : 'DisLike' : 'DisLike' }}</a>
                        @if(Auth::user() == $post->user)
                            |
                        <a href="#"  class="edit">Edit</a> |
                        <a href="{{route('post.delete' , ['post_id' => $post->id])}}">Delete</a>
                            @endif
                    </div>
                </article>
            @endforeach
        </div>
    </section>
    <div class="modal fade" tabindex="-1" role="dialog" id="edit-modal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Edit Post</h4>
                </div>
                <div class="modal-body">
                    <form >
                        <div class="form-group">
                            <label for="post-body">Edit The Post</label>
                            <textarea class="form-control" name="post-body" id="post-body" cols="30" rows="10"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="modal-save">Save changes</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <script>
        var token = '{{Session::token()}}';
        var urlEdit = '{{route('edit')}}';
        var urlLike = '{{route('like')}}';
    </script>
    @endsection
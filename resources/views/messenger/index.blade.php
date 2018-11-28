@extends('layouts.messenger.master')

@section('title', 'Messenger')

@section('content')
    <div class="row row-offcanvas row-offcanvas-left">
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar">
            <h4><i class="fa fa-comments"></i> Conversations</h4>
            <hr>
            <messenger-search></messenger-search>
            <hr>
            <messenger-conversations></messenger-conversations>
        </div><!-- /.col-sm-3 -->
        <div class="col-xs-12 col-sm-9">
            <p class="visible-xs">
                <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">
                    <i class="fa fa-comments"></i>
                </button>
            </p>
            <div class="messenger-content">
                <messenger-conversation></messenger-conversation>

                <div class="message-form-wrapper">
                    <div class="message-form-inner-wrapper">
                        <messenger-editor></messenger-editor>
                    </div>
                </div>
            </div><!--  -->
        </div><!-- /.col-sm-9 -->
    </div><!-- /.row -->
@endsection

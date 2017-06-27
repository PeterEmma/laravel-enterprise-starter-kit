@extends('layouts.master')

@section('head_extra')
    <!-- jVectorMap 1.2.2 -->
    <link href="{{ asset("/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <script>
        $( function() {
          var availableTags = [
        
          @foreach($users as $user)   
          "{{ $user->first_name}}, {{$user->last_name}}",
          @endforeach
           ""];

           availableTags.splice(0,0,' ');
          
          $(".select-add-tags").select2({
            data: availableTags,
            tags:false,
            theme: "bootstrap",
            minimumResultsForSearch: Infinity,
          });
        });
    </script>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-3">
          <a href="../inbox" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Memo</h3>
              <div class='box-tools'>
                <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li id="inbox_left_li"><a href="../inbox"><i class="fa fa-inbox"></i> Inbox <span id="inbox_left" class="label label-primary pull-right"></span></a></li>
                <li><a href="../sent"><i class="fa fa-envelope-o"></i> Sent</a></li>
                <li><a href="../trash"><i class="fa fa-trash-o"></i> Trash</a></li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /. box -->
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Labels</h3>
              <div class='box-tools'>
                <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
              </div>
            </div><!-- /.box-header -->
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="../dashboard"><i class="fa fa-circle-o text-red"></i> Dashboard</a></li>
                <li><a href="../viewall"><i class="fa fa-circle-o text-yellow"></i> Activity Timeline</a></li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
                    <div class="content-wrapper">
        <!-- Content Header (Page header) -->

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Read Mail</h3>
                  <div class="box-tools pull-right">
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Previous"><i class="fa fa-chevron-left"></i></a>
                    <a href="#" class="btn btn-box-tool" data-toggle="tooltip" title="Next"><i class="fa fa-chevron-right"></i></a>
                  </div>
                </div><!-- /.box-header -->
				 @foreach($memos as $memo)
                <div class="box-body no-padding">
                  <div class="mailbox-read-info">
                    <h3>{{ $memo->subject}}</h3>
                    <h5>From: {{ $memo->emailfrom}} <span class="mailbox-read-time pull-right">{{ date('l jS \of F Y h:i:s A', strtotime($memo->created_at )) }}</span></h5>
                  </div><!-- /.mailbox-read-info -->
                  <div class="mailbox-controls with-border text-center">
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm" data-toggle="tooltip" title="Print"><i class="fa fa-print"></i></button>
                  </div><!-- /.mailbox-controls -->
                  <div class="mailbox-read-message">
                    <p>{{ $memo->message}}</p>
                  </div><!-- /.mailbox-read-message -->
                </div><!-- /.box-body -->
				@endforeach
               
                <div class="box-footer">
                  <div class="pull-right">
                  </div>
                  <button class="btn btn-default"><i class="fa fa-trash-o"></i> Delete</button>
                  <button class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                </div><!-- /.box-footer -->
              </div><!-- /. box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      </div><!-- /.row -->
    </section><!-- /.content -->
@endsection


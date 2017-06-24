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
          "{{ $user->email}}",
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
          <a href="inbox" class="btn btn-primary btn-block margin-bottom">Back to Inbox</a>
          <div class="box box-solid">
            <div class="box-header with-border">
              <h3 class="box-title">Folders</h3>
              <div class='box-tools'>
                <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li><a href="inbox"><i class="fa fa-inbox"></i> Inbox <span class="label label-primary pull-right">12</span></a></li>
                <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
                <li><a href="#"><i class="fa fa-file-text-o"></i> Drafts</a></li>
                <li><a href="#"><i class="fa fa-filter"></i> Junk <span class="label label-warning pull-right">65</span></a></li>
                <li><a href="#"><i class="fa fa-trash-o"></i> Trash</a></li>
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
                <li><a href="dashboard"><i class="fa fa-circle-o text-red"></i> Dashboard</a></li>
                <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Activity Timeline</a></li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
        <div class="col-md-9">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Compose New Message</h3>
            </div><!-- /.box-header -->
			<form action="store_memo" method="post" enctype="multipart/form-data">
            <div class="box-body">
			<input type="hidden" name="email_name" value="{{ Auth::user()->email }} {{ Auth::user()->last_name }}">
			<input type="hidden" name="emailfrom" value="{{ Auth::user()->email }}">

            <div class="form-group pmd-textfield pmd-textfield-floating-label"> 
                <label>To:</label>      
              <select id="forward_to_user" class="select-add-tags form-control pmd-select2-tags" name="emailto[]" multiple="multiple" placeholder="Recipient Email..."></select>
            </div>

              <!--<div class="form-group">
                <input class="form-control" name="emailto" placeholder="To:"/>
              </div>-->
              <div class="form-group">
                <input class="form-control" name="subject" placeholder="Subject:"/>
              </div>
              <div class="form-group">
                <textarea id="compose-textarea" class="form-control" name="message" placeholder="Message" style="height: 300px">
                  
                </textarea>
              </div>
			  <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div><!-- /.box-body -->
            <div class="box-footer">
              <div class="pull-right">
                <button class="btn btn-default"><i class="fa fa-pencil"></i> Draft</button>
                <button type="submit" id="send_memo" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              <button class="btn btn-default"><i class="fa fa-times"></i> Discard</button>
            </div><!-- /.box-footer -->
			</form>
          </div><!-- /. box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
@endsection


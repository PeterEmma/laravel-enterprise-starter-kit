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
            
            ""
           ];

           // availableTags.splice(0,0,' ');
          $(".select2").select2({
            data: availableTags,
            tags:false,
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
              <h3 class="box-title">Memo</h3>
              <div class='box-tools'>
                <button class='btn btn-box-tool' data-widget='collapse'><i class='fa fa-minus'></i></button>
              </div>
            </div>
            <div class="box-body no-padding">
              <ul class="nav nav-pills nav-stacked">
                <li id="inbox_left_li"><a href="inbox"><i class="fa fa-inbox"></i> Inbox <span id="inbox_left" class="label label-primary pull-right"></span></a></li>
                <li><a href="sent"><i class="fa fa-envelope-o"></i> Sent</a></li>
                <li><a href="trash"><i class="fa fa-trash-o"></i> Trash</a></li>
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
                <li><a href="viewall"><i class="fa fa-circle-o text-yellow"></i> Activity Timeline</a></li>
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

            <div class="form-group"> 
                <label>To:</label>      
              <select id="forward_to_user" class="form-control select2" name="emailto[]" multiple="multiple" placeholder="Recipient Email..."></select>
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
                <button type="submit" id="" class="btn btn-primary"><i class="fa fa-envelope-o"></i> Send</button>
              </div>
              	</form>
                <center>
            <div style="width:350px" align="center">
                <div id='preview'></div>    
                <form id="image_upload_form" method="post" enctype="multipart/form-data" action='file-upload/image_upload.php' autocomplete="off">
                    <div class="browse_text">Browse Image File:</div>
                    <div class="file_input_container">
                    <!-- <div class="btn btn-default btn-file upload_button"><i class="fa fa-paperclip"></i> Attachment<input type="file" name="photo" id="photo" class="file_input" /></div>-->
                        <div class="upload_button"><input type="file" name="photo" id="photo" class="file_input" /></div>
                    </div><br clear="all">
                </form>
            </div>
        </center>
            </div><!-- /.box-footer -->
		
          </div><!-- /. box -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
@endsection


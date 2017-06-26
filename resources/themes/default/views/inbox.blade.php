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
          <a href="compose" class="btn btn-primary btn-block margin-bottom">Compose</a>
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
                <li><a href="#"><i class="fa fa-envelope-o"></i> Sent</a></li>
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
                <li><a href="viewall"><i class="fa fa-circle-o text-yellow"></i> Activity Timeline</a></li>
              </ul>
            </div><!-- /.box-body -->
          </div><!-- /.box -->
        </div><!-- /.col -->
               <div class="col-md-9">
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">Inbox</h3>
                  <div class="box-tools pull-right">
                    <div class="has-feedback">
                      <input type="text" class="form-control input-sm" placeholder="Search Mail"/>
                      <span class="glyphicon glyphicon-search form-control-feedback"></span>
                    </div>
                  </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                     
                      <div class="btn-group">
                        <?php echo $memos->render(); ?>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                  <div class="table-responsive mailbox-messages">
                    <table class="table table-hover table-striped">
                      <tbody>
					   @foreach($memos as $memo)
						
                        <tr>
                          <td><input type="checkbox" /></td>
                          <a href="read_memo/{{ $user->id }}">						  
                          <td class="mailbox-name"><a href="read-mail.html">{{ $memo->emailfrom}}</a></td>
                          <td class="mailbox-subject"><b>{{ $memo->subject}}</b> | {{ $memo->message}}</td>
                          <td class="mailbox-attachment"></td>
                          <td class="mailbox-date">{{ date('F d, Y', strtotime($memo->created_at )) }}</td>
                          </a>
                        </tr>
						
						@endforeach
                      </tbody>
                    </table><!-- /.table -->
                  </div><!-- /.mail-box-messages -->
                </div><!-- /.box-body -->
                <div class="box-footer no-padding">
                  <div class="mailbox-controls">
                    <!-- Check all button -->
                    <button class="btn btn-default btn-sm checkbox-toggle"><i class="fa fa-square-o"></i></button>                    
                    <div class="btn-group">
                      <button class="btn btn-default btn-sm"><i class="fa fa-trash-o"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-reply"></i></button>
                      <button class="btn btn-default btn-sm"><i class="fa fa-share"></i></button>
                    </div><!-- /.btn-group -->
                    <button class="btn btn-default btn-sm"><i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                    
                      <div class="btn-group">
                        <?php echo $memos->render(); ?>
                      </div><!-- /.btn-group -->
                    </div><!-- /.pull-right -->
                  </div>
                </div>
              </div><!-- /. box -->
            </div><!-- /.col -->
      </div><!-- /.row -->
    </section><!-- /.content -->
@endsection


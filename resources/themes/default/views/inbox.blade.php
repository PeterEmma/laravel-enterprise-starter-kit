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
                  <h3 class="box-title">Inbox</h3>

                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  
                  <div class="container table-responsive mailbox-messages" style="width:97%;">	
                      <div class="row">
                        <table id="example" class="display" width="100%" cellspacing="0">
                          <thead>
                              <tr>
                                  <th>emailfrom</th>
                                  <th>subject</th>
                                  <th>message</th>
                              </tr>
                          </thead>       
                      </table>	
                    </div>		
                  </div>
                </div><!-- /.box-body -->
                
              </div><!-- /. box -->
            </div><!-- /.col -->
      </div><!-- /.row -->
      


    <script>
      $( document ).ready(function() {	
      var table = $('#example').DataTable( {
        "ajax": "dataphp",
        "bPaginate":true,
        "bProcessing": true,
        "pageLength": 8,
        "columns": [
          { mData: 'emailfrom' } ,
          { mData: 'subject' },
          { mData: 'message' }
        ],
        columnDefs: [
            {
                targets: [ 0, 1, 2 ],
                className: 'mdl-data-table__cell--non-numeric'
            }
        ]
      });	
      setInterval( function () {
        table.ajax.reload(null, false);
      }, 10000 );	
    });

</script>



  </section><!-- /.content -->
@endsection


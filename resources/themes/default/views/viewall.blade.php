@extends('layouts.master')

@section('head_extra')
    <!-- jVectorMap 1.2.2 -->
    <link href="{{ asset("/bower_components/admin-lte/plugins/jvectormap/jquery-jvectormap-1.2.2.css") }}" rel="stylesheet" type="text/css" />  
    @include('partials._head_extra_jstree_css')
    @include('partials._head_extra_select2_css')
@endsection

@section('content')

  <style type="text/css">
    #read-time{
      color:  tomato;
    }
    .box-footer{
      
    }
    .mailbox-attachment-icon{
      width:200px !important;
      height:105px !important;
      background-color: #efe;
    }
    .mailbox-attachment-info{
      width: 200px !important;
      height: 70px;
    }
    #activity-timeline{
      margin-top: -15px !important;
    }
  </style>
  <script>
    $( function() {
      var availableTags = [
          @foreach($users as $user)   
             "@if($user->position){{$user->position}} - @endif {{ $user->first_name }}, {{$user->last_name}}",
          @endforeach
          ""
        ];

      availableTags.splice(0, 0,'Select Recipient');
      
      $(".select-with-search").select2({
        data: availableTags,
        placeholder: "Select Recipient",
        theme: "bootstrap",
        minimumResultsForSearch: Infinity
      });
    });
  </script>

  <style type="text/css">
    .column{margin-top: -10px; float: right; }
  </style>
 
    <div class='row pull right'>
      <div class="pull right">
        <div class='col-md-6'>
            <!-- SERVER HEALTH REPORT -->
		<div id="activity-timeline" class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title"><b>MyActivity Timeline</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
                @foreach($activity as $activity_by)
        @if($activity_by->activity_by == Auth::user()->email || Auth::user()->username)
                    <li>                     
                      <small>{{ $activity_by->activity }}
                      <i class="fa fa-clock-o"></i>
           <b>{{ date('F d, Y', strtotime($activity_by->created_at )) }}</b></small>
                      </li>
                      
               @endif
        @endforeach
        
              </ul>
<?php echo $activity->render(); ?>
   </div><!-- /.box-body -->
        </div><!-- /.box -->   
      <!-- PROJECT STATUS -->
      </div><!-- /.col md-->


              <div class='col-md-5'>
            <!-- SERVER HEALTH REPORT -->
          <div id="activity-timeline" class="box box-primary">
            <div class="box-header">
              <i class="ion ion-clipboard"></i>
              <h3 class="box-title"><b>MYActivity on Folder</b></h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <ul class="todo-list">
                @foreach($folderactivity as $activity_by)
        @if($activity_by->activity_by == Auth::user()->email || Auth::user()->username)
                    <li>                     
                      <small>{{ $activity_by->activity }}
                      <i class="fa fa-clock-o"></i>
           <b>{{ date('F d, Y', strtotime($activity_by->created_at )) }}</b></small>
                      </li>
                      
               @endif
        @endforeach
              </ul>
               <div class="box-footer text-center">
                  <?php echo $folderactivity->render(); ?>
                </div><!-- /.box-footer -->
            </div><!-- /.box-body -->
            </div><!-- /.box -->   
      <!-- PROJECT STATUS -->
      </div><!-- /.col md-->
      </div>  

    
      </div><!-- /.row -->

    {{-- <script>
    // Work on this later. Fix like on Linked in
    // http://jsfiddle.net/FDv2J/1913/
    // https://css-tricks.com/scroll-fix-content/
    // https://forums.digitalpoint.com/threads/stop-scrolling-div-before-footer.2751269/
      // $(document).scroll(function(){
      //   $('.main-header').css('position', 'fixed');
      // }).mouseup(function(){
      //   $('.navbar').css('position', 'absolute');
      // }).keyup(function(){
      //   $('.navbar').css('position', 'relative');
      // });     
   //</script> --}}
@endsection
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
      
    }
    .box-footer{
      
    }
    .mailbox-attachment-icon{
      width:200px !important;
      height:105px !important;
     /* background-color: #efe;*/
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
            "{{ $user->first_name }}, {{ $user->last_name }}",
         @endforeach
         ""
       ];
       // @if($user->position){{$user->position}} - @endif

      //availableTags.splice(0, 0,'Select Recipient');

      $(".js-parents").select2();
      $(".select-with-search").select2({
        theme: "bootstrap",
        placeholder: "Select Recipient",
        //minimumInputLength: 3,
        allowClear: true,
        data: availableTags,
        tags: false
      });
   })
 </script>

  <style type="text/css">
    .column{margin-top: -10px; float: right; }
  </style>

  {{-- <script type="text/javascript" src="file-upload/scripts/jquery.min.js"></script> --}}
  <script type="text/javascript" src="{{ asset("file-upload/scripts/jquery.form.js") }}"></script>
  <script type="text/javascript" src="{{ asset("file-upload/scripts/upload.js") }}"></script>
  <link type="text/css" rel="stylesheet" href="{{ asset("file-upload/style.css") }}" />

  <script type="text/javascript" src="{{ asset("bower_components/admin-lte/plugins/moment/moment.min.js") }}"></script>
  
    <div class='row'>
  
  <div class='col-md-3 pull-left'> <!-- left hand div -->
	  <!-- USERS LIST -->
	<div class="box box-primary"> <!-- department div-->
	  <div class="box-header with-border">
		  <!-- @cpnwaugha: c-e: here we will allow users see the other users in their department
			and admin and registry see all the users that are in the system.
		  -->
		   {{--@unless(Auth::user()->isRoot()) --}}
			<h3 class="box-title">Department: {{ Auth::user()->department }}</h3>
		   {{--@endunless --}}
		  <div class="box-tools pull-right">
			  {{-- auto fetch the users in the department--}}
			  <span class="label label-primary"><label id='users_online'>15</label>users online</span> {{-- The span is to be auto generated --}}
			  <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
			  {{-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
		  </div>
	  </div><!-- /.box-header -->
	  <div class="box-body no-padding">
		<ul class="users-list clearfix">
		  @foreach($users as $user)
			@if($user->department == Auth::user()->department)
			  <li>
				{{--<img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/> --}}
				<img src="img/profile_picture/photo/{{ $user->avatar }}" class="offline" style="width: 52px; height: 52px; top: 10px; left: 10px; border-radius: 50%;" alt="User Image"/>
				<a class="users-list-name" href="">{!! link_to_route('admin.users.show', $user->full_name, [$user->id], []) !!}</a>
				{{-- <span class="users-list-date">{{ $user->created_at }}</span> --}}
			  </li>
			@endif
		  @endforeach
		</ul><!-- /.users-list -->
	  </div><!-- /.box-body -->
	  <div class="box-footer text-center">
		  <a href="javascript::viewall" class="uppercase">View All Users</a>
	  </div><!-- /.box-footer -->
	</div>
	<!-- BROWSER USAGE -->
		<!-- TO DO List -->
		<div id="activity-timeline" class="box box-primary">
			<div class="box-header">
				<i class="ion ion-clipboard"></i>
				<h3 class="box-title">Activity Timeline</h3>
				<div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
					{{-- <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button> --}}
				</div>
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
			</div><!-- /.box-body -->
			<div class="box-footer text-center">
				<a href="viewall" class="uppercase">View All Activity</a>
			</div><!-- /.box-footer -->
		</div><!-- /.box -->        
	</div><!-- /.col  end left div -->

    <!--<div class='row pull-right'> -->
	<div class='col-md-9 pull-right'> <!-- right hand div -->
    
		<?php $loopindex = 0; ?>
		
		@foreach($folder as $user)

			<?php $loopindex++; ?>
		<div class='container-fluid'> <!-- external panel -->
		  <div class="col-md-9"> <!-- pull right col-md-9 div for pdf view + comment + forward, and file activity -->
			
				<!-- SERVER HEALTH REPORT -->
				<!-- MAP & BOX PANE {{ substr($user->fold_name, 3) }} -->
			  <div class="box box-primary"> <!-- div for pdf view -->
					<div class="box-body no-padding">
					  <div class="mailbox-read-info">
						<h3>File Name: <b>{{ $user->fold_name }}</b></h3>
						<h5>From: {{ $user->folder_by }} <i class="fa fa-user"></i> <span id="read-time" class="mailbox-read-time pull-right">{{ date('F d, Y', strtotime($user->created_at)) }}</span></h5>
					  </div><!-- /.mailbox-read-info getFullNameAttribute() pdf header -->
					 
					  <div class="mailbox-read-message">        
						<object data="/docs/files/1/{{ $user->fold_name }}/{{ $user->latest_doc }}" type="application/pdf" style="width: 100%" height="450">
						  <!-- support older browsers -->
						  <!-- <embed src="uploads/C_TAW12_731.pdf" type="application/pdf" width="900" height="500"/> -->
						  <!-- For those without native support, no pdf plugin, or no js -->
						  <p>It appears you do not have PDF support in this web browser. <a href="/docs/files{{ $user->fold_name }}/{{ $user->latest_doc }}" target="_blank">Click here to download the document.</a></p>
						</object>
					 
					  </div><!-- /.mailbox-read-message -->
					</div><!-- /.box-body first pdf view-->
					<div class="box-footer">
					  <ul class="mailbox-attachments clearfix">
						@foreach($file as $folder_id)
						  @if($folder_id->folder_id == $user->id)
							<li>
							  <a href="/docs/files{{ $user->fold_name }}/{{ $folder_id->name }}" class="mailbox-attachment-name"></a>
							  <span class="mailbox-attachment-icon"><i class="fa fa-file-pdf-o"></i>
							  </span>
							  <div class="mailbox-attachment-info">
								<i class="fa fa-paperclip"></i> {{ $folder_id->name }}<br/> <!-- </a> -->
								<span class="mailbox-attachment-size">
								  {{ $folder_id->created_at }}
								  <a href="#" class="btn btn-default btn-xs pull-right">{{--<i class="fa fa-cloud-download"></i>--}}</a>
								</span>
							  </div>
							</li>
						  @endif
						@endforeach
					  </ul>
					</div> <!-- end box-footer for other pdfs attachment -->
				
					<div class="box"> <!-- div for comment header-->
						<div class="box-header"> 
						  <i class="fa fa-comments-o"></i>
						  <h3 class="box-title">Comments</h3>
					  </div>
					  <div class="box-footer" id="chat-box">
						<!-- chat item -->
						<!-- chat item -->
							<center>
								<div style="width:350px" align="center">
									<div id='preview'></div>    
									<form id="image_upload_form" method="post" enctype="multipart/form-data" action='file-upload/image_upload.php' autocomplete="off">
										<div class="browse_text">Attach new File:</div>
										<div class="file_input_container">
											<div class="upload_button"><input type="file" name="photo" id="photo" class="file_input" /></div>
										</div><br clear="all">
									</form>
								</div>
							</center>
						</div> <!-- end of attach file -->
					</div>
			
				
				  <!-- chat item -->
				<div class='chat'>
					<div id="reload_comment{{$loopindex}}" class="divcomment">	<!-- comment on file -->
					  @foreach($comments as $comment)
						@if($comment->folder_id == $user->id)
						  <div class="item">
						  <!-- @cpnwaugha: c-e: Fetching the user's image. Change to fetch uploaded image -->
						  {{--<img src="{{ Gravatar::get(Auth::user()->email), 'tiny'}}" class="offline" alt="User Image"/>--}}
						  <img src="img/profile_picture/photo/{{ Auth::user()->avatar }}" class="offline" style="width: 42px; height: 42px; top: 10px; left: 10px; border-radius: 50%;" alt="User Image"/>
						  <!--<img src="{{ asset("/bower_components/admin-lte/dist/img/user2-160x160.jpg") }}" alt="user image" class="offline"/>-->
						  <p class="message">
							<a href="#" class="name"> <!-- @cpnwaugha: c-e: comments to have date and time -->
							<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> {{ date('M d, Y', strtotime($comment->created_at)) }}</small> 
							{{ $comment->comment_by }}
							</a>
							{{ $comment->comment }}
						  </p>
						  </div>
						@endif
					  @endforeach
					</div> 
				</div> <!-- end div comment -->

				<script>
				  $(function(){

					$.ajaxSetup({
					  headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') }
					});
			
					$(document).on('click', "button#submitPostBtn{{$loopindex}}", function(e){
					  e.preventDefault();
					  e.stopPropagation();

					  var folder_id = $("#folder_id{{$loopindex}}").val();
					  var comment_by= $("#comment_by{{$loopindex}}").val();
					  var activity  = $("#activity{{$loopindex}}").val();
					  var comment   = $("#comment{{$loopindex}}").val();
					  var formData  = $("#commentForm{{$loopindex}}").serialize();
					  var data = formData; // {comment: comment, comment_by: comment_by, folder_id: folder_id, activity: activity, '_token': $('input[name=_token]').val()};

					  $("#comment{{$loopindex}}").val('');

					  created_at = moment().format('ll'); //moment().startOf('hour').fromNow();  // an hour ago
							
					  var renderComment = `
						<div class="item">
						  <img src="img/profile_picture/photo/{{ Auth::user()->avatar }}" class="offline" style="width: 42px; height: 42px; top: 10px; left: 10px; border-radius: 50%;" alt="User Image"/>
						  <p class="message">
							<a href="#" class="name"> 
							<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> ${created_at}</small> 
							${comment_by }
							</a>
							${comment}
						  </p>
						</div>
					  `;
					  
					  $("#reload_comment{{$loopindex}}").append(renderComment); 

					  $.ajax({
						  url:"ajaxcomment",
						  method:"GET",
						  dataType:"json",
						  data: data,
						  success:function(returnData)
						  {
							console.log('Good, comment added to database.');
						  },
						  error:function()
						  {
							console.log('Bad, not connected');
						  }
					  });

					  $.toast({
							heading: 'File comment',
							text: 'New comment added to file',
							icon: 'success',
							bgColor: '#E01A31',
							hideAfter: 5000,
							showHideTransition: 'slide',
							loader: false,        // Change it to false to disable loader
							loaderBg: '#9EC600'  // To change the background
						});
					});
				  })
			  </script>
		  <!--</div> --><!-- end div chat-box -->

			<div><!-- div comment: Form to receive user's comment.-->
				<form action="comment" id="commentForm{{$loopindex}}" class='commentFormClass' method="post" enctype="multipart/form-data">
				  <input type="hidden" id="comment_by{{$loopindex}}" name="comment_by" value="{{ Auth::user()->email }}">
				  <input type="hidden" id="folder_id{{$loopindex}}" name="folder_id" value="{{ $user->id }}">
				  <input type="hidden" id="activity{{$loopindex}}" name="activity" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} Comment on {{ substr($user->fold_name, 3) }}">
				  <input type="hidden" name="_token" value="{{ csrf_token() }}">
				  <div class="box-footer">
					<div class="input-group">
					  <input class="form-control" id="comment{{$loopindex}}" name="comment" placeholder="Type message..."/>
					  <div class="input-group-btn">
						  <button id="submitPostBtn{{$loopindex}}" class="btn btn-primary commentrefresh"><i class="fa fa-plus"> Post</i></button>
					  </div>
					</div>
				  </div>
				</form>
			</div> <!-- end div -->
		
			<div class="box-footer"> <!--div forward file -->
			  <form action = "/update/8" method = "post">
				<input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">
				<div class="form-group">
				   <label><b>Enter Recipient Email:</b></label>               
				  <div class="input-group">
					<input type="hidden" name="comment_by" value="{{ Auth::user()->email }}">
					<input type="hidden" name="activity" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }} Forward this file: {{ substr($user->fold_name, 3) }} to ">
					<input type="hidden" name="fold_name" value="{{ $user->fold_name}}">  
					
					{{-- <div class="form-group pmd-textfield pmd-textfield-floating-label">
					  <label>Enter Recipient Email:</label>         
					  <input id="" class="form-control" name="share-input" placeholder="Recipient Email...">
					</div> --}}

					<div class="form-group pmd-textfield pmd-textfield-floating-label">       
					 <select id="forward_to_user" class="select-with-search form-control select2" name="share-input" placeholder="Recipient Email..."></select>
				   </div> 
					  <div class="input-group-btn">
						<button id='forwardBtn' class="btn btn-success"><i class="fa fa-share"></i> Forward</button>
					  </div>
				  </div>                   
				</div>
			  </form>
			</div><!-- /.box-footer --> <!--div forward file -->
				  
			</div> <!-- div for pdf view -->	  <!-- Main content -->
		
		  <!-- PROJECT STATUS -->
		</div><!-- /.col md-->
		
		<div class='col-md-3'>
			<div id="activity-timeline" class="box box-primary">
				<div class="box-header">
				  <i class="fa fa-folder-open-o"></i>
				  <h3 class="box-title">File Movement</h3>
				  <div class="box-tools pull-right">
					<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
				  </div>
				</div><!-- /.box-header -->
				<div class="box-body">
				  <ul class="todo-list">
					@foreach($activity as $folder_id)
						@if($folder_id->folder_id == $user->id)
							<li> 
								{{ $folder_id->activity }}                    
								<small class="label label-info"> 
								<i class="fa fa-clock-o"></i>
								<b>{{ date('F d, Y', strtotime( $folder_id->created_at )) }}</b></small>
							</li>             
						@endif
					@endforeach
				  </ul>
				</div><!-- /.box-body -->
			</div><!-- /.box -->        
		</div><!-- /.col -->
	</div><!-- /.container fluid -->
	@endforeach
		
    </div> <!-- end right div -->
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
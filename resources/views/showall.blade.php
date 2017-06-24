


<html>
    <head>
        <title>File Update</title>
    </head>
    <body>
        <form action="edit" method="post" enctype="multipart/form-data">
		<img src="{{asset($user->name)}}" alt="" width="100">
		<label for="name">name</label>
		<input type="text" name="name" value=""></br>
		
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<input type="submit" name="submit" value="Submit">
		
		</form>
    </body>
</html>



<!DOCTYPE html>
<html>
    <head>
        <title>Show all</title>
    </head>
    <body>
	
	@foreach ($user as $users)
         <tr>
            <td>{{ $users->id }}</td>
            <td>{{ $users->name }}</td>
            <td><a href = 'edit/{{ $users->id }}'>Edit</a></td>
         </tr>
         @endforeach
		 
		 
		 
		 </br>
		 
		 
		 
        @foreach($user as $users)
		{{ $users->title }}
		<img src="{{$users->name}}" alt="" width="100">
		@endforeach
    </body>
</html>

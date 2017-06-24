<!DOCTYPE html>
<html>
    <head>
        <title>Create</title>
    </head>
    <body>
        <form action="store" method="post">
		<label for="filename"></label>
		<input type="text" name="filename" value="">
		<input type="text" name="doc_name" value="">
		
		<input type="hidden" name="_token" value="{{ csrf_token() }}">
		
		<input type="submit" name="submit" value="Submit">
		
		</form>
    </body>
</html>

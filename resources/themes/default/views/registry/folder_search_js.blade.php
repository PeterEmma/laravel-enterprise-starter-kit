<script>
    $(function(){
		$.get('scan_dir', function(data) {

			console.log(data);
			$('.search').click(function(){
				var search = $(this);

				search.find('span').hide();
				search.find('input[type=search]').show().focus();
			});
		});

	})

</script>
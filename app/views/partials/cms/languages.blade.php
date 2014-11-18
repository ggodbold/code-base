{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}

<div class="form-group">
	{{ Form::label('language', 'Language') }}
	{{ Form::select('language', $viewModel->languages, null, array('class' => 'form-control')) }}
	
</div>

<div class="form-group text-right button-group">
	{{ Form::button('Edit', array('Class' => 'btn btn-primary edit', 'Disabled' => 'Disabled')) }}
	{{ Form::button('New', array('Class' => 'btn btn-success new')) }}
	{{ Form::button('Delete', array('Class' => 'btn btn-danger delete', 'Disabled' => 'Disabled')) }}
</div>

{{ Form::close() }}

<script>
	$(document).ready( function() {
		$('#language').change( function() {
			DropDownContentLoader('pages', '/cms/pages/' + $('#language').val());
			SetButtonStatus('#languages', '#language'); // section id, dropdown id
			DropDownContentLoader('sections', '/cms/sections/0', true);
		});
	});
</script>
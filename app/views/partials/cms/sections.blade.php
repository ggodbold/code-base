<hr>

{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}

<div class="form-group">
	{{ Form::label('section', 'Section') }}
	{{ Form::select('section', $viewModel->sections, null, array('class' => 'form-control')) }}
</div>

<div class="form-group text-right button-group">
	{{ Form::button('Edit', array('class' => 'btn btn-primary edit', 'Disabled' => 'Disabled')) }}
	{{ Form::button('New', array('class' => 'btn btn-success new')) }}
	{{ Form::button('Delete', array('class' => 'btn btn-danger delete', 'Disabled' => 'Disabled')) }}
</div>

{{ Form::close() }}

<script>
	$(document).ready( function() {
	   	$('#section').on('change', function() {
	   		SetButtonStatus('#sections', '#section'); // section id, dropdown id
	   	});
	});
</script>
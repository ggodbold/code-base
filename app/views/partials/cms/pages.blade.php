<hr>

{{ Form::open(array('class' => 'form-horizontal', 'role' => 'form')) }}

<div class="form-group">
	{{ Form::label('page', 'Page') }}
	{{ Form::select('page', $viewModel->pages, null, array('class' => 'form-control')) }}
</div>

<div class="form-group text-right button-group">
	{{ Form::button('Edit', array('Class' => 'btn btn-primary edit', 'Disabled' => 'Disabled')) }}
	{{ Form::button('New', array('Class' => 'btn btn-success new')) }}
	{{ Form::button('Delete', array('Class' => 'btn btn-danger delete', 'Disabled' => 'Disabled')) }}
</div>

{{ Form::close() }}

<script>
	$(document).ready( function() {
		$('#page').on('change', function() {
			DropDownContentLoader('sections', '/cms/sections/' + $('#page').val());
			SetButtonStatus('#pages', '#page'); // section id, dropdown id
		});
	});
</script>
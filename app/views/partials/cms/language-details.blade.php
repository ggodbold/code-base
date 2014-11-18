{{ Form::open(array('role' => 'form', 'id' => 'language-details', 'class' => 'form-horizontal')) }}

<div id="errors" class="alert alert-danger"></div>

<div class="form-group">
	{{ Form::label('name', 'Name') }}
	{{ Form::text('name', $viewModel->languageDetails->name, array('class' => 'form-control', 'id' => 'name')) }}
</div>

<div class="form-group">
	{{ Form::label('logo', 'Select a Logo') }}
	{{ Form::text('logo', $viewModel->languageDetails->logo_path, array('class' => 'form-control')) }}
</div>

{{ Form::hidden('language_id', $viewModel->languageDetails->id, array('id' => 'language_id')) }}
{{ Form::hidden('action', $viewModel->action, array('id' => 'action')) }}

<div class="text-right">
	{{ Form::button('Save', array('id' => 'save', 'class' => 'btn btn-success')) }}
	{{ Form::button('Revert', array('id' => 'revert', 'class' => 'btn btn-warning')) }}
</div>

{{ Form::close() }}

<script>
	$(document).ready(function() {
		$('#errors').hide();

		$('#revert').click(function() {
			@if( $viewModel->action == "New" )
				Delete('{{ $viewModel->deleteUrl }}', false)
			@endif

			bootbox.hideAll();
			$.notify("Changes abandoned!", "warn");
		});

		$('#save').click(function() {
			errors = Validate('languages');

			if(errors.length === 0) {
				Save('{{ $viewModel->saveUrl }}', $('form').serialize());
				DropDownContentLoader('{{ $viewModel->dropDownId }}', '{{ $viewModel->dropDownContentUrl }}')
				bootbox.hideAll();
				$.notify("Details saved!", "success");
			} else {
				$('#errors').html('<strong>You have the following errors: </strong><br>'); 
				$('#errors').append(errors.join('<br>'));  
				$('#errors').slideDown();
			}

		});
	});
</script>
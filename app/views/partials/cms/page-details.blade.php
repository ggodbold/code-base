{{ Form::open(array('role' => 'form', 'id' => 'page-details', 'class' => 'form-horizontal')) }}

<div id="errors" class="alert alert-danger"></div>

<div class="form-group">
	{{ Form::label('title', 'Title') }}
	{{ Form::text('title', $viewModel->pageDetails->title, array('class' => 'form-control', 'id' => 'title')) }}
</div>

{{ Form::hidden('page_id', $viewModel->pageDetails->id, array('id' => 'page_id')) }}
{{ Form::hidden('language_id', $viewModel->pageDetails->language_id, array('id' => 'language_id')) }}
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
			errors = Validate('pages');

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
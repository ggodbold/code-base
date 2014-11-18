{{ Form::open(array('role' => 'form', 'id' => 'section-details', 'class' => 'form-horizontal')) }}

<div id="errors" class="alert alert-danger"></div>

<div class="form-group">
	{{ Form::label('title', 'Title') }}
	{{ Form::text('title', $viewModel->sectionDetails->title, array('class' => 'form-control', 'id' => 'title')) }}
</div>

<div class="form-group">
	{{ Form::label('content', 'Content') }}
	{{ Form::textarea('content', $viewModel->sectionDetails->content, array('class' => 'form-control')) }}
</div>

<div class="form-group">
	{{ Form::label('section-type', 'Section Type') }}
	{{ Form::select('section-type', $viewModel->sectionTypes, $viewModel->sectionDetails->section_type_id,
		 array('class' => 'form-control', 'id' => 'section_type_id')) }}
</div>

{{ Form::hidden('section_id', $viewModel->sectionDetails->id, array('id' => 'section_id')) }}
{{ Form::hidden('page_id', $viewModel->sectionDetails->page_id, array('id' => 'page_id')) }}
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
			errors = Validate('sections');

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
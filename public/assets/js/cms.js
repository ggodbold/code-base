// delete content by calling correct restful controller with the correct id
function Delete(url, showMessage) {
	$.ajax({
		type: 'delete',
		url: url,
		async: false,
						   
		success: function(data) {
			if( data !== 'Success') {
				bootbox.dialog({
		        	title: 'An Error has occured',
        			message: data
    			});	
			}

			if(showMessage === true && data == 'Success') {
   				$.notify("Deletion Complete!", "warn");
			}
		},
		error: function(xhr, textStatus, thrownError) {
		    console.log('Something went to wrong.Please Try again later...');
		}
	});
}


// load dropdown box content via ajax and slide down to reveal
function DropDownContentLoader(section, url, hide) {
   	$('#' + section).load(url);
	$(document).ajaxComplete(function() {
		if( hide !== true ) {
			$('#' + section).slideDown();
		}
	});
}


// Show modal form for editing data and creating new records, the URL defines the action e.g. New or Edit
function EditOrNew(ajaxPageDisplayUrl, windowTitle, postData) {
	var ajaxData;
	// get update form
	$.ajax({
		url: ajaxPageDisplayUrl,
	    async: false,
	    type: "get",
	    data: postData, // only required for new records holds the id of the parent table
	          dataType: "json",
	    success: function(data) {
	    	ajaxData = data;
	    }
	});

	// display update form in modal window
	bootbox.dialog({
		closeButton: false,
        title: windowTitle,
        message: ajaxData
    });	

}


// Save data
function Save(url, formData) {
	$.ajax({
		type: 'put',
		url: url,
		data: formData,
		async: false,
						   
		success: function(data) {
		    console.log(data);
		},
		error: function(xhr, textStatus, thrownError) {
		    alert('Something went to wrong.Please Try again later...');
		}
	});
}

function Validate(section) {
	errors = [];

	if (section === 'languages') {
		if( $('#name').val() == '' ) {
			errors.push('You must supply a language name');
		}
	} else if (section === 'pages') {
		if( $('#title').val() == '' ) {
			errors.push('You must supply a page title');
		}
	} else if (section === 'sections') {
		if( $('#title').val() == '' ) {
			errors.push('You must supply a section title');
		}
		
		if( $('#content').val() == '' ) {
			errors.push('You must supply a section content');
		} 
	}
	return errors;
}

// disable buttons if no value is selected in the dropdown
function SetButtonStatus(sectionId, dropDownId) {
	if( $(sectionId + ' ' + dropDownId).val() == 0 ) {
		$(sectionId + ' .edit').attr('disabled','disabled');
		$(sectionId + ' .delete').attr('disabled','disabled');	
	} else {
		$(sectionId + ' .edit').removeAttr('disabled');
		$(sectionId + ' .delete').removeAttr('disabled');
	}
}




$(document).ready(function() {
	// initial page setup 
   	$.notify.defaults({globalPosition: 'bottom right'});

	DropDownContentLoader('languages', '/cms/languages');	
	
	$('#pages').hide();
	$('#sections').hide();



   	// language functions
	$(document).on("click", '#languages .edit', function() {
		EditOrNew('/cms/languages/' + $('#language').val() + '/edit', "Language Details", ""); 		
	});

	$(document).on("click", '#languages .new', function() {
		EditOrNew('/cms/languages/create', "Language Details", ""); 		
	});
	
	$(document).on("click", '#languages .delete', function() {
		Delete('/cms/languages/' + $('#language').val(), true); 
		DropDownContentLoader('languages', '/cms/languages');		
	});



	// page functions
	$(document).on("click", '#pages .edit', function() {
		EditOrNew('/cms/pages/' + $('#page').val() + '/edit', "Page Details", ""); 		
	});

	$(document).on("click", '#pages .new', function() {
		EditOrNew('/cms/pages/create', "Page Details", { languageId : $('#language').val() }); 		
	});
	
	$(document).on("click", '#pages .delete', function() {
		Delete('/cms/pages/' + $('#page').val(), true); 
		DropDownContentLoader('pages', '/cms/pages/'+ $('#language').val());		
	});




	// section functions
	$(document).on("click", '#sections .edit', function() {
		EditOrNew('/cms/sections/' + $('#section').val() + '/edit', "Section Details", { pageId : $('#page').val() }); 		
	});

	$(document).on("click", '#sections .new', function() {
		EditOrNew('/cms/sections/create', "Section Details", { pageId : $('#page').val() }); 		
	});

	$(document).on("click", '#sections .delete', function() {
		Delete('/cms/sections/' + $('#section').val(), true); 
		DropDownContentLoader('sections', '/cms/sections/' + $('#page').val());		
	});
});
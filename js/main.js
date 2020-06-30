// The root URL for the RESTful services
var rootURL = "http://localhost/event-manage/api/index";

var currentUser;

// Retrieve wine list when application starts 

// Nothing to delete in initial application state


// Register listeners


// Trigger search when pressing 'Return' on search key input field


$('#btnSave').click(function() {
	
		addUser();
	
});



function addUser() {
	console.log('addUser');
    debugger;
	$.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: 'http://localhost/event-manage/api/index.php?action=addUser',
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
			alert('User created successfully');
		      debugger;
			$('#username').val(data.username);
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('addUser error: ' + textStatus);
		}
	});
}


function renderDetails(user) {
	
	$('#username').val(user.name);
	$('#email').val(user.email);
	$('#password').val(user.password);
	$('#confirm_password').val(user.confirm_password);
	
}

// Helper function to serialize all the form fields into a JSON string
function formToJSON() {
	return JSON.stringify({
		
		"username": $('#username').val(), 
		"email": $('#email').val(),
		"password": $('#password').val(),
		"confirm_password": $('#confirm_password').val(),
		
		});
}

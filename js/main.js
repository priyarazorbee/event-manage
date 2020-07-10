// The root URL for the RESTful services
var rootURL = "http://localhost/event-manage/api";

var currentUser;

// Retrieve wine list when application starts 

// Nothing to delete in initial application state


// Register listeners


// Trigger search when pressing 'Return' on search key input field

$(document).ready(function() { 
	$("#signForm").submit(function(e){
		e.preventDefault();
        console.log('addUser');
    $.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: rootURL +'/file',
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
	});
    
   $("#loginForm").submit(function(e){
		e.preventDefault();
        console.log('seeUser'); 
   $.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: rootURL +'/login',
		dataType: "json",
		data: formToJSON(),
		success: function(data, textStatus, jqXHR){
			alert('User logged in successfully');
		      debugger;
			
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('seeUser error: ' + textStatus);
		}
	});
	}); 
});



function addUser() {
	console.log('addUser');
   $.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: 'http://localhost/event-manage/api/getUsers',
		dataType: "json",
		data: JSON.stringify({
		
		"username": $('#username').val(), 
		"email": $('#email').val(),
		"password": $('#password').val(),
		}),
		success: function(data, textStatus, jqXHR){
			alert('User created successfully');
		      debugger;
			
		},
		error: function(jqXHR, textStatus, errorThrown){
			alert('addUser error: ' + textStatus);
		}
	});
}

$("#upload").submit(function(e){
		var formData = new FormData($(this)[0]);

  $.ajax({
    url: rootURL +'/image',
    type: "POST",
    data: formData,
    success: function (msg) {
      alert(msg)
    },
    cache: false,
    contentType: false,
    processData: false
  });

  e.preventDefault();
});

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

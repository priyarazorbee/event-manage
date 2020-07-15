// The root URL for the RESTful services
var rootURL = "http://localhost/event-manage/api/";

var currentUser;


findById();


function findAll() {
	console.log('findAll');
	$.ajax({
		type: 'GET',
		url: rootURL,
		dataType: "json", // data type of response
		success: renderList
	});
}
function findById(id) {
	console.log('findById: ' + id);
	$.ajax({
		type: 'GET',
		url: rootURL + id,
		dataType: "json",
		success: function(data){
			$('#btnDelete').show();
			console.log('findById success: ' + data.name);
			currentImage = data;
			renderDetails(currentImage);
		}
	});
}

function renderList(data) {
	// JAX-RS serializes an empty list as null, and a 'collection of one' as an object (not an 'array of one')
	var list = data == null ? [] : (data.image instanceof Array ? data.image : [data.image]);

//	$('#imageList li').remove();
	$.each(list, function(index, data) {
		$('#imageList').append('<tr><td hidden>'+data.id+'</td><td>'+data.name+'</td><td>'+data.description+'</td><td>'+data.image+'</td><td><button onClick="findById('+data.id+');"><a href="edit.html">Edit</a></button></td></tr>');
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

var rootURL = "http://localhost/event-manage/api/";

var currentImage;


findAll();



$(document).ready(function() { 
	$("#signForm").submit(function(e){
		e.preventDefault();
        console.log('addUser');
    $.ajax({
		type: 'POST',
		contentType: 'application/json',
		url: rootURL +'file',
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
		url: rootURL +'login',
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
    url: rootURL +'image',
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
			
			console.log('findById success: ' + data.name);
			currentImage = data;
            var txt_name=document.getElementById("txt_name").value;
//			$('#txt_name').val(txt_name);
//	$('#description').val(description);
//	$('#action').val(action);
//	$('#txt_file').attr('src', 'api/upload/' + txt_file);
		}
	});
}

	
function renderList(data) {
	
	var list = data == null ? [] : (data.image instanceof Array ? data.image : [data.image]);

//	$('#imageList li').remove();
	$.each(list, function(index, data) {
		$('#imageList').append('<tr href="#" data-identity="' + data.id + '"><td class="center">'+data.name+'</td><td class="center">'+data.description+'</td><td class="center">'+data.action+'</td><td><img  class="img-thumbnail" style="width:20%;" src='+data.image+'></td><td><button class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" onClick="findById('+data.id+');">Edit</button></td></tr>');
	});
}
$('#imageList tr').live('click', function() {
	findById($(this).data('identity'));
});
function renderDetails(currentImage) {
	
	$('#txt_name').val(txt_name);
	$('#description').val(description);
	$('#action').val(action);
	$('#txt_file').attr('src', 'api/upload/' + txt_file);
	
}


function formToJSON() {
	return JSON.stringify({
		
		"username": $('#username').val(), 
		"email": $('#email').val(),
		"password": $('#password').val(),
		"confirm_password": $('#confirm_password').val(),
		
		});
}

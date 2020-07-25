<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<script src="js/jquery-1.12.4-jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
    
  </head>
<body>
    

    <nav class="navbar navbar-default navbar-static-top navbar-new">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href=""></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
  <div class="container">  
    <div class="sidenav" style="margin-top:15px;"><br>
  <a href="#about">Dashboard</a>
 
  <button class="dropdown-btn">Event 
    <i class="fa fa-caret-down"></i>
  </button>
  <div class="dropdown-container">
    <a href="#">Add</a>
    <a href="#">View</a>
   
  </div>
  <a href="#contact">Search</a>
</div>
  <div class="main">  
	
        
       <h1 >Welcome to the application</h1>
     

<table class="table table-bordered">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Description</th>
      <th scope="col"></th>
      <th scope="col"></th>
      <th scope="col"></th>  
        <th scope="col"></th>  
    </tr>
  </thead>
  <tbody id="imageList">
      
      </tbody>   
     </table> 
      
    </div>
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update file</h4>
        </div>
        <form method="post" class="form-horizontal" id="updateForm" enctype="multipart/form-data">
				<input  type="hidden" id="id" name="id" class="form-control" />	
				<div class="form-group">
				<label class="col-sm-3 control-label">Name</label>
				<div class="col-sm-6">
				<input type="text" id="txt_name" name="txt_name" class="form-control" placeholder="enter name" />
				</div>
				</div>
					
				<div class="form-group">
				<label class="col-sm-3 control-label">Description</label>
				<div class="col-sm-6">
				<input type="text" id="description"name="description" class="form-control" placeholder="enter Description" />
				</div>
				</div>
                
                <div class="form-group">
                 <label class="col-sm-3 control-label">Action</label>   
                
                  <div class="col-sm-6">   
                <select name="action" id="action" required="required">
                            <option value="1">Active</option>
                            <option value="2">In-Active</option>
                        </select>
                </div>   
                 </div>   
				<div class="form-group">
				<label class="col-sm-3 control-label">File</label>
				<div class="col-sm-6">
				<input type="file" id="txt_file" name="txt_file" class="form-control" accept="image/*"/>
				</div>
				</div>
                
				<div class="form-group">
				<div class="col-sm-offset-3 col-sm-9 m-t-15">
                <input type="hidden" name="_METHOD" value="PUT"/>
				<input type="submit"  name="btn_insert" class="btn btn-success" value="Insert">
				<a href="index.php" class="btn btn-danger">Cancel</a>
				</div>
				</div>
					
			</form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div> 
</div>
   <div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Delete file</h4>
        </div>
        <form method="delete" class="form-horizontal" id="deleteForm" enctype="multipart/form-data">
					
				<div class="form-group">
				Do you want to delete??
				</div>
					
				
                
               
                
				<div class="form-group">
			
                
				<input type="submit"  name="btn_insert" class="btn btn-success" value="Delete">
				<a href="index.php" class="btn btn-danger">Cancel</a>
				</div>
				
					
			</form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div> 
</div> 
</div>
  



<script src="js/jquery-1.7.1.min.js"></script>
<script src="js/main.js"></script>
<script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
  dropdown[i].addEventListener("click", function() {
  this.classList.toggle("active");
  var dropdownContent = this.nextElementSibling;
  if (dropdownContent.style.display === "block") {
  dropdownContent.style.display = "none";
  } else {
  dropdownContent.style.display = "block";
  }
  });
}
</script>
</body>
</html>
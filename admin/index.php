<?php include_once('../autoload.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Home</title>
<!-- Bootstrap -->
<link rel="stylesheet" href="<?php echo APP_PATH ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo APP_PATH ?>assets/css/mystyle.css">
</head>
<body>
<div class="container">
	<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand">Unicremind</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a href="#">About Us</a></li>
		<li><a href="#">Contact Us</a></li>
		<li><a href="#">Help</a></li>
      </ul>
    </div>
  </div>
</nav>
<div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading text-center"> <strong class="">Admin control panel</strong>

                </div>
                <div class="panel-body">
                    <div class="form-horizontal">
                    
            <form id="uploadfileform" method="post" enctype="multipart/form-data" onsubmit="return submitForm();">
            <div class="messages"></div>
            
            <div class="form-group">
                <label for="videoType" class="col-sm-3 control-label">Video Type <span class="required">*</span></label>
                <div class="col-sm-9">
                  <label class="radio-inline">
                  <input type="radio" name="videoType" value="1" checked>&nbsp;Movie
                  </label>
                  <label class="radio-inline">
                   <input type="radio" name="videoType" value="2">&nbsp;Advertisement</label>
                </div>
              </div>
                <div class="form-group"l id="language_sel">
                <label for="videoLang" class="col-sm-3 control-label">Language <span class="required">*</span></label>
                <div class="col-sm-9">
                  <select name="videoLang" id="videoLang" class="form-control input-sm">
                    <option value="">Select One</option>
                    <option value="1" selected>Hindi</option>
                    <option value="2">Tamil</option>
                    <option value="3">Kannada</option>
                    <option value="4">Malayalam</option>
                    <option value="5">Telugu</option>
                  </select>
                </div>
              </div>
              
              
              
              <div class="form-group">
                <label for="uploadFile" class="col-sm-3 control-label">Upload file <span class="required">*</span></label>
                <div class="col-sm-9">
                  <input name="file" id="uploadFile" type="file" class="form-control input-sm" />
                </div>
              </div>

              <!-- <div class="form-group">
                <label for="videoName" class="col-sm-3 control-label">File Name <span class="required">*</span></label>
                <div class="col-sm-9">
                  <input name="videoName" id="videoName" class="form-control input-sm" />
                </div>
              </div>
              
              <div class="form-group">
                <label for="videoDescription" class="col-sm-3 control-label">Description </label>
                <div class="col-sm-9">
                  <textarea name="videoDescription" id="videoDescription" class="form-control input-sm" /></textarea>
                </div>
              </div> -->

              <div class="form-group">
                <label for="uploadFile" class="col-sm-3 control-label"></label>
                <div class="col-sm-9">
                  <input type="submit" id="uploadbtn" value="Upload" class="btn btn-success btn-outline-rounded green">
                </div>
              </div>
              <div class="form-group text-center">                
                <div id="loadingDiv" style="display:none;">                 
                  <img src="<?php echo APP_PATH ?>assets/images/ajax_loader.gif"/>
                </div>
              </div>
                      </form>
                    </div>
                </div>
                <div class="panel-footer">
                  &nbsp;
                </div>
            </div>
        </div>
    </div>
    </div>
 </div> 	
<!-- Script -->
<script src="<?php echo APP_PATH ?>assets/js/jquery-1.11.3.js"></script>	
<script src="<?php echo APP_PATH ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo APP_PATH ?>assets/js/custom.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('input[type="radio"]').click(function(){
        var inputValue = $(this).attr("value");
        if(inputValue==1)
        {
          $('#language_sel').show();
        }
        if(inputValue==2)
        {
          $('#language_sel').hide();
        }
    });
});

  function submitForm() {
            //console.log("submit event");
            var fd = new FormData(document.getElementById("uploadfileform"));
            //fd.append("label", "WEBUPLOAD");
            $("#loadingDiv").css('display', '');
            $.ajax({
              url: "upload-handler.php",
              type: "POST",
              data: fd,
              processData: false,  // tell jQuery not to process the data
              contentType: false   // tell jQuery not to set contentType
            }).done(function( data ) {

                $("#loadingDiv").css('display', 'none');
                    var messageAlert = 'alert-' + data.type;
                    var messageText = data.message;
                    if (messageAlert && messageText) {
                        $('#uploadfileform').find('.messages').html(messageText);
                        $('#uploadfileform')[0].reset();
                    }
                //console.log("PHP Output:");
                //console.log( data );
            });
            return false;
        }
</script>
</body>
</html>
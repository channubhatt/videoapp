<?php include_once('common/header.php'); ?>
  <form name="language_selection" method="post" action="">
  <input type="hidden" name="MethodName" value="FormPost">
  <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-heading text-center"> <strong class="">Select language for movie</strong>
                </div>
                <div class="panel-body">
                    <div class="form-horizontal">                     
                          <div class="form-group">
                <label for="videoLang" class="col-sm-3 control-label">Language </label>
                <div class="col-sm-9">
                  <select id="videoLang" class="form-control" name="LanguageSelection">
                    <option value="">Select One</option>
                    <option value="1">Hindi</option>
                    <option value="2">Tamil</option>
                    <option value="3">Kannada</option>
                    <option value="4">Malayalam</option>
                    <option value="5">Telugu</option>
                  </select>
                </div>
              </div>
              <div class="form-group text-center">
                  <input type="Submit" name="submit" value="Submit" class="btn btn-success btn-outline-rounded green">
                
              </div>
                    </div>
                </div>
                <div class="panel-footer">
                  &nbsp;
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
$(document).ready(function(){
  $(window).load(function(){
  $('#preloader').fadeOut('slow',function(){$(this).remove();});
});
});
</script> 

<?php include_once('common/footer.php'); ?>

<?php 
if($_POST['MethodName']=="FormPost")
{
  $option= $_POST['LanguageSelection'];
  switch ($option) {
    case '1':
    echo "<script>window.location.href='hindi.php'</script>";
    break;
    
    case '2':
    echo "<script>window.location.href='tamil.php'</script>";
    break;
    
    case '3':
    echo "<script>window.location.href='kannada.php'</script>";
    break;
    
    case '4':
    echo "<script>window.location.href='malayalam.php'</script>";
    break;
    
    case '5':
    echo "<script>window.location.href='telugu.php'</script>";
    break;
    
    default:
      # code...
      break;
  }
}
?>



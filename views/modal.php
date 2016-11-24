
<html>
<body>
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<div class="container">
  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p><?php
         echo $_REQUEST['q'];
          ?></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" onclick="myopen()">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
</body>
<script type="">
  $(window).load(function()
{
    $('#myModal').modal('show');
});
  function myopen()
  {
window.open("../views/sign_up.html",name="_parent");

  }
</script>
</html>
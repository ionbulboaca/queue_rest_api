<?php include "config/constants.php"; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Queue App</title>
	<link rel="stylesheet" type="text/css" href="assets/DataTables/media/css/jquery.dataTables.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  	<script type="text/javascript" language="javascript" src="assets/DataTables/media/js/jquery.dataTables.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	
</head>
<body>

	<div class="container">
    <form action="" method="post" name="queue" id="queue" >
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
			    	<div class="panel-heading">New Customer</div>
			    	<div class="panel-body">
			    		<div id="services"></div>
			    		<div id="types"></div>
			    		<div id="customer_details"></div>	
			    		<div class="form-actions">
		            		<input type="submit" class="btn btn-success btn-large" name="save" id="save" value="Submit" />
		        		</div>
					</div>
				</div>
        	</div>

            <div class="col-md-6">
                <div class="panel panel-default">
			    	<div class="panel-heading">Queues</div>
			    	<div  id="populate_queue_list">
			    		
			    	</div>
				</div>
        	</div>
        </div>
    </form>
</div>
<script type="text/javascript">
	var base_url = <?php echo json_encode(BASE_URL); ?>;
</script>
<script type="text/javascript" language="javascript" src="assets/js/my_js.js"></script>
</body>
</html>
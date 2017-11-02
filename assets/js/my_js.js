
$(document).ready(function(){

	Services();
	CustomerTypes();
	CustomerDetails(1);
	populate_queue_list();

	function Services(){

		$.getJSON(base_url + "/Queue/Service.php", function(data){
	 		
	 		read_services_html ="<h3><strong>Services</strong></h3>";

	 		// loop through returned list of data
			$.each(data.services, function(key, val) {

			    read_services_html += "<div class='radio'>";
				read_services_html += "<label>";    		
				read_services_html += "<input type='radio' name='service' id='service' value='" + val['id'] + "' required>" + val['Name'];
				read_services_html += "</label>";
				read_services_html += "</div>";    			
			});
			$("#services").html(read_services_html);
		});
	}

	function CustomerTypes(){

		$.getJSON(base_url + "/Queue/CustomerType.php", function(data){
	 		
	 		read_types_html =  "<div class='form-group'>";
	 		read_types_html += "<div class='input-group-btn' data-toggle='buttons'>";
								
	 		// loop through returned list of data
			$.each(data.types, function(key, val) {

				if (key==0) {

					read_types_html += "<label class='btn btn-primary active'>";
					read_types_html += "<input type='radio' name='type' id='type' value='" + val['id'] + "' checked>" + val['Name'];
					read_types_html += "</label>";

				}else{

					read_types_html += "<label class='btn btn-primary'>";
					read_types_html += "<input type='radio' name='type' id='type' value='" + val['id'] + "'>" + val['Name'];
					read_types_html += "</label>";
				} 		 			
			});

			read_types_html += "</div>";
	 		read_types_html += "</div>";

			$("#types").html(read_types_html);
		});	
	}

	function CustomerDetails(type){

		customer_details_html = "";
		
		if(type == 1){
			$.getJSON(base_url + "/Queue/CustomerTitle.php", function(data){
	 			
		 		customer_details_html += "<div class='form-group'>";
		 		customer_details_html += "<label for='title'>Title:</label>";
				customer_details_html += "<select class='form-control' id='title' name='title' required>";					
				customer_details_html += "<option></option>";

		 		// loop through returned list of data
				$.each(data.titles, function(key, val) {

					customer_details_html += "<option value='" + val['id'] + "'>" + val['Title'] + "</option>";
					 			
				});

				customer_details_html += "</select>";
		 		customer_details_html += "</div>";

		 		customer_details_html += "<div class='form-group'>";
				customer_details_html += "<label for='FirstName'> First Name:</label>";
				customer_details_html += "<input type='text' class='form-control' id='FirstName' name='FirstName' required>";
				customer_details_html += "</div>";

				customer_details_html += "<div class='form-group'>";
				customer_details_html += "<label for='LastName'>Last Name:</label>";
				customer_details_html += "<input type='text' class='form-control' id='LastName' name='LastName' required>";
				customer_details_html += "</div>";	
				$("#customer_details").html(customer_details_html);

			});										
		}

		if(type == 2){

			customer_details_html += "<div class='form-group'>";
			customer_details_html += "<label for='Name'> Organization Name:</label>";
			customer_details_html += "<input type='text' class='form-control' id='Name' name='Name'>";
			customer_details_html += "</div>";

		}
		if(type == 3){
			customer_details_html += "";
		}
		
		$("#customer_details").html(customer_details_html);
	}


	$("#queue").on('submit', function(){
		
		event.preventDefault();

        var form_data=JSON.stringify($(this).serializeObject());
      
		$.ajax({
		    url: base_url + "/Queue/create.php",
		    type : "POST",
		    contentType : 'application/json',
		    data : form_data,
		    success : function(result) {
		       
		       populate_queue_list()
		    },
		    error: function(xhr, resp, text) {
		        // show error to console
		        console.log(xhr, resp, text);
		    }
		});
	});

	function populate_queue_list(){
		$.getJSON(base_url + "/Queue/QueueList.php", function(data){
			
			queue_list_html = "<h3>List of customers being queued!</h3>";
	 		queue_list_html += "<table  id='populate_table_queue_list' class='table table-bordered data-table'>";
	 		queue_list_html += "<thead>";
	 		queue_list_html += "<tr>";
	 		queue_list_html += "<th>#</th>";
	 		queue_list_html += "<th>Type</th>";
	 		queue_list_html += "<th>Name</th>";
	 		queue_list_html += "<th>Service</th>";
	 		queue_list_html += "<th>Queued at</th>";
	 		queue_list_html += "</tr>";
	 		queue_list_html += "</thead>";
   			queue_list_html += "<tbody>";

			$.each(data.queue_list, function(key, val) {
				
                queue_list_html += "<tr>";
                queue_list_html += "<td>" + val['id'] + "</td>";
                queue_list_html += "<td>" + val['Type'] + "</td>";
                queue_list_html += "<td>" + val['Name'] + "</td>";
                queue_list_html += "<td>" + val['Service'] + "</td>";
                queue_list_html += "<td>" + val['id'] + "</td>";
                queue_list_html += "</tr>";

            });

			queue_list_html += "</tbody>";
			queue_list_html += "</table>";

			$("#populate_queue_list").html(queue_list_html);
			$('#populate_table_queue_list').DataTable();
		});
	}

	$(document).on('change', 'input[name="type"]', function(){

        type_id =  $(this).val();
        CustomerDetails(type_id);

	});

	// function to make form values to json format
	$.fn.serializeObject = function()
	{
	    var o = {};
	    var a = this.serializeArray();
	    $.each(a, function() {
	        if (o[this.name] !== undefined) {
	            if (!o[this.name].push) {
	                o[this.name] = [o[this.name]];
	            }
	            o[this.name].push(this.value || '');
	        } else {
	            o[this.name] = this.value || '';
	        }
	    });
	    return o;
	};
});

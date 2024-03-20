<?php 
require 'header.php';
?>


<title>Dashboard</title>


<style>
	
	body {
		min-height: 100vh;
		min-height: -webkit-fill-available;
	}

	html {
		height: -webkit-fill-available;
	}

	main {
		height: 100vh !important;
		height: -webkit-fill-available;
		max-height: 100vh !important;
		overflow-x: auto !important;
		overflow-y: hidden !important;
	}


	.btn-toggle-nav a {
		padding: .1875rem .5rem;
		margin-top: .125rem;
		margin-left: 1.25rem;
	}
	.btn-toggle-nav a:hover,
	.btn-toggle-nav a:focus {
		background-color: var(--bs-tertiary-bg);
	}

	.scrollarea {
		overflow-y: auto ;
	}
	
</style>

<div class="container-fluid">
	<div class="row">

		<?php 
		include 'nav.php'; 
		?>

		<!-- SIDEBAR  -->
		<div class="sidebar border border-right col-md-3 col-lg-2 p-0 bg-body-tertiary">
			<div class="offcanvas-lg offcanvas-end bg-body-tertiary" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
				<div class="offcanvas-header">
					<h5 class="offcanvas-title" id="sidebarMenuLabel">Home</h5>
					<button type="button" class="btn-close" data-bs-dismiss="offcanvas" data-bs-target="#sidebarMenu" aria-label="Close"></button>
				</div>

				<div class="offcanvas-body d-md-flex flex-column p-0 pt-lg-3 overflow-y-auto">

					<ul class="nav nav-pills flex-column mb-auto px-3">

						<li class="nav-item  mb-1">
							<a class="nav-link d-flex active align-items-center gap-2 "  href="dashboard">
								<i class="fa-solid fa-gauge"></i>
								Dashboard
							</a>
						</li>

					</ul>

				</ul>

				<hr class="my-3">

				<ul class="nav flex-column mb-auto bottom-0 px-3">
					<li class="nav-item">
						<a class="nav-link d-flex align-items-center gap-2" href="actions/logout">
							<i class="fa-solid fa-right-from-bracket"></i>
							Sign out
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<!-- SIDEBAR END -->

	<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
		<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
			<h1 class="h2">Upload Image</h1>
		</div>

		<div class="text-center p-2 mx-auto mb-2">

			<?php

			$image = "-proof-2024.png"; 
			$image2 = "-proof-2024.jpg"; 
			$files = scandir('./images'); 		


			?>
			<?php if (str_contains(implode(",", $files), $image)): ?>
				<img src="./images/-proof-2024.png" class="border p-2" width="300" height="350" alt="">
			<?php elseif (str_contains(implode(",", $files), $image2)): ?>
				<img src="./images/-proof-2024.jpg" class="border p-2" width="300" height="350" alt="">
			<?php else: ?>
			<?php endif ?>


		</div>

		<div class="container col-md-8 mx-auto">

			<form id="sendsms"  method="POST"  class="form-control">

				<div class="mb-3 mt-5">
					<label for="exampleFormControlInput1" class="form-label">Image</label>
					<input type="file" required class="form-control" name="image" id="image" placeholder="Zenith">
					<p id="senderror" class="text-danger"></p>
				</div>

				<!-- ERROR MeSSAGE -->
				<div style="display: none;" id="notify" class="alert   text-center alert-dismissible fade show" role="alert">
					<b id="error_show"></b>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

				</div>



				<div class="mb-3 text-center p-2">
					<button id="btnsms" class="btn btn-md btn-block btn-outline-primary" name="sen" type="submit">
						<i class="fa-regular fa-paper-plane"></i>
					Upload Image</button>
				</div>
			</form>
		</div>

	</main>

</div>
</div>





<?php include 'footer.php'; ?>

<script>
	$(document).ready(function(e) {
		$("#notify").hide();

		$("#senderror").hide();
	});

	$("form#sendsms").submit(function(e) {

		e.preventDefault();    
		var formData = new FormData(this);
		$.ajax({
			url: './actions/smsngn',
			type: 'POST',
			data: formData,
			beforeSend:function(){
				$('#btnsms').html("Uploading Image <span class='fas fa-1x fa-spinner fa-spin'></span>").show();
			},
			success: function (data) {
				if (data == "success") {
					$("#notify").show().addClass('alert-success');

					$("#error_show").html("Image uploaded succssfully. Redirecting... <span class='fas fa-1x fa-spinner fa-pulse'></span>").show();

					setTimeout(' window.location.href = "dashboard"; ', 3000);
				}else{
					$("#notify").show().addClass('alert-danger');
					$("#error_show").html(data).show();
				}   
			},
			cache: false,
			error:function(){
				('#notify').show().addClass('alert-warning');
				$('#error_show').html("An error has occured!!").show();
			},
			contentType: false,
			processData: false
		});
	});


</script>
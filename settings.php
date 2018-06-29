<?php include 'config/topMem.php'; ?>
			<h2>Settings</h2>
			<h4></h4>
		</div>
		<h3>Upload Profile Image:</h3>
		<p>Max allowed file size is 2MB</p>
		<form id="profilePhoto" enctype="multipart/form-data" action="execs/proPhoUp.php">
			<input class="form-input" type="file" name="proPho" />
			<button id="proPhoClick" onclick="pgShow()" class="btn btn-success" name="submit" type="submit">Upload Photo</button>
			<br /><br />
			<div id="bar" style="display:none">
					<div class="progress">
						<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
					</div>
					<br>
				</div>

		<br>
		<button class="btn btn-danger" onclick="pop()">Delete Account</button>
		<br /><br />
		<div id="delAlert" class="alert alert-danger alert-dismissible fade show" 
			style="display:none;" role="alert">
			<form id="delForm" class="d-flex flex-wrap justify-content-center" action="delUser.php" method="POST">
				<h3>
					You are about to delet your account! <br />
					If this is intended please continue.
				</h3>
				<input name="user" style="display:none" 
					value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
				</input>
				<button type="submit" name="submit" class="btn btn-danger btn-lg">
					Yes, delete my account.
				</button>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</form>
		</div>
<script>
	function pop(){
		document.getElementById("delAlert").style = "display: block";
	}

	function pgShow() {
		var bar = document.getElementById("bar");
		bar.style.display = "block";
	}

</script>
<?php include 'config/bottom.html'; ?>

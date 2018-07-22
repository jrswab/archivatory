<?php 
include 'config/top.php'; 
include_once 'config/uploadDBconfig.php';
$user = htmlspecialchars($_SESSION['username']);

// add playlist column if non-existant.
if($playlistCheck = $link->query("SELECT playlist FROM '".$_SESSION['username']."'")) {
	echo '';
} else {
	$addPlaylist = "ALTER TABLE ".$_SESSION['username']." ADD playlist TINYINT(1);";
	$link->query($addPlaylist);
}

//Check for deletion
if (!empty($_GET['delete'])) {
	$sqlDelete = "DELETE FROM ".$user." WHERE id='".$_GET["delete"]."'";
	$delRun = mysqli_query($link, $sqlDelete);
	$rm = shell_exec("rm uploads/".$_GET['delete']);
}

// Check for add to playlist
if (!empty($_GET['addPlay'])) {
	$sqlAddPlay = "UPDATE ".$user." SET playlist=1 WHERE id='".$_GET['addPlay']."'";
	$runAddPlay = mysqli_query($link, $sqlAddPlay);
} 

// Check for removal from playlist
if (!empty($_GET['delPlay'])) {
	$sqlDelPlay = "UPDATE ".$user." SET playlist=0 WHERE id='".$_GET['delPlay']."'";
	$runDelPlay = mysqli_query($link, $sqlDelPlay);
}

// query user data
$sql = "SELECT * FROM ".$user." ORDER BY date DESC;";
$result = mysqli_query($link, $sql);
$resultCheck = mysqli_num_rows($result);
?>
			<h3>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. 
			This is your personal Archivatory Database! </h3>
		</div>
		<div class="d-flex flex-column align-items-center">
			<?php
				if ($resultCheck > 0) {
					// loop through users' table and output into html table body	
					while ($row = mysqli_fetch_assoc($result)) {
						$playlist = $row["playlist"];
						$fileName = $row["file_name"];
						$hash = $row["hash"];
						$fileSize = round(($row["file_size"]/1000000), 2);
						$id = $row["id"];
						$title = $row["title"];
						$des = $row["des"];

						if ($playlist == 0) {
							$onList = '
								<div class="btn-group">
										<button type="button" class="btn btn-success dropdown-toggle" 
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Add</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" name="addPlay" href="?addPlay='.$id.'">Yes, add to playlist.</a>
									</div>
								</div>';
						} else {
							$onList = '
								<div class="btn-group">
										<button type="button" class="btn btn-warning dropdown-toggle" 
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Remove</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" name="delPlay" href="?delPlay='.$id.'">Yes, remove from playlist.</a>
									</div>
								</div>';
						}	
						echo '
						<div class="card border-dark mb-3">
							<div class="card-header bg-info text-light"><h4>'.$fileName.'</h4></div>
							<div class="card-body text-dark">
								<form enctype="multipart/form-data" action="execs/rssMeta.php" method="POST">
									<input name="title" type="text" class="form-control" placeholder="'.$title.'"><br />
									<textarea name="des" class="form-control" rows="3" placeholder="'.$des.'"></textarea><br />
									<input type="hidden" name="rowID" value="'.$id.'">
									<button type="submit" class="btn btn-primary">Submit</button>
								</form><br />

								<p class="card-text"><strong>IPFS Link: </strong>
									<a href="https://ipfs.io/ipfs/'.$hash.'" target="_blank">'.$hash.'</a>
								</p>
								<p class="card-text"><strong>Size: </strong>'.$fileSize.' MB</p>

								<div class="row">
									<div class="col"><strong>Playlist:</strong> '.$onList.'</div>
								</div>
								<br />

								<div class="btn-group">
										<button type="button" class="btn btn-danger dropdown-toggle" 
										data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delete</button>
									<div class="dropdown-menu">
										<a class="dropdown-item" name="id" href="?delete='.$id.'">Yes, delete forever.</a>
									</div>
								</div>
							</div>
						</div>';
					}
				}
			?>
		</div>
	

<?php	include 'config/bottom.html'; ?>

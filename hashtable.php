<?php 
include 'config/top.php'; 
include_once 'config/uploadDBconfig.php';
$user = htmlspecialchars($_SESSION['username']);

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
		<div class="table-responsive">
			<table class="table table-striped table-sm" style="table-layout:fixed">
				<thead>
					<tr>
						<th scope='col' style="text-align:center">Playlist</th>
						<th scope='col' style="text-align:center">File Name</th>
						<th scope='col' style="text-align:center">IPFS Hash</th>
						<th scope='col' style="text-align:center">File Size</th>
						<th scope='col' style="text-align:center">Delete?</th>
					</tr>
				</thead>
			<tbody>
				<?php
					if ($resultCheck > 0) {
						// loop through users' table and output into html table body	
						while ($row = mysqli_fetch_assoc($result)) {
							$playlist = $row["playlist"];
							$fileName = $row["file_name"];
							$hash = $row["hash"];
							$fileSize = round(($row["file_size"]/1000000), 2);
							$id = $row["id"];
							
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
							<tr>
								<td align="center">
									'.$onList.'
								</td>	
								<td style="word-wrap:break-word" align="center">'.$fileName.'</td>
								<td style="word-wrap:break-word" align="center"><a href="https://ipfs.io/ipfs/'.$hash.'" 
									target="_blank">'.$hash.'</a></td>
								<td align="center">'.$fileSize.' MB</td><td align="center">
									<div class="btn-group">
											<button type="button" class="btn btn-danger dropdown-toggle" 
											data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Delete</button>
										<div class="dropdown-menu">
											<a class="dropdown-item" name="id" href="?delete='.$id.'">Yes, delete forever.</a>
										</div>
									</div>
								</td>
							</tr>';
						}
					}
				?>
		</tbody>
	</table>
</div>
	

<?php	include 'config/bottom.html'; ?>

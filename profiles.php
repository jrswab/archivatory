<?php
include 'config/top.php';

$timeIs = time();

$fullURI = "$_SERVER[REQUEST_URI]";
$URIArray = explode('/', $fullURI);
$user = $URIArray[2];

$proPho = shell_exec('ls '.$dir.'uploads/profiles | grep '.$user);

$profile = shell_exec('ls '.$dir.'u/ | grep '.$user);
if(!$profile){
	shell_exec('mkdir '.$dir.'u/'.$user);
	shell_exec('touch '.$dir.'u/'.$user.'/index.php');
	$proPath = '"<?php require \'../../profiles.php\' ?>"';
	shell_exec("echo ".$proPath." >> u/".$user."/index.php");
}
?>

			<h2></h2>
		</div><!-- this close tag relates to the topM.mephp file -->

		<div class="d-flex flex-column align-items-center">
			<div id="currentPhoto" style="padding:15px;">
				<?php echo '<img src="'.$dir.'uploads/profiles/'.$proPho.'?='.$timeIs.'" 
				class="rounded img-fluid" style="max-height:150px;"/>'; ?>
			</div>

			<h2><?php echo $user; ?></h2>
			<p>
				<?php
					require 'config/config.php';
					$sqlBio = "SELECT bio FROM archivatory.users WHERE username='".$user."';";
					$runBio = mysqli_query($link, $sqlBio);
					$userData = mysqli_fetch_assoc($runBio);
					echo $userData['bio'];
				?>
				<br />
			</p>

			<h4>Playlist</h4>
			<div class="table-responsive">
				<table class="table table-striped table-m">
					<thead>
						<tr>
							<th scope="col">Media</th>
						</tr>
					</thead>
					<tbody>
						<?php
							include 'config/uploadDBconfig.php';

							// query user data
							$sql = "SELECT * FROM ".$user." WHERE playlist=1;";
							$result = mysqli_query($link, $sql);
							$resultCheck = mysqli_num_rows($result);

							if ($resultCheck > 0) {
								// loop through users' table and output into html table body	
								while ($row = mysqli_fetch_assoc($result)) { 
									echo '
									<tr>
										<td>
											<a href="https://ipfs.io/ipfs/'.$row["hash"].'" 
												target="_blank">'.$row["file_name"].'</a>
										</td>
									</tr>';
								}
							}
						?>
					</tbody>
				</table>
			</div>
		</div>

<?php include 'config/bottom.html'; ?>

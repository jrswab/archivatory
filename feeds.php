<?php
include 'config/uploadDBconfig.php';

// uso URI to grab username since user may not be logged in.
$fullURI = "$_SERVER[REQUEST_URI]";
$URIArray = explode('/', $fullURI);
$endURL = end($URIArray);
$rev = end($URIArray);
$user = prev($rev);
echo $user;

// query user data
$sql = "SELECT * FROM ".$user." WHERE playlist=1 ORDER BY date DESC;";
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

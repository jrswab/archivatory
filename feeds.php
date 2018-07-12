<?php
	include 'config/uploadDBconfig.php';

	// tell php what type of content follows
	header("Content-Type: application/rss+xml; charset=ISO-8859-1");

	// uso URI to grab username since user may not be logged in.
	$fullURI = "$_SERVER[REQUEST_URI]";
	$URIArray = explode('/', $fullURI);
	$endURL = end($URIArray);
	$user = prev($URIArray);

	// top of rss feed
	$rssfeed = '<?xml version="1.0" encoding="UTF-8"?>';
	$rssfeed .= '<rss xmlns:dc="http://purl.org/dc/elements/1.1/" 
		xmlns:content="http://purl.org/rss/1.0/modules/content/" 
		xmlns:atom="http://www.w3.org/2005/Atom" version="2.0" 
		xmlns:cc="http://cyber.law.harvard.edu/rss/creativeCommonsRssModule.html">';
	$rssfeed .= '<channel>';
	
	// unchanging rss info
	$rssfeed .= '<title>'.$user.'\'s Archivatory Feed</title>';
	$rssfeed .= '<link>https://archivatory.com/u/'.$user.'/</title>';
	$rssfeed .= '<description>This is the Archivatory RSS feed for '.$user.'</description>';
	$rssfeed .= '<language>en-us</language>';
	$rssfeed .= '<copyright>Copyright (C) 'date("Y")' '.$user.'</copyright>';

	// query user data
	$sql = "SELECT * FROM ".$user." WHERE playlist=1 ORDER BY date DESC;";
	$result = mysqli_query($link, $sql);
	$resultCheck = mysqli_num_rows($result);

	if ($resultCheck > 0) {
		// loop through users' table and output into html table body	
		while ($row = mysqli_fetch_assoc($result)) { 
			$rssfeed .= '
			<item>
				<link>https://ipfs.io/ipfs/'.$row["hash"].'</link>
				<pubDate>'.$row["date"].'</pubDate>
			</item>';
		}
	}

$rssfeed .= '</channel>'
$rssfeed .= '</rss>'

echo $rssfeed;
?>

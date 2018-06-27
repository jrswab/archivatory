<?php include 'config/mainTop.html'; ?> 
	<div id="content" class="container">
    <div style="text-align:center;width:100%;">
      <br />
      <h2>Welcome to Archivatory.</h2>
      <h4>More features are coming soon so make sure to join us on 
        <a href="https://discord.gg/dKDuaST" target="_blank">Discord</a> 
				and meet all the other Archivonauts!</h4>
    </div>
    <br>
    <form id="upload-form" enctype="multipart/form-data" action="hash.php" method="POST">
      <div class="text-center">
        <h2>Upload Your File</h2>
        <p>Max allowed file size is 25MB.</p>
        <input class="form-input" type="file" name="file" />
      </div>
      <br><br>
      <button id="click" onclick="pgShow()" class="btn btn-success btn-lg 
	    btn-block" name="submit" type="submit">Upload</button><br>
      <div id="bar" style="display:none">
        <div class="progress">
          <div class="progress-bar progress-bar-striped progress-bar-animated" 
            role="progressbar" aria-valuenow="100" aria-valuemin="0" 
			aria-valuemax="100" style="width: 100%"></div>
        </div>
        <br>
      </div>
      
      <p class="alert alert-danger"><strong>Disclaimer:</strong> Due to the 
	  nature of IPFS your content may never be able to be removed entirely from 
	  the network. Even if we delete your file from our server, the hash will 
	  more than likely still proved the end user with a copy. Please keep this 
	  in mind when uploading and never upload anything you do not want to be online 
	  forever.</p>
      <p class="alert alert-warning"><strong>This is still a beta serverice!</strong> 
	  Please do not use this as a backup service. We are still in the early stages 
	  of Archivatory and don't want you to lose your data. Always save a copy on 
	  an external hard drive and a separate cloud service for redundancy.</p>
    </form>
    
    <h3>How To Use:</h3>
    <div>
      <ol>
        <li>Click "Select File"</li>
        <li>Click "Upload"</li>
        <li>Wait. The larger the file the longer it will take to upload so be patient.</li>
      </ol>
    </div>
    
    <p>For video content, we recommend 
	<a href="https://handbrake.fr" target="_blank">HandBreak</a> it's a 
	free and open-source video transcoder that lets the user input their 
	original video and output a web-optimized version. This optimized version 
	will not only upload faster with our service but will also have better 
	playback for your viewers.</p>
    
    <p>Servers of this size are quite expensive; please consider donating 
	STEEM or SBD to <a href="https://steemit.com/@jrswab">@jrswab</a> in order 
	to keep this service running. Be sure to add a memo to let us know the 
	donation is for this project and we'll add your name to the coming 
	"supporters" page.</p>
    
    <p>Donations help show that you would like to see further development on 
	this project. Some things we'd like to include:  user signups so you can 
	save your hashes for future reference, better user experience, and 
	SteemConnect integration.</p>
    
    <p>If you have a Steem account and find this service helpful please 
	<a href="https://steemconnect.com/sign/account-witness-vote?witness=jrswab&approve=1" target="_blank">
	  vote for @jrswab's witness server</a>. Every vote counts no matter how much Steem Power you hold.</p>
    
    <p>Join us on <a href="https://discord.gg/dKDuaST" target="_blank">Discord</a>!</p>
    
<script>
	$("input[type=file]").change(function () {
		var fieldVal = $(this).val();

		// Change the node's value by removing the fake path (Chrome)
		fieldVal = fieldVal.replace("C:\\fakepath\\", "");

		if (fieldVal != undefined || fieldVal != "") {
			$(this).next(".custom-file-label").attr('data-content', fieldVal);
			$(this).next(".custom-file-label").text(fieldVal);
		}
	});

	function pgShow() {
		var bar = document.getElementById("bar");
		bar.style.display = "block";
	}
</script>
<?php include 'config/bottom.html'; ?>

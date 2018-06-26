## Archivatory
### How to use:
1. Head over to https://archivatory.com
2. Click "Choose File"
3. Click "Upload"
4. Wait for the file to upload (progress bar coming soon)
5. Save the hash and link (user acconts in progress)

## Setting Up Your Own Archivatory:
### Configure Your php.ini file:
1. Head to /etc/php/7.0/apache2/ (Ubutnu 16.04)
2. Open php.ini in your text editor of choice.
3. Change the following:
  - `post_max_size` set to 0 for unlimited or choose a limit.
	- `upload_max_size` set to the max allowed upload for your instance.
	- `memory_limit` If running a server that only has an Archivatory instance do not set this higher that half of your total server RAM. This tells PHP how much RAM it is allowed to hog.
	- `max_execution_time` Limits the execution time per scripte. Large files may need more run time.
	- For more information on these settings see [PHP: Handling file upload - Common Pitfalls](http://www.php.net/manual/en/features.file-upload.common-pitfalls.php).

### Set Us As A Peer!
In order to keep Archivatory from becoming just another "holder-of-files" make sure to set us as one of your IPFS peers:
`ipfs swarm connect /ip4/139.99.131.59/tcp/6537/ipfs/QmYUTAbwZWck3LW9XZBcHTz2Jaip3mGfYDt3LTXdPLEh23`

### Setup script is in the works.

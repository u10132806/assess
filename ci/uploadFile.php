<?php 
		try {
			if (
				!isset($_FILES['file']['error']) ||
				is_array($_FILES['file']['error'])
			) {
				throw new RuntimeException('Invalid parameters.');
			}
		
			switch ($_FILES['file']['error']) {
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					throw new RuntimeException('No file sent.');
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new RuntimeException('Exceeded filesize limit.');
				default:
					throw new RuntimeException('Unknown errors.');
			}
		
			//$filepath = sprintf('files/%s_%s', uniqid(), $_FILES['file']['name']);
		//	echo $_FILES['file']['tmp_name'];
			//print_r($_FILES);
			
			$filepath=sprintf('assets/images/products/%s_%s',uniqid(),$_FILES['file']['name']);
			$info = getimagesize($_FILES['file']['tmp_name']);
			if (!move_uploaded_file($_FILES['file']['tmp_name'],$filepath) || $info === FALSE || ($info[2] !== IMAGETYPE_GIF) && ($info[2] !== IMAGETYPE_JPEG) && ($info[2] !== IMAGETYPE_PNG)) {
				throw new RuntimeException('Failed to move uploaded file.');
			}
		
			// All good, send the response
			echo json_encode([
				'status' => 'ok',
				'path' => $filepath
			]);

			// $con=mysqli_connect("localhost","root","","tailor");
			// if (mysqli_connect_errno())
			// {
			// 	echo "Failed to connect to MySQL: " . mysqli_connect_error();
			// }			
			// $sql="INSERT INTO `gallery`( `file_name`) VALUES ('$filepath')";
			// //echo $sql;
			// mysqli_query($con,$sql);
			// mysqli_close($con);

		} catch (RuntimeException $e) {
			// Something went wrong, send the err message as JSON
			http_response_code(400);
		
			echo json_encode([
				'status' => 'error',
				'message' => $e->getMessage()
			]);
		}

?>
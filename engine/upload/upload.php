<?php
session_start();

// A list of permitted file extensions
$allowed = array('png', 'jpg', 'gif', 'zip', 'swf');

if(isset($_FILES['step_3_new']) && $_FILES['step_3_new']['error'] == 0){

	$extension = pathinfo($_FILES['step_3_new']['name'], PATHINFO_EXTENSION); //odseparowanie rozszerzenia

	if(!in_array(strtolower($extension), $allowed)){ //sprawdzenie odseparowanego rozszerzenia z dozwolonymi w tablicy rozszerzeniami
            echo '{"status":"error"}';
            exit;
	}

	if(move_uploaded_file($_FILES['step_3_new']['tmp_name'], '../../examples/'.$_SESSION['b2_folder'].'/'.$_FILES['step_3_new']['name'])){
            //rename('../../examples/'.$_SESSION['b2_folder'].'/'.$_FILES['upl']['name'], '../../examples/'.$_SESSION['b2_folder'].'/'.$_FILES['upl']['name'])
            echo '{"status":"success"}';
            exit;
	}
}

echo '{"status":"error"}';
exit;
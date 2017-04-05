<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equityvc extends CI_Controller {


        public function index()
        {
                $this->load->view('uploadpic');
        }


public function doupload($id=1){


$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["picture"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["picture"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["picture"]["size"] > 500000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "jpeg" ) {
    echo "Sorry, only JPG or JPEG, PNG & GIF files are not allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["picture"]["tmp_name"], $target_file)) {

			echo "<br>The file ". basename( $_FILES["picture"]["name"]). " has been uploaded.";
} else {
echo "Sorry, there was an error uploading your file.";
}
}

	 $geodata = $this->read_gps_location($target_file);

	 //print_r($inage_geodata);
	 echo "=========<pre>";

	 print_r($geodata); // die();


	 if (isset($geodata) && is_array($geodata)) {

					 $this->saveimagedata($geodata);

					 $data['emailphone'] = 1;
	 }


	 die();

	 // 1. Check if there's a pre-order on currently
	 // 2. If it is, check if it is access controlled, and show access page
	 // 3. If its not, go directly to the product pre-order page
	 // 4. Show data based on current pre-order
	 // 5.

	 $this->clearSessionButReferrer();

	 $this->checkAndStoreReferrer();


	 $viewToLoad = 'doupload';


	 $this->view_data['main_view'] = $viewToLoad;
	 $this->display_equityvc();

}


public function saveimagedata($value='')
{
    $this->load->library('mongo_db');

    $this->mongo_db->insert('image_data' , $value);

}







function read_gps_location($file){
                            if (is_file($file)) {
                                $info = exif_read_data($file);

                                	if (isset($info['GPSLatitude']) && isset($info['GPSLongitude']) &&
                                    isset($info['GPSLatitudeRef']) && isset($info['GPSLongitudeRef']) &&
                                    in_array($info['GPSLatitudeRef'], array('E','W','N','S')) && in_array($info['GPSLongitudeRef'], array('E','W','N','S'))) {

                                    $GPSLatitudeRef  = strtolower(trim($info['GPSLatitudeRef']));
                                    $GPSLongitudeRef = strtolower(trim($info['GPSLongitudeRef']));

                                    $lat_degrees_a = explode('/',$info['GPSLatitude'][0]);
                                    $lat_minutes_a = explode('/',$info['GPSLatitude'][1]);
                                    $lat_seconds_a = explode('/',$info['GPSLatitude'][2]);
                                    $lng_degrees_a = explode('/',$info['GPSLongitude'][0]);
                                    $lng_minutes_a = explode('/',$info['GPSLongitude'][1]);
                                    $lng_seconds_a = explode('/',$info['GPSLongitude'][2]);

                                    $lat_degrees = $lat_degrees_a[0] / $lat_degrees_a[1];
                                    $lat_minutes = $lat_minutes_a[0] / $lat_minutes_a[1];
                                    $lat_seconds = $lat_seconds_a[0] / $lat_seconds_a[1];
                                    $lng_degrees = $lng_degrees_a[0] / $lng_degrees_a[1];
                                    $lng_minutes = $lng_minutes_a[0] / $lng_minutes_a[1];
                                    $lng_seconds = $lng_seconds_a[0] / $lng_seconds_a[1];

                                    $lat = (float) $lat_degrees+((($lat_minutes*60)+($lat_seconds))/3600);
                                    $lng = (float) $lng_degrees+((($lng_minutes*60)+($lng_seconds))/3600);

                                                                        print_r($lat); print_r($lng);

                                    //If the latitude is South, make it negative.
                                    //If the longitude is west, make it negative
                                    $GPSLatitudeRef  == 's' ? $lat *= -1 : '';
                                    $GPSLongitudeRef == 'w' ? $lng *= -1 : '';
                                                                        $filename  = strtolower(trim($info['FileName']));





                                    return array(
                                        'name' => $filename,
                                        'lat' => $lat,
                                        'lng' => $lng
                                    );
                                }
                            }
                            return false;
													}}

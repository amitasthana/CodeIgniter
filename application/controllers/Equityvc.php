<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Equityvc extends CI_Controller {


function array_to_csv_download($array) {
    
    if (count($array) == 0) {
        return null;
    }
    
    $filename = "data_export_" . date("Y-m-d") . ".csv";
    // disable caching
    $now = gmdate("D, d M Y H:i:s");
    header("Expires: Tue, 03 Jul 2001 06:00:00 GMT");
    header("Cache-Control: max-age=0, no-cache, must-revalidate, proxy-revalidate");
    header("Last-Modified: {$now} GMT");
 
    // force download  
    header("Content-Type: application/force-download");
    header("Content-Type: application/octet-stream");
    header("Content-Type: application/download");
 
    // disposition / encoding on response body
    header("Content-Disposition: attachment;filename={$filename}");
    header("Content-Transfer-Encoding: binary");
 
    $df = fopen("php://output", 'w');
    fputcsv($df, array_keys(reset($array)));
    foreach ($array as $row) {
        fputcsv($df, $row);
    }
    fclose($df);
    die();    
}


public function exports_data($data){
          //  $data[] = array('x'=> $x, 'y'=> $y, 'z'=> $z, 'a'=> $a);
             header("Content-type: application/csv");
            header("Content-Disposition: attachment; filename=\"test".".csv\"");
            header("Pragma: no-cache");
            header("Expires: 0");

            $handle = fopen('php://output', 'w');

            foreach ($data as $data) {
                fputcsv($handle, $data);
            }
                fclose($handle);
            exit;
        }	
	
 function array_to_csv($array, $download = "")
    {	

	echo "<pre>"; print_r($array); die(); 


        if ($download != "")
        {    
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $download . '"');
        }        

        ob_start();
        $f = fopen($download, 'wb') or show_error("Can't open php://output");
        $n = 0;        
        foreach ($array as $line)
        {
            $n++;
            if ( ! fputcsv($f, $line))
            {
                show_error("Can't write line $n: $line");
            }
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();

        if ($download == "")
        {
            return $str;    
        }
        else
        {    
            echo $str;
        }        
    }





        public function info()
        {	

			phpinfo(); 
                //      echo "-------"; die();

                $this->load->view('uploadpic');
        }

        public function index()
        {  
		//	echo "-------"; die();
			
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



public function csv($value='')
{
    $this->load->library('mongo_db');

  $data =   $this->mongo_db->get('image_data');

	

	foreach($data as $key => $value){
		
	unset($data[$key]['_id']);
			
	
	}
	
	//	echo "<pre>"; print_r($data);



	$this->array_to_csv_download($data , 'image.csv' ); 












		


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

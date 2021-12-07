<?php
require ("vendor/autoload.php");

if(isset($_POST['submit'])){
    $fileName =  $_FILES['file']['name'];    
    $fileTempName =  $_FILES['file']['tmp_name'];
    $fileSize =  $_FILES['file']['size'];
    $fileError =  $_FILES['file']['error'];
    $fileType =  $_FILES['file']['type'];

    $fileExt = explode('.', $fileName);
    $fileExtLowercase = strtolower(end($fileExt));
    $allowedFileFormat = array('xlsx','xls');

    if(in_array($fileExtLowercase, $allowedFileFormat)){
        if($fileError === 0){
            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fileTempName);   // Loading the Excel file that contains the sheet that I will read
            $sheet = $spreadsheet->getSheetByName("Sheet1");  //getting the specific sheet I want to read
        
            // Store data from the read sheet to the variable in the form of Array
            $data = array(1,$sheet->toArray(null,true,true,true));

           $envUser = getenv('USERNAME') ?: getenv('USER');

            $phoneNum = '';
            $name = '';
            $surname = '';
            $contactsFileName = fopen('C:\Users\\'.$envUser.'\Downloads\\'.'contacts.csv', 'w');
            $outputArray = array();
            foreach($data[1] as $key){
                $name =  $key['A'];
                $surname =  $key['B'];
                if(strlen($key['C']) < 10){
                    $phoneNum = '0'.$key['C'];
                }else{ 
                    $phoneNum = $key['C'];
                }                
                array_push($outputArray, $name.','.$surname.',,,,,,,,,,,,,,,,,,,,,,,,,,,* myContacts,,,Mobile,'.$phoneNum.',,,,,,,,,,,,,,,,,,,,,');
            }

            foreach($outputArray as $arr){
                echo $arr . '<br>';
                $val = explode(",",  $arr);
                fputcsv($contactsFileName,$val);
            }
            fclose($contactsFileName);
            echo '<script>alert("Successfully uploaded and created file!")</script>'; 
            header('Location: index.php?uploadsucessful');                    
        }else{
            echo '<script>alert("There was an error with this file. Please check it again!")</script>';
        }
    }else{
        echo '<script>alert("Error. Upload excel files only!")</script>';
    }

} else {
    echo '<script>alert("File not found. Please select file again!")</script>';
}
?>
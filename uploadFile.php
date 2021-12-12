<?php
    require ("vendor/autoload.php");
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

            $contactsFileName = fopen('C:\Users\\'.$envUser.'\Downloads\\'.'contacts.csv', 'w');
            $outputArray = array('Name,Given Name,Additional Name,Family Name,Yomi Name,Given Name Yomi,Additional Name Yomi,Family Name Yomi,Name Prefix,Name Suffix,Initials,Nickname,Short Name,Maiden Name,Birthday,Gender,Location,Billing Information,Directory Server,Mileage,Occupation,Hobby,Sensitivity,Priority,Subject,Notes,Language,Photo,Group Membership,Phone 1 - Type,Phone 1 - Value');
            foreach($data[1] as $key){
                $sanitisedNumber = str_replace('\'','', str_replace('+', '', str_replace('.', '', str_replace(',', '', str_replace(' ', '', $key['C'])))));
                $name =  $key['A'];
                $surname =  $key['B'];
                if(strlen($sanitisedNumber) == 11){ //if the number is like this 27123456789
                    $phoneNum = '0'.substr($sanitisedNumber, 2);
                }else if(strlen($sanitisedNumber) == 9){ //if the number is like this 123456789
                    $phoneNum = '0'.$sanitisedNumber;
                }else if(strlen($sanitisedNumber) == 12){ //if the number is like this 270123456789
                    $phoneNum = '0'.substr($sanitisedNumber, 3);
                }
                //N.B! This format does not cater for an alternative number.
                array_push($outputArray,$name.','.$surname.',,'.$surname.',,,,,,,,,,,,,,,,,,,,,,,,,* myContacts,Mobile,'.$phoneNum);
            }

            foreach($outputArray as $arr){
                $val = explode(",",  $arr);
                fputcsv($contactsFileName,$val);
            }
            fclose($contactsFileName);
            //echo '<script>alert("Successfully uploaded and created file!")</script>'; 
            //header('Location: index.php?uploadsucessful');                    
        }else{
            echo '<script>alert("There was an error with this file. Please check it again!")</script>';
        }
    }else{
        echo '<script>alert("Error. Upload excel files only!")</script>';
    }
?>
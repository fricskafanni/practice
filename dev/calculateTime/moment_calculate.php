<?php
ini_set('display_errors',1);
   
ini_set('error_reporting',E_ALL);
require_once __DIR__ . '/config.php';
    // Set the time to 9:00 am for the start date
   //$startTime->setTime(9, 0, 0);
    //use while, mert igy csak 30at ad vissza nekunk meg 50 kell szval a while 
    //de forral is megoldhato ha berakunk egy quantityt es egy countert szval tudjuk kovetni mikor telik meg az arrayunk
    //esti hazifeladat.
    
    //next step: store the data!
    
//require_once __DIR__ . '/config/config.php';

// Function to calculate moments between two specific dates. MATHRANDOM
function calculateMoments() {
    $randomDates = array();
    $checkedRandomDates = array();
    $moments = array();
    $startDate = new DateTime('2024-03-28');
    $endDate = new DateTime('2024-04-28');
    $counter=0;
    
    $startDate = $startDate->format('Y-m-d H:i:s');
    $endDate = $endDate->format('Y-m-d H:i:s');
    
    $startDate = strtotime($startDate);
    $endDate = strtotime($endDate);
    
    for ($i=0; $counter<50; $i++) {
        $randomDates[] = mt_rand($startDate, $endDate);
        $checkDate = date("H:i:s", $randomDates[$i]);
        
        $startTime = date("09:00:00");
        $endTime = date("23:00:00");
        if($checkDate >= $startTime && $endTime >= $checkDate){
            $checkedRandomDates[] =+ $randomDates[$i];
            $counter++;
        }
    }
    
    for ($i=0; $i<count($checkedRandomDates); $i++){
        $moments[] = date("Y-m-d H:i:s", $checkedRandomDates[$i]);
    }
    
    sort($moments);
    
    //foreach ($moments as $element) {
    //    echo $element . "\n";
    //}

    return $moments;
}

$momentos = calculateMoments();

$response = $moments->checkIfTableEmpty($momentos);
if ($response) {
    echo "Everything is fine.";
    echo $response;
    $moments->checkIfDateAvaible();
}
else {
    echo "There's something wrong";
    echo $response;
}

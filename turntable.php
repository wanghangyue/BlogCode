<?php
class turntable{
	private function get_rand($Arr) { 
    $result = ''; 
    //概率数组的总概率精度 
    $proSum = array_sum($Arr); 
    //概率数组循环 
    foreach ($Arr as $key => $proCur) { 
        $randNum = mt_rand(1, $proSum); 
        if ($randNum <= $proCur) { 
            $result = $key; 
            break; 
        } else { 
            $proSum -= $proCur; 
        } 
    } 
    unset ($Arr);
    return $result; 
	} 
}

$config=array(
		1=>array(1706,25),
		2=>array(5037,25),
		3=>array(509,400),
		4=>array(5135,400),
		5=>array(516,400),
		6=>array(503,850),
		7=>array(549,850),
		8=>array(504,850),
		9=>array(57,1550),
		10=>array(508,1550),
		11=>array(15,1550),
		12=>array(5033,1550),
 );

function mainfunc(){
$prob =array();
foreach ($config as $k=>$v)
{
array_push($prob,$v[1]);
$getrand = $this->get_rand($prob);
$award_id = $getrand+1;
}
$award = $config[$award_id];
}
?>
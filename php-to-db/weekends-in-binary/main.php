<?php
define('Monday', 1 << 0);            // 00000001 или в десятичной 1
define('Tuesday', 1 << 1);           // 00000010 или в десятичной 2
define('Wednesday', 1 << 2);         // 00000100 или в десятичной 4
define('Thursday', 1 << 3);          // 00001000 или в десятичной 8
define('Friday', 1 << 4);            // 00010000 или в десятичной 16
define('Saturday', 1 << 5);          // 00100000 или в десятичной 32
define('Sunday', 1 << 6);            // 01000000 или в десятичной 64
define('Seven', 1 << 7);             // 10000000 - все дни выходные 128
//Либо такая капись Seven
define('Seven', Monday | Tuesday | Wednesday | Thursday | Friday | Saturday | Sunday);  // 01111111 или в десятичной 127, то есть все дни выходные

$query = Monday;                     // 00000001
$query2 = Monday | Sunday;           // 01000001
$query3 = Seven;                     // 01111111

//Быстрая запись функций
//bindec(11111111) -> 255
//decbin(255) -> 11111111
//strrev(Monday) -> yadnoM
//implode([1,1,1,1,1,1,1,1]) -> 11111111

function setWeekendsBait($data){
  $result=[];
  $result['bait_code'] = strrev(implode($data));          //01000010
  $result['bait_value'] = bindec($result['bait_code']);   //66 - запись в таблице
  return $result;
}
function getWeekendsByDays($weekends){
  $bait = setWeekendsBait($weekends); //Кодируем дни недели в байт, получаем информацию
  print_r($bait);
  $result = [];
  //$result = query('SELECT * FROM table_name WHERE weekends = '.$bait_value);
  //Если находим значение, значит есть записи у которых выходные дни Вторник и Воскресенье
  return $result;
}
getWeekendsByDays([0,0,0,0,0,1,1,0]); //найти все дни недели, в которых Вторник и Воскресенье выходные
echo '<br>';
print_r(str_split(strrev(decbin(0)))); //[0] => 1 [1] => 1 [2] => 0 [3] => 1 [4] => 0 [5] => 1 [6] => 1
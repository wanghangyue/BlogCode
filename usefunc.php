<?
/**
   * 数组合并
   * Enter description here ...
   * @param unknown_type $array_info
   */
  public function array_array($array_info)
  {
    $result = array();
    foreach($array_info as $key => $value) {
      if(array_key_exists($value[0],$result)) {
        $result[$value[0]]=$value[1] + $result[$value[0]];
      } else {
        $result[$value[0]]=$value[1];
      }
    }
    foreach($result as $key => $value) {
      $result1[] = array($key,$value);
    }
    return $result1;
  }
/**
  * use mbstr()
  * 截取中国文字符串
  *
  */
  public function cnsubstr($str,$start,$len){
    $strlen = $start + $len;
    for ($i=0; $i < $strlen; $i++) { 
      if (ord(substr($str, $i, 1))>0xa0) {
        $tmpstr .= substr($str, $i, 2);
      }
      else {
        $tmpstr .= substr($str, $i, 1);
      }
    }
    return $tmpstr;
  }
/**
  * list和each的使用
  * 
  */
  $a = array(1,2,3,4,5 );
  while(list($k,$v) = each($a)){
    echo "$v";
  }
  
?>       
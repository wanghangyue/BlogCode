  //7、在不同函数中输出内容如下
  <?php
  function print_header()  
  {  
      echo "<div id='header'>Site Log and Login links</div>";  
  }  
     
  function print_footer()  
  {  
      echo "<div id='footer'>Site was made by me</div>";  
  }  

  print_header();  
  for($i = 0 ; $i <100; $i++)  
  {  
        echo "I is : $i <br />";  
  } 

  print_footer(); 
  ?>

//以上这种情况，可以在某地方集中收集输出. 你可以存储在函数的局部变量中,也可以使用ob_start和ob_end_clean. 使用PHP ob_start()函数打开服务器server的cache，这样可以保证cache的内容在你调用flush(),ob_end_flush()（或程序执行完毕）之前不会被输出。如下:

<?php
function print_header()  
  {  
      $o = "<div id='header'>Site Log and Login links</div>";  
      return $o;  
  }   
  function print_footer()  
  {  
      $o = "<div id='footer'>Site was made by me</div>";  
      return $o;  
  }  
  ob_start();
  echo print_header();  
  for($i = 0 ; $i <100; $i++)  
  {  
      echo "I is : $i <br />";  
  }  
  echo print_footer(); 
?>

//更加清楚的使用方法
<?php
ob_start();//buf1
echo ‘multiple’;
ob_start();//buf2
echo ‘bufferswork’;
$buf1 = ob_get_contents();
ob_end_clean();
$buf2 = ob_get_contents();
ob_end_clean();
ob_start();
for($i = 0 ; $i <100; $i++)  
  {  
        echo "I is : $i <br />";  
  } 
$ok = ob_get_contents();
ob_end_clean();
echo $ok;
echo $buf1;
echo "<br/>";
echo $buf2;
?>

//8、发送正确的mime类型，输出非html内容
$xml = '<?xml version="1.0" encoding="utf-8" standalone="yes"?>';  
$xml = "<response>      
      <code>
        0
      </code>   
    </response>";  
header("content-type: text/xml");  //头部要写类型，确定输出类型，pdf这种都可以
echo $xml;

//9、为mysql连接设置正确的字符编码
 <? //Attempt to connect to database  
  $c = mysqli_connect($this->host , $this->username, $this->password);    //主机名，用户名和密码是作为三个私有属性 
  //Check connection validity  
  if (!$c) 
  {  
      die ("Could not connect to the database host: <br />". mysqli_connect_error());  
  }    
  //Set the character set of the connection  
  if(!mysqli_set_charset ( $c , 'UTF8' ))  
  {  
      die('mysqli_set_charset() failed');  
  } 
  //一旦连接数据库, 最好设置连接的 characterset. 你的应用如果要支持多语言, 这么做是必须的.
  ?>
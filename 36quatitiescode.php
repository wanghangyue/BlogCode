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

  //10、使用 htmlentities 设置正确的编码选项
  <?php
  1 $value = htmlentities($this->value , ENT_QUOTES , CHARSET);
  ?>
  
  //11、不要在应用中使用gzip压缩输出, 让apache处理
  //12. 使用json_encode输出动态javascript内容
  <?php
  $images = array( 'myself.png' , 'friends.png' , 'colleagues.png' );  
  $js_code = '';     
    foreach($images as $image)  
    {  
    $js_code .= "'$image' ,";  
    }    
    $js_code = 'var images = [' . $js_code . ']; ';     
    echo $js_code;  
    //Output is var images = ['myself.png' ,'friends.png' ,'colleagues.png' ,]; 
  ?>
  //使用json_encode
  <?php
  $images = array( 'myself.png' , 'friends.png' , 'colleagues.png' );      
  $js_code = 'var images = ' . json_encode($images);     
  echo $js_code;     
  //Output is : var images = ["myself.png","friends.png","colleagues.png"]
  ?>
  //13.写或保存文件前, 确保目录是可写的, 假如不可写, 输出错误信息. 这会节约你很多调试时间. linux系统中, 需要处理权限, 目录权限不当会导致很多很多的问题, 文件也有可能无法读取等等.确保你的应用足够智能, 输出某些重要信息.
  <?php
  $contents = "All the content";  
  $file_path = "/var/www/project/content.txt";     
  file_put_contents($file_path , $contents); 
  ?>
  //这大体上正确. 但有些间接的问题. file_put_contents 可能会由于几个原因失败:父目录不存在，目录存在, 但不可写，文件被写锁住。所以写文件前做明确的检查更好.
  <?php
  $contents = "All the content";  
  $dir = '/var/www/project';  
  $file_path = $dir . "/content.txt";  
     
  if(is_writable($dir))  
  {  
      file_put_contents($file_path , $contents);  
  }  
  else  
  {  
      die("Directory $dir is not writable, or does not exist. Please check");  
  } 
  ?>
  //14.在 linux环境中, 权限问题可能会浪费你很多时间. 从今往后, 无论何时, 当你创建一些文件后, 确保使用chmod设置正确权限. 否则的话, 可能文件先是由"php"用户创建, 但你用其它的用户登录工作, 系统將会拒绝访问或打开文件, 你不得不奋力获取root权限, 更改文件的权限等等.
  <?php
  // Read and write for owner, read for everybody else  
  chmod("/somedir/somefile", 0644);  
  // Everything for owner, read and execute for others  
  chmod("/somedir/somefile", 0755); 
  ?>
  //15.不要依赖submit按钮值来检查表单提交行为
  <?php
   if($_POST['submit'] == 'Save')  
   {  
      //Save the things  
   } 
  ?>
  //上面大多数情况正确, 除了应用是多语言的. 'Save' 可能代表其它含义. 你怎么区分它们呢. 因此, 不要依赖于submit按钮的值.
  <?php
  if( $_SERVER['REQUEST_METHOD'] == 'POST' and isset($_POST['submit']) )  
   {  
       //Save the things  
   } 
  ?>
  //16. 为函数内总具有相同值的变量定义成静态变量
  <?php
  //Delay for some time
  functiondelay(){
    $sync_delay= get_option('sync_delay');
    echo"<br />Delaying for $sync_delay seconds...";
    sleep($sync_delay);
    echo"Done <br />";
  }
  ?>
  //用静态变量取代
  <?php
  //Delay for some time0
  functiondelay(){
    static $sync_delay= null;
    if($sync_delay== null){
      $sync_delay= get_option('sync_delay');
    }
    echo"<br />Delaying for $sync_delay seconds...";
    sleep($sync_delay);
    echo"Done <br />";
  }
  ?>
  //17. 不要直接使用 $_SESSION 变量,某些简单例子:
  <?php
  $_SESSION['username'] = $username;  
  $username = $_SESSION['username'];  
  ?>
  //这会导致某些问题. 如果在同个域名中运行了多个应用, session 变量可能会冲突. 两个不同的应用可能使用同一个session key. 例如, 一个前端门户, 和一个后台管理系统使用同一域名.
  //从现在开始, 使用应用相关的key和一个包装函数:
  <?php
  define('APP_ID' , 'abc_corp_ecommerce');       
  //Function to get a session variable  
  function session_get($key)  
  {  
      $k = APP_ID . '.' . $key;  
      if(isset($_SESSION[$k]))  
      {  
          return $_SESSION[$k];  
      }   
      return false;  
  }   
  //Function set the session variable  
  function session_set($key , $value)  
  {  
      $k = APP_ID . '.' . $key;  
      $_SESSION[$k] = $value;  
      return true;  
  } 
  ?>
  
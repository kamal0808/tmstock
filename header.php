<?php
session_start();
if(!isset($_SESSION['password']))
{
    echo<<<_END
    <script type="text/javascript">
        curpath=window.location.href;
        var index = curpath.lastIndexOf("/")+1;
        var filename = curpath.substr(index);
        if(filename!="index.php")
            window.location.replace("index.php");
    </script>
_END;
}

$dbhost=getenv('DB_HOST');
$dbname=getenv('DB_NAME');
$dbuser=  getenv('DB_USER');
$dbpass=  getenv('DB_PASS');
$dbport = getenv('DB_PORT');
$appname='TMStock';
global $con;
$con=mysqli_connect($dbhost,$dbuser,$dbpass, $dbname, $dbport);
function destroySession()
{
    session_start();
    $query="DELETE from online_students where studentid='$_SESSION[user]'";
    $result=queryMysql($query);
    $_SESSION=array();
    if(session_id()!=""||isset($_COOKIE[session_name()]))
        setcookie (session_name (),'',time()-2592000,'/');
    session_destroy();
}

function sanitizeString($var)
{
    global $con;
    $var=strip_tags($var);
    $var=htmlentities($var);
    $var=stripslashes($var);
    return mysqli_real_escape_string($con,$var);
}

function queryMysql($query)
{
    global $con;
    $result=mysqli_query($con,$query) or die(mysqli_error($con));
    return $result;
}

function salt($password)
{
    $salt1="*#@1";
    $salt2="23#%";
    $password=md5("$salt1$password$salt2");
    return $password;
}

if(isset($_GET['application']))
{
    $application=sanitizeString($_GET['application']);
    if($application=="event")
    {
        $application="Event Management";
        $business="Events";
    }
    elseif($application=="catering")
    {
        $application="Catering Management";
        $business="Catering";
    }
    else
    {
        die("Something went wrong");
    }
    $_SESSION['application']=$application;
    $_SESSION['business']=$business;
}

function columns()
{
    $columns='';
    foreach($_POST as $key=>$value)
    {
      $key=sanitizeString($key);
        if(!is_array($value))
            $columns=$columns.",".$key;
    }
    $columns=substr($columns, 1);
    return $columns;
}

function values()
{
    $values='';
    foreach($_POST as $key=>$value)
    {
        
        if(!is_array($value))
        {
            $value=sanitizeString($value);
    //        $columns=$columns.",".$key;
            if(!is_numeric($value))
                $values=$values.","."'".$value."'";
            else
                $values=$values.",".$value;
        }
            
    }
//    $columns=substr($columns, 1);
    $values=substr($values, 1);
    return $values;
}

function query($table)
{
    $columns=columns($_POST);
    $values=values($_POST);
    $query="Insert into $table($columns) values($values)";
    
    $result=  queryMysql($query);
}

function id($id)
{
      if($id<10)
      {
          $id="00".$id;
      }
      elseif($id>=10&&$id<100)
      {
          $id="0".$id;
      }
      return $id;
}

function ymdDate($date)
{
    $date=str_replace('/', '-', $date);
    $date=date('Y-m-d', strtotime($date));
    return $date;
}
function dmyDate($date)
{
    if($date!="1969-12-31")
    {
        $date=date('d-m-Y', strtotime($date));
        $date=str_replace('-', '/', $date);
        return $date;
        
    }
}

function uploadimage($tempname,$saveto,$type,$max)
{
    move_uploaded_file($tempname,$saveto);
$typeok=TRUE;
switch($type)
{
    case "image/gif":   $src=imagecreatefromgif($saveto);   break;
    case "image/jpeg":  break;
    case "image/pjpeg": $src=imagecreatefromjpeg($saveto);  break;
    case "image/png":   $src=imagecreatefrompng($saveto); break;
default :   $typeok=FALSE;
}
if($typeok)
{
    list($w,$h)=getimagesize($saveto);
    
    $tw=$w;
    $th=$h;
    
    if($w>$h&&$max<$w)
    {
        $th=$max/$w*$h;
        $tw=$max;
    }
    elseif($h>$w&&$max<$h)
    {
        $tw=$max/$h*$w;
        $th=$max;
    }
    elseif($max<$w)
    {
        $tw=$th=$max;
    }
    $jpeg_quality = 60;
    //$img_r = imagecreatefromjpeg($saveto);
	$tmp = ImageCreateTrueColor( $tw, $th );
       // imagecopyresampled($dst_r,$img_r,0,0,$_POST['x'],$_POST['y'],
    //$targ_w,$targ_h,$_POST['w'],$_POST['h']);
	//imagejpeg($dst_r,$saveto,$jpeg_quality);
//    $tmp=imagecreatetruecolor($tw, $th);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
    //imageconvolution($tmp, array(
      //                      array(-1,-1,-1),
        //                    array(-1,16,-1),
          //                  array(-1,-1,-1)
            //                ),8,0);
                    imagejpeg($tmp,$saveto,$jpeg_quality);
               //     imagedestroy($tmp);
                 //   imagedestroy($src);
}
}
?>

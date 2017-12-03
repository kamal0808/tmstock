<?php
include_once 'header.php';
if(isset($_POST['app']))
{
    $app=sanitizeString($_POST['app']);
    if($app=="itemtype")
    {
        $itemname=sanitizeString($_POST['itemname']);
        $filename=sanitizeString($_POST['filename']);
        $query="Select distinct itemtype from items where name='$itemname'";
        $result=queryMysql($query);
        $types="<option value=''>Select</option>";
        while($row=mysqli_fetch_array($result))
        {
            $types=$types."<option value='$row[itemtype]'>$row[itemtype]</option>";
        }
        if($filename=="additems.php")
            $types=$types."<option value='other'>Other</option>";
        echo $types;
    }
    if($app=="itemdescription")
    {
        $itemname=sanitizeString($_POST['item']);
        $itemtype=sanitizeString($_POST['itemtype']);
            $query="Select distinct description,itemid,business from items where name='$itemname' and itemtype='$itemtype' group by description,business";
        $result=queryMysql($query);
        $types="<option value=''>Select</option>";
        while($row=mysqli_fetch_array($result))
        {
            $types=$types."<option value='$row[description]'>$row[description] - $row[business]</option>";
        }
        echo "$types";
    //    $tes="";
    //    foreach($myitems as $val)
    //        $tes=$tes.$val;
    //    echo $tes;
    }

    if($app=="itemgodown")
    {
        $itemdesc=sanitizeString($_POST['itemdesc']);
        $itemtype=sanitizeString($_POST['itemtype']);
        $itemname=sanitizeString($_POST['itemname']);
        $business=sanitizeString($_POST['business']);
        $myitemsid=$_POST['myitemsid'];
        $range=implode(',',$myitemsid);
        $range=substr($range, 0, strlen($range));
        if($range!="")
            $query="Select godowns.name as godownname,items.quantity,items.itemid from items join godowns on items.godownid=godowns.godownid where items.name='$itemname' and items.itemtype='$itemtype' and items.description='$itemdesc' and items.business='$business' and items.itemid NOT IN ($range)";
        else
            $query="Select godowns.name as godownname,items.quantity,items.itemid from items join godowns on items.godownid=godowns.godownid where items.name='$itemname' and items.itemtype='$itemtype' and items.description='$itemdesc' and items.business='$business'";
//        echo $query;
        $result=queryMysql($query);
        $quantity="<option value=''>Select</option>";
        while($row=mysqli_fetch_array($result))
        {
            $quantity=$quantity."<option value='$row[itemid]'>$row[godownname] - $row[quantity]</option>";
        }
        echo $quantity;
    }
}



?>

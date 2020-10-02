<?php
$mysqli=new mysqli('localhost','root','','library');



function db($sql){
    global $mysqli;
        $rez=$mysqli->query($sql);
        $array=array();
            while ($row=$rez->fetch_assoc()) {
               $array[]=$row;
            }
             return $array;
}
function books(){
    $sql="SELECT * FROM `books`";
    return db($sql);
}

/*Популярность книг */
function books_static(){
    $sql="SELECT * FROM `books` ORDER BY `issued` DESC";
    return db($sql);
}

function readers(){
    $sql="SELECT * FROM `readers`";
    return db($sql);
}


function issuing_books(){
    $sql="SELECT * FROM `issuing_books`";
    return db($sql);
}


function get_all_field_id($table,$id){
    global $mysqli;
    $sql="SELECT * FROM `".$table."` WHERE `id`=".$mysqli->real_escape_string($id);
    return db($sql);
}



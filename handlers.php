<?php
require_once(__DIR__.'/db.php');


function issuing_readers(){
    global $mysqli;

    $issued = (int)$_POST['issued'] + 1;
    $sql1 = "UPDATE `books` SET `issued`='".$mysqli->real_escape_string($issued)."' WHERE `id`=".$mysqli->real_escape_string($_POST['issuing_books']).
    " AND `count_books`>=".$mysqli->real_escape_string($issued);
    $res = $mysqli->query($sql1);

    $title = get_all_field_id('books',$_POST['issuing_books'])[0]['title'];
    $name = get_all_field_id('readers',$_POST['readers'])[0]['name'];
    $count = get_all_field_id('books',$_POST['issuing_books'])[0]['count_books'];

    if((int)$issued > (int)$count){
        return false;
    }

     $sql="INSERT INTO `issuing_books` SET ";
            $sql.="`title_book`='".$mysqli->real_escape_string($title)."', ";
            $sql.="`date`='".date("Y-m-d")."', ";
            $sql.="`reader`='".$mysqli->real_escape_string(trim($name))."', ";
            $sql.="`status`='1',  ";
            $sql.="`id_readers`='".$mysqli->real_escape_string($_POST['readers'])."',  ";
            $sql.="`id_books`='".$mysqli->real_escape_string($_POST['issuing_books'])."'  ";
    $mysqli->query($sql);
}


function add_book(){
    global $mysqli;
    $sql="INSERT INTO `books` SET ";
    $sql.="`avtor`='', ";
    $sql.="`date`='".date("Y-m-d")."', ";
    $sql.="`title`='', ";
    $sql.="`description`='', ";
    $sql.="`page_count`='', ";
    $sql.="`count_books`=''";

    $mysqli->query($sql);
}


function add_readers(){
    global $mysqli;
    $sql="INSERT INTO `readers` SET ";
    $sql.="`name`='', ";
    $sql.="`adress`='', ";
    $sql.="`telefon`='' ";


    $mysqli->query($sql);
}

function delete_books($id){
    global $mysqli;

    $sql="DELETE FROM `books` WHERE `id`='".$mysqli->real_escape_string($id)."'";
    $mysqli->query($sql);
}

function delete_readers($id){
    global $mysqli;

    $sql="DELETE FROM `readers` WHERE `id`='".$mysqli->real_escape_string($id)."'";
    $mysqli->query($sql);
}



function update_books(){
    global $mysqli;
    $sql="UPDATE `books` SET `".$_POST['field']."`='".$mysqli->real_escape_string($_POST['text'])."' WHERE `id`='".$_POST['id']."' ";

    $mysqli->query($sql);
}

function update_readers(){
    global $mysqli;
    $sql="UPDATE `readers` SET `".$_POST['field']."`='".$mysqli->real_escape_string($_POST['text'])."' WHERE `id`='".$_POST['id']."' ";

    $mysqli->query($sql);
}


function issuing_readers_status(){
    global $mysqli;

    $sql="UPDATE `issuing_books` SET `status`='0' WHERE `id`='".$_POST['status_issuing']."'";
    $mysqli->query($sql);
    $sql="SELECT `issued` FROM `books`  WHERE `id`='".$_POST['book_id']."'";
    $res = $mysqli->query($sql);
    $count_db = $res->fetch_assoc()['issued'];
    $sql="UPDATE `books` SET `issued`='".$mysqli->real_escape_string((int)$count_db -1)."' WHERE `id`='".$_POST['book_id']."'";
    $res = $mysqli->query($sql);
}



if(isset($_POST['delete']) && (int)$_POST['delete'] !==0){
$id=(int)$_POST['delete'];
delete_books($id);
}


if(isset($_POST['delete_readers']) && (int)$_POST['delete_readers'] !==0){
    $id=(int)$_POST['delete_readers'];
    delete_readers($id);
}

if(isset($_POST['add']) && (int)$_POST['add'] ===1){
    add_book();
}


if(isset($_POST['add_readers']) && (int)$_POST['add_readers'] ===1){

    add_readers();
}

if(isset($_POST['update']) && (int)$_POST['update'] ===1
        && isset($_POST['id']) && (int)$_POST['id'] !==0
        && isset($_POST['field']) && trim($_POST['field']) !==''
        && isset($_POST['text']) && trim($_POST['text']) !==''
){
    update_books();
}



if(isset($_POST['update_readers']) && (int)$_POST['update_readers'] ===1
    && isset($_POST['id']) && (int)$_POST['id'] !==0
    && isset($_POST['field']) && trim($_POST['field']) !==''
    && isset($_POST['text']) && trim($_POST['text']) !==''
){
    update_readers();
}


if(isset($_POST['issuing_books']) && (int)$_POST['issuing_books'] !==0
        && isset($_POST['readers']) && (int)$_POST['readers'] !==0
    && isset($_POST['issued'])
){

    issuing_readers();
}


if(isset($_POST['status_issuing']) && (int)$_POST['status_issuing'] !==0
    && isset($_POST['book_id']) && (int)$_POST['book_id'] !==0
){

    issuing_readers_status();
}


header('Location: '.$_SERVER['HTTP_REFERER']);
exit();
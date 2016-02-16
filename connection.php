<?php

function executeQuery($query)
{
    $connect = mysqli_connect("localhost", "root", "", "alanya");
    $result = mysqli_query($connect, $query);
    return $result;
}

?>
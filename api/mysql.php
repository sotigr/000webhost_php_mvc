<?php
function query($querystring) {
 
    $conn = mysqli_connect("localhost", "root", "", "test");
    if (mysqli_connect_errno()) {
        mysqli_close($conn);
        return "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    $res = mysqli_query($conn, $querystring);
    mysqli_close($conn);
    if (is_bool($res)) {
        if ($res) {
            return '1';
        } else {
            return '0';
        }
    } else {
        $table = array();
        $cn = 0;
        while ($row = mysqli_fetch_array($res, MYSQLI_BOTH)) {
            $table[$cn] = $row;
            $cn++;
        }
        return $table;
    }
}
?>
<?php
    include 'Connection.php';

    $nip = $_POST['nip'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM m_user WHERE nip = '$nip' AND password = '$password'";
    $login = pg_query($sql);
    $row = pg_fetch_row($login);
    $cek = pg_numrows($login);

    if ($cek > 0) {
        session_start();
        $_SESSION['username'] = $nip;
        $_SESSION['name'] = $row[1];
        $_SESSION['status'] = "login";

        echo '<script>window.location = "../pages/Dashboard.php?nip=' . $nip . '";</script>';
    } else {
        echo '<script>alert("NIP dan Password tidak valid")</script>';
        echo '<script>window.location = "../index.php";</script>';
    }

    pg_close();
?>
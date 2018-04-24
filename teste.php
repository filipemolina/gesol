<?php
        $connection = pg_connect ("host=localhost dbname=site user=postgres password=root");

        if($connection) {
                 echo 'connected';
        } else {
                 echo 'there has been an error connecting';
        }
?>


<?php
     class DB {

        static function getConnection() {
            // $mysqli = new mysqli("", "", "", "");
            // $mysqli = new $mysqli("", "", "", "");
            return $mysqli;
        }

        static function select($statement) {
            $conn = DB::getConnection();
            $result = $conn->prepare($statement);
            $result->execute();
            return $result;
        }

        static function bind($fields) {

        }

        static function insert($statement) {

        }

        static function update($statement) {

        }

        static function delete($statement) {

        }
    }
?>


<!--
// this is essentially how to get DB results
$rentals = DB::select('select title from rental;');
$rentals->bind_result($title);
while($rentals->fetch()){
    echo $title;
}
$rentals->close(); -->

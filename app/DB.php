<?php
include 'constants.php';
    class DB {

        static function getConnection() {
            $conn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);
            return $conn;
        }

        //
        static function get_result( $Statement ) {
            $RESULT = array();
            $Statement->store_result();
            for ( $i = 0; $i < $Statement->num_rows; $i++ ) {
                $Metadata = $Statement->result_metadata();
                $PARAMS = array();
                $j = 0;
                while ( $Field = $Metadata->fetch_field() ) {
                    $PARAMS[] = &$RESULT[ $i ][ $j ];
                    $j++;
                }
                call_user_func_array( array( $Statement, 'bind_result' ), $PARAMS );
                $Statement->fetch();
            }
            return $RESULT;
        }
    }
?>

<?php
define("DB_HOST", "localhost");
define("DB_DATABASE", "yas252");
define("DB_USERNAME", "jason");
define("DB_PASSWORD","nathaniel");
function errorLog($text) {
    $filename = "dberrors_log.txt";
    $fh = fopen($filename, "a");
    fwrite($fh, "\n".date("m-d-Y, H:i")."\n\t$text");
    fclose($fh);
}
$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

function yasDB_insert($sql, $escape = false) {
    global $mysqli;
    if ($escape) {
        $sql = $mysqli->real_escape_string($sql);
    }
    $result = $mysqli->query($sql);
    if ($mysqli->error) {
		try {   
			throw new Exception("MySQL error $mysqli->error \n\tQuery: \"$sql\"", $msqli->errno);   
		} catch(Exception $e ) {
			$text =  "Error No: ".$e->getCode(). " - ". $e->getMessage() . "\n";
			$text .= "\t".str_replace("\n", "\n\t",$e->getTraceAsString());
			errorLog($text);
			return false;
		}
	}
	return $result;
}
function yasDB_select($sql, $escape = false) {
    global $mysqli;
    if ($escape) {
        $sql = $mysqli->real_escape_string($sql);
    }
    $result = $mysqli->query($sql);
    if ($mysqli->error) {
		try {   
			throw new Exception("MySQL error $mysqli->error \n\tQuery: \"$sql\"", $msqli->errno);   
		} catch(Exception $e ) {
			$text =  "Error No: ".$e->getCode(). " - ". $e->getMessage() . "\n";
			$text .= "\t".str_replace("\n", "\n\t",$e->getTraceAsString());
			errorLog($text);
			return false;
		}
	}
	return $result;
}
function yasDB_update($sql, $escape = false) {
    global $mysqli;
    if ($escape) {
        $sql = stripslashes($sql);
        $sql = $mysqli->real_escape_string($sql);
    }
    $result = $mysqli->query($sql);
    if ($mysqli->error) {
		try {   
			throw new Exception("MySQL error $mysqli->error \n\tQuery: \"$sql\"", $msqli->errno);   
		} catch(Exception $e ) {
			$text =  "Error No: ".$e->getCode(). " - ". $e->getMessage() . "\n";
			$text .= "\t".str_replace("\n", "\n\t",$e->getTraceAsString());
			errorLog($text);
			return false;
		}
	}
	return $result;
}
function yasDB_delete($sql, $escape = false) {
    global $mysqli;
    if ($escape) {
        $sql = $mysqli->real_escape_string($sql);
    }
    $result = $mysqli->query($sql);
    if ($mysqli->error) {
		try {   
			throw new Exception("MySQL error $mysqli->error \n\tQuery: \"$sql\"", $msqli->errno);   
		} catch(Exception $e ) {
			$text =  "Error No: ".$e->getCode(). " - ". $e->getMessage() . "\n";
			$text .= "\t".str_replace("\n", "\n\t",$e->getTraceAsString());
			errorLog($text);
			return false;
		}
	}
	return $result;
}
function yasDB_clean($dirty, $encode_ent = false) {
    global $mysqli;
    $dirty = @trim($dirty);
    if ($encode_ent) {
        $dirty = htmlentities($dirty);
    }
    if(version_compare(phpversion(),'4.3.0') >= 0) {
        if(get_magic_quotes_gpc()) {
            $dirty = stripslashes($dirty);
        }
        $clean = $mysqli->real_escape_string($dirty);
    }
    else {
        if(!get_magic_quotes_gpc()) {
            $clean = addslashes($dirty);
        }
    }
    return $clean;
}
?>
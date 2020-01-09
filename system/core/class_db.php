<?php

defined('SINAUID') OR exit('No direct script access allowed');

class db {
	var $db_link;
	var $result;
	var $default_username = 'SinauID';
	var $mysqli_flag = MYSQLI_ASSOC; // mysqli_BOTH or mysqli_ASSOC or mysqli_NUM

	// Sets up database link using variables from a config file
	public function __construct($dbhost, $dbname, $dbuser, $dbpassword) {
		$this->db_link = @mysqli_connect( $dbhost, $dbuser, $dbpassword ) or die( 'Error: Tidak Bisa Konek ke Database: ' . mysqli_connect_error() );
		mysqli_select_db( $this->db_link, $dbname ) or die( 'Error: Tidak bisa memilih Database: ' . mysqli_error($this->db_link) );
	}

	// Preform any sql query
	public function go( $query = NULL, $ref = 0 ) {
		$this->use_log = 'go:';
		if( $query != NULL ) {
			$this->result[$ref] = @mysqli_query( $this->db_link, $query) or die('Error: Database Query Error<br><br>'.mysqli_error($this->db_link).'<hr/>'.$query);
			return $this->result[$ref];
		}
		
		return false;
	}
	
	// Return array with one result
	public function fetchArray( $ref = 0 ) {
		if( isset( $this->result[$ref] ) && !( empty( $this->result[$ref] ) ) ) {
			return @mysqli_fetch_array( $this->result[$ref], $this->mysqli_flag );
		}
		
		return false;
	}
	
	// Return an array with all the results
	public function fetchAll( $ref = 0 ) {
		if( isset( $this->result[$ref] ) && !( empty( $this->result[$ref] ) ) ) {
            $result = array();
			while( $a = @mysqli_fetch_array( $this->result[$ref], $this->mysqli_flag ) ) {
				$result[] = $a;
			}
			return $result;
		}
		
		return false;
	}
	
	// Number of rows returned from last called query
	public function numRows( $ref = 0 ) {
		if( isset( $this->result[$ref] ) && !( empty( $this->result[$ref] ) ) ) {
			return @mysqli_num_rows( $this->result[$ref] );
		}
		
		return false;

	}
	
	// Number of affectedrows returned from last called query
	public function affectedRows( $ref = 0 ) {
		if( isset( $this->result[$ref] ) && !( empty( $this->result[$ref] ) ) ) {
			return @mysqli_affected_rows( $this->result[$ref] );
		}
		
		return false;
	}
	
	// Return the last queries insert id
	public function lastId() {
		return @mysqli_insert_id($this->db_link);
	}
	
	// Clear a query result from the class
	public function clearResult( $ref = 0 ) {
		if( isset( $this->result[$ref] ) && !( empty( $this->result[$ref] ) ) ) {
			if( @mysqli_free_result( $this->result[$ref] ) ) 
				$clear = true;
			unset( $this->result[$ref] );
			if( isset( $clear ) ) {
				return true;
			}
			
			return false;
		}
		
		return false;
	}
	
	// Closes database connection
	public function close() {
		if( isset( $this->db_link ) && !( empty( $this->db_link ) ) ) {
			if( @mysqli_close( $this->db_link ) ) {
				return true;
			}
			
			return false;
		}

		return false;
	}
    
    public function q($val = '') {
        if(!$escaped = mysqli_real_escape_string($this->db_link, $val)) {
            $escaped = str_replace(array("\x00", "\n", "\r", '\\', "'", '"', "\x1a"), array('\x00', '\n', '\r', '\\\\' ,"\'", '\"', '\x1a'), $val);
        }
        
        return $escaped;
    }

	// Here CRUD function
    // Insert data into database
    public function insert($table, $fields = array()) {
    	$fields['created'] = time();
		$fields['created_by'] = isset($_SESSION['username']) ? $_SESSION['username'] : $this->default_username;
		if($table != 'change_logs') {
			$fields['updated'] = time();
			$fields['updated_by'] = isset($_SESSION['username']) ? $_SESSION['username'] : $this->default_username;
		}

    	$key = array_keys($fields);
	    $value = array_values($fields);

		$query = "INSERT INTO ".$table." (" . implode(', ', $this->q($key)) . ") VALUES ('" . implode("', '", $this->q($value)) . "')";
	    $sql = $this->go($query);

	    if($sql) {
			if($table != 'change_logs') {
				$this->changelog($query, $fields);
			}

	    	return $this->lastId();
	    }

		return false;
    }

    // Update data into database
    public function update($table, $fields = array(), $where = array()) {
		$fields['updated'] = time();
		$fields['updated_by'] = isset($_SESSION['username']) ? $_SESSION['username'] : $this->default_username;

		$query = "UPDATE ".$table." SET ";
	    $i = 0;
	    foreach($fields as $key => $value) {
	        $query.= $key." = '".$value."'";
	        if ($i < count($fields) - 1) {
	            $query.= " , ";
	        }
	        $i++;
	    }
	    if (count($where) > 0) {
	        $query.= " WHERE ";
	        $i = 0;
	        foreach($where as $key => $value) {
	            $query.= $key." = '".$this->q($value)."'";
	            if ($i < count($where) - 1) {
	                $query.= " AND ";
	            }
	            $i++;
	        }
	    }

	    $sql = $this->go($query);

	    if($sql) {
			$this->changelog($query, $fields);
	    	return $this->lastId();
	    }

	    return false;
	}
	
    // Delete data from database
    public function delete($table, $where = array()) {

		$query = "DELETE FROM ".$table." ";
	    if (count($where) > 0) {
	        $query.= " WHERE ";
	        $i = 0;
	        foreach($where as $key => $value) {
	            $query.= $key." = ".$this->q($value);
	            if ($i < count($where) - 1) {
	                $query.= " AND ";
	            }
	            $i++;
	        }
	    }

	    $sql = $this->go($query);

	    if($sql) {
			$this->changelog($query, $fields);
	    	return $this->lastId();
	    }

		return false;
	}

	private function changelog($db_query, $new_data = array(), $current_data = array()) {
		$login_as 	= isset($_SESSION['username']) ? $_SESSION['username'] : $this->default_username;
		$controller	= (!empty($_GET['do'])) ? $_GET['do'] : 'none';
		// $method     = $_SERVER['REQUEST_METHOD'];
		$method		= (!empty($_GET['act'])) ? $_GET['act'] : 'none';
		$post       = json_encode($_POST);
		$base_url 	= ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ? "https" : "http"); 
		$base_url  .= "://". @$_SERVER['HTTP_HOST']; 
		$base_url  .= str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
		$url        = $base_url . (!empty($_SERVER['QUERY_STRING']) ? '?' . $_SERVER['QUERY_STRING'] : '');
		$ip         = (!empty($_SERVER['REMOTE_ADDR'])) ? $_SERVER['REMOTE_ADDR'] : 'none';

		$insert = array(
			'created'      => time(),
			'created_by'   => $login_as,
			'controller'   => $controller,
			'action'       => $method,
			'querystring'  => $db_query,
			'post'         => json_encode($post),
			'url'          => $url,
			'ip'           => $ip,
			'current_data' => json_encode($current_data),
			'new_data'     => json_encode($new_data)
		);

		$this->insert('change_logs', $insert);
	}
}


?>
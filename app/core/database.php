<?php 
declare(strict_types=1);

/**
 * Singleton Database class
 *
 */

Class Database
{
	private static $inst = null;
	public $last_insert_id;
	public $row_count;
	public static $database_error;
	private $conn;


	/**
	 * It creates a new PDO object and assigns it to the  property of the class.
	 */
	private function __construct() {
		try{
			$dsn = DB_TYPE .":host=".DB_HOST.";dbname=".DB_NAME.";";
			 $this->conn = new PDO($dsn,DB_USER,DB_PASS);
			
		}catch(PDOExecption $e){
			die($e->getMessage());
		}
	}

	 /**
     * Call this method to get singleton
     *
     * @return Database
     */
    public static function getInstance()
    {
        if (self::$inst === null) {
            self::$inst = new Database();
        }
        return self::$inst;
    }

	/**
	 * If you try to clone this object, you'll get an error.
	 */
	public function __clone()
	{
    	trigger_error('Cloning forbidden.', E_USER_ERROR);
	}

	/**
	 * It takes a query and an array of data, and returns an array of data
	 * 
	 * @param query The SQL query to be executed.
	 * @param data The data to be inserted into the database.
	 * @param single if you want to return a single row, set this to true.
	 * 
	 * @return array|bool array of data from the database or false when there no data or error. 
	 */
	public function db_read(string $query, array $data = [], bool $single=false): array | false
	{
		$DB = $this->conn;
		$stm = $DB->prepare($query);

		if(count($data) == 0)
		{
			$check = $stm->execute();
		}else{
			$check = $stm->execute($data);
		}

		if($check)
		{
			if ($single) {
				$data = $stm->fetch(PDO::FETCH_ASSOC);
			}else{
				$data = $stm->fetchAll(PDO::FETCH_ASSOC);
			}

			if(is_array($data) && count($data) > 0)
			{
				$this->row_count = $stm->rowCount();
				return $data;
			}
			return false;
		}else
		{
			return false;
		}
	}

	/**
	 * It takes a query and an array of data, and returns true if the query was successful, and false if
	 * it wasn't
	 * 
	 * @param query The query to be executed.
	 * @param data This is an array of data that you want to insert into the database.
	 * 
	 * @return The return value is a boolean.
	 */
	public function db_write(string $query, array $data = []): bool
	{

		$DB = $this->conn;
		$stm = $DB->prepare($query);

		if(count($data) == 0)
		{
			$check = $stm->execute();
		}else{

			$check = $stm->execute($data);
		}
		
		if($check)
		{
			$this->last_insert_id = $DB->lastInsertId();
			return true;
		}else
		{
			self::$database_error = $DB->errorInfo();
			return false;
		}
	}

	
}
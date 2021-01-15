<?php
/**
 * A simple class PHP CRUD SQLITE  
 **************************
   This  class use PHP CRUD (Create, Read, Update, Delete) Application using OOP (Object Oriented Programming) and SQLITE.
 **************************
 * Before used this class, below the prerequises : 
 * The sqlite3 extension must be enable.
 * PHP 5 or newer
 * @author Hassane Moussa <mhassane2012@gmail.com>
 * @From Africa / Niamey-Niger
 * @License GPL
 */

 class SqliteCrud extends SQLite3
  {
    private
	
		$dirDataBase     = 'bin/sqlite/sqlite3/data',
		$dbName         = 'sqlite.db',
		$msgConnect = 'Connected database successfully',
		$array=array(),
		$i = 0;
    
	/**
    * Constructor of the class
	* Create db path folder,db file and .htaccess
    */
	public function __construct() {
		
		try {
			$this->open($this->makeFolderDb($this->dirDataBase)."/".$this->dbName);
		}catch(PDOException $e) {
			die($e->getMessage());
		}
    }
	
	/**
    * Function to make Folder of db.
	* @return Path created.
    */
	public function makeFolderDb($path){
		
		if(!is_dir($path)){
			mkdir($path,0755, true);
			file_put_contents($path.'/.htaccess','Deny from all');
		}
		
		return $path;
	}
	
	/**
	* Function Heredoc string for SQL.
    */
	public function heredocStringSql($string){
		
		$eofsql =<<< EOFSQL
			$string
EOFSQL;

		return $eofsql;
	}
	
	/**
    * Function to execute a command SQL (Create a Table,INSERT,UPDATE,DELETE).
	* @return boolean true or false.
    */
	public function executeCommandSql($sql){
		
		return $this->exec($this->heredocStringSql($sql));
	}
	
	/**
    * Function SELECT Operation.
	* @return array
    */
	public function selectTable($sqlcommand){
		
		$query = $this->query($this->heredocStringSql($sqlcommand));
		$row = $query->fetchArray(SQLITE3_ASSOC);

		while ($row = $query->fetchArray(SQLITE3_ASSOC))
		{
			foreach ($row as $key => $val){
			$this->array[$this->i][$key] = $val;
			}
			$this->i++;
		}
		
		return $this->array;
	}
	
	/**
    * Function Choise Operation CRUD with sql.
	* 
    */
	public function switchOperationsCrud($choise,$sql){
		
		switch($choise) {
		case "CREATETABLE":
		case "INSERT":
		case "UPDATE":
		case "DELETE":
			return $this->executeCommandSql($sql); 
		break;
		default: 
			return $this->selectTable($sql); 
			break;
		}
		
	}
	
	
	
  }
?>
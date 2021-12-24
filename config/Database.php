<?php 

    class Database{
        // Database Params
        private $host='localhost';
        private $db_name='myblog';
        private $username='root';
        private $password='';
        private $conn;

        // Database Connection
        public function connect(){
            $this->conn=null;
            
            try{
                // check ',' and ';' for DSN during connection
                $this->conn=new PDO('mysql:host='.$this->host.';dbname='.$this->db_name,$this->username,$this->password);

                // We set errormode so that we want to make exceptons when we get some mistake in query and it tells where is the mistake
                // for understanding attributes watch crash course
                $this->conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);  
                // Setting this attribute helps display error message properly at all cases of errors


            }catch(PDOException $e){
                echo 'Connection error:'.$e->getMessage();
            }
            return $this->conn;

        }
    }
?>
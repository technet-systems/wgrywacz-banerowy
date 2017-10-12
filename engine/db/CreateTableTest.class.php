<?php
include_once "UniversalConnect.class.php";

class CreateTableTest {
    private $tableMaster;
    private $hookup;
 
    public function __construct()
    {
        $this->tableMaster="sandTable";

        //Single line to create mysqli object
        $this->hookup=UniversalConnect::doConnect();

        $drop = "DROP TABLE IF EXISTS $this->tableMaster";

        if($this->hookup->query($drop) === true)
        {
                printf("Old table %s has been dropped.<br/>",$this->tableMaster);
        }

        $sql = "CREATE TABLE $this->tableMaster (id SERIAL, uname NVARCHAR(15), pw NVARCHAR(10), PRIMARY KEY (id))";

        if($this->hookup->query($sql) === true)
        {
                printf("Table $this->tableMaster has been created successfully.<br/>");
        }
        $this->hookup->close();
    }
}
$worker=new CreateTable();

?>
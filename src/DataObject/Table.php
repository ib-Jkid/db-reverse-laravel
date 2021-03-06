<?php  

namespace App\DataObject;

use SplObjectStorage;

class Table {

    private $contents;
    private $columns;
    private $name;
    private $contraints;

    public function __construct(string $tableName)
    {
        $this->name = $tableName;
        $this->contraints = array();
    }


    public function getName() : string {
        return $this->name;
    }

    public function addContents(array $contents) : void {
        $this->contents = $contents;
    }

    public function getContents() : array {
        return $this->contents;
    }

    public function setColumns(SplObjectStorage $columns) {
        $this->columns = $columns; 
    }

    public function getColums() : SplObjectStorage {
        return $this->columns;
    }

    public function addContraints(array $contraints) : void {
        $this->contraints = $contraints;
    }

    public function getContraints() : array {
        return $this->contraints;
    }

}
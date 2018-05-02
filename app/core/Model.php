<?php
class Model {

    protected $table_name;
    protected $id_column;
    protected $columns = [];
    protected $collection;
    protected $sql;
    protected $params = [];
    
    public function initCollection() {
        $columns = implode(',',$this->getColumns());
        $this->sql = "select $columns from " . $this->table_name ;
        return $this;
    }
    
    public function getColumns() {
        $db = new DB();
        $sql = "show columns from  $this->table_name;";
        $results = $db->query($sql);
        foreach($results as $result) {
            array_push($this->columns,$result['Field']);
        }
        return $this->columns;
    }


    public function sort($params) {
        foreach ($params as $field => $order) {
            $sortString[] = "$field $order";
        }
        $sortString = implode(", ",$sortString);
        $this->sql .=' ORDER BY '.$sortString;
        return $this;
    }

    public function filter($params) {
        return $this;
    }
    
    public function getCollection() {
        $db = new DB();
        $this->sql .= ";";
        $this->collection = $db->query($this->sql, $this->params);
        //var_dump($this->collection);
        return $this;
    }
    
    public function select() {
        return $this->collection;
    }
    
    public function selectFirst() {
        return isset($this->collection[0]) ? $this->collection[0] : null;
    }

    public function addItem($values) {
        $sql = "INSERT INTO $this->table_name (sku,name,price,qty) VALUES ('$values[sku]', '$values[name]', '$values[price]', $values[qty]);";
        $db = new DB();
        $params = array();
        $db->query($sql, $params);
    }

    public function deleteItem($id) {
        $sql = "DELETE FROM $this->table_name WHERE id = $id";
        $db = new DB();
        $params = array();
        $db->query($sql, $params);
    }
    public function getItem($id) {
        $sql = "select * from $this->table_name where $this->id_column = ?;";
        $db = new DB();
        $params = array($id);
        return $db->query($sql, $params)[0];
    }

    public function saveItem($id,$values) {
        $sql = "UPDATE $this->table_name SET sku = ?, name = ?, price = ?, qty = ? WHERE id = '$id';";
        foreach ($values as $value) {
            $parameters[] = $value;
        }
        $db = new DB();
        return $db->query($sql, $parameters);
    }

    public function getPostValues() {
        $values = [];
        $columns = $this->getColumns();
        foreach ($columns as $column) {
            if ( isset($_POST[$column]) && $column !== $this->id_column ) {
                $values[$column] = $_POST[$column];
            }
            /*$column_value = filter_input(INPUT_POST, $column);
            if ($column_value && $column !== $this->id_column ) {
                $values[$column] = $column_value;
            }*/
        }
        return $values;
    }

}

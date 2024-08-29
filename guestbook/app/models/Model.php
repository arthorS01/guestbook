<?php

namespace app\Models;

use App\App;

class Model{

    protected ?string $table = null ;
    /**returns a particular entry based on the field value
     * if entry is not found, False is returned
     * @param string $field
     * @return Model|bool
     */

    public function findOrFail(string|array $fields="id"){

        $query = "SELECT * FROM {$this->get_table()} {$this->get_where($fields)}";
    
        $result = App::$db->read($query,$fields);

    
        if((bool)$result){
            $result = $result->fetch(\PDO::FETCH_OBJ);

            
            return  $this->processToClass($result);
        }else{
           return false;
        }
    }

    /**returns all the entries of a particular model */
    public function all( array $param=null){
      
        $query = null;
        if(is_null($param)){
            $query = "SELECT * FROM {$this->get_table()}";
        }else{
            $query = "SELECT * FROM {$this->get_table()} {$this->get_where($param)}";
        }
      
        $result = App::$db->read($query,$param);

        return $result->fetchAll();

    }

    /**
     * returns the name of the table
     */
    protected function get_table(){

        if(is_null($this->table)){
                    
            $table = strtolower(get_class($this));
            $table = explode("\\",$table);
            $table = array_reverse($table);
            $table=$table[0]."s";

            return $table;

        }else{
            return $this->table;
        }
    }

    private function get_where(array|string $fields){

        $query = "where ";

        if(is_array($fields)){
            $keyCount = 0;
            //add each element in the array to the query
            foreach($fields as $key=>$field){

                $string = " {$key}=:{$key}";
                $query.=$string;
                
                if($keyCount <  count($fields)-1){
                    $query.=" and ";
                }
                $keyCount++;
            }
        }else{
            $string= " id=:id";
            $query.=$string;
        }


        return $query;
    }


    public function save(){

        $query = "INSERT into {$this->get_table()}({$this->get_fields_str()}) Values({$this->get_values_str()})";
        
        $result = App::$db->create($query,$this->get_field_data());
        
        if($result){
            return true;
        }else{
            return false;
        }
    }

    public function update(array $data)
    {
        if($this->id == null){
            die("id cannot be null");
        }
        $query = "UPDATE {$this->get_table()} SET {$this->get_set_fields($data)} where id = $this->id";

        $result = App::$db->update($query,$data);

    }

    public function delete()
    {
        if(is_null($this->id)){
            die("Id should not be null");
        }

        $query = "DELETE FROM {$this->get_table()} where id = :id";

        App::$db->delete($query,$this->id);
    }
    
    private function get_fields_str()
    {
        //initialize empty string
        $str = "";
        //scan through fields array
        foreach($this->fields as $key=>$field){
            $str.=$field;

            if($key < count($this->fields)-1){
                $str.=",";
            }
        }

        return $str;
    }

    private function get_set_fields($data)
    {
        $str = "";

        $counter = 0;

        foreach($data as $key=>$entry){

            if(!in_array($key,$this->fields)){
                die("'$key' is not a field on the {$this->get_table()} table");
            }
            $str .= "$key=:$key";
            if($counter < count($data)-1){
                $str.=",";
            }
            $counter++;
        }

       return $str;

    }

    private function get_values_str()
    {
        //initialize empty string
        $str = "";
        //scan through fields array
        foreach($this->fields as $key=>$field){
            $str.=":$field";

            if($key < count($this->fields)-1){
                $str.=",";
            }
        }

        return $str;
    }

    private function get_field_data()
    {
        $data = [];
        //scan through fields array
        foreach($this->fields as $key=>$field){
            $data[$field] = $this->$field;
        }


        
        return $data;
    }

    private function processToClass($obj)
    {
        $class = get_class($this);

        
        $myObj = new $class;

        $obj= (array)$obj;
        
        foreach($obj as $Key=>$field){
            $myObj->$Key = $field;
        }

        return $myObj;
    }
}
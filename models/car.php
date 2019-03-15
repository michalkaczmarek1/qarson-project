<?php

class Car
{
    public $id;
    public $mark;
    public $model;
    public $engine;
    public $model_name;
    public $photo;
    public $availability;

    public function saveData(array $file_input, $database): string
    {

        $sql = "INSERT INTO cars(mark, model, engine, model_name, photo, availability) VALUES ";
        $i = 0;
        foreach ($file_input as $value) {
            
            $this->model_name = $value["mark"] . ' ' . $value["model"] . ' ' . $value["engine"];

            $sql .= "('".$value["make"]."','".$value["model"]."','".$value["engine"]."',
            '".$this->model_name."','".$value["photo"]."','".$value["availability"]."')";

            $i++;

            if($i < count($file_input)){
                $sql .= ",";
            } else {
                $sql .= "";
            }
        }

        return $sql;
    }
}

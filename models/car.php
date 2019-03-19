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

    /**
     * save data with file json to database
     *
     * @param array $file_input
     * @param PDO $database
     * @return boolean
     */
    public function saveData(array $file_input, PDO $database): bool
    {
        // create sql
        $sql = "INSERT INTO cars(mark, model, engine, model_name, photo, availability) VALUES ";
        $i = 0;

        foreach ($file_input as $value) {
            
            // set variables to save the database
            $this->model_name = $value["make"] . ' ' . $value["model"] . ' ' . $value["engine"];
            $value["photo"] = !isset($value["photo"]) ? "brak informacji" : $value["photo"];
            $value["availability"] = $value["availability"] === false ? "Nie" : $value["availability"];

            $sql .= "('" . htmlentities($value["make"]) . "','" . htmlentities($value["model"]) . "','" . htmlentities($value["engine"]) . "',
            '" . htmlentities($this->model_name) . "','" . htmlentities($value["photo"]) . "','" . htmlentities($value["availability"]);

            $i++;

            if ($i === count($file_input)) {
                $sql .= "')";
            } else {
                $sql .= "'),";
            }

        }

        // prepare sql
        $insertSql = $database->prepare($sql);

        // execute sql
        if ($insertSql->execute()) {
            return true;
        } else {
            throw new PDOException("Błąd zapytania");
            return false;
        }

    }

    /**
     * get list of cars with database
     *
     * @param PDO $database
     * @return array
     */
    public function getCars(PDO $database): array
    {
        // create sql
        $sql = "SELECT * FROM cars";

        // prepare sql
        $getSql = $database->prepare($sql);

        // execute sql
        if ($getSql->execute() === false) {
            throw new PDOException("Błąd zapytania");
        }

        if ($getSql->rowCount() > 0) {
            $result = $getSql->fetchAll();
        }

        return $result;

    }

    /**
     * change availability cars in database
     *
     * @param string $availability
     * @param integer $id
     * @param PDO $database
     * @return boolean
     */
    public function changeAvailabilityCar(string $availability, int $id, PDO $database): bool
    {
        // create sql
        $changeSql = "UPDATE cars SET availability = '".$availability."' WHERE id = ".$id;

        // prepare sql
        $changeSql = $database->prepare($changeSql);

        // execute sql
        if ($changeSql->execute() === false) {
            throw new PDOException("Błąd zapytania");
            return false;
        } else {
            return true;
        }

    }
    
    /**
     * delete cars with database
     *
     * @param integer $id
     * @param PDO $database
     * @return boolean
     */
    public function deleteCar(int $id, PDO $database): bool
    {
        // create sql
        $deleteSql = "DELETE FROM cars WHERE id = ".$id;

        // prepare sql
        $deleteSql = $database->prepare($deleteSql);

        // execute sql
        if ($deleteSql->execute() === false) {
            throw new PDOException("Błąd zapytania");
            return false;
        } else {
            return true;
        }

    }
}

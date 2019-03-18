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

    public function saveData(array $file_input, PDO $database): bool
    {

        $sql = "INSERT INTO cars(mark, model, engine, model_name, photo, availability) VALUES ";
        $i = 0;

        foreach ($file_input as $value) {
            // print_r ($value);

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

            // $sql .= "('".htmlentities($value["make"])."','".htmlentities($value["model"])."','".htmlentities($value["engine"])."',
            // '".htmlentities($this->model_name)."','".htmlentities($value["photo"])."','".htmlentities($value["availability"])."')";

        }

        // $newData["offers"]["make"] = $value["make"];
        // $newData["offers"]["model"] = $value["model"];
        // $newData["offers"]["engine"] = $value["engine"];
        // $newData["offers"]["availability"] = $value["availability"];
        // $newData["offers"]["photo"] = $value["photo"];

        $insertSql = $database->prepare($sql);

        if ($insertSql->execute()) {
            return true;
        } else {
            throw new PDOException("Błąd zapytania");
            return false;
        }

    }

    public function getCars(PDO $database): array
    {

        $sql = "SELECT * FROM cars";

        $getSql = $database->prepare($sql);

        if ($getSql->execute() === false) {
            throw new PDOException("Błąd zapytania");
        }

        if ($getSql->rowCount() > 0) {
            $result = $getSql->fetchAll();
        }

        return $result;

    }

    public function changeAvailabilityCar($availability, $id, PDO $database)
    {
        // $this->availability = $availability === false ? "Nie" : "Tak";
        $changeSql = "UPDATE cars SET availability = '".$availability."' WHERE id = ".$id;

        $changeSql = $database->prepare($changeSql);

        if ($changeSql->execute() === false) {
            throw new PDOException("Błąd zapytania");
            return false;
        } else {
            return true;
        }

    }

    public function deleteCar($id, PDO $database)
    {
        // $this->availability = $availability === false ? "Nie" : "Tak";
        $deleteSql = "DELETE FROM cars WHERE id = ".$id;

        $deleteSql = $database->prepare($deleteSql);

        if ($deleteSql->execute() === false) {
            throw new PDOException("Błąd zapytania");
            return false;
        } else {
            return true;
        }

    }
}

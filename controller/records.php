<?php
require_once '../model/records.php';

class Coffeorder {
    private $model;

    public function __construct() {
        $this->model = new Coffeorder();
    }

    public function createcoffeorderupdatecoffeorder($data) {
        if ($this->model->insertcoffeorderupdatecoffeorder($data)) {
            echo json_encode(["message" => "Coffe record added successfully!"]);
        } else {
            echo json_encode(["message" => "Error"]);
        }
    }

    public function updatecoffeorder($id, $data) {
        if ($this->model->updatecoffeorder($id, $data)) {
            echo json_encode(["message" => "Record updated successfully!", "result" => $data]);
        } else {
            echo json_encode(["message" => "Error"]);
        }
    }

    public function deletecoffeorder($id) {
        if ($this->model->deletecoffeorderupdatecoffeorder($id)) {
            echo json_encode(["message" => "Record deleted successfully!"]);
        } else {
            echo json_encode(["message" => "Record not found."]);
        }
    }

    public function searchcoffeorder($ownername) {
        $records = $this->model->searchcoffeorder($ownername);
        if (!empty($records)) {
            echo json_encode($records);
        } else {
            echo json_encode(["message" => "No records found."]);
        }
    }

    public function getAllcoffeorderupdatecoffeorders() {
        $records = $this->model->getAllcoffeorders();
        if (!empty($records)) {
            echo json_encode($records);
        } else {
            echo json_encode(["message" => "No records found."]);
        }
    }
}
?>
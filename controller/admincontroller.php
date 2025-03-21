<?php
require_once '../model/admincontroller.php';

class orderController {
    private $order;

    public function __construct()
    {
        $this->order = new order();
    }
    // Get order by id
    public function Getorder($id){
        $order = $this->order->Getorder($id);
        if($order){
            echo json_encode($order);
        } else{
            echo json_encode(['message' => 'No order found']);
        }
    }
    //get all orders by user id
    public function GetallordersByUserId($user_id){
        $order = $this->order->GetorderByUserId($user_id);
        if($order){
            echo json_encode($order);
        } else{
            echo json_encode(['message' => 'No order found']);
        }
    }
    // Get all orders
    public function GetAllorders(){
        $orders = $this->order->GetAllorders();
        if($orders){
            echo json_encode($orders);
        } else{
        echo json_encode(['message' => 'No order found'. $orders]);
        } 
    }
    //Create order
    public function Createorder($input){
        $user_id = $input['user_id'];
        $order_name = $input['order_name'];
        $order_coffename = $input['order_coffename'];
        $this->order->Createorders($user_id,$order_name, $order_coffename);
    }
    //Update order status
    public function UpdateordersStatus($id, $input){
        $order = $this->order->Getorder($id);
        if(!$order){
            echo json_encode(['message' => 'No order found']);
            return;
        }
        $status = $input['status'];
        $this->order->UpdateStatus($status, $id);
        echo json_encode(['message' => 'order status updated']);
    }
    //Delete order
    public function Deleteorder($id){
        $order = $this->order->Getorder($id);
        if(!$order){
            echo json_encode(['message' => 'No order found']);
            return;
        }
        $this->order->Deleteorder($id);
        echo json_encode(['message' => 'order deleted']);
    }

}
?>
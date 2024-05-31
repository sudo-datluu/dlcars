<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    protected $carModel;

    public function __construct(Car $car)
    {
        $this->carModel = $car;
    }

    public function order($orderID) {
        $order = Order::find($orderID);
        $car = null;

        if ($order) {
            $car = $this->carModel->get($order->carID);
        }

        return view('order', [
            'car' => $car,
            'order' => $order
        ]);
    }

    public function confirm($orderID) {
        $order = Order::find($orderID);
        if (!$order->status) {
            $order->status = 1;
            $order->save();
    
            $cars = $this->carModel->getAllCars();
    
            // Find the car with the matching ID
            foreach ($cars as &$car) {
                if ($car['id'] == $order->carID) {
                    // Update the quantity
                    $car['quantity'] -= $order->qty;
    
                    // If the quantity is 0, set 'available' to false
                    if ($car['quantity'] == 0) {
                        $car['available'] = false;
                    }
    
                    break;
                }
            }
            file_put_contents($this->carModel->filePath, json_encode($cars));
            return response() -> json([
                'status' => true
            ]);
        }
        return response() -> json([
            'status' => false,
            'errors' => "This order is confirmed"
        ]);
    }
        
}

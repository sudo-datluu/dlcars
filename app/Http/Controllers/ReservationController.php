<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Car;
use App\Models\Reservation;
use App\Models\Order;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;

class ReservationController extends Controller
{
    protected $carModel;

    public function __construct(Car $car)
    {
        $this->carModel = $car;
    }

    function index() {
        $reservation = session('reservation');
        $car = null;
        if ($reservation) {
            $car = $this->carModel->get($reservation->carID);
        }
        $data['reservation'] = $reservation;
        $data['car'] = $car;
        return view('reservation', [
            'reservation' => $reservation,
            'car' => $car
        ]);
    }

    public function clear(Request $request) {
        $request->session()->forget('reservation');
        return response() -> json([
            'status' => 'success'
        ]);
    }

    public function save(Request $request) {

        $reservation = session('reservation');
        $car = $this->carModel->get($reservation->carID);
        if ($car['available']) {
            // Clear reservation
            $order = new Order();

            $validator = Validator::make($reservation->toArray(),[
                'carID' => 'required|integer',
                'qty' => 'required|integer',
                'name' => 'required|string',
                'license' => 'required|string',
                'email' => 'required|email',
                'phone' => 'required|string',
                'startDate' => 'required|date',
                'endDate' => 'required|date',
                'total' => 'required|between:0,9999999.99'
            ]);

            if ($validator->fails()) {
                return response() -> json([
                    'status' => false,
                    'errors' => 'The quantity of this car should be no greater than ' + $car['quantity']
                ]);
            }

            if ($reservation->qty > $car['quantity']) {
                return response() -> json([
                    'status' => false,
                    'errors' => $validator->errors()
                ]);
            }

            $order->carId = $reservation->carID;
            $order->qty = $reservation->qty;
            $order->name = $reservation->name;
            $order->license = $reservation->license;
            $order->email = $reservation->email;
            $order->phone = $reservation->phone;
            $order->start = $reservation->startDate;
            $order->end = $reservation->endDate;
            $order->total = $reservation->total;
            
            $request->session()->forget('reservation');
            $order->save();

            return response() -> json([
                'status' => true,
                'message' => 'Order placed successfully',
                'order' => $order,
                'order_url' => route('order', $order->id ?? 1)
            ]);
        } else {
            return response() -> json([
                'status' => false,
                'errors' => 'The car is not available'
            ]);
        }
    }

    public function store(Request $request) {
        $data = $request->validate([
            'carID' => 'nullable|integer',
            'qty' => 'nullable|integer',
            'name' => 'nullable|string',
            'license' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'startDate' => 'nullable|date',
            'endDate' => 'nullable|date',
            'total' => 'nullable|between:0,9999999.99'
        ]);
        $reservation = session('reservation');

        if (isset($data['startDate'])) {
            $data['startDate'] = Carbon::parse($data['startDate'])->format('d M Y');
            $reservation->startDate = $data['startDate'];
        }
    
        if (isset($data['endDate'])) {
            $data['endDate'] = Carbon::parse($data['endDate'])->format('d M Y');
            $reservation->endDate = $data['endDate'];
        }

        if (!$reservation) {
            $reservation = new Reservation($data);
        } else {
            if (isset($data['carID'])) {
                $reservation->carID = $data['carID'];
            }

            if (isset($data['qty'])) {
                $reservation->qty = $data['qty'];
            }

            if (isset($data['name'])) {
                $reservation->name = $data['name'];
            }


            if (isset($data['license'])) {
                $reservation->license = $data['license'];
            }

            if (isset($data['email'])) {
                $reservation->email = $data['email'];
            }

            if (isset($data['phone'])) {
                $reservation->phone = $data['phone'];
            }

            if (isset($data['total'])) {
                $reservation->total = $data['total'];
            }  
        }

        Session::put('reservation', $reservation);
        return response()->json([
            'status' => 'success',
            'reservation' => $reservation
        ]);
    }
}

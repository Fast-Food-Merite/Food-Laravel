<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Throwable;

class ReservationController extends Controller
{
    public function reservation(Request $req){
        if ($req->filled('name', 'email', 'place', 'number', 'reservationDate')) {
            try{
                $booking = Reservation::create([
                    'name' => $req->name,
                    'email' => $req->email,
                    'place' => $req->place,
                    'number' => $req->number,
                    'reservationDate' => $req->reservationDate,
                    'validation' => false
                ]);
            } catch(Throwable $e){
                return[
                    "status" => "error",
                    "message" => "champ incomplet"
                ];
            }

            if ($booking) {
                return [
                    'status' => "success",
                    'message' => "ca marche",
                ];
            } else {
                return [
                    'message' => "donnees non envoyees ou mal envoyees"
                ];
            }
        } else {
            return [
                'code' => 'validation erronne',
                'message' => 'voir les donnees entrees',
            ];
        }
    }

    public function getReservation(){
        $reservation = Reservation::all();

        return $reservation;
    }

    public function delete($id){
        $reservation = Reservation::find($id);

        if ($reservation) {
            $delete = $reservation->delete();

            if ($delete) {
                return [
                    'code' => "succes",
                    'message' => "ca marche",
                ];
            } else {
                return [
                    'code' => "default",
                    'message' => "ca marche pas",
                ];
            }
        } else {
            return [
                'code' => "error",
                'message' => "L'élément n'existe plus",
            ];
        }
    }
}

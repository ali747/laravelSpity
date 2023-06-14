<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Traits\HasRoles;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Attendance;
use App\Models\AttendanceUser;

class AttendanceController extends Controller
{
    public function checkIn(Request $request)
    {
        $ipAddress = $request->ip();
        $address = AttendanceUser::where('ip_address', $ipAddress)->first();
        //return $address->ip_address;
        if ($address) {
            Attendance::create(
                [
                    "ip_address" => $address->ip_address,
                    "checkIn_time" => Carbon::now()
                ]


            );
            //$address->save();

            return response()->json($address);
        }

        return response()->json(['Message' => "It is a remote user. Your IP is " . $ipAddress]);
    }
    public function checkout(Request $request)
    {
        $ip = $request->ip();
        $endTime = Carbon::now();
        $address = AttendanceUser::where('ip_address', $ip)->first();
        if ($address) {
            // Calculate difference between $this->startTime and $endTime
            $ipemp = Attendance::where('ip_address', $ip)->first();

            $difference = $endTime->diffInHours($ipemp->checkIn_time);
            $ipemp->checkout_time = $endTime;
            $ipemp->stay_duration = $difference;
            $ipemp->save();
            return response()->json([
                "ip_address" => $ip,
                "location" => $address->location,
                "stay_duration" => $difference
            ]);
        }
    }
}

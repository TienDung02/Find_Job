<?php

use App\Models\Candidate;
use App\Models\Employer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

if (!function_exists('getDayDifference')) {
    function getDayDifference($data)
    {
        $dateToCompare = $data->updated_at;
        $now = Carbon::now();
        $daysDifference = $now->diffInDays($dateToCompare);

        if ($daysDifference < 1) {
            $hoursDifference = $now->diffInHours($dateToCompare);
            if ($hoursDifference < 1) {
                $minutesDifference = $now->diffInMinutes($dateToCompare);
                if ($minutesDifference < 1) {
                    $secondsDifference = $now->diffInSeconds($dateToCompare);
                    return $secondsDifference . ' seconds ago';
                }
                return $minutesDifference . ' minutes ago';
            }
            return $hoursDifference . ' hours ago';
        } elseif ($daysDifference > 1) {
            return $daysDifference . ' days ago';
        } else {
            return $daysDifference . ' day ago';
        }
    }
}
if (!function_exists('truncateText')) {
    function truncateText($text, $length = 6)
    {
        if (strlen($text) > $length){
           $text = substr($text, 0, $length) . '...';
        }
        return  $text;
    }
}
if (!function_exists('checkUser')) {
    function checkUser()
    {
        $user = Auth::user();
        $data = null;
        if ($user) {
            if ($user->role == 2) {
                $data = Candidate::where('user_id', $user->id)->firstOrFail();
            } elseif ($user->role == 3) {
                $data = Employer::where('user_id', $user->id)->firstOrFail();
            }
        }
        return $data;
    }
}

?>


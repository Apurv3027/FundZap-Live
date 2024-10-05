<?php

namespace App\Helper;

use Request;
use App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use URL;
use DateTime;
use DateTimeZone;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class helper
{
    // Role Types
    public static function RolesArray()
    {
        $roles = [
            1 => 'Admin',
            2 => 'User',
        ];
        return $roles;
    }

    // // Plans Types
    // public static function PlansArray()
    // {
    //     $plans_array = [
    //         ['id' => '1', 'type' => 'Free', 'description' => 'Basic plan with limited features.', 'price' => '0'],
    //         ['id' => '2', 'type' => 'Standard', 'description' => 'Intermediate plan with moderate features.', 'price' => '500'],
    //         ['id' => '3', 'type' => 'Premium', 'description' => 'Advanced plan with full features.', 'price' => '1000'],
    //     ];
    //     return $plans_array;
    // }

    // User Status
    public static function UserStatusArray()
    {
        $user_status_array = [
            1 => 'enable',
            2 => 'disable',
        ];
        return $user_status_array;
    }

    /* For Store Path Start */
    public static function profileFileUploadPath()
    {
        return storage_path('app/public/profilepic/');
    }
    /* For Store Path End */

    /* For Display Image */
    public static function displayProfilePath()
    {
        return URL::to('/') . '/storage/profilepic/';
    }

    public static function getRoleArray()
    {
        return [
            '1' => 'Super Admin',
            '2' => 'Admin',
            '3' => 'User',
        ];
    }

    public static function getTimezone()
    {
        if (Session::get('customTimeZone') && Session::get('customTimeZone') != '') {
            return Session::get('customTimeZone');
        } else {
            return 'Europe/Berlin';
        }
    }

    public static function displayDateTimeConvertedWithFormat($date, $format = '')
    {
        if (!$format) {
            $format = config('const.displayDateTimeFormatForAll');
        }

        $dt = new DateTime($date);
        $tz = new DateTimeZone(Helper::getTimezone()); // or whatever zone you're after

        $dt->setTimezone($tz);
        return $dt->format($format);
    }

    public static function Status($user)
    {
        if ($user->document_verified) {
            return '<button type="button" class="btn green btn-xs pointerhide cursornone">Verified</button>';
        } else {
            return '<button type="button" class="btn red btn-xs pointerhide cursornone">Not Verified</button>';
        }
    }

    public static function Action($editLink = '', $deleteID = '', $viewLink = '', $verifyUserDocumentsLink = '')
    {
        if ($editLink) {
            $edit = '<a href="' . $editLink . '" class="btn btn-xs green"> <i class="fa fa-edit"></i></a>';
        } else {
            $edit = '';
        }

        if ($deleteID) {
            $delete = '<a id="' . $deleteID . '" class="btn btn-xs red deleterecord"> <i class="fa fa-trash"></i></a>';
        } else {
            $delete = '';
        }

        if ($viewLink) {
            $view = '<a href="' . $viewLink . '" class="btn btn-xs blue"><i class="fa fa-eye"></i></a>';
        } else {
            $view = '';
        }

        if (isset($verifyUserDocumentsLink) && $verifyUserDocumentsLink == config('const.userDocumentNotVerify')) {
            $verifyDocuments =
                '<img src="' .
                URL::to('/assets/images/loading.gif') .
                '" id="loader' .
                $deleteID .
                '" style="display:none;">
                <button user_id="' .
                $deleteID .
                '" type="button" class="btn green btn-xs verify-documents">Verify Documents</button>';
        } else {
            $verifyDocuments = '';
        }

        return $view . '' . $edit . '' . $delete . '' . $verifyDocuments;
    }

    // public static function getAdminData()
    // {
    //     return [
    //         'name'      => config('const.admin.name'),
    //         'email'     => config('const.admin.email'),
    //         'password'  => Hash::make(config('const.admin.password')),
    //         'email_verified_at'=>Carbon::now(),
    //         'role_id'   => 1,
    //         'status'    => 1,
    //     ];
    // }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller {
    /*Created by : Dipali Suryawanshi
    Purpose: To show user's filtered data
    Date: 01-04-2025
    */
    public function index(Request $request) {       
        //Use eloquent query to avoid n+1 query issue and get user's data using ''with' command
        $query = User::with(['details', 'location']);

        /*Return only those fields which are mentioned in api url parameters*/
        $users = $query->get();

        if ($request->has('fields')) {
            $fields = explode(',', $request->fields);
            $users = $users->map(function ($user) use ($fields) {
                return collect($user)->only($fields);
            });
        }
        /* End of Return only those fields which are mentioned in api url parameters*/

        /*Get all user data based on filters applied in api url parameters*/
        else{

            if ($request->has('gender')) {
                $query->whereHas('details', function ($q) use ($request) {
                    $q->where('gender', $request->gender);
                });
            }

            if ($request->has('city')) {
                $query->whereHas('location', function ($q) use ($request) {
                    $q->where('city', $request->city);
                });
            }

            if ($request->has('country')) {
                $query->whereHas('location', function ($q) use ($request) {
                    $q->where('country', $request->country);
                });
            }
            $users = $query->paginate($request->input('limit', 10));            
        }
        /*End of Get all user data based on filters applied in api url parameters*/

        //return response in json format
        return response()->json($users);
    }    
}


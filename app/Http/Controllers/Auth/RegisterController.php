<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
    Address
};
use App\Http\Requests\Auth\RegisterRequest;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(RegisterRequest $request){
        $requestdata = $request->all();
        $requestdata['user']['role'] = 'participant';

        $user = User::create($requestdata['user']);
        $user->address()->create($requestdata['address']);

        foreach ($requestdata['phones'] as $phone) {
            $user->phone()->create($phone);
        }
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\{
    User,
    Address
};
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;

class RegisterController extends Controller
{
    public function create(){
        return view('auth.register');
    }

    public function store(Request $request){
        $requestdata = $request->all();
        $requestdata['user']['role'] = 'participant';

        $user = User::create($requestdata['user']);
        $user->address()->create($requestdata['address']);

        foreach ($requestdata['phones'] as $phone) {
            $user->phone()->create($phone);
        }
    }
}

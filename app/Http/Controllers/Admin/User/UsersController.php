<?php

namespace App\Http\Controllers\Admin\User;

use App\Events\User\UserRegistered;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Services\User\UserCreateService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    
    private $userRepository;
    
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }
    
    public function index()
    {
        $users = $this->userRepository->all();
        
        return view('admin.user.index', compact('users'));
    }
    
    public function create()
    {
        return view('admin.user.create');
    }
    
    public function store(Request $request)
    {
        $userCreateService = new UserCreateService([
            'name'     => $request->input('name'),
            'email'    => $request->input('userEmail'),
            'password' => $request->input('userPassword'),
        ]);
        
        $user_create_result = $userCreateService->perform();
        
        return redirect()->back()->with('success', $user_create_result);
    }
    
    public function search(Request $request)
    {
        $results = $this->userRepository->searchUsers($request->search);
        return response()->json(['items'=>$results]);
    }
    
 
    
}

<?php


namespace App\Http\Controllers\Admin\User;


use App\Http\Controllers\Controller;
use App\Models\UserAccount;
use App\Repositories\Contracts\GatewayRepositoryInterface;
use App\Repositories\Contracts\UserAccountRepositoryInterface;
use Illuminate\Http\Request;

class UserAccountController extends Controller
{
    /**
     * @var UserAccountRepositoryInterface
     */
    private $user_account_repository;
    
    public function __construct(
        UserAccountRepositoryInterface $user_account_repository
    ) {
        $this->user_account_repository = $user_account_repository;
    }
    
    public function index()
    {
        $userAccounts = $this->user_account_repository->all();
        
        return view('admin.user.account.index', compact('userAccounts'));
    }
    
    public function create()
    {
        $userAccountStatus = UserAccount::getStatuses();
        $userAccountItem   = null;
        
        return view('admin.user.account.create',
            compact('userAccountStatus', 'userAccountItem'));
    }
    
    public function store(Request $request)
    {
        $newUserAccount = $this->user_account_repository->store([
            'user_account_user_id'      => $request->owner,
            'user_account_title'        => $request->title,
            'user_account_card_number'  => $request->account_card,
            'user_account_sheba_number' => $request->account_sheba,
            'user_account_number'       => $request->account_number,
            'user_account_status'       => $request->account_status,
        ]);
        if ($newUserAccount) {
            return redirect()->back()
                             ->with('status', 'حساب جدید با موفقیت اضافه شد');
        }
    }
    
    public function delete(Request $request‌, $id)
    {
        $deleteAccount = $this->user_account_repository->delete($id);
        if ($deleteAccount) {
            return redirect()->back()
                             ->with('status', 'حساب بانکی با موفقیت حذف شد');
        }
    }
    
    public function edit(Request $request)
    {
        $userAccountItem   = $this->user_account_repository->find($request->id);
        $userAccountStatus = UserAccount::getStatuses();
        
        return view('admin.user.account.edit',
            compact('userAccountItem', 'userAccountStatus'));
        
    }
    
    public function update(Request $request, $id)
    {
        $updateUserAccount
            = $this->user_account_repository->update($id,
            [
                'user_account_user_id'      => $request->input('owner'),
                'user_account_title'        => $request->input('title'),
                'user_account_card_number'  => $request->input('account_card'),
                'user_account_sheba_number' => $request->input('account_sheba'),
                'user_account_number'       => $request->input('account_number'),
                'user_account_status'       => $request->input('account_status'),
            ]
        );
        if ($updateUserAccount) {
            return redirect()->back()
                             ->with('status', 'حساب بانکی با موفقیت تغییر کرد');
        }
        
    }
    
    public function search(Request $request)
    {
        $gateway_id         = $request->gateway;
        $gateway_repository = resolve(GatewayRepositoryInterface::class);
        $gateway_item       = $gateway_repository->find($gateway_id);
        $results            = $this->user_account_repository->findBy([
            'user_account_user_id' => $gateway_item->gateway_user_id,
        ], ['user_account_id as id', 'user_account_title as text'],false);
        //$htmlResult = view('admin.user.account.search',compact('results'))->render();
        return response()->json([
            'items' => $results,
        ]);
    }
    
    
}
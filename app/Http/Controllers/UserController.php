<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Utils\PayTech;
use App\Models\Account;
use App\Models\Payment;
use App\Models\AccountItem;
use Illuminate\Http\Request;
use App\Http\Middleware\Auth;
use App\Models\PaymentPending;
use Illuminate\Support\Carbon;
use App\Models\PaymentNotConfirm;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class UserController extends Controller
{

    use PayTech;
    public function __construct()
    {
        $this->middleware(Auth::class)->except(['ipn']);
    }

    public function profile()
    {
        $user = auth()->user();

        if ($user->is_admin) {

            return view('admin-profile')->with([
                'accounts' => Account::with('account_items')->get(),
            ]);
        }

        $account_items = $user->account_items;

        return view('profile', compact('account_items'));
    }

    public function newAccount()
    {
        return view('new-account');
    }

    public function newAccountPost(Request $request, Logger $log)
    {
        $request->validate([
            'nb_month' => 'required|integer|min:1|max:3',
        ]);

        $availableAccount = AccountItem::whereUserId(null)->whereStatus(true)->first();
        if ($availableAccount) {
            DB::beginTransaction();
            try {

                $user = auth()->user();
                $reference = uniqid();

                $customfield = json_encode([
                    'email' => $user->phone,
                    'user_id' => $user->id,
                    'amount' => $this->price * $request->nb_month,
                    'nb_month' => $request->nb_month,
                    'ref' => $reference,
                ]);

                $data = [
                    'item_price' => $this->price * $request->nb_month,
                    "currency"     => "xof",
                    "ref_command" => $reference,
                    'item_name' => $this->command_name,
                    'command_name' => $this->command_name,
                    "success_url"  =>  URL::to('/pay-success'),
                    "ipn_url"      =>  URL::to('/api/pay-ipn'),
                    "cancel_url"   =>  URL::to('/pay-cancel'),
                    'env' => 'test',
                    "custom_field" =>   $customfield,
                ];
                Payment::create([
                    "reference" => $reference,
                    "status" => false,
                    "account_item_id" => $availableAccount->id,
                    "via" => "PayTech",
                    "nb_month" => $request->nb_month,
                    "date" => Carbon::now(),
                    "amount" => $this->price * $request->nb_month,
                    "user_id" => $user->id,
                ]);

                DB::commit();

                toastr()->info('Payer en ligne et activer votre compte', 'Informtion');
                return $this->requestPayment($data, $user);
            } catch (\Exception $e) {
                DB::rollBack();
                toastr()->error('Une erreur s\'est produite.', 'Oups !!');
                return redirect()->route('new-account');
            }
        }

        toastr()->error('Aucun compte disponible pour le moment.');
        return redirect()->route('new-account');
    }

    public function ipn(Request $request, Logger $logger)
    {
        $logger->debug($request->all());
        $api_key_sha256 = $request->api_key_sha256;
        $api_secret_sha256 = $request->api_secret_sha256;
        // hash('sha256', $this->secret_key) === $api_secret_sha256 && hash('sha256', $this->api_key) === $api_key_sha256
        if (true) {
            $token = $request->ref_command;
            $pendding = Payment::whereStatus(false)->whereReference($token)->first();

            if (($request->type_event === "sale_complete") && $pendding != null) {

                DB::beginTransaction();
                try {

                    $pendding->via = $request->payment_method;


                    $profile = AccountItem::whereUserId(null)->whereStatus(true)->first();

                    if ($profile == null) {
                        $notConf = new PaymentNotConfirm();
                        $notConf->amount = $pendding->amount;
                        $notConf->date = now();
                        $notConf->user_id = $pendding->user_id;
                        $notConf->save();
                        $pendding->account_item_id = $profile->id;
                        $pendding->status = false;

                    } else {
                        $profile->attach_at = now();
                        $profile->user_id = $pendding->user_id;
                        $profile->limit_at = Carbon::now()->addMonth($pendding->nb_month);
                        $profile->save();
                        $pendding->status = true;
                    }

                    $pendding->user_id =  $pendding->user_id;
                    $pendding->save();

                    DB::commit();
                    return response()->json(['OK'], 200);
                } catch (\Throwable $th) {
                    DB::rollBack();
                    return response()->json(["erreur" => $th->getMessage()], 500);
                }
            }
        } else {
            return response()->json([
                "message" => "La requête ne vient pas de paytech."
            ], 200);
        }
    }


    /**
     * ADMIN
     */


    public function newAccountAdmin()
    {
        if (auth()->user()->is_admin)
            return view('new-account-admin');
        return view('welcome');
    }

    public function newAccountAdminPost(Request $request)
    {
        $request->validate([
            'username' => ['required', 'email'],
            'password' => 'required|string',
            'nb_profile' => 'required|numeric'
        ], [
            'username.required' => 'Le mail du compte est obligatoire.',
            'username.email' => 'Adresse email invalide.',
            'password.required' => 'Le mot de passe est obligatoire.',
            'nb_profile.min' => 'Le nombre de profile est obligatoire.'
        ]);


        $account = new Account();
        $account->username = $request->username;
        $account->password = $request->password;
        $account->type = 'netflix';
        $account->status = true;
        $account->save();

        for ($i = 0; $i < $request->nb_profile; $i++) {
            $accountItems = new AccountItem();
            $accountItems->account_id = $account->id;
            $accountItems->save();
        }

        return redirect("profile");
    }


    public function users()
    {
        if (auth()->user()->is_admin) {
            $currentUser = auth()->user();
            return view('users')->with([
                'users' => User::where('id', '!=', $currentUser->id)->get()
            ]);
        }
        return redirect('profile');
    }

    public function updateUser($id)
    {
        $user = User::find($id);

        if ($user) {
            return view('update-user')->with(['user' => $user]);
        } else {
            toastr()->error('Utilisateur n\'existe pas.');
            return redirect('/');
        }
    }

    public function updateUserPost(Request $request)
    {
        $request->validate(
            [
                'id' => ['required', 'exists:users,id'],
                'password' => ['required', 'min:4']
            ],
            [
                'id.required' => 'Veuillez selection un utilisateurs',
                'password.required' => 'Le mot de passe est obligatoire.',
                'password.min' => 'Le mot de passe doit comporter au moins :min caractères.'
            ]
        );

        $user = User::find($request->id);
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();

            toastr()->success('Mot de passe modifier avec succès.');

            return redirect('users');
        }

        toastr()->error('USER IS NULL.', $request->id);
        return back();
    }


    public function daylyCheck()
    {
        $account_items = AccountItem::where('user_id', '!=', null)->get();
        $toChange = [];
        foreach ($account_items as $item) {
            if ($item->limit_at <= now()) {
                $item->user_id = null;
                $item->limit_at = null;
                $item->attach_at = null;
                $item->save();
                $toChange[] = $item;
            }
        }

        return view('check', compact('toChange'));
    }
}

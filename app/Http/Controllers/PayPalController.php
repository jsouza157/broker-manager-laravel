<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserPlan;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\BuyLog;

class PayPalController extends Controller
{
	private $user;
	private $pwd;
	private $signature;

	public function __construct()
    {
    	$this->user 		= 'jeffersondasilva1-facilitator_api1.hotmail.com';
		$this->pwd 			= 'GXUW4LMA3PTENKLW';
		$this->signature 	= 'APreiuMSbjU.2DGNjIKidvhGFbj6AlJOEMovQGoXBwsa2OOC7wQ0cFhv';
        $this->middleware('auth:web,broker');
    }

	public function Payment(Request $request)
	{
		$curl = curl_init();

		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_POST, true);
		curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
			'USER' 		=> $this->user,
			'PWD' 		=> $this->pwd,
			'SIGNATURE' => $this->signature,

			'METHOD' 		=> 'SetExpressCheckout',
			'VERSION' 		=> '108',
			'LOCALECODE' 	=> 'pt_BR',

			'PAYMENTREQUEST_0_AMT' 				=> $request->value,
			'PAYMENTREQUEST_0_CURRENCYCODE' 	=> 'BRL',
			'PAYMENTREQUEST_0_PAYMENTACTION' 	=> 'Sale',
			'PAYMENTREQUEST_0_ITEMAMT' 			=> $request->value,

			'L_PAYMENTREQUEST_0_NAME0' 			=> $request->plan,
			'L_PAYMENTREQUEST_0_DESC0' 			=> 'Assinatura',
			'L_PAYMENTREQUEST_0_QTY0' 			=> 1,
			'L_PAYMENTREQUEST_0_AMT0' 			=> $request->value,
			'L_BILLINGTYPE0' 					=> 'RecurringPayments',
			'L_BILLINGAGREEMENTDESCRIPTION0' 	=> 'Assinatura '.$request->plan,

			'CANCELURL' => 'http://localhost:8000/admin/buy/error',
			'RETURNURL' => 'http://localhost:8000/admin/buy/success'
		)));

		$response =    curl_exec($curl);

		curl_close($curl);

		$nvp = array();

		if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
			foreach ($matches['name'] as $offset => $name) {
				$nvp[$name] = urldecode($matches['value'][$offset]);
			}
		}

		if (isset($nvp['ACK']) && $nvp['ACK'] == 'Success') {
			UserPlan::create([
				'plan_id'		=> $request->plan_id,
				'user_id'		=> rootId(), 
				'pay_day'		=> Carbon::now(), 
				'status_pay'	=> $nvp['ACK'],
				'token'			=> $nvp['TOKEN'], 
				'correlationid' => $nvp['CORRELATIONID'], 
				'build'			=> $nvp['BUILD'],
				'PayerID'		=> null
			]);
			$query = array(
				'cmd'    => '_express-checkout',
				'token'  => $nvp['TOKEN']
			);
			$redirectURL = sprintf('https://www.sandbox.paypal.com/cgi-bin/webscr?%s', http_build_query($query));

			return redirect($redirectURL);
		} else {
			session()->flash('danger', 'Ocorreu um erro ao realizar a assinatura, entre em contato por e-mail para concluir ou tente mais tarde');
			return redirect('/admin/plans');
		} 
	}

	public function success(Request $request)
	{
		try{
			UserPlan::where('token', '=', $request->token)
			->update([
				'PayerID'	=> $request->PayerID
			]);

			$buy = UserPlan::with(['plan'])
			->where('token', '=', $request->token)
			->first();

			$this->recurringPayment($buy->token, $buy->PayerID, $buy->plan->value, $buy->plan->name);

			session()->flash('success', 'Obrigado, você será notificado assim que processarmos seus dados.');
			return redirect('admin/plans');
		}catch(\Exception $e) {
			session()->flash('success', 'Obrigado, você será notificado assim que processarmos seus dados.');
			return redirect('admin/plans');
		}
	}

	public function error(Request $request)
	{
		session()->flash('danger', 'Ocorreu um erro ao processar sua solicitação, tente novamente em alguns minutos.');
		return redirect('admin/plans');
	}



	public function recurringPayment($token, $payerID, $value, $plan)
	{
		try {
			$curl = curl_init();

			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp');
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query(array(
				'USER' 		=> $this->user,
				'PWD' 		=> $this->pwd,
				'SIGNATURE' => $this->signature,

				'METHOD' 		=> 'CreateRecurringPaymentsProfile',
				'VERSION' 		=> '108',
				'LOCALECODE' 	=> 'pt_BR',

				'TOKEN' 	=> $token,
				'PayerID' 	=> $payerID,

				'PROFILESTARTDATE' 	=> Carbon::now()->toIso8601ZuluString(),
				'DESC' 				=> 'Assinatura '.$plan,
				'BILLINGPERIOD' 	=> 'Month',
				'BILLINGFREQUENCY' 	=> '1',
				'AMT' 				=> $value,
				'CURRENCYCODE' 		=> 'BRL',
				'COUNTRYCODE' 		=> 'BR',
				'MAXFAILEDPAYMENTS' => 3
			)));

			$response =    curl_exec($curl);

			curl_close($curl);

			$nvp = array();

			if (preg_match_all('/(?<name>[^\=]+)\=(?<value>[^&]+)&?/', $response, $matches)) {
				foreach ($matches['name'] as $offset => $name) {
					$nvp[$name] = urldecode($matches['value'][$offset]);
				}
			}

			UserPlan::where('token', '=', $token)
			->update([
				'profileID'			=> $nvp['PROFILEID'],
				'profile_status'	=> $nvp['PROFILESTATUS']
			]);

			return true;
		}catch(\Exception $e) {
			BuyLog::create([
				'token'		=> $token,
				'payerID'	=> $payerID
			]);
			return true;
		}
	}


}

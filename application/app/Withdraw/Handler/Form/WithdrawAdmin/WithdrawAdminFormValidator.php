<?php namespace App\Withdraw\Handler\Form\WithdrawAdmin;

use App\Admin\AdminFactory as AdminFactory;

class WithdrawAdminFormValidator
{
	/**
	 * Doi tuong Request
	 *
	 * @var WithdrawAdminFormRequest
	 */
	protected $request;

	/**
	 * Form errors
	 *
	 * @var array
	 */
	protected $errors = [];


	/**
	 * Khoi tao doi tuong
	 *
	 * @param WithdrawAdminFormRequest $request
	 */
	public function __construct(WithdrawAdminFormRequest $request)
	{
		$this->request = $request;
	}

	/**
	 * Lay rules
	 *
	 * @return array
	 */
	public function rules()
	{
		$rules = [

			'purse_number' => 'required',

			'amount' => 'required',

			'desc' => [
				'label' => lang('withdraw_reason'),
				'rules' => 'required',
			],

		];

		if ($this->request->isPageConfirm())
		{
			$rules['password'] = 'required';
		}

		return $rules;
	}

	/**
	 * Thuc hien validate
	 *
	 * @return bool
	 */
	public function validate()
	{
		if ( ! $this->request->getPurse())
		{
			$this->errors['purse_number'] = lang('notice_value_not_exist', lang('purse'));

			return false;
		}

		if ($this->request->get('amount') <= 0)
		{
			$this->errors['amount'] = lang('notice_value_invalid', lang('amount'));

			return false;
		}

		if ($this->request->isPageConfirm())
		{
			if ( ! $this->checkPasword())
			{
				$this->errors['password'] = lang('notice_value_incorrect', lang('password'));

				return false;
			}
		}

		return true;
	}

	/**
	 * Kiem tra password
	 *
	 * @return bool
	 */
	protected function checkPasword()
	{
		return AdminFactory::auth()->checkPasword($this->request->get('password'));
	}

	/**
	 * Lay error
	 *
	 * @param string $key
	 * @return string
	 */
	public function error($key = null)
	{
		return array_get($this->errors, $key);
	}

}
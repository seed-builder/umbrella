<?php

namespace App\Listeners;

use App\Events\PaymentEvent;
use App\Helpers\Utl;
use App\Models\Customer;
use App\Models\CustomerHire;
use App\Models\CustomerPayment;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentHandler //implements ShouldQueue
{
//    use InteractsWithQueue;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentEvent $event
     * @return void
     */
    public function handle(PaymentEvent $event)
    {
        $model = $event->model;

        if ($model->status != CustomerPayment::STATUS_SUCCESS)
            return;

        switch ($model->type) {
            case CustomerPayment::TYPE_IN_CHARGE: {
                $this->recharge($model);
                break;
            }
            case CustomerPayment::TYPE_IN_DEPOSIT: {
                $this->depositRecharge($model);
                break;
            }
            case CustomerPayment::TYPE_OUT_DEPOSIT: {
                $this->depositPay($model);
                break;
            }
            case CustomerPayment::TYPE_INT_DEPOSIT_BACK: {
                $this->depositBack($model);
                break;
            }
            case CustomerPayment::TYPE_OUT_RENT: {
                $this->hirePay($model);
                break;
            }
            case CustomerPayment::TYPE_OUT_WITHDRAW: {
                $this->withdraw($model);
                break;
            }
        }
    }

    /**
     * 账户充值
     * @param $model
     */
    protected function recharge($model)
    {
        $customer = Customer::find($model->customer_id);
        $account = $customer->account;

        $account->balance_amt = $account->balance_amt + $model->amt;

        $account->save();
    }

    /**
     * 押金充值
     * @param $model
     */
    protected function depositRecharge($model)
    {
        $customer = Customer::find($model->customer_id);
        $account = $customer->account;

        $account->deposit = $account->deposit + $model->amt;

        $account->save();
    }

    /**
     * @param $model
     * 押金支出
     */
    protected function depositPay($model)
    {
        $customer = Customer::find($model->customer_id);
        $account = $customer->account;

        $account->deposit = $account->deposit - $model->amt;
        $account->freeze_deposit = $account->freeze_deposit + $model->amt;

        $account->save();
    }

    /**
     * 押金退回
     * @param $model
     */
    protected function depositBack($model)
    {
        $customer = Customer::find($model->customer_id);
        $account = $customer->account;

        $account->deposit = $account->deposit + $model->amt;
        $account->freeze_deposit = $account->freeze_deposit - $model->amt;
        $account->save();
    }

    /**
     * 借伞租金支出
     * @param $model
     */
    protected function hirePay($model)
    {
        $customer = Customer::find($model->customer_id);
        $account = $customer->account;

        if ($account->balance_amt < $model->amt)
            return ;

        $account->balance_amt = $account->balance_amt - $model->amt;
        $account->save();

        $hire = CustomerHire::find($model->reference_id);
        $hire->status = CustomerHire::STATUS_COMPLETE; //变更租借单为已完成
        $hire->save();
    }

    /**
     * 账户提现
     * @param $model
     */
    protected function withdraw($model)
    {
        $customer = Customer::find($model->customer_id);
        $account = $customer->account;

        $account->deposit = $account->deposit - $model->amt;
        $account->save();
    }

}

<?php

namespace App\Listeners;

use App\Events\PaymentEvent;
use App\Models\Customer;
use App\Models\CustomerHire;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentHandler implements ShouldQueue
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

        if ($model->status != 2)
            return;

        switch ($model->type) {
            case 1: {
                $this->recharge($model);
                break;
            }
            case 2: {
                $this->depositRecharge($model);
                break;
            }
            case 3: {
                $this->depositPay($model);
                break;
            }
            case 4: {
                $this->depositBack($model);
                break;
            }
            case 5: {
                $this->hirePay($model);
                break;
            }
            case 6: {
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

        $hire = CustomerHire::find($model->reference_id);
        if ($hire->status != 2)
            return;

        $account->deposit = $account->deposit + $model->amt;
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
        $hire->status = 2;
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

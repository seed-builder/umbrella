<?php

namespace App\Http\Controllers\Admin;

use App\Models\Site;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class HomeController extends BaseController
{
    //
    public function index()
    {
        $sites = Site::all();
        return view('admin.home.index', compact('sites'));
    }

    /**
     * 用户增长情况图表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chartsUser(Request $request)
    {
        $data = $request->all();
        $flag = !empty($data['flag']) ? $data['flag'] : '7d';

        $all = $this->userSql($flag);
        $srs = $this->userSql($flag, 'y');
        $nrs = $this->userSql($flag, 'n');

        $resp = [];
        foreach ($all as $k => $v) {
            $resp['xs'][] = $k;
            $resp['ys'][0][] = !empty($srs[$k]) ? $srs[$k] : 0;
            $resp['ys'][1][] = !empty($nrs[$k]) ? $nrs[$k] : 0;
        }

        return $this->success_result('', $resp);
    }

    /**
     * 用户增长情况 Sql
     * @param $flag
     * @param string $n
     * @return array
     */
    protected function userSql($flag, $n = '')
    {
        switch ($n) {
            case 'y':
                $condition = 'AND  mobile <> ""';
                break;
            case 'n':
                $condition = 'AND ISNULL(mobile)';
                break;
            default:
                $condition = '';
        }

        switch ($flag) {
            case '1m':
                $dateRange = '1 MONTH';
                break;
            case '3m':
                $dateRange = '3 MONTH';
                break;
            default:
                $dateRange = '7 DAY';
        }
        $rs = DB::select('SELECT
                                DATE_FORMAT(created_at, "%m-%d") AS date,
                                count(*) AS count
                            FROM
                                customers
                            WHERE
                                created_at >= date(now()) - INTERVAL ' . $dateRange . '
                                ' . $condition . '
                            GROUP BY
                                DATE(created_at)');
        $result = [];
        foreach ($rs as $r) {
            $result[$r->date] = $r->count;
        }
        return $result;
    }


    /**
     * 借伞情况统计图表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chartsHire(Request $request)
    {
        $data = $request->all();
        $flag = !empty($data['flag']) ? $data['flag'] : '7d';

        $dateList = $this->getDateList($flag);
        $all = collect($this->hireSql($flag));

        $sites = Site::all();
        foreach ($dateList as $date) {
            $resp['xs'][] = $date;
        }

        foreach ($sites as $site) {
            $y = [];
            $y['name'] = $site->name;
            foreach ($dateList as $date) {
                $filtered = $all->filter(function ($item) use ($date, $site) {
                    return $item->date == date('m-d', strtotime($date)) && $item->site_id == $site->id;
                });
                $filtered = $filtered->values();
                if (empty($filtered[0]))
                    $y['data'][] = 0;
                else
                    $y['data'][] = $filtered[0]->count;
            }
            $resp['ys'][] = $y;
        }

        return $this->success_result('', $resp);
    }

    /**
     * 借伞情况 sql
     * @param $flag
     * @param string $n
     * @return array
     */
    protected function hireSql($flag)
    {
        switch ($flag) {
            case '1m':
                $dateRange = '1 MONTH';
                break;
            case '3m':
                $dateRange = '3 MONTH';
                break;
            default:
                $dateRange = '7 DAY';
        }
        $rs = DB::select('SELECT
                                DATE_FORMAT(customer_hires.created_at, "%m-%d") AS date,
                                sites.`id` AS site_id,
                                sites.`name` AS site_name,
                                count(*) AS count
                            FROM
                                customer_hires
                            LEFT JOIN sites ON sites.id = customer_hires.hire_site_id
                            WHERE
                                customer_hires.created_at >= date(now()) - INTERVAL ' . $dateRange . '
                                AND customer_hires.STATUS != 1
                            GROUP BY
                                DATE(customer_hires.created_at),
                                hire_site_id');

        $result = [];
        foreach ($rs as $r) {
            $result[] = $r;
        }
        return $result;
    }

    /**
     * 平台资金情况图表
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chartsPayment(Request $request)
    {
        $data = $request->all();
        $flag = !empty($data['flag']) ? $data['flag'] : '7d';

        $dateList = $this->getDateList($flag);
        $chargeAmt = collect($this->paymentSql($flag,1)); //租金充值
        $depositAmt = collect($this->paymentSql($flag,2)); //押金充值
        $withdrawAmt = collect($this->withdrawSql($flag)); //押金充值

        $resp = [];
//        $resp['xs'] = $dateList;
        $resp['ys'] = [
            ['name'=>'租金收入','data'=>[],'color'=>'green'],
            ['name'=>'押金收入','data'=>[],'color'=>'rgb(128, 133, 233)'],
            ['name'=>'用户提现','data'=>[],'color'=>'rgb(244, 91, 91)']
        ];
        foreach ($dateList as $date){
            $resp['xs'][] = date('m-d',strtotime($date));
            $chargeFiltered = $chargeAmt->filter(function ($item) use ($date) {
                return $item->date == date('m-d', strtotime($date)) ;
            });
            $chargeFiltered = $chargeFiltered->values();
            $resp['ys'][0]['data'][] = !empty($chargeFiltered[0]) ? (float)$chargeFiltered[0]->amt : 0;

            $depositFiltered = $depositAmt->filter(function ($item) use ($date) {
                return $item->date == date('m-d', strtotime($date)) ;
            });
            $depositFiltered = $depositFiltered->values();
            $resp['ys'][1]['data'][] = !empty($depositFiltered[0]) ? (float)$depositFiltered[0]->amt : 0;

            $withdrawFiltered = $withdrawAmt->filter(function ($item) use ($date) {
                return $item->date == date('m-d', strtotime($date)) ;
            });
            $withdrawFiltered = $withdrawFiltered->values();
            $resp['ys'][2]['data'][] = !empty($withdrawFiltered[0]) ? (float)$withdrawFiltered[0]->amt : 0;
        }

        return $this->success_result('',$resp);

        dd($resp);
    }

    /**
     * 资金纪录Sql
     * @param $flag
     * @param $type
     * @return mixed
     */
    protected function paymentSql($flag, $type)
    {
        switch ($flag) {
            case '1m':
                $dateRange = '1 MONTH';
                break;
            case '3m':
                $dateRange = '3 MONTH';
                break;
            default:
                $dateRange = '7 DAY';
        }
        $rs = DB::select('SELECT
                                DATE_FORMAT(
                                    customer_payments.created_at,
                                    "%m-%d"
                                ) AS date,
                                SUM(amt) AS amt
                            FROM
                                customer_payments
                            WHERE
                              customer_payments.created_at >= date(now()) - INTERVAL ' . $dateRange . '
                                AND type = ' . $type . '
                            GROUP BY
                                DATE(
                                    customer_payments.created_at
                                )');

        return $rs;
    }

    /**
     * 提现纪录Sql
     * @param $flag
     * @return mixed
     */
    protected function withdrawSql($flag){
        switch ($flag) {
            case '1m':
                $dateRange = '1 MONTH';
                break;
            case '3m':
                $dateRange = '3 MONTH';
                break;
            default:
                $dateRange = '7 DAY';
        }
        $rs = DB::select('SELECT
                            DATE_FORMAT(
                                customer_withdraws.created_at,
                                "%m-%d"
                            ) AS date,
                            SUM(amt) AS amt
                        FROM
                            customer_withdraws
                        WHERE
                            customer_withdraws.created_at >= date(now()) - INTERVAL ' . $dateRange . '
                            AND status = 2
                        GROUP BY
                            DATE(
                                customer_withdraws.created_at
                            )');

        return $rs;
    }

    /**
     * 获取时间区间列表
     * @param $flag
     * @return array
     */
    protected function getDateList($flag)
    {
        $rs = [];
        $i = 1;
        switch ($flag) {
            case '1m':
                while ($i <= 31) {
                    array_unshift($rs, date('Y-m-d', strtotime("-$i day")));
                    $i++;
                }
                break;
            case '3m':
                while ($i <= 90) {
                    array_unshift($rs, date('Y-m-d', strtotime("-$i day")));
                    $i++;
                }
                break;
            default:
                while ($i <= 7) {
                    array_unshift($rs, date('Y-m-d', strtotime("-$i day")));
//                    $rs[] = date('Y-m-d', strtotime("-$i day"));
                    $i++;
                }
        }

        return $rs;
    }

}

<?php

namespace App\Helpers\WeChatLib;


class WxPayEnterprise
{
	protected $values = array();
	
	/**
	* 设置签名，详见签名生成算法
	* @param string $value 
	**/
	public function setSign()
	{
		$sign = $this->makeSign();
		$this->values['sign'] = $sign;
		return $sign;
	}
	
	/**
	* 获取签名，详见签名生成算法的值
	* @return 值
	**/
	public function getSign()
	{
		return $this->values['sign'];
	}
	
	/**
	* 判断签名，详见签名生成算法是否存在
	* @return true 或 false
	**/
	public function isSignSet()
	{
		return array_key_exists('sign', $this->values);
	}

	/**
	 * 输出xml字符
	 * @throws WxPayException
	**/
	public function toXml()
	{
		if(!is_array($this->values) 
			|| count($this->values) <= 0)
		{
    		dd("数组数据异常！");
    	}
    	
    	$xml = "<xml>";
    	foreach ($this->values as $key=>$val)
    	{
    		if (is_numeric($val)){
    			$xml.="<".$key.">".$val."</".$key.">";
    		}else{
    			$xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
    		}
        }
        $xml.="</xml>";
        return $xml; 
	}
	
    /**
     * 将xml转为array
     * @param string $xml
     * @throws WxPayException
     */
	public function fromXml($xml)
	{	
		if(!$xml){
			dd("xml数据异常！");
		}
        //将XML转为array
        //禁止引用外部xml实体
        libxml_disable_entity_loader(true);
        $this->values = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);		
		return $this->values;
	}
	
	/**
	 * 格式化参数格式化成url参数
	 */
	public function toUrlParams()
	{
		$buff = "";
		foreach ($this->values as $k => $v)
		{
			if($k != "sign" && $v != "" && !is_array($v)){
				$buff .= $k . "=" . $v . "&";
			}
		}
		
		$buff = trim($buff, "&");
		return $buff;
	}
	
	/**
	 * 生成签名
	 * @return 签名，本函数不覆盖sign成员变量，如要设置签名需要调用SetSign方法赋值
	 */
	public function makeSign()
	{
		//签名步骤一：按字典序排序参数
		ksort($this->values);
		$string = $this->ToUrlParams();
		//签名步骤二：在string后加入KEY
		$string = $string . "&key=".env('WECHAT_MCHKEY');
		//签名步骤三：MD5加密
		$string = md5($string);
		//签名步骤四：所有字符转为大写
		$result = strtoupper($string);

		return $result;
	}
	
	/**
	 * 获取设置的值
	 */
	public function getValues()
	{
		return $this->values;
	}
	/* 设置微信分配的公众账号ID
	* @param string $value 
	**/
	public function setAppid($value)
	{
		$this->values['mch_appid'] = $value;
	}
	/**
	* 获取微信分配的公众账号ID的值
	* @return 值
	**/
	public function getAppid()
	{
		return $this->values['mch_appid'];
	}
	/**
	* 判断微信分配的公众账号ID是否存在
	* @return true 或 false
	**/
	public function isAppidSet()
	{
		return array_key_exists('mch_appid', $this->values);
	}


	/**
	* 设置微信支付分配的商户号
	* @param string $value 
	**/
	public function setMch_id($value)
	{
		$this->values['mchid'] = $value;
	}
	/**
	* 获取微信支付分配的商户号的值
	* @return 值
	**/
	public function getMch_id()
	{
		return $this->values['mchid'];
	}
	/**
	* 判断微信支付分配的商户号是否存在
	* @return true 或 false
	**/
	public function isMch_idSet()
	{
		return array_key_exists('mch_id', $this->values);
	}


	/**
	* 设置微信支付分配的终端设备号，商户自定义
	* @param string $value 
	**/
	public function setDevice_info($value)
	{
		$this->values['device_info'] = $value;
	}
	/**
	* 获取微信支付分配的终端设备号，商户自定义的值
	* @return 值
	**/
	public function getDevice_info()
	{
		return $this->values['device_info'];
	}
	/**
	* 判断微信支付分配的终端设备号，商户自定义是否存在
	* @return true 或 false
	**/
	public function isDevice_infoSet()
	{
		return array_key_exists('device_info', $this->values);
	}


	/**
	* 设置随机字符串，不长于32位。推荐随机数生成算法
	* @param string $value 
	**/
	public function setNonce_str($value)
	{
		$this->values['nonce_str'] = $value;
	}
	/**
	* 获取随机字符串，不长于32位。推荐随机数生成算法的值
	* @return 值
	**/
	public function getNonce_str()
	{
		return $this->values['nonce_str'];
	}
	/**
	* 判断随机字符串，不长于32位。推荐随机数生成算法是否存在
	* @return true 或 false
	**/
	public function isNonce_strSet()
	{
		return array_key_exists('nonce_str', $this->values);
	}

    /**
     * 设置商户订单号
     * @param string $value
     **/
    public function setPartner_trade_no($value)
    {
        $this->values['partner_trade_no'] = $value;
    }
    /**
     * 获取商户订单号
     * @return 值
     **/
    public function getPartner_trade_no()
    {
        return $this->values['partner_trade_no'];
    }
    /**
     * 判断商户订单号是否存在
     * @return true 或 false
     **/
    public function isPartner_trade_noSet()
    {
        return array_key_exists('partner_trade_no', $this->values);
    }


    /**
	* 设置trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识。下单前需要调用【网页授权获取用户信息】接口获取到用户的Openid。 
	* @param string $value 
	**/
	public function setOpenid($value)
	{
		$this->values['openid'] = $value;
	}
	/**
	* 获取trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识。下单前需要调用【网页授权获取用户信息】接口获取到用户的Openid。 的值
	* @return 值
	**/
	public function getOpenid()
	{
		return $this->values['openid'];
	}
	/**
	* 判断trade_type=JSAPI，此参数必传，用户在商户appid下的唯一标识。下单前需要调用【网页授权获取用户信息】接口获取到用户的Openid。 是否存在
	* @return true 或 false
	**/
	public function isOpenidSet()
	{
		return array_key_exists('openid', $this->values);
	}

    /**
     * 设置校验用户姓名选项
     * @param string $value
     **/
    public function setCheck_name($value)
    {
        $this->values['check_name'] = $value;
    }
    /**
     * 获取校验用户姓名选项
     * @return 值
     **/
    public function getCheck_name()
    {
        return $this->values['check_name'];
    }
    /**
     * 判断校验用户姓名选项是否存在
     * @return true 或 false
     **/
    public function isCheck_nameSet()
    {
        return array_key_exists('check_name', $this->values);
    }

    /**
     * 设置收款用户姓名（可选）
     * @param string $value
     **/
    public function setRe_user_name($value)
    {
        $this->values['re_user_name'] = $value;
    }
    /**
     * 获取收款用户姓名（可选）
     * @return 值
     **/
    public function getRe_user_name()
    {
        return $this->values['re_user_name'];
    }
    /**
     * 判断收款用户姓名（可选）是否存在
     * @return true 或 false
     **/
    public function isRe_user_nameSet()
    {
        return array_key_exists('re_user_name', $this->values);
    }

    /**
     * 设置金额
     * @param string $value
     **/
    public function setAmount($value)
    {
        $this->values['amount'] = $value;
    }
    /**
     * 获取金额
     * @return 值
     **/
    public function getAmount()
    {
        return $this->values['amount'];
    }
    /**
     * 判断金额是否存在
     * @return true 或 false
     **/
    public function isAmountSet()
    {
        return array_key_exists('amount', $this->values);
    }

    /**
     * 设置企业付款描述信息
     * @param string $value
     **/
    public function setDesc($value)
    {
        $this->values['desc'] = $value;
    }
    /**
     * 获取企业付款描述信息
     * @return 值
     **/
    public function getDesc()
    {
        return $this->values['desc'];
    }
    /**
     * 判断企业付款描述信息是否存在
     * @return true 或 false
     **/
    public function isDescSet()
    {
        return array_key_exists('desc', $this->values);
    }

    /**
     * 设置Ip地址
     * @param string $value
     **/
    public function setSpbill_create_ip($value)
    {
        $this->values['spbill_create_ip'] = $value;
    }
    /**
     * 获取Ip地址
     * @return 值
     **/
    public function getSpbill_create_ip()
    {
        return $this->values['spbill_create_ip'];
    }
    /**
     * 判断Ip地址是否存在
     * @return true 或 false
     **/
    public function isSpbill_create_ipSet()
    {
        return array_key_exists('spbill_create_ip', $this->values);
    }
}

?>

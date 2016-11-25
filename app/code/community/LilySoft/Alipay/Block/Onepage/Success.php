<?php
/**
 * 
 * ������д checkout_onepage_success���block�� 
 * @author Administrator
 *
 */
class LilySoft_Alipay_Block_Onepage_Success extends Mage_Checkout_Block_Onepage_Success{
	protected $_notAllowOnlinePayment = array('free', 'cod','bankremittance');
	protected $template = "alipay/success.phtml";
	
	
	/**
	 * ͨ����д�����е� _toHtml()�����������������������µ� template��ָ�򣬾Ϳ����ˡ�
	 * (non-PHPdoc)
	 * @see Mage_Core_Block_Template::_toHtml()
	 */
	protected function _toHtml()
    {
    	//��Ҫ�������ж϶����ǲ���֧�����ģ������֧�����ģ��ͼ�������success�ļ���������ǣ������ԭ���ġ�֧�����ͲƸ�ͨ�Ĳ���ж�д������űȽϺ�
    	$order = Mage::getSingleton('sales/order')->loadByIncrementId($this->getOrderId());
    	if($order->getPayment()->getMethodInstance()->getCode() == 'alipay'){
    		$this->setTemplate('alipay/success.phtml');
    	}else if($order->getPayment()->getMethodInstance()->getCode() == 'tenpay'){
    		$this->setTemplate('tenpay/success.phtml');
    	}
    	return parent::_toHtml();
    }
	
	/**
     * Get order
     *
     * @return Mage_Sales_Model_Order
     */
    public function getOrder()
    {
    	//����ǿյģ�����Ҫ���� �����е�order�ſ��ԣ�������ǿյģ���Ҫʹ�� orderid����ѯ
    	return Mage::getSingleton('sales/order')->loadByIncrementId($this->getOrderId());
    }
    
	public function canOnlinePayment(){
    	return !in_array($this->getOrder()->getPayment()->getMethodInstance()->getCode(), $this->_notAllowOnlinePayment);
    }
    
	public function getReturnUrl()
    {
    	if(Mage::getSingleton('customer/session')->isLoggedIn()){
    		return $this->getUrl('sales/order/view', array('order_id' =>Mage::getSingleton('checkout/session')->getLastOrderId()));
    	}

        return  Mage::getUrl('searchorder/order/order',array('order_id' => $this->getOrderId()));
    }
}
?>
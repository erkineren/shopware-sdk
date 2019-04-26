<?php

namespace LeadCommerce\Shopware\SDK\Entity;


class Order extends Base
{

    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $number;
    /**
     * @var int
     */
    protected $customerId;
    /**
     * @var int
     */
    protected $paymentId;
    /**
     * @var int
     */
    protected $dispatchId;
    /**
     * @var string
     */
    protected $partnerId;
    /**
     * @var int
     */
    protected $shopId;
    /**
     * @var double
     */
    protected $invoiceAmount;
    /**
     * @var double
     */
    protected $invoiceAmountNet;
    /**
     * @var int
     */
    protected $invoiceShipping;
    /**
     * @var int
     */
    protected $invoiceShippingNet;
    /**
     * @var string
     */
    protected $orderTime;
    /**
     * @var string
     */
    protected $transactionId;
    /**
     * @var string
     */
    protected $comment;
    /**
     * @var string
     */
    protected $customerComment;
    /**
     * @var string
     */
    protected $internalComment;
    /**
     * @var int
     */
    protected $net;
    /**
     * @var int
     */
    protected $taxFree;
    /**
     * @var string
     */
    protected $temporaryId;
    /**
     * @var string
     */
    protected $referer;
    /**
     * @var
     */
    protected $clearedDate;
    /**
     * @var string
     */
    protected $trackingCode;
    /**
     * @var string
     */
    protected $languageIso;
    /**
     * @var string
     */
    protected $currency;
    /**
     * @var int
     */
    protected $currencyFactor;
    /**
     * @var string
     */
    protected $remoteAddress;
    /**
     * @var string
     */
    protected $deviceType;
    /**
     * @var array
     */
    protected $attribute;
    /**
     * @var CustomerAttribute
     */
    protected $customer;
    /**
     * @var int
     */
    protected $paymentStatusId;
    /**
     * @var int
     */
    protected $orderStatusId;


    /**
     * @var OrderDetail[]
     */
    protected $details;
    /**
     * @var Document[]
     */
    protected $documents;
    /**
     * @var PaymentData
     */
    protected $payment;

    /**
     * @var PaymentStatus
     */
    protected $paymentStatus;
    /**
     * @var OrderStatus
     */
    protected $orderStatus;
    /**
     * @var PaymentInstance[]
     */
    protected $paymentInstances;
    /**
     * @var Billing
     */
    protected $billing;
    /**
     * @var Shipping
     */
    protected $shipping;
    /**
     * @var Shop
     */
    protected $shop;
    /**
     * @var Dispatch
     */
    protected $dispatch;
    /**
     * @var Shop
     */
    protected $languageSubShop;

    /**
     * @return PaymentStatus
     */
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @param PaymentStatus $paymentStatus
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    /**
     * @return OrderStatus
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * @param OrderStatus $orderStatus
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;
    }

    /**
     * @return PaymentInstance[]
     */
    public function getPaymentInstances()
    {
        return $this->paymentInstances;
    }

    /**
     * @param PaymentInstance[] $paymentInstances
     */
    public function setPaymentInstances($paymentInstances)
    {
        $this->paymentInstances = $paymentInstances;
    }

    /**
     * @return Billing
     */
    public function getBilling()
    {
        return $this->billing;
    }

    /**
     * @param Billing $billing
     */
    public function setBilling($billing)
    {
        $this->billing = $billing;
    }

    /**
     * @return Shipping
     */
    public function getShipping()
    {
        return $this->shipping;
    }

    /**
     * @param Shipping $shipping
     */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }

    /**
     * @return Shop
     */
    public function getShop()
    {
        return $this->shop;
    }

    /**
     * @param Shop $shop
     */
    public function setShop($shop)
    {
        $this->shop = $shop;
    }

    /**
     * @return Dispatch
     */
    public function getDispatch()
    {
        return $this->dispatch;
    }

    /**
     * @param Dispatch $dispatch
     */
    public function setDispatch($dispatch)
    {
        $this->dispatch = $dispatch;
    }

    /**
     * @return Shop
     */
    public function getLanguageSubShop()
    {
        return $this->languageSubShop;
    }

    /**
     * @param Shop $languageSubShop
     */
    public function setLanguageSubShop($languageSubShop)
    {
        $this->languageSubShop = $languageSubShop;
    }


    /**
     * @return PaymentData
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * @param PaymentData $payment
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;
    }

    /**
     * @return Document[]
     */
    public function getDocuments()
    {
        return $this->documents;
    }

    /**
     * @param Document[] $documents
     */
    public function setDocuments($documents)
    {
        $this->documents = $documents;
    }

    /**
     * @return OrderDetail[]
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * @param OrderDetail[] $details
     */
    public function setDetails($details)
    {
        $this->details = $details;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getCustomerId()
    {
        return $this->customerId;
    }

    /**
     * @param int $customerId
     */
    public function setCustomerId($customerId)
    {
        $this->customerId = $customerId;
    }

    /**
     * @return int
     */
    public function getPaymentId()
    {
        return $this->paymentId;
    }

    /**
     * @param int $paymentId
     */
    public function setPaymentId($paymentId)
    {
        $this->paymentId = $paymentId;
    }

    /**
     * @return int
     */
    public function getDispatchId()
    {
        return $this->dispatchId;
    }

    /**
     * @param int $dispatchId
     */
    public function setDispatchId($dispatchId)
    {
        $this->dispatchId = $dispatchId;
    }

    /**
     * @return string
     */
    public function getPartnerId()
    {
        return $this->partnerId;
    }

    /**
     * @param string $partnerId
     */
    public function setPartnerId($partnerId)
    {
        $this->partnerId = $partnerId;
    }

    /**
     * @return int
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @param int $shopId
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
    }

    /**
     * @return float
     */
    public function getInvoiceAmount()
    {
        return $this->invoiceAmount;
    }

    /**
     * @param float $invoiceAmount
     */
    public function setInvoiceAmount($invoiceAmount)
    {
        $this->invoiceAmount = $invoiceAmount;
    }

    /**
     * @return float
     */
    public function getInvoiceAmountNet()
    {
        return $this->invoiceAmountNet;
    }

    /**
     * @param float $invoiceAmountNet
     */
    public function setInvoiceAmountNet($invoiceAmountNet)
    {
        $this->invoiceAmountNet = $invoiceAmountNet;
    }

    /**
     * @return int
     */
    public function getInvoiceShipping()
    {
        return $this->invoiceShipping;
    }

    /**
     * @param int $invoiceShipping
     */
    public function setInvoiceShipping($invoiceShipping)
    {
        $this->invoiceShipping = $invoiceShipping;
    }

    /**
     * @return int
     */
    public function getInvoiceShippingNet()
    {
        return $this->invoiceShippingNet;
    }

    /**
     * @param int $invoiceShippingNet
     */
    public function setInvoiceShippingNet($invoiceShippingNet)
    {
        $this->invoiceShippingNet = $invoiceShippingNet;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return string
     */
    public function getCustomerComment()
    {
        return $this->customerComment;
    }

    /**
     * @param string $customerComment
     */
    public function setCustomerComment($customerComment)
    {
        $this->customerComment = $customerComment;
    }

    /**
     * @return string
     */
    public function getInternalComment()
    {
        return $this->internalComment;
    }

    /**
     * @param string $internalComment
     */
    public function setInternalComment($internalComment)
    {
        $this->internalComment = $internalComment;
    }

    /**
     * @return int
     */
    public function getNet()
    {
        return $this->net;
    }

    /**
     * @param int $net
     */
    public function setNet($net)
    {
        $this->net = $net;
    }

    /**
     * @return int
     */
    public function getTaxFree()
    {
        return $this->taxFree;
    }

    /**
     * @param int $taxFree
     */
    public function setTaxFree($taxFree)
    {
        $this->taxFree = $taxFree;
    }

    /**
     * @return string
     */
    public function getTemporaryId()
    {
        return $this->temporaryId;
    }

    /**
     * @param string $temporaryId
     */
    public function setTemporaryId($temporaryId)
    {
        $this->temporaryId = $temporaryId;
    }

    /**
     * @return string
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * @param string $referer
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;
    }

    /**
     * @return \DateTime
     */
    public function getClearedDate()
    {
        return $this->clearedDate;
    }

    /**
     * @param  $clearedDate
     */
    public function setClearedDate($clearedDate)
    {
        $this->clearedDate = $clearedDate;
    }

    /**
     * @return string
     */
    public function getTrackingCode()
    {
        return $this->trackingCode;
    }

    /**
     * @param string $trackingCode
     */
    public function setTrackingCode($trackingCode)
    {
        $this->trackingCode = $trackingCode;
    }

    /**
     * @return string
     */
    public function getLanguageIso()
    {
        return $this->languageIso;
    }

    /**
     * @param string $languageIso
     */
    public function setLanguageIso($languageIso)
    {
        $this->languageIso = $languageIso;
    }

    /**
     * @return string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

    /**
     * @return int
     */
    public function getCurrencyFactor()
    {
        return $this->currencyFactor;
    }

    /**
     * @param int $currencyFactor
     */
    public function setCurrencyFactor($currencyFactor)
    {
        $this->currencyFactor = $currencyFactor;
    }

    /**
     * @return string
     */
    public function getRemoteAddress()
    {
        return $this->remoteAddress;
    }

    /**
     * @param string $remoteAddress
     */
    public function setRemoteAddress($remoteAddress)
    {
        $this->remoteAddress = $remoteAddress;
    }

    /**
     * @return string
     */
    public function getDeviceType()
    {
        return $this->deviceType;
    }

    /**
     * @param string $deviceType
     */
    public function setDeviceType($deviceType)
    {
        $this->deviceType = $deviceType;
    }

    /**
     * @return array
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * @param array $attribute
     */
    public function setAttribute($attribute)
    {
        $this->attribute = $attribute;
    }

    /**
     * @return CustomerAttribute
     */
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param CustomerAttribute $customer
     */
    public function setCustomer($customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return int
     */
    public function getPaymentStatusId()
    {
        return $this->paymentStatusId;
    }

    /**
     * @param int $paymentStatusId
     */
    public function setPaymentStatusId($paymentStatusId)
    {
        $this->paymentStatusId = $paymentStatusId;
    }

    /**
     * @return int
     */
    public function getOrderStatusId()
    {
        return $this->orderStatusId;
    }

    /**
     * @param int $orderStatusId
     */
    public function setOrderStatusId($orderStatusId)
    {
        $this->orderStatusId = $orderStatusId;
    }

    /**
     * @return string
     */
    public function getOrderTime()
    {
        return $this->orderTime;
    }

    /**
     * @param string $orderTime
     */
    public function setOrderTime($orderTime)
    {
        $this->orderTime = $orderTime;
    }
}
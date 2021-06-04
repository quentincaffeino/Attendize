<?php

namespace Services\PaymentGateway;

class GoPay
{

    const GATEWAY_NAME = 'GoPay';

    private $transaction_data;

    private $gateway;

    private $extra_params = [];

    public function __construct($gateway, $options)
    {
        $this->gateway = $gateway;
        $this->options = $options;
    }

    private function createTransactionData($order_total, $order_email, $event)
    {
        $returnUrl = route('showEventCheckoutPaymentReturn', [
            'event_id' => $event->id,
        ]);

        $transactionReference = uniqid();

        $this->transaction_data = [
            'transactionReference' => $transactionReference,

            'purchaseData' => [
                'payer' => [
                    'default_payment_instrument' => 'BANK_ACCOUNT',
                    'allowed_payment_instruments' => ['BANK_ACCOUNT', 'PAYMENT_CARD'],
                ],
                'target' => [
                    'type' => 'ACCOUNT',
                    'goid' => $this->gateway->getParameter('goId'),
                ],
                'amount' => floatval($order_total) * 100,
                'currency' => 'CZK',
                'order_number' => $transactionReference,
                'order_description' => 'Order for customer: ' . $order_email,
                'items' => [
                    [
                        'count' => 1,
                        'name' => 'Order for customer: ' . $order_email,
                        'amount' => floatval($order_total) * 100
                    ],
                ],
                // 'eet'               => [
                //     "celk_trzba" => 15000,
                //     "zakl_dan1"  => 14000,
                //     "dan1"       => 1000,
                //     "zakl_dan2"  => 14000,
                //     "dan2"       => 1000,
                //     "mena"       => 'CZK'
                // ],
                'callback' => [
                    'return_url' => $returnUrl,
                    'notification_url' => $returnUrl, // $notifyUrl,
                ],
            ],
        ];

        return $this->transaction_data;
    }

    public function startTransaction($order_total, $order_email, $event)
    {
        $this->createTransactionData($order_total, $order_email, $event);
        $response = $this->gateway->purchase($this->transaction_data);

        return $response;
    }

    public function getTransactionData()
    {
        return $this->transaction_data;
    }

    public function extractRequestParameters($request)
    {
        foreach ($this->extra_params as $param) {
            if (!empty($request->get($param))) {
                $this->options[$param] = $request->get($param);
            }
        }
    }

    public function completeTransaction($data)
    {
        $completeRequest = ['transactionReference' => $_GET['id']];
        return $this->gateway->completePurchase($completeRequest);
    }

    public function getAdditionalData($response)
    {
        // $additionalData['payment_intent'] = $response->getPaymentIntentReference();
        // return $additionalData;
        return [];
    }

    public function storeAdditionalData()
    {
        return false;
    }

    public function refundTransaction($order, $refund_amount, $refund_application_fee)
    {
        $request = $this->gateway->cancel([
            'transactionReference' => $order->transaction_id,
            'amount' => $refund_amount,
            'refundApplicationFee' => $refund_application_fee,
            'paymentIntentReference' => $order->payment_intent
        ]);

        $response = $request->send();

        if ($response->isCancelled()) {
            $refundResponse['successful'] = true;
        } else {
            $refundResponse['successful'] = false;
            $refundResponse['error_message'] = $response->getMessage();
        }

        return $refundResponse;
    }
}

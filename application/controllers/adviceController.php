<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose:
 *
 * @author: Rishabh Dev Bansal
 * @created on: 22/1/13 1:20 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class adviceController extends SaanController
{
    public function index()
    {
        return true;
    }

    public function request($args)
    {
        $this->registry->template->Title = "Infopedia :: Get an Advice";
        if (is_array($args) && $args['expert'] != "") {
            $expertEmail = $this->registry->security->decryptData($args['expert']);
            $this->registry->template->EncryptedEmail = $args['expert'];
            $this->registry->template->Title = "Infopedia :: Get an Advice";
            if ($this->isPostBack()) {
                $postArray = $this->requestPost();
                foreach ($postArray as $postKey => $postValue) {
                    if ($postKey != "user_comments") {
                        if ($this->registry->validation->isEmpty($postValue)) {
                            $controlName = ucwords(str_replace("_", " ", $postKey));
                            $_SESSION['error'][] = "$controlName cannot be left blank";
                        } else {
                            if ($postKey == "user_email_address" && $this->registry->validation->validateEmail($postValue) === FALSE) {
                                $_SESSION['error'][] = "Please Enter a valid Email Address";
                            }

                            if ($postKey == "user_phone_number" && $this->registry->validation->validatePhone($postValue) === FALSE) {
                                $_SESSION['error'][] = "Please Enter a valid Phone Number";
                            }
                        }
                    }
                }
                if (count($_SESSION['error']) == 0) {
                    $selectedExpertArray = $this->registry->model->run('getExpertByEmail', $expertEmail);
                    $postArray['selected_expert_id'] = $selectedExpertArray[0]['expert_id'];

                    /**
                     * We have not used encryption here because there was some problem in the jquery with the
                     * character "=" in the url and encrypted string was generating = in the text.
                     */
                    if ($customerId = $this->registry->model->run('addNewRequest', $postArray)) {
                        $_SESSION['request_complete'] = "request_complete";
                        $_SESSION['success'] = "Thank you for submitting your details.";
                        General::redirect(__SITE_URL . "advice/choose_payment/user:$customerId");
                        exit;
                    }
                } else {
                    $this->registry->template->RetainPost = $postArray;
                }
            }

        } else {
            echo __SITE_URL . "index";
            General::redirect(__SITE_URL . "index");
            exit;
        }
        $this->registry->template->show('request_advice');
    }

    public function choose_payment($args)
    {
        if (isset($_SESSION['request_complete']) && $_SESSION['request_complete'] == "request_complete") {
            $this->registry->template->Title = "Infopedia :: Choose You payment Mode";
            if (is_array($args) && count($args) > 0) {
                $customerId = $args['user'];
                $adviceRequestArray = $this->registry->model->run('getRequestByRequestId', $customerId);
                $this->registry->template->RequestId = $adviceRequestArray[0]['advice_request_id'];
            }
            $this->registry->template->show('choose_payment');
        } else {
            General::redirect(__SITE_URL);
        }

    }

    public function directPayment()
    {
        $this->registry->template->Title = "Infopedia :: Credit Card Payment";
        if ($this->isPostBack()) {
            $newPostArray = $this->requestPost();
            $postArray = array();
            foreach ($newPostArray as $postKey => $postValue) {
                $postArray[$postKey] = urlencode($postValue);
            }
            $amountValue = appController::getAppSettingBySettingName('customer_transaction_amount');
            $currencyCodeType = urlencode("USD");
            $paymentType = urlencode("Sale");
            $postArray['date_month'] = str_pad($postArray['date_month'], 2, '0', STR_PAD_LEFT);
            $postArray['exp_date'] = $postArray['date_month'] . $postArray['date_year'];
            PaypalPayment::setVariablesForDirectPayment($amountValue, $currencyCodeType, $paymentType);
            $transactionStatusArray = PaypalPayment::initDirectPayment($postArray);
            if (is_array($transactionStatusArray)) {
                $_SESSION['transaction_details'] = $transactionStatusArray;
                if (strtolower($transactionStatusArray['ACK']) == "success") {
                    $transactionStatusArray['REQUESTID'] = $postArray['customer_number'];
                    $transactionStatusArray['payment_by'] = "credit card";
                    if ($lastPaymentId = $this->registry->model->run('addNewPayment', $transactionStatusArray)) {
                        $this->registry->model->run('updateAdviceRequestPayStatus', $transactionStatusArray['REQUESTID']);
                        $customerPaymentArray = $this->registry->model->run('getCustomerPaymentByAdviceId', $transactionStatusArray['REQUESTID']);
                        //This updates the amount due for payment to the experts in the amount_due_details table
                        $this->registry->model->run('updateAmountDueByExpertId', $customerPaymentArray[0]['expert_id']);
                        $_SESSION['last_payment_id'] = $lastPaymentId;

                        /* *************************** Start: Send Email to the Expert Registered ************************* */

                        $templateArray = appController::getTemplateByName('payment_notification');
                        $msg = $templateArray[0]['email_template_content'];
                        $msg = str_replace("{CUSTOMER_NAME}", ucwords($customerPaymentArray[0]['user_fullname']), $msg);
                        $msg = str_replace("{EXPERT_NAME}", ucwords($customerPaymentArray[0]['expert_name']), $msg);
                        $msg = str_replace("{TRANSACTION_ID}", $customerPaymentArray[0]['transaction_id'], $msg);
                        $msg = str_replace("{PAID_AMOUNT}", $customerPaymentArray[0]['paid_amount'], $msg);
                        $msg = str_replace("{PAYMENT_DATE}", General::getFormatedDate($customerPaymentArray[0]['paid_datetime']), $msg);

                        $message = Swift_Message::newInstance(ucwords($templateArray[0]['email_template_subject']))
                            ->setFrom(array(FROM_EMAIL => FROM_NAME))
                            ->setBody($msg, 'text/html');
                        $message->setTo(array($customerPaymentArray[0]['user_email_address'] => $customerPaymentArray[0]['user_fullname']));
                        $failedRecipients = array(FAILED_EMAIL => FAILED_NAME);
                        $this->registry->mailer->send($message, $failedRecipients);

                        /* *************************** End: Send Email to the Expert Registered ************************* */

                        General::redirect(__SITE_URL . "advice/directPayment");
                    }
                } else if (strtolower($transactionStatusArray['ACK']) == "failure") {
                    $_SESSION['last_payment_id'] = "failure";
                    General::redirect(__SITE_URL . "advice/directPayment");
                }
            } else {
                $_SESSION['last_payment_id'] = "none";
                General::redirect(__SITE_URL . "advice/directPayment");
            }
        }
        $this->registry->template->show('credit_card_payment');
    }

    public function expressCheckout($args)
    {
        if (is_array($args)) {
            $requestIdValue = $args['request_id'];
            $amountValue = appController::getAppSettingBySettingName('customer_transaction_amount');
            $currencyCodeType = urlencode("USD");
            $paymentType = "Sale";

            $returnURL = __SITE_URL . "advice/expChkConfirmation/amount:" . $amountValue . "/currency:" . $currencyCodeType . "/type:" . $paymentType . "/request_id:" . $requestIdValue . "/?succ=yes";
            $cancelURL = __SITE_URL . "advice/expChkConfirmation/amount:" . $amountValue . "/currency:" . $currencyCodeType . "/type:" . $paymentType . "/request_id:" . $requestIdValue . "/?succ=can";

            $checkoutDescription = "Test Paypal API using class";
            PaypalPayment::setVariablesForExpChkOut($returnURL, $cancelURL, $amountValue, $currencyCodeType, $paymentType, $checkoutDescription);
            PaypalPayment::initExpressCheckout();
        } else {
            General::redirect(__SITE_URL);
        }

    }

    public function expChkConfirmation($args)
    {
        $this->registry->template->Title = "Infopedia :: Paypal Express Checkout Payment";
        if ($this->isGetBack()) {
            $getArray = $this->requestGet();
            if ($getArray['token'] != '') {
                if ($getArray['succ'] == "yes") {
                    $amountValue = $args['amount'];
                    $currencyCode = $args['currency'];
                    $paymentType = $args['type'];
                    PaypalPayment::setPayerID($getArray['PayerID']);
                    PaypalPayment::setTokenID($getArray['token']);
                    $transactionStatusArray = PaypalPayment::GetShippingDetails($amountValue, $paymentType, $currencyCode);
                    if (is_array($transactionStatusArray)) {
                        if (strtolower($transactionStatusArray['ACK']) == "success") {
                            $transactionStatusArray['REQUESTID'] = $args['request_id'];
                            $transactionStatusArray['TRANSACTIONID'] = $transactionStatusArray['PAYMENTINFO_0_TRANSACTIONID'];
                            $transactionStatusArray['AMT'] = $transactionStatusArray['PAYMENTINFO_0_AMT'];
                            $transactionStatusArray['payment_by'] = "express";
                            if ($lastPaymentId = $this->registry->model->run('addNewPayment', $transactionStatusArray)) {
                                $this->registry->model->run('updateAdviceRequestPayStatus', $transactionStatusArray['REQUESTID']);
                                $customerPaymentArray = $this->registry->model->run('getCustomerPaymentByAdviceId', $transactionStatusArray['REQUESTID']);
                                $this->registry->model->run('updateAmountDueByExpertId', $customerPaymentArray[0]['expert_id']);
                                $_SESSION['last_payment_id'] = $lastPaymentId;

                                /* *************************** Start: Send Email to the Expert Registered ************************* */

                                $templateArray = appController::getTemplateByName('payment_notification');
                                $msg = $templateArray[0]['email_template_content'];
                                $msg = str_replace("{CUSTOMER_NAME}", ucwords($customerPaymentArray[0]['user_fullname']), $msg);
                                $msg = str_replace("{EXPERT_NAME}", ucwords($customerPaymentArray[0]['expert_name']), $msg);
                                $msg = str_replace("{TRANSACTION_ID}", $customerPaymentArray[0]['transaction_id'], $msg);
                                $msg = str_replace("{PAID_AMOUNT}", $customerPaymentArray[0]['paid_amount'], $msg);
                                $msg = str_replace("{PAYMENT_DATE}", General::getFormatedDate($customerPaymentArray[0]['paid_datetime']), $msg);

                                $message = Swift_Message::newInstance(ucwords($templateArray[0]['email_template_subject']))
                                    ->setFrom(array(FROM_EMAIL => FROM_NAME))
                                    ->setBody($msg, 'text/html');
                                $message->setTo(array($customerPaymentArray[0]['user_email_address'] => $customerPaymentArray[0]['user_fullname']));
                                $failedRecipients = array(FAILED_EMAIL => FAILED_NAME);
                                $this->registry->mailer->send($message, $failedRecipients);

                                $this->registry->template->Amount = $transactionStatusArray['AMT'];

                                /* *************************** End: Send Email to the Expert Registered ************************* */
                            }
                        } else if (strtolower($transactionStatusArray['ACK']) == "failure") {
                            $_SESSION['last_payment_id'] = "none";
                        }
                    } else {
                        $_SESSION['last_payment_id'] = "none";
                    }
                } else if ($getArray['succ'] == "can") {
                    $_SESSION['last_payment_id'] = "cancel";
                }
            }
        }
        $this->registry->template->show('express_checkout');
    }

}

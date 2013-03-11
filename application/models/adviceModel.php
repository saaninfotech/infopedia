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
class adviceModel extends SaanModel
{
    public function addNewRequest($adviceArray)
    {
        $currentTime = time();
        $insertArray = array('user_fullname' => $adviceArray['user_full_name'],
                            'user_email_address' => $adviceArray['user_email_address'],
                            'user_phone_number' => $adviceArray['user_phone_number'],
                            'expert_id' => $adviceArray['selected_expert_id'],
                            'advice_request_datetime' => $currentTime,
                            'user_comments' => $adviceArray['user_comments']);


        return $this->db->query_insert('advice_request_details', $insertArray);
    }

    public function getExpertByEmail($expertEmail)
    {
        $query = "SELECT * FROM expert_details WHERE expert_email = '$expertEmail'";
        return $this->db->fetch_rows($query);
    }

    public function getRequestByRequestId($requestId)
    {
        $query = "SELECT advice_request_id FROM advice_request_details WHERE advice_request_id = '$requestId' AND advice_request_payment_status = 'incomplete'";
        return $this->db->fetch_rows($query);
    }

    public function addNewPayment($paymentArray)
    {
        $insertArray = array('advice_request_id' => $paymentArray['REQUESTID'],
                                'transaction_id' => $paymentArray['TRANSACTIONID'],
                                'corelation_id' => $paymentArray['CORRELATIONID'],
                                'paid_amount' => $paymentArray['AMT'],
                                'paid_datetime' => time(),
                                'paid_status' => 'complete',
                                'payment_by' => $paymentArray['payment_by']);
        return $this->db->query_insert('advice_payment_details', $insertArray);
    }

    public function updateAdviceRequestPayStatus($requestId)
    {
        $query = "UPDATE advice_request_details SET advice_request_payment_status = 'complete' WHERE advice_request_id = '$requestId'";
        return $this->db->query($query);
    }

    public function getCustomerPaymentByAdviceId($adviceId)
    {
        $query = "SELECT T.*, E.expert_name, U.user_email_address, U.user_fullname, U.expert_id FROM advice_request_details U
                        INNER JOIN expert_details E
                            ON U.expert_id = E.expert_id
                        INNER JOIN advice_payment_details T
                            ON U.advice_request_id = T.advice_request_id
                        WHERE U.advice_request_id = '$adviceId'";
        return $this->db->fetch_rows($query);
    }

    public function updateAmountDueByExpertId($expertId, $updateType = "add", $subtractAmount = 0.00)
    {
        $amountDueArray = $this->getAmountDueByExpertId($expertId);
        if($updateType == "add")
        {
            $amountDueValue = $amountDueArray[0]['amount_due_value'] + appController::getAppSettingBySettingName('amount_to_expert');
        }
        else if ($updateType == "subtract")
        {
            $amountDueValue = $amountDueArray[0]['amount_due_value'] - $subtractAmount;
        }

        $query = "UPDATE amount_due_details SET amount_due_value = '$amountDueValue' WHERE expert_id = '$expertId'";
        return $this->db->query($query);
    }

    public function getAmountDueByExpertId($expertId)
    {
        $query = "SELECT amount_due_value FROM amount_due_details WHERE expert_id = '$expertId'";
        return $this->db->fetch_rows($query);
    }
}

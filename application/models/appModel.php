<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose:
 *
 * @author: Saurabh Sinha
 * @created on: 1/14/13 9:23 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class appModel
{
    static $db;

    static function setDB($db)
    {
        self::$db = $db;
    }

    static function getCategoryListWithCount()
    {
        $query = "SELECT EC.expert_category_name AS category_name,
                          COUNT(E.expert_id) AS count_value
                        FROM
                          expert_category_details EC
                          LEFT JOIN expert_details E
                            ON EC.expert_category_id = E.expert_category_id
                        GROUP BY EC.expert_category_name ";

        return self::$db->fetch_rows($query);
    }

    static function getTemplateByName($templateName)
    {
        $query = "SELECT * FROM email_template_details WHERE email_template_name = '$templateName' and email_template_status = 'active'";

        return self::$db->fetch_rows($query);
    }

    static function getExpertProfileImage($expertEmail)
    {
        $query = "SELECT expert_photo FROM expert_details WHERE expert_email = '$expertEmail'";
        return self::$db->fetch_rows($query);
    }

    static function logLoginDetails($detailsArray)
    {
        $updateOtherLoginQuery = "UPDATE expert_login_details SET login_status = 'inactive' WHERE session_id = '" . $detailsArray['session_id'] ."'";
        self::$db->query($updateOtherLoginQuery);

        $updateExpertLoginStatusQuery = "UPDATE expert_details SET expert_login_status = 'online' WHERE expert_id = '" . $detailsArray['expert_id'] ."'";
        self::$db->query($updateExpertLoginStatusQuery);

        $query = "INSERT INTO expert_login_details SET session_id = '" . $detailsArray['session_id'] ."',
                                    expert_id = '" . $detailsArray['expert_id'] ."',
                                    browser_name = '" . $detailsArray['browser_name'] ."',
                                    ip_address = '" . $detailsArray['ip_address'] ."',
                                    login_datetime = '" . $detailsArray['login_datetime'] ."'";
        return self::$db->query($query);
    }

    static function markExpertLogout($sessionId, $expertId)
    {
        $query = "UPDATE expert_login_details SET login_status = 'inactive' WHERE session_id = '$sessionId' AND expert_id = '$expertId'";
        self::$db->query($query);

        $updateExpertLoginStatusQuery = "UPDATE expert_details SET expert_login_status = 'offline' WHERE expert_id = '$expertId'";
        self::$db->query($updateExpertLoginStatusQuery);
        return true;
    }

    static function getExpertIdByEmail($expertEmail)
    {
        $query = "SELECT expert_id FROM expert_details WHERE expert_email = '$expertEmail'";
        return self::$db->fetch_rows($query);
    }

    static function getExpertLastLogin($expertId)
    {
        $query = "SELECT login_datetime FROM expert_login_details WHERE expert_id = '$expertId' AND login_status = 'inactive' ORDER BY expert_login_id DESC LIMIT 0, 1";
        return self::$db->fetch_rows($query);
    }

    static function getExpertByEmail($expertEmail)
    {
        $query = "SELECT E.*, EC.expert_category_name FROM expert_details E
                        INNER JOIN expert_category_details EC
                            ON E.expert_category_id = EC.expert_category_id
                        WHERE E.expert_email = '$expertEmail'";

        return self::$db->fetch_rows($query);
    }

    static function getAppSettingBySettingName($settingName)
    {
        $query = "SELECT * FROM app_setting_details WHERE app_setting_name = '$settingName'";
        return self::$db->fetch_rows($query);
    }

    static function countExpertPendingCalls($expertId)
    {
        $query = "SELECT advice_request_id
                        FROM advice_request_details
                    WHERE expert_id = '$expertId' AND
                            advice_request_status = 'open' AND
                            advice_request_payment_status = 'complete'";
        return self::$db->num_rows($query);
    }

    static function countTotalAmountPaidByExpertId($expertId)
    {
        $query = "SELECT SUM( paid_amount ) as total_paid_amount
                    FROM expert_payment_details
                    WHERE expert_id = '$expertId'
                    GROUP BY expert_id";
        return self::$db->fetch_rows($query);
    }

    static function countTotalAmountPendingByExpertId($expertId)
    {
        $query = "SELECT amount_due_value FROM amount_due_details WHERE expert_id = '$expertId'";
        return self::$db->fetch_rows($query);
    }

    static function countTotalCustomersByExpertId($expertId)
    {
        $query = "SELECT count(advice_request_id) as customer_count FROM advice_request_details WHERE expert_id = '$expertId' AND advice_request_payment_status = 'complete'";
        return self::$db->fetch_rows($query);
    }

    static function countTotalCallsByExpertId($expertId)
    {
        $query = "SELECT count(advice_request_id) as call_count FROM advice_request_details WHERE expert_id = '$expertId' AND advice_request_status = 'called'";
        return self::$db->fetch_rows($query);
    }

    static function countTotalFeedbackByExpertId($expertId, $type = "all")
    {
        $query = "SELECT count(AF.advice_feedback_id) as feedback_count
                    FROM advice_request_details AR
                        INNER JOIN advice_feedback_details AF
                            ON AR.advice_request_id = AF.advice_id
                    WHERE AR.expert_id = '$expertId'";
        if($type == "unread")
        {
            $query .= " AND AF.expert_read = 'no'";
        }
        return self::$db->fetch_rows($query);
    }

    static function getTotalPointsByExpertId($expertId)
    {
        $query = "SELECT expert_total_points FROM expert_details WHERE expert_id = '$expertId'";
        return self::$db->fetch_rows($query);
    }
}

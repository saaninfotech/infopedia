<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose:
 *
 * @author: Saurabh Sinha
 * @created on: 1/14/13 8:55 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class appController
{
    static $CategoryList;

    static function getCategoryListWithCount()
    {
        self::$CategoryList = appModel::getCategoryListWithCount();
    }

    static function getTemplateByName($templateName)
    {
        return appModel::getTemplateByName($templateName);
    }

    static function getExpertProfileImage($expertPhoto)
    {
        if(file_exists(__UPLOAD_PATH . "expert_profile_image/" . $expertPhoto))
        {
            return __UPLOAD_URL . "expert_profile_image/" . $expertPhoto;
        }
        else{
            return __UPLOAD_URL . "expert_profile_image/" . "default.jpg";
        }
    }

    static function getExpertByEmail($expertEmail)
    {
        return appModel::getExpertByEmail($expertEmail);
    }

    static function logLoginDetails($detailArray)
    {
        return appModel::logLoginDetails($detailArray);
    }

    static function markExpertLogout($sessionId, $expertId)
    {
        return appModel::markExpertLogout($sessionId, $expertId);
    }

    static function getExpertIdByEmail($expertEmail)
    {
        return appModel::getExpertIdByEmail($expertEmail);
    }

    static function getExpertLastLogin($expertId)
    {
        return appModel::getExpertLastLogin($expertId);
    }

    static function getAppSettingBySettingName($settingName)
    {
        $appSettingArray = appModel::getAppSettingBySettingName($settingName);
        return $appSettingArray[0]['app_setting_value'];
    }

    static function countExpertPendingCalls($expertId, $bypass = FALSE)
    {
        if(!isset($_SESSION['expert_pending_calls']) || $bypass === TRUE)
        {
            $_SESSION['expert_pending_calls'] = appModel::countExpertPendingCalls($expertId);
        }
    }

    static function countTotalAmountPaidByExpertId($expertId)
    {
        $amountArray = appModel::countTotalAmountPaidByExpertId($expertId);
        return $amountArray[0]['total_paid_amount'];
    }

    static function countTotalAmountPendingByExpertId($expertId)
    {
        $amountArray = appModel::countTotalAmountPendingByExpertId($expertId);
        return $amountArray[0]['amount_due_value'];
    }

    static function countTotalCustomersByExpertId($expertId)
    {
        $countArray = appModel::countTotalCustomersByExpertId($expertId);
        return $countArray[0]['customer_count'];
    }

    static function countTotalCallsByExpertId($expertId)
    {
        $countArray = appModel::countTotalCallsByExpertId($expertId);
        return $countArray[0]['call_count'];
    }

    static function countTotalFeedbackByExpertId($expertId, $type = "all")
    {
        $countArray = appModel::countTotalFeedbackByExpertId($expertId, $type);
        return $countArray[0]['feedback_count'];
    }

    static function getTotalPointsByExpertId($expertId)
    {
        $countArray = appModel::getTotalPointsByExpertId($expertId);
        return $countArray[0]['expert_total_points'];
    }
}

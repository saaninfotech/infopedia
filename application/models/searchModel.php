<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose:
 *
 * @author: Saurabh Sinha
 * @created on: 1/15/13 9:05 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class searchModel extends SaanModel
{
    public function searchExpertByCredential($searchValue)
    {
        if ($searchValue) {
            $query = "SELECT E.*, EC.expert_category_name
                        FROM expert_details E
                            INNER JOIN expert_category_details EC
                                ON E.expert_category_id = EC.expert_category_id
                        WHERE MATCH(expert_credential_description) AGAINST ('" . $searchValue . "' IN BOOLEAN MODE)
                        AND expert_status = 'active'";
            return $this->db->fetch_rows($query);
        }

    }
}

<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose: This is the Model Class for the Index Controller
 *
 * @author: Rishabh Dev Bansal
 * @created on: 9/1/13 3:17 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class indexModel extends SaanModel
{
    public function getUser()
    {
        $resultSet = $this->db->fetch_rows("SELECT * FROM index_details");

        return $resultSet;
    }

    public function getUserById($userArray)
    {
        if ($userArray) {
            echo "This is the model page value from controller <pre>";
            print_r($userArray);
        }
    }

    public function getCategoryListWithCount()
    {
        $query = "SELECT EC.expert_category_name AS category_name,
                          COUNT(e.expert_id) AS count_value
                        FROM
                          expert_category_details EC
                          LEFT JOIN expert_details E
                            ON ec.expert_category_id = e.expert_category_id
                        GROUP BY ec.expert_category_name";

        return $this->db->fetch_rows($query);
    }

    public function getAllExperts($expertArray)
    {
        if (is_array($expertArray)) {
            $query = "SELECT E.*, EC.expert_category_name
                            FROM expert_details E
                        INNER JOIN expert_category_details EC
                            ON E.expert_category_id = EC.expert_category_id
                            WHERE expert_status = 'active'";
            if ($expertArray['latest']) {
                $query .= " ORDER BY E.expert_id DESC";
            }
            if ($expertArray[limit] != 0) {
                $query .= " LIMIT 0, " . $expertArray[limit];
            }
        }
        return $this->db->fetch_rows($query);
    }

    public function getAdviceByAdviceId($args)
    {
        if(is_array($args))
        {
            $adviceId = $args['advice_id'];
            $tokenValue = $args['token_value'];
            $query = "SELECT
                              AF.advice_feedback_id,
                              E.expert_name,
                              AF.star_value
                            FROM
                              advice_feedback_details AF
                              INNER JOIN advice_request_details AR
                                ON AF.advice_id = AR.advice_request_id
                              INNER JOIN expert_details E
                                ON AR.expert_id = E.expert_id
                            WHERE AF.advice_id = '$adviceId' AND AF.token_value = '$tokenValue'";
            return $this->db->fetch_rows($query);
        }

    }

    public function updateFeedback($args)
    {
        $timeValue = time();
        $query = "UPDATE advice_feedback_details
                        SET star_value = '" . $args['hdnPoint'] . "',
                            feedback_comment = '" . $args['comments'] . "',
                            feedback_datetime = '" . $timeValue . "'
                        WHERE advice_id = '" . $args['advice_id'] . "' AND token_value = '" . $args['token_value'] . "'";
        return $this->db->query($query);
    }

    public function getTotalPointsByExpertId($expertId)
    {
        $query = "SELECT expert_total_points FROM expert_details WHERE expert_id = '$expertId'";
        return $this->db->fetch_rows($query);
    }

    public function updateTotalPointsByExpertId($args)
    {
        if(is_array($args))
        {
            $query = "UPDATE expert_details SET expert_total_points = '" . $args['new_points'] . "' WHERE expert_id = '" . $args['expert_id'] . "'";
            return $this->db->query($query);
        }
    }

    public function getPopularExperts()
    {
        $query = "SELECT E.*, EC.expert_category_name
                        FROM expert_details E
                    INNER JOIN expert_category_details EC
                        ON E.expert_category_id = EC.expert_category_id
                        WHERE expert_status = 'active' AND E.expert_total_points > 0 ORDER BY E.expert_total_points DESC LIMIT 0, 10";

        return $this->db->fetch_rows($query);
    }
}

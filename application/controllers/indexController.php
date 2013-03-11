<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Technical Support System
 * @purpose: This is the Index controller for the Framework
 *
 * @author: Rishabh Dev Bansal
 * @created on: 12/30/12 3:21 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/
class indexController extends SaanController
{
    public function index()
    {
        $this->registry->template->Title = " Infopedia - Technical Support Center";
        $latestArray = array('limit' => 0,
            'type' => 'latest');
        $this->registry->template->ExpertListLatest = $this->getAllExperts($latestArray);
        $this->registry->template->ExpertListPopular = $this->getPopularExperts();
        $this->registry->template->show("index");
    }

    public function getAllExperts($latestArray)
    {
        $latestArray['latest'] = TRUE;
        return $this->registry->model->run('getAllExperts', $latestArray);
    }

    public function getPopularExperts()
    {
        return $this->registry->model->run('getPopularExperts');
    }


    public function feedback($args)
    {
        if(is_array($args))
        {
            $adviceQueryArray['advice_id'] = $this->registry->security->decryptData($args['advice_id']);
            $adviceQueryArray['token_value'] = $this->registry->security->decryptData($args['token_value']);
            $adviceArray = $this->registry->model->run('getAdviceByAdviceId', $adviceQueryArray);
            if(is_array($adviceArray) && count($adviceArray) > 0)
            {
                if($adviceArray[0]['star_value'] === NULL || $adviceArray[0]['star_value'] == "")
                {
                    $this->registry->template->Title = " Infopedia - Feedback Page";
                    $this->registry->template->AdviceArray = $adviceArray;
                    if($this->isPostBack())
                    {
                        $postArray = $this->requestPost();
                        if($postArray['hdnPoint'] < 1 || $postArray['hdnPoint'] > 5)
                        {
                            $_SESSION['error'][] = "Please choose Star Rating";
                        }
                        if(strlen($postArray['comments']) < 10)
                        {
                            $_SESSION['error'][] = "Please write atleast 10 characters in the comment's field";
                        }
                        if(count($_SESSION['error']) == 0)
                        {
                            $postArray['advice_id'] = $adviceQueryArray['advice_id'];
                            $postArray['token_value'] = $adviceQueryArray['token_value'];
                            if($this->registry->model->run('updateFeedback', $postArray))
                            {
                                $postArray['expert_id'] = $this->registry->security->decryptData($args['expert_id']);
                                $expertPointArray = $this->registry->model->run('getTotalPointsByExpertId', $postArray['expert_id']);
                                $postArray['new_points'] = $postArray['hdnPoint'] + $expertPointArray[0]['expert_total_points'];
                                $this->registry->model->run('updateTotalPointsByExpertId', $postArray);
                                $_SESSION['success'] = "Feedback Submitted Successfully.";
                                General::redirect(__SITE_URL . "index/feedback_success");
                            }
                        }
                    }

                    $this->registry->template->show("feedback");
                }
                else{
                    General::redirect(__SITE_URL);
                }

            }
        }
    }

    public function feedback_success()
    {
        if(isset($_SESSION['success']) && $_SESSION['success'] == "Feedback Submitted Successfully.")
        {
            $this->registry->template->Title = " Infopedia - Technical Support Center";
            $this->registry->template->show("feedback_success");
        }
    }

}

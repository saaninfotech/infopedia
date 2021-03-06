<?php
/**
 * SAAN FRAMEWORK
 *
 * @project: Core SAAN Framework
 * @purpose: This is the Application Config file to manage the simple applicaiton level configuration
 *           including the database credentials
 *
 * @author: Saurabh Sinha
 * @created on: 12/30/12 12:13 PM
 *
 * @url: www.saaninfotech.com
 * @email: info@saaninfotech.com
 * @license: SAAN INFOTECH
 *
 */

/***********************************************************************/

//This is the configuration for the Template used for the System
$__template_name = "saan_template";

/* ****************** Start: This is the Configuration for Database Credentials for the Application */

if (LOCAL_MODE === TRUE) {
    $__host = "localhost";
    $__user = "root";
    $__password = "";
    $__database = "technical_support_db";
}
else {
    $__host = "saaninfotechcom.ipagemysql.com";
    $__user = "techsupport_user";
    $__password = "tech@123";
    $__database = "technical_support_db";
}

/* ****************** End: This is the Configuration for Database Credentials for the Application */

/* *********************** Start: the credentials for the Mailer Component ********************* */

$__smtpServer = "smtpout.secureserver.net";
$__portNo = "465";
$__useSSL = "ssl";
$__smtpUser = "info@infopedia.us";
$__smtpPassword = "sample@123";

define('FROM_EMAIL', "no-reply@infopedia.net");
define('FROM_NAME', "Infopedia");

define('FAILED_EMAIL', "failed@infopedia.net");
define('FAILED_NAME', "Infopedia");

/* *********************** Start: the credentials for the Mailer Component ********************* */

/** ************************ Start: Credentials for Paypal Payment Process ********************* */

define("PAYPAL_PROXY_HOST", "127.0.0.1");
define("PAYPAL_PROXY_PORT", "808");

define("PAYPAL_API_USERNAME", 'write._1359196367_biz_api1.gmail.com');
define('PAYPAL_API_PASSWORD', '1359196417');
define('PAYPAL_API_SIGNATURE', 'AFcWxV21C7fd0v3bYYYRCpSSRl31A-zlNZS5E.K6gIF-osE6vzwGCc5Z');

define('PAYPAL_SBNCODE', 'PP-ECWizard');

define('PAYPAL_USE_SANDBOX', TRUE);
define('PAYPAL_USE_PROXY', FALSE);
define('PAYPAL_VERSION', '64');

/** ************************ Start: Credentials for Paypal Payment Process ********************* */

define('RECORDS_PER_PAGE', 10);
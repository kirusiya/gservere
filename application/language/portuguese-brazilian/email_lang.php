<?php
/**
 * System messages translation for CodeIgniter(tm)
 *
 * @author	CodeIgniter community
 * @copyright	Copyright (c) 2014 - 2017, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	https://codeigniter.com
 */
defined('BASEPATH') OR exit('No direct script access allowed');

$lang['email_must_be_array'] = 'The email validation method must be passed an array.';
$lang['email_invalid_address'] = 'Invalid email address: %s';
$lang['email_attachment_missing'] = 'Cannot find the following attached file: %s';
$lang['email_attachment_unreadable'] = 'Cannot open attachment: %s';
$lang['email_no_from'] = 'Unable to send email without source email.';
$lang['email_no_recipients'] = 'You must include the recipients: To(to), Cc(copy), or Bcc(blind copy)';
$lang['email_send_failure_phpmail'] = 'Cannot send email using PHP mail(). Your server may not be configured to send email using this method.';
$lang['email_send_failure_sendmail'] = 'Unable to send email using PHP Sendmail. Your server may not be configured to send email using this method.';
$lang['email_send_failure_smtp'] = 'Unable to send email using PHP SMTP. Your server may not be configured to send email using this method.';
$lang['email_sent'] = 'Your message was successfully sent using the following protocol: %s';
$lang['email_no_socket'] = 'Cannot open a socket for Sendmail. Please check the settings.';
$lang['email_no_hostname'] = 'You did not specify an SMTP address.';
$lang['email_smtp_error'] = 'The following SMTP errors have occurred: %s';
$lang['email_no_smtp_unpw'] = 'Error: You must assign an SMTP username and password.';
$lang['email_failed_smtp_login'] = 'Failed to send AUTH LOGIN command. Error: %s';
$lang['email_smtp_auth_un'] = 'Failed to authenticate user. Mistake: %s';
$lang['email_smtp_auth_pw'] = 'Falha ao autenticar senha. Error: %s';
$lang['email_smtp_data_failure'] = 'Unable to send data: %s';
$lang['email_exit_status'] = 'Exit status code: %s';

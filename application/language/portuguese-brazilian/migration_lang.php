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

$lang['migration_none_found'] = 'No migration found.';
$lang['migration_not_found'] = 'No migration found with version number: %s.';
$lang['migration_sequence_gap'] = 'Following migration to the next version number does not exist.: %s.';
$lang['migration_multiple_version'] = 'Here are the multiple migrations with the same version number: %s.';
$lang['migration_class_doesnt_exist'] = 'Migration class "%s" cannot be found.';
$lang['migration_missing_up_method'] = 'Migration class "%s" is missing the "up" method.';
$lang['migration_missing_down_method'] = 'Migration class "%s" is missing method "down".';
$lang['migration_invalid_filename'] = 'Migration "%s" has invalid filename.';

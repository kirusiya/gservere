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

$lang['db_invalid_connection_str'] = 'Unable to determine database settings based on the connection string you submitted.';
$lang['db_unable_to_connect'] = 'Unable to connect to your database using the provided settings.';
$lang['db_unable_to_select'] = 'Could not select the specified database: %s';
$lang['db_unable_to_create'] = 'The specified database could not be created: %s';
$lang['db_invalid_query'] = 'The query(query) you submitted is not valid.';
$lang['db_must_set_table'] = 'You must configure the table in your database to be used with your query.';
$lang['db_must_use_set'] = 'You must use the "set" method to update a record.';
$lang['db_must_use_index'] = 'You must specify an index to match your batch updates.';
$lang['db_batch_missing_index'] = 'One or more rows sent for batch update are missing the specified index.';
$lang['db_must_use_where'] = 'Updates are not allowed unless there is a "where" clause.';
$lang['db_del_must_use_where'] = 'Deletions are not allowed unless there is a "where" or "like" clause.';
$lang['db_field_param_missing'] = 'To fetch fields requires the table name as a parameter.';
$lang['db_unsupported_function'] = 'This functionality is not available for the database you are using.';
$lang['db_transaction_failure'] = 'Transaction Failed: Rollback performed.';
$lang['db_unable_to_drop'] = 'Could not delete(drop) the specified database.';
$lang['db_unsupported_feature'] = 'Functionality not supported in the database you are using.';
$lang['db_unsupported_compression'] = 'The file compression format you have chosen is not supported by your server.';
$lang['db_filepath_error'] = 'Unable to write data to the file you uploaded.';
$lang['db_invalid_cache_path'] = 'The cache path you sent is not valid or writable.';
$lang['db_table_name_required'] = 'The table name is required for this operation.';
$lang['db_column_name_required'] = 'The column name is required for this operation.';
$lang['db_column_definition_required'] = 'Column definition is mandatory for this operation.';
$lang['db_unable_to_set_charset'] = 'Unable to configure client connection character set: %s';
$lang['db_error_heading'] = 'A Database Error Occurred';

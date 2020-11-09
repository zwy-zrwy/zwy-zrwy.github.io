<?php

if (!defined('PCLZIP_READ_BLOCK_SIZE')) {
    define('PCLZIP_READ_BLOCK_SIZE', 2048);
}

if (!defined('PCLZIP_SEPARATOR')) {
    define('PCLZIP_SEPARATOR', ',');
}

if (!defined('PCLZIP_ERROR_EXTERNAL')) {
    define('PCLZIP_ERROR_EXTERNAL', 0);
}

if (!defined('PCLZIP_TEMPORARY_DIR')) {
    define('PCLZIP_TEMPORARY_DIR', '');
}

if (!defined('PCLZIP_TEMPORARY_FILE_RATIO')) {
    define('PCLZIP_TEMPORARY_FILE_RATIO', 0.47);
}


$g_pclzip_version = "2.8.2";

define('PCLZIP_ERR_USER_ABORTED', 2);
define('PCLZIP_ERR_NO_ERROR', 0);
define('PCLZIP_ERR_WRITE_OPEN_FAIL', -1);
define('PCLZIP_ERR_READ_OPEN_FAIL', -2);
define('PCLZIP_ERR_INVALID_PARAMETER', -3);
define('PCLZIP_ERR_MISSING_FILE', -4);
define('PCLZIP_ERR_FILENAME_TOO_LONG', -5);
define('PCLZIP_ERR_INVALID_ZIP', -6);
define('PCLZIP_ERR_BAD_EXTRACTED_FILE', -7);
define('PCLZIP_ERR_DIR_CREATE_FAIL', -8);
define('PCLZIP_ERR_BAD_EXTENSION', -9);
define('PCLZIP_ERR_BAD_FORMAT', -10);
define('PCLZIP_ERR_DELETE_FILE_FAIL', -11);
define('PCLZIP_ERR_RENAME_FILE_FAIL', -12);
define('PCLZIP_ERR_BAD_CHECKSUM', -13);
define('PCLZIP_ERR_INVALID_ARCHIVE_ZIP', -14);
define('PCLZIP_ERR_MISSING_OPTION_VALUE', -15);
define('PCLZIP_ERR_INVALID_OPTION_VALUE', -16);
define('PCLZIP_ERR_ALREADY_A_DIRECTORY', -17);
define('PCLZIP_ERR_UNSUPPORTED_COMPRESSION', -18);
define('PCLZIP_ERR_UNSUPPORTED_ENCRYPTION', -19);
define('PCLZIP_ERR_INVALID_ATTRIBUTE_VALUE', -20);
define('PCLZIP_ERR_DIRECTORY_RESTRICTION', -21);

define('PCLZIP_OPT_PATH', 77001);
define('PCLZIP_OPT_ADD_PATH', 77002);
define('PCLZIP_OPT_REMOVE_PATH', 77003);
define('PCLZIP_OPT_REMOVE_ALL_PATH', 77004);
define('PCLZIP_OPT_SET_CHMOD', 77005);
define('PCLZIP_OPT_EXTRACT_AS_STRING', 77006);
define('PCLZIP_OPT_NO_COMPRESSION', 77007);
define('PCLZIP_OPT_BY_NAME', 77008);
define('PCLZIP_OPT_BY_INDEX', 77009);
define('PCLZIP_OPT_BY_EREG', 77010);
define('PCLZIP_OPT_BY_PREG', 77011);
define('PCLZIP_OPT_COMMENT', 77012);
define('PCLZIP_OPT_ADD_COMMENT', 77013);
define('PCLZIP_OPT_PREPEND_COMMENT', 77014);
define('PCLZIP_OPT_EXTRACT_IN_OUTPUT', 77015);
define('PCLZIP_OPT_REPLACE_NEWER', 77016);
define('PCLZIP_OPT_STOP_ON_ERROR', 77017);
define('PCLZIP_OPT_EXTRACT_DIR_RESTRICTION', 77019);
define('PCLZIP_OPT_TEMP_FILE_THRESHOLD', 77020);
define('PCLZIP_OPT_ADD_TEMP_FILE_THRESHOLD', 77020);
define('PCLZIP_OPT_TEMP_FILE_ON', 77021);
define('PCLZIP_OPT_ADD_TEMP_FILE_ON', 77021);
define('PCLZIP_OPT_TEMP_FILE_OFF', 77022);
define('PCLZIP_OPT_ADD_TEMP_FILE_OFF', 77022);

define('PCLZIP_ATT_FILE_NAME', 79001);
define('PCLZIP_ATT_FILE_NEW_SHORT_NAME', 79002);
define('PCLZIP_ATT_FILE_NEW_FULL_NAME', 79003);
define('PCLZIP_ATT_FILE_MTIME', 79004);
define('PCLZIP_ATT_FILE_CONTENT', 79005);
define('PCLZIP_ATT_FILE_COMMENT', 79006);

define('PCLZIP_CB_PRE_EXTRACT', 78001);
define('PCLZIP_CB_POST_EXTRACT', 78002);
define('PCLZIP_CB_PRE_ADD', 78003);
define('PCLZIP_CB_POST_ADD', 78004);

class PclZip
{
    var $zipname = '';
    
    var $zip_fd = 0;
    
    var $error_code = 1;
    var $error_string = '';
    
    var $magic_quotes_status;
    
    function PclZip($p_zipname)
    {
        
        if (!function_exists('gzopen')) {
            die('Abort ' . basename(__FILE__) . ' : Missing zlib extensions');
        }
        
        $this->zipname             = $p_zipname;
        $this->zip_fd              = 0;
        $this->magic_quotes_status = -1;
        
        return;
    }
    
    
    function extract()
    {
        $v_result = 1;
        
        $this->privErrorReset();
        
        if (!$this->privCheckFormat()) {
            return (0);
        }
        
        $v_options         = array();
        $v_path            = '';
        $v_remove_path     = "";
        $v_remove_all_path = false;
        
        $v_size = func_num_args();
        
        $v_options[PCLZIP_OPT_EXTRACT_AS_STRING] = FALSE;
        
        if ($v_size > 0) {
            $v_arg_list = func_get_args();
            
            if ((is_integer($v_arg_list[0])) && ($v_arg_list[0] > 77000)) {
                
                $v_result = $this->privParseOptions($v_arg_list, $v_size, $v_options, array(
                    PCLZIP_OPT_PATH => 'optional',
                    PCLZIP_OPT_REMOVE_PATH => 'optional',
                    PCLZIP_OPT_REMOVE_ALL_PATH => 'optional',
                    PCLZIP_OPT_ADD_PATH => 'optional',
                    PCLZIP_CB_PRE_EXTRACT => 'optional',
                    PCLZIP_CB_POST_EXTRACT => 'optional',
                    PCLZIP_OPT_SET_CHMOD => 'optional',
                    PCLZIP_OPT_BY_NAME => 'optional',
                    PCLZIP_OPT_BY_EREG => 'optional',
                    PCLZIP_OPT_BY_PREG => 'optional',
                    PCLZIP_OPT_BY_INDEX => 'optional',
                    PCLZIP_OPT_EXTRACT_AS_STRING => 'optional',
                    PCLZIP_OPT_EXTRACT_IN_OUTPUT => 'optional',
                    PCLZIP_OPT_REPLACE_NEWER => 'optional',
                    PCLZIP_OPT_STOP_ON_ERROR => 'optional',
                    PCLZIP_OPT_EXTRACT_DIR_RESTRICTION => 'optional',
                    PCLZIP_OPT_TEMP_FILE_THRESHOLD => 'optional',
                    PCLZIP_OPT_TEMP_FILE_ON => 'optional',
                    PCLZIP_OPT_TEMP_FILE_OFF => 'optional'
                ));
                if ($v_result != 1) {
                    return 0;
                }
                
                if (isset($v_options[PCLZIP_OPT_PATH])) {
                    $v_path = $v_options[PCLZIP_OPT_PATH];
                }
                if (isset($v_options[PCLZIP_OPT_REMOVE_PATH])) {
                    $v_remove_path = $v_options[PCLZIP_OPT_REMOVE_PATH];
                }
                if (isset($v_options[PCLZIP_OPT_REMOVE_ALL_PATH])) {
                    $v_remove_all_path = $v_options[PCLZIP_OPT_REMOVE_ALL_PATH];
                }
                if (isset($v_options[PCLZIP_OPT_ADD_PATH])) {
                    if ((strlen($v_path) > 0) && (substr($v_path, -1) != '/')) {
                        $v_path .= '/';
                    }
                    $v_path .= $v_options[PCLZIP_OPT_ADD_PATH];
                }
            }
            
            else {
                
                $v_path = $v_arg_list[0];
                
                if ($v_size == 2) {
                    $v_remove_path = $v_arg_list[1];
                } else if ($v_size > 2) {
                    PclZip::privErrorLog(PCLZIP_ERR_INVALID_PARAMETER, "Invalid number / type of arguments");
                    
                    return 0;
                }
            }
        }
        
        $this->privOptionDefaultThreshold($v_options);
        
        
        $p_list   = array();
        $v_result = $this->privExtractByRule($p_list, $v_path, $v_remove_path, $v_remove_all_path, $v_options);
        if ($v_result < 1) {
            unset($p_list);
            return (0);
        }
        
        return $p_list;
    }
    
    
    
    function errorCode()
    {
        if (PCLZIP_ERROR_EXTERNAL == 1) {
            return (PclErrorCode());
        } else {
            return ($this->error_code);
        }
    }
    
    function errorName($p_with_code = false)
    {
        $v_name = array(
            PCLZIP_ERR_NO_ERROR => 'PCLZIP_ERR_NO_ERROR',
            PCLZIP_ERR_WRITE_OPEN_FAIL => 'PCLZIP_ERR_WRITE_OPEN_FAIL',
            PCLZIP_ERR_READ_OPEN_FAIL => 'PCLZIP_ERR_READ_OPEN_FAIL',
            PCLZIP_ERR_INVALID_PARAMETER => 'PCLZIP_ERR_INVALID_PARAMETER',
            PCLZIP_ERR_MISSING_FILE => 'PCLZIP_ERR_MISSING_FILE',
            PCLZIP_ERR_FILENAME_TOO_LONG => 'PCLZIP_ERR_FILENAME_TOO_LONG',
            PCLZIP_ERR_INVALID_ZIP => 'PCLZIP_ERR_INVALID_ZIP',
            PCLZIP_ERR_BAD_EXTRACTED_FILE => 'PCLZIP_ERR_BAD_EXTRACTED_FILE',
            PCLZIP_ERR_DIR_CREATE_FAIL => 'PCLZIP_ERR_DIR_CREATE_FAIL',
            PCLZIP_ERR_BAD_EXTENSION => 'PCLZIP_ERR_BAD_EXTENSION',
            PCLZIP_ERR_BAD_FORMAT => 'PCLZIP_ERR_BAD_FORMAT',
            PCLZIP_ERR_DELETE_FILE_FAIL => 'PCLZIP_ERR_DELETE_FILE_FAIL',
            PCLZIP_ERR_RENAME_FILE_FAIL => 'PCLZIP_ERR_RENAME_FILE_FAIL',
            PCLZIP_ERR_BAD_CHECKSUM => 'PCLZIP_ERR_BAD_CHECKSUM',
            PCLZIP_ERR_INVALID_ARCHIVE_ZIP => 'PCLZIP_ERR_INVALID_ARCHIVE_ZIP',
            PCLZIP_ERR_MISSING_OPTION_VALUE => 'PCLZIP_ERR_MISSING_OPTION_VALUE',
            PCLZIP_ERR_INVALID_OPTION_VALUE => 'PCLZIP_ERR_INVALID_OPTION_VALUE',
            PCLZIP_ERR_UNSUPPORTED_COMPRESSION => 'PCLZIP_ERR_UNSUPPORTED_COMPRESSION',
            PCLZIP_ERR_UNSUPPORTED_ENCRYPTION => 'PCLZIP_ERR_UNSUPPORTED_ENCRYPTION',
            PCLZIP_ERR_INVALID_ATTRIBUTE_VALUE => 'PCLZIP_ERR_INVALID_ATTRIBUTE_VALUE',
            PCLZIP_ERR_DIRECTORY_RESTRICTION => 'PCLZIP_ERR_DIRECTORY_RESTRICTION'
        );
        
        if (isset($v_name[$this->error_code])) {
            $v_value = $v_name[$this->error_code];
        } else {
            $v_value = 'NoName';
        }
        
        if ($p_with_code) {
            return ($v_value . ' (' . $this->error_code . ')');
        } else {
            return ($v_value);
        }
    }
    
    function errorInfo($p_full = false)
    {
        if (PCLZIP_ERROR_EXTERNAL == 1) {
            return (PclErrorString());
        } else {
            if ($p_full) {
                return ($this->errorName(true) . " : " . $this->error_string);
            } else {
                return ($this->error_string . " [code " . $this->error_code . "]");
            }
        }
    }
    
    
    
    
    
    function privCheckFormat($p_level = 0)
    {
        $v_result = true;
        
        clearstatcache();
        
        $this->privErrorReset();
        
        if (!is_file($this->zipname)) {
            PclZip::privErrorLog(PCLZIP_ERR_MISSING_FILE, "Missing archive file '" . $this->zipname . "'");
            return (false);
        }
        
        if (!is_readable($this->zipname)) {
            PclZip::privErrorLog(PCLZIP_ERR_READ_OPEN_FAIL, "Unable to read archive '" . $this->zipname . "'");
            return (false);
        }
        
        
        
        
        return $v_result;
    }
    
    function privParseOptions(&$p_options_list, $p_size, &$v_result_list, $v_requested_options = false)
    {
        $v_result = 1;
        
        $i = 0;
        while ($i < $p_size) {
            
            if (!isset($v_requested_options[$p_options_list[$i]])) {
                PclZip::privErrorLog(PCLZIP_ERR_INVALID_PARAMETER, "Invalid optional parameter '" . $p_options_list[$i] . "' for this method");
                
                return PclZip::errorCode();
            }
            
            switch ($p_options_list[$i]) {
                case PCLZIP_OPT_PATH:
                case PCLZIP_OPT_REMOVE_PATH:
                case PCLZIP_OPT_ADD_PATH:
                    if (($i + 1) >= $p_size) {
                        PclZip::privErrorLog(PCLZIP_ERR_MISSING_OPTION_VALUE, "Missing parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    $v_result_list[$p_options_list[$i]] = PclZipUtilTranslateWinPath($p_options_list[$i + 1], FALSE);
                    $i++;
                    break;
                
                case PCLZIP_OPT_TEMP_FILE_THRESHOLD:
                    if (($i + 1) >= $p_size) {
                        PclZip::privErrorLog(PCLZIP_ERR_MISSING_OPTION_VALUE, "Missing parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        return PclZip::errorCode();
                    }
                    
                    if (isset($v_result_list[PCLZIP_OPT_TEMP_FILE_OFF])) {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_PARAMETER, "Option '" . PclZipUtilOptionText($p_options_list[$i]) . "' can not be used with option 'PCLZIP_OPT_TEMP_FILE_OFF'");
                        return PclZip::errorCode();
                    }
                    
                    $v_value = $p_options_list[$i + 1];
                    if ((!is_integer($v_value)) || ($v_value < 0)) {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_OPTION_VALUE, "Integer expected for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        return PclZip::errorCode();
                    }
                    
                    $v_result_list[$p_options_list[$i]] = $v_value * 1048576;
                    $i++;
                    break;
                
                case PCLZIP_OPT_TEMP_FILE_ON:
                    if (isset($v_result_list[PCLZIP_OPT_TEMP_FILE_OFF])) {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_PARAMETER, "Option '" . PclZipUtilOptionText($p_options_list[$i]) . "' can not be used with option 'PCLZIP_OPT_TEMP_FILE_OFF'");
                        return PclZip::errorCode();
                    }
                    
                    $v_result_list[$p_options_list[$i]] = true;
                    break;
                
                case PCLZIP_OPT_TEMP_FILE_OFF:
                    if (isset($v_result_list[PCLZIP_OPT_TEMP_FILE_ON])) {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_PARAMETER, "Option '" . PclZipUtilOptionText($p_options_list[$i]) . "' can not be used with option 'PCLZIP_OPT_TEMP_FILE_ON'");
                        return PclZip::errorCode();
                    }
                    if (isset($v_result_list[PCLZIP_OPT_TEMP_FILE_THRESHOLD])) {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_PARAMETER, "Option '" . PclZipUtilOptionText($p_options_list[$i]) . "' can not be used with option 'PCLZIP_OPT_TEMP_FILE_THRESHOLD'");
                        return PclZip::errorCode();
                    }
                    
                    $v_result_list[$p_options_list[$i]] = true;
                    break;
                
                case PCLZIP_OPT_EXTRACT_DIR_RESTRICTION:
                    if (($i + 1) >= $p_size) {
                        PclZip::privErrorLog(PCLZIP_ERR_MISSING_OPTION_VALUE, "Missing parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    if (is_string($p_options_list[$i + 1]) && ($p_options_list[$i + 1] != '')) {
                        $v_result_list[$p_options_list[$i]] = PclZipUtilTranslateWinPath($p_options_list[$i + 1], FALSE);
                        $i++;
                    } else {
                    }
                    break;
                
                case PCLZIP_OPT_BY_NAME:
                    if (($i + 1) >= $p_size) {
                        PclZip::privErrorLog(PCLZIP_ERR_MISSING_OPTION_VALUE, "Missing parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    if (is_string($p_options_list[$i + 1])) {
                        $v_result_list[$p_options_list[$i]][0] = $p_options_list[$i + 1];
                    } else if (is_array($p_options_list[$i + 1])) {
                        $v_result_list[$p_options_list[$i]] = $p_options_list[$i + 1];
                    } else {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_OPTION_VALUE, "Wrong parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    $i++;
                    break;
                
                case PCLZIP_OPT_BY_EREG:
                    $p_options_list[$i] = PCLZIP_OPT_BY_PREG;
                case PCLZIP_OPT_BY_PREG:
                    if (($i + 1) >= $p_size) {
                        PclZip::privErrorLog(PCLZIP_ERR_MISSING_OPTION_VALUE, "Missing parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    if (is_string($p_options_list[$i + 1])) {
                        $v_result_list[$p_options_list[$i]] = $p_options_list[$i + 1];
                    } else {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_OPTION_VALUE, "Wrong parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    $i++;
                    break;
                
                case PCLZIP_OPT_COMMENT:
                case PCLZIP_OPT_ADD_COMMENT:
                case PCLZIP_OPT_PREPEND_COMMENT:
                    if (($i + 1) >= $p_size) {
                        PclZip::privErrorLog(PCLZIP_ERR_MISSING_OPTION_VALUE, "Missing parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    if (is_string($p_options_list[$i + 1])) {
                        $v_result_list[$p_options_list[$i]] = $p_options_list[$i + 1];
                    } else {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_OPTION_VALUE, "Wrong parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    $i++;
                    break;
                
                case PCLZIP_OPT_BY_INDEX:
                    if (($i + 1) >= $p_size) {
                        PclZip::privErrorLog(PCLZIP_ERR_MISSING_OPTION_VALUE, "Missing parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    $v_work_list = array();
                    if (is_string($p_options_list[$i + 1])) {
                        
                        $p_options_list[$i + 1] = strtr($p_options_list[$i + 1], ' ', '');
                        
                        $v_work_list = explode(",", $p_options_list[$i + 1]);
                    } else if (is_integer($p_options_list[$i + 1])) {
                        $v_work_list[0] = $p_options_list[$i + 1] . '-' . $p_options_list[$i + 1];
                    } else if (is_array($p_options_list[$i + 1])) {
                        $v_work_list = $p_options_list[$i + 1];
                    } else {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_OPTION_VALUE, "Value must be integer, string or array for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    $v_sort_flag  = false;
                    $v_sort_value = 0;
                    for ($j = 0; $j < sizeof($v_work_list); $j++) {
                        $v_item_list      = explode("-", $v_work_list[$j]);
                        $v_size_item_list = sizeof($v_item_list);
                        
                        
                        if ($v_size_item_list == 1) {
                            $v_result_list[$p_options_list[$i]][$j]['start'] = $v_item_list[0];
                            $v_result_list[$p_options_list[$i]][$j]['end']   = $v_item_list[0];
                        } elseif ($v_size_item_list == 2) {
                            $v_result_list[$p_options_list[$i]][$j]['start'] = $v_item_list[0];
                            $v_result_list[$p_options_list[$i]][$j]['end']   = $v_item_list[1];
                        } else {
                            PclZip::privErrorLog(PCLZIP_ERR_INVALID_OPTION_VALUE, "Too many values in index range for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                            
                            return PclZip::errorCode();
                        }
                        
                        
                        if ($v_result_list[$p_options_list[$i]][$j]['start'] < $v_sort_value) {
                            $v_sort_flag = true;
                            
                            PclZip::privErrorLog(PCLZIP_ERR_INVALID_OPTION_VALUE, "Invalid order of index range for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                            
                            return PclZip::errorCode();
                        }
                        $v_sort_value = $v_result_list[$p_options_list[$i]][$j]['start'];
                    }
                    
                    if ($v_sort_flag) {
                    }
                    
                    $i++;
                    break;
                
                case PCLZIP_OPT_REMOVE_ALL_PATH:
                case PCLZIP_OPT_EXTRACT_AS_STRING:
                case PCLZIP_OPT_NO_COMPRESSION:
                case PCLZIP_OPT_EXTRACT_IN_OUTPUT:
                case PCLZIP_OPT_REPLACE_NEWER:
                case PCLZIP_OPT_STOP_ON_ERROR:
                    $v_result_list[$p_options_list[$i]] = true;
                    break;
                
                case PCLZIP_OPT_SET_CHMOD:
                    if (($i + 1) >= $p_size) {
                        PclZip::privErrorLog(PCLZIP_ERR_MISSING_OPTION_VALUE, "Missing parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    $v_result_list[$p_options_list[$i]] = $p_options_list[$i + 1];
                    $i++;
                    break;
                
                case PCLZIP_CB_PRE_EXTRACT:
                case PCLZIP_CB_POST_EXTRACT:
                case PCLZIP_CB_PRE_ADD:
                case PCLZIP_CB_POST_ADD:
                    if (($i + 1) >= $p_size) {
                        PclZip::privErrorLog(PCLZIP_ERR_MISSING_OPTION_VALUE, "Missing parameter value for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    $v_function_name = $p_options_list[$i + 1];
                    
                    if (!function_exists($v_function_name)) {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_OPTION_VALUE, "Function '" . $v_function_name . "()' is not an existing function for option '" . PclZipUtilOptionText($p_options_list[$i]) . "'");
                        
                        return PclZip::errorCode();
                    }
                    
                    $v_result_list[$p_options_list[$i]] = $v_function_name;
                    $i++;
                    break;
                
                default:
                    PclZip::privErrorLog(PCLZIP_ERR_INVALID_PARAMETER, "Unknown parameter '" . $p_options_list[$i] . "'");
                    
                    return PclZip::errorCode();
            }
            
            $i++;
        }
        
        if ($v_requested_options !== false) {
            for ($key = reset($v_requested_options); $key = key($v_requested_options); $key = next($v_requested_options)) {
                if ($v_requested_options[$key] == 'mandatory') {
                    if (!isset($v_result_list[$key])) {
                        PclZip::privErrorLog(PCLZIP_ERR_INVALID_PARAMETER, "Missing mandatory parameter " . PclZipUtilOptionText($key) . "(" . $key . ")");
                        
                        return PclZip::errorCode();
                    }
                }
            }
        }
        
        if (!isset($v_result_list[PCLZIP_OPT_TEMP_FILE_THRESHOLD])) {
            
        }
        
        return $v_result;
    }
    
    function privOptionDefaultThreshold(&$p_options)
    {
        $v_result = 1;
        
        if (isset($p_options[PCLZIP_OPT_TEMP_FILE_THRESHOLD]) || isset($p_options[PCLZIP_OPT_TEMP_FILE_OFF])) {
            return $v_result;
        }
        
        $v_memory_limit = ini_get('memory_limit');
        $v_memory_limit = trim($v_memory_limit);
        $last           = strtolower(substr($v_memory_limit, -1));
        
        if ($last == 'g')
            $v_memory_limit = $v_memory_limit * 1073741824;
        if ($last == 'm')
            $v_memory_limit = $v_memory_limit * 1048576;
        if ($last == 'k')
            $v_memory_limit = $v_memory_limit * 1024;
        
        $p_options[PCLZIP_OPT_TEMP_FILE_THRESHOLD] = floor($v_memory_limit * PCLZIP_TEMPORARY_FILE_RATIO);
        
        
        if ($p_options[PCLZIP_OPT_TEMP_FILE_THRESHOLD] < 1048576) {
            unset($p_options[PCLZIP_OPT_TEMP_FILE_THRESHOLD]);
        }
        
        return $v_result;
    }
    
    
    
    function privOpenFd($p_mode)
    {
        $v_result = 1;
        
        if ($this->zip_fd != 0) {
            PclZip::privErrorLog(PCLZIP_ERR_READ_OPEN_FAIL, 'Zip file \'' . $this->zipname . '\' already open');
            
            return PclZip::errorCode();
        }
        
        if (($this->zip_fd = @fopen($this->zipname, $p_mode)) == 0) {
            PclZip::privErrorLog(PCLZIP_ERR_READ_OPEN_FAIL, 'Unable to open archive \'' . $this->zipname . '\' in ' . $p_mode . ' mode');
            
            return PclZip::errorCode();
        }
        
        return $v_result;
    }
    
    function privCloseFd()
    {
        $v_result = 1;
        
        if ($this->zip_fd != 0)
            @fclose($this->zip_fd);
        $this->zip_fd = 0;
        
        return $v_result;
    }
    
    
    
    function privConvertHeader2FileInfo($p_header, &$p_info)
    {
        $v_result = 1;
        
        $v_temp_path               = PclZipUtilPathReduction($p_header['filename']);
        $p_info['filename']        = $v_temp_path;
        $v_temp_path               = PclZipUtilPathReduction($p_header['stored_filename']);
        $p_info['stored_filename'] = $v_temp_path;
        $p_info['size']            = $p_header['size'];
        $p_info['compressed_size'] = $p_header['compressed_size'];
        $p_info['mtime']           = $p_header['mtime'];
        $p_info['comment']         = $p_header['comment'];
        $p_info['folder']          = (($p_header['external'] & 0x00000010) == 0x00000010);
        $p_info['index']           = $p_header['index'];
        $p_info['status']          = $p_header['status'];
        $p_info['crc']             = $p_header['crc'];
        
        return $v_result;
    }
    
    function privExtractByRule(&$p_file_list, $p_path, $p_remove_path, $p_remove_all_path, &$p_options)
    {
        $v_result = 1;
        
        $this->privDisableMagicQuotes();
        
        if (($p_path == "") || ((substr($p_path, 0, 1) != "/") && (substr($p_path, 0, 3) != "../") && (substr($p_path, 1, 2) != ":/")))
            $p_path = "./" . $p_path;
        
        if (($p_path != "./") && ($p_path != "/")) {
            while (substr($p_path, -1) == "/") {
                $p_path = substr($p_path, 0, strlen($p_path) - 1);
            }
        }
        
        if (($p_remove_path != "") && (substr($p_remove_path, -1) != '/')) {
            $p_remove_path .= '/';
        }
        $p_remove_path_size = strlen($p_remove_path);
        
        if (($v_result = $this->privOpenFd('rb')) != 1) {
            $this->privSwapBackMagicQuotes();
            return $v_result;
        }
        
        $v_central_dir = array();
        if (($v_result = $this->privReadEndCentralDir($v_central_dir)) != 1) {
            $this->privCloseFd();
            $this->privSwapBackMagicQuotes();
            
            
            return $v_result;
        }
        
        $v_pos_entry = $v_central_dir['offset'];
        
        $j_start = 0;
        for ($i = 0, $v_nb_extracted = 0; $i < $v_central_dir['entries']; $i++) {
            
            @rewind($this->zip_fd);
            if (@fseek($this->zip_fd, $v_pos_entry)) {
                $this->privCloseFd();
                $this->privSwapBackMagicQuotes();
                
                PclZip::privErrorLog(PCLZIP_ERR_INVALID_ARCHIVE_ZIP, 'Invalid archive size');
                
                return PclZip::errorCode();
            }
            
            $v_header = array();
            if (($v_result = $this->privReadCentralFileHeader($v_header)) != 1) {
                $this->privCloseFd();
                $this->privSwapBackMagicQuotes();
                
                return $v_result;
            }
            
            $v_header['index'] = $i;
            
            $v_pos_entry = ftell($this->zip_fd);
            
            $v_extract = false;
            
            if ((isset($p_options[PCLZIP_OPT_BY_NAME])) && ($p_options[PCLZIP_OPT_BY_NAME] != 0)) {
                
                for ($j = 0; ($j < sizeof($p_options[PCLZIP_OPT_BY_NAME])) && (!$v_extract); $j++) {
                    
                    if (substr($p_options[PCLZIP_OPT_BY_NAME][$j], -1) == "/") {
                        
                        if ((strlen($v_header['stored_filename']) > strlen($p_options[PCLZIP_OPT_BY_NAME][$j])) && (substr($v_header['stored_filename'], 0, strlen($p_options[PCLZIP_OPT_BY_NAME][$j])) == $p_options[PCLZIP_OPT_BY_NAME][$j])) {
                            $v_extract = true;
                        }
                    } elseif ($v_header['stored_filename'] == $p_options[PCLZIP_OPT_BY_NAME][$j]) {
                        $v_extract = true;
                    }
                }
            }
            
            
            else if ((isset($p_options[PCLZIP_OPT_BY_PREG])) && ($p_options[PCLZIP_OPT_BY_PREG] != "")) {
                
                if (preg_match($p_options[PCLZIP_OPT_BY_PREG], $v_header['stored_filename'])) {
                    $v_extract = true;
                }
            }
            
            else if ((isset($p_options[PCLZIP_OPT_BY_INDEX])) && ($p_options[PCLZIP_OPT_BY_INDEX] != 0)) {
                
                for ($j = $j_start; ($j < sizeof($p_options[PCLZIP_OPT_BY_INDEX])) && (!$v_extract); $j++) {
                    
                    if (($i >= $p_options[PCLZIP_OPT_BY_INDEX][$j]['start']) && ($i <= $p_options[PCLZIP_OPT_BY_INDEX][$j]['end'])) {
                        $v_extract = true;
                    }
                    if ($i >= $p_options[PCLZIP_OPT_BY_INDEX][$j]['end']) {
                        $j_start = $j + 1;
                    }
                    
                    if ($p_options[PCLZIP_OPT_BY_INDEX][$j]['start'] > $i) {
                        break;
                    }
                }
            }
            
            else {
                $v_extract = true;
            }
            
            if (($v_extract) && (($v_header['compression'] != 8) && ($v_header['compression'] != 0))) {
                $v_header['status'] = 'unsupported_compression';
                
                if ((isset($p_options[PCLZIP_OPT_STOP_ON_ERROR])) && ($p_options[PCLZIP_OPT_STOP_ON_ERROR] === true)) {
                    
                    $this->privSwapBackMagicQuotes();
                    
                    PclZip::privErrorLog(PCLZIP_ERR_UNSUPPORTED_COMPRESSION, "Filename '" . $v_header['stored_filename'] . "' is " . "compressed by an unsupported compression " . "method (" . $v_header['compression'] . ") ");
                    
                    return PclZip::errorCode();
                }
            }
            
            if (($v_extract) && (($v_header['flag'] & 1) == 1)) {
                $v_header['status'] = 'unsupported_encryption';
                
                if ((isset($p_options[PCLZIP_OPT_STOP_ON_ERROR])) && ($p_options[PCLZIP_OPT_STOP_ON_ERROR] === true)) {
                    
                    $this->privSwapBackMagicQuotes();
                    
                    PclZip::privErrorLog(PCLZIP_ERR_UNSUPPORTED_ENCRYPTION, "Unsupported encryption for " . " filename '" . $v_header['stored_filename'] . "'");
                    
                    return PclZip::errorCode();
                }
            }
            
            if (($v_extract) && ($v_header['status'] != 'ok')) {
                $v_result = $this->privConvertHeader2FileInfo($v_header, $p_file_list[$v_nb_extracted++]);
                if ($v_result != 1) {
                    $this->privCloseFd();
                    $this->privSwapBackMagicQuotes();
                    return $v_result;
                }
                
                $v_extract = false;
            }
            
            if ($v_extract) {
                
                @rewind($this->zip_fd);
                if (@fseek($this->zip_fd, $v_header['offset'])) {
                    $this->privCloseFd();
                    
                    $this->privSwapBackMagicQuotes();
                    
                    PclZip::privErrorLog(PCLZIP_ERR_INVALID_ARCHIVE_ZIP, 'Invalid archive size');
                    
                    return PclZip::errorCode();
                }
                
                if ($p_options[PCLZIP_OPT_EXTRACT_AS_STRING]) {
                    
                    $v_string = '';
                    
                    $v_result1 = $this->privExtractFileAsString($v_header, $v_string, $p_options);
                    if ($v_result1 < 1) {
                        $this->privCloseFd();
                        $this->privSwapBackMagicQuotes();
                        return $v_result1;
                    }
                    
                    if (($v_result = $this->privConvertHeader2FileInfo($v_header, $p_file_list[$v_nb_extracted])) != 1) {
                        $this->privCloseFd();
                        $this->privSwapBackMagicQuotes();
                        
                        return $v_result;
                    }
                    
                    $p_file_list[$v_nb_extracted]['content'] = $v_string;
                    
                    $v_nb_extracted++;
                    
                    if ($v_result1 == 2) {
                        break;
                    }
                } elseif ((isset($p_options[PCLZIP_OPT_EXTRACT_IN_OUTPUT])) && ($p_options[PCLZIP_OPT_EXTRACT_IN_OUTPUT])) {
                    $v_result1 = $this->privExtractFileInOutput($v_header, $p_options);
                    if ($v_result1 < 1) {
                        $this->privCloseFd();
                        $this->privSwapBackMagicQuotes();
                        return $v_result1;
                    }
                    
                    if (($v_result = $this->privConvertHeader2FileInfo($v_header, $p_file_list[$v_nb_extracted++])) != 1) {
                        $this->privCloseFd();
                        $this->privSwapBackMagicQuotes();
                        return $v_result;
                    }
                    
                    if ($v_result1 == 2) {
                        break;
                    }
                } else {
                    $v_result1 = $this->privExtractFile($v_header, $p_path, $p_remove_path, $p_remove_all_path, $p_options);
                    if ($v_result1 < 1) {
                        $this->privCloseFd();
                        $this->privSwapBackMagicQuotes();
                        return $v_result1;
                    }
                    
                    if (($v_result = $this->privConvertHeader2FileInfo($v_header, $p_file_list[$v_nb_extracted++])) != 1) {
                        $this->privCloseFd();
                        $this->privSwapBackMagicQuotes();
                        
                        return $v_result;
                    }
                    
                    if ($v_result1 == 2) {
                        break;
                    }
                }
            }
        }
        
        $this->privCloseFd();
        $this->privSwapBackMagicQuotes();
        
        return $v_result;
    }
    
    function privExtractFile(&$p_entry, $p_path, $p_remove_path, $p_remove_all_path, &$p_options)
    {
        $v_result = 1;
        
        if (($v_result = $this->privReadFileHeader($v_header)) != 1) {
            return $v_result;
        }
        
        
        if ($this->privCheckFileHeaders($v_header, $p_entry) != 1) {
        }
        
        if ($p_remove_all_path == true) {
            if (($p_entry['external'] & 0x00000010) == 0x00000010) {
                
                $p_entry['status'] = "filtered";
                
                return $v_result;
            }
            
            $p_entry['filename'] = basename($p_entry['filename']);
        }
        
        else if ($p_remove_path != "") {
            if (PclZipUtilPathInclusion($p_remove_path, $p_entry['filename']) == 2) {
                
                $p_entry['status'] = "filtered";
                
                return $v_result;
            }
            
            $p_remove_path_size = strlen($p_remove_path);
            if (substr($p_entry['filename'], 0, $p_remove_path_size) == $p_remove_path) {
                
                $p_entry['filename'] = substr($p_entry['filename'], $p_remove_path_size);
                
            }
        }
        
        if ($p_path != '') {
            $p_entry['filename'] = $p_path . "/" . $p_entry['filename'];
        }
        
        if (isset($p_options[PCLZIP_OPT_EXTRACT_DIR_RESTRICTION])) {
            $v_inclusion = PclZipUtilPathInclusion($p_options[PCLZIP_OPT_EXTRACT_DIR_RESTRICTION], $p_entry['filename']);
            if ($v_inclusion == 0) {
                
                PclZip::privErrorLog(PCLZIP_ERR_DIRECTORY_RESTRICTION, "Filename '" . $p_entry['filename'] . "' is " . "outside PCLZIP_OPT_EXTRACT_DIR_RESTRICTION");
                
                return PclZip::errorCode();
            }
        }
        
        if (isset($p_options[PCLZIP_CB_PRE_EXTRACT])) {
            
            $v_local_header = array();
            $this->privConvertHeader2FileInfo($p_entry, $v_local_header);
            
            $v_result = $p_options[PCLZIP_CB_PRE_EXTRACT](PCLZIP_CB_PRE_EXTRACT, $v_local_header);
            if ($v_result == 0) {
                $p_entry['status'] = "skipped";
                $v_result          = 1;
            }
            
            if ($v_result == 2) {
                $p_entry['status'] = "aborted";
                $v_result          = PCLZIP_ERR_USER_ABORTED;
            }
            
            $p_entry['filename'] = $v_local_header['filename'];
        }
        
        
        if ($p_entry['status'] == 'ok') {
            
            if (file_exists($p_entry['filename'])) {
                
                if (is_dir($p_entry['filename'])) {
                    
                    $p_entry['status'] = "already_a_directory";
                    
                    if ((isset($p_options[PCLZIP_OPT_STOP_ON_ERROR])) && ($p_options[PCLZIP_OPT_STOP_ON_ERROR] === true)) {
                        
                        PclZip::privErrorLog(PCLZIP_ERR_ALREADY_A_DIRECTORY, "Filename '" . $p_entry['filename'] . "' is " . "already used by an existing directory");
                        
                        return PclZip::errorCode();
                    }
                } else if (!is_writeable($p_entry['filename'])) {
                    
                    $p_entry['status'] = "write_protected";
                    
                    if ((isset($p_options[PCLZIP_OPT_STOP_ON_ERROR])) && ($p_options[PCLZIP_OPT_STOP_ON_ERROR] === true)) {
                        
                        PclZip::privErrorLog(PCLZIP_ERR_WRITE_OPEN_FAIL, "Filename '" . $p_entry['filename'] . "' exists " . "and is write protected");
                        
                        return PclZip::errorCode();
                    }
                }
                
                else if (filemtime($p_entry['filename']) > $p_entry['mtime']) {
                    if ((isset($p_options[PCLZIP_OPT_REPLACE_NEWER])) && ($p_options[PCLZIP_OPT_REPLACE_NEWER] === true)) {
                    } else {
                        $p_entry['status'] = "newer_exist";
                        
                        if ((isset($p_options[PCLZIP_OPT_STOP_ON_ERROR])) && ($p_options[PCLZIP_OPT_STOP_ON_ERROR] === true)) {
                            
                            PclZip::privErrorLog(PCLZIP_ERR_WRITE_OPEN_FAIL, "Newer version of '" . $p_entry['filename'] . "' exists " . "and option PCLZIP_OPT_REPLACE_NEWER is not selected");
                            
                            return PclZip::errorCode();
                        }
                    }
                } else {
                }
            }
            
            else {
                if ((($p_entry['external'] & 0x00000010) == 0x00000010) || (substr($p_entry['filename'], -1) == '/'))
                    $v_dir_to_check = $p_entry['filename'];
                else if (!strstr($p_entry['filename'], "/"))
                    $v_dir_to_check = "";
                else
                    $v_dir_to_check = dirname($p_entry['filename']);
                
                if (($v_result = $this->privDirCheck($v_dir_to_check, (($p_entry['external'] & 0x00000010) == 0x00000010))) != 1) {
                    
                    $p_entry['status'] = "path_creation_fail";
                    
                    $v_result = 1;
                }
            }
        }
        
        if ($p_entry['status'] == 'ok') {
            
            if (!(($p_entry['external'] & 0x00000010) == 0x00000010)) {
                if ($p_entry['compression'] == 0) {
                    
                    if (($v_dest_file = @fopen($p_entry['filename'], 'wb')) == 0) {
                        
                        $p_entry['status'] = "write_error";
                        
                        return $v_result;
                    }
                    
                    
                    $v_size = $p_entry['compressed_size'];
                    while ($v_size != 0) {
                        $v_read_size = ($v_size < PCLZIP_READ_BLOCK_SIZE ? $v_size : PCLZIP_READ_BLOCK_SIZE);
                        $v_buffer    = @fread($this->zip_fd, $v_read_size);
                        @fwrite($v_dest_file, $v_buffer, $v_read_size);
                        $v_size -= $v_read_size;
                    }
                    
                    fclose($v_dest_file);
                    
                    touch($p_entry['filename'], $p_entry['mtime']);
                    
                    
                } else {
                    if (($p_entry['flag'] & 1) == 1) {
                        PclZip::privErrorLog(PCLZIP_ERR_UNSUPPORTED_ENCRYPTION, 'File \'' . $p_entry['filename'] . '\' is encrypted. Encrypted files are not supported.');
                        return PclZip::errorCode();
                    }
                    
                    
                    if ((!isset($p_options[PCLZIP_OPT_TEMP_FILE_OFF])) && (isset($p_options[PCLZIP_OPT_TEMP_FILE_ON]) || (isset($p_options[PCLZIP_OPT_TEMP_FILE_THRESHOLD]) && ($p_options[PCLZIP_OPT_TEMP_FILE_THRESHOLD] <= $p_entry['size'])))) {
                        $v_result = $this->privExtractFileUsingTempFile($p_entry, $p_options);
                        if ($v_result < PCLZIP_ERR_NO_ERROR) {
                            return $v_result;
                        }
                    }
                    
                    else {
                        
                        
                        $v_buffer = @fread($this->zip_fd, $p_entry['compressed_size']);
                        
                        $v_file_content = @gzinflate($v_buffer);
                        unset($v_buffer);
                        if ($v_file_content === FALSE) {
                            
                            $p_entry['status'] = "error";
                            
                            return $v_result;
                        }
                        
                        if (($v_dest_file = @fopen($p_entry['filename'], 'wb')) == 0) {
                            
                            $p_entry['status'] = "write_error";
                            
                            return $v_result;
                        }
                        
                        @fwrite($v_dest_file, $v_file_content, $p_entry['size']);
                        unset($v_file_content);
                        
                        @fclose($v_dest_file);
                        
                    }
                    
                    @touch($p_entry['filename'], $p_entry['mtime']);
                }
                
                if (isset($p_options[PCLZIP_OPT_SET_CHMOD])) {
                    
                    @chmod($p_entry['filename'], $p_options[PCLZIP_OPT_SET_CHMOD]);
                }
                
            }
        }
        
        if ($p_entry['status'] == "aborted") {
            $p_entry['status'] = "skipped";
        }
        
        elseif (isset($p_options[PCLZIP_CB_POST_EXTRACT])) {
            
            $v_local_header = array();
            $this->privConvertHeader2FileInfo($p_entry, $v_local_header);
            
            $v_result = $p_options[PCLZIP_CB_POST_EXTRACT](PCLZIP_CB_POST_EXTRACT, $v_local_header);
            
            if ($v_result == 2) {
                $v_result = PCLZIP_ERR_USER_ABORTED;
            }
        }
        
        return $v_result;
    }
    
    
    
    function privReadFileHeader(&$p_header)
    {
        $v_result = 1;
        
        $v_binary_data = @fread($this->zip_fd, 4);
        $v_data        = unpack('Vid', $v_binary_data);
        
        if ($v_data['id'] != 0x04034b50) {
            
            PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, 'Invalid archive structure');
            
            return PclZip::errorCode();
        }
        
        $v_binary_data = fread($this->zip_fd, 26);
        
        if (strlen($v_binary_data) != 26) {
            $p_header['filename'] = "";
            $p_header['status']   = "invalid_header";
            
            PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, "Invalid block size : " . strlen($v_binary_data));
            
            return PclZip::errorCode();
        }
        
        $v_data = unpack('vversion/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len', $v_binary_data);
        
        $p_header['filename'] = fread($this->zip_fd, $v_data['filename_len']);
        
        if ($v_data['extra_len'] != 0) {
            $p_header['extra'] = fread($this->zip_fd, $v_data['extra_len']);
        } else {
            $p_header['extra'] = '';
        }
        
        $p_header['version_extracted'] = $v_data['version'];
        $p_header['compression']       = $v_data['compression'];
        $p_header['size']              = $v_data['size'];
        $p_header['compressed_size']   = $v_data['compressed_size'];
        $p_header['crc']               = $v_data['crc'];
        $p_header['flag']              = $v_data['flag'];
        $p_header['filename_len']      = $v_data['filename_len'];
        
        $p_header['mdate'] = $v_data['mdate'];
        $p_header['mtime'] = $v_data['mtime'];
        if ($p_header['mdate'] && $p_header['mtime']) {
            $v_hour    = ($p_header['mtime'] & 0xF800) >> 11;
            $v_minute  = ($p_header['mtime'] & 0x07E0) >> 5;
            $v_seconde = ($p_header['mtime'] & 0x001F) * 2;
            
            $v_year  = (($p_header['mdate'] & 0xFE00) >> 9) + 1980;
            $v_month = ($p_header['mdate'] & 0x01E0) >> 5;
            $v_day   = $p_header['mdate'] & 0x001F;
            
            $p_header['mtime'] = @mktime($v_hour, $v_minute, $v_seconde, $v_month, $v_day, $v_year);
            
        } else {
            $p_header['mtime'] = time();
        }
        
        
        $p_header['stored_filename'] = $p_header['filename'];
        
        $p_header['status'] = "ok";
        
        return $v_result;
    }
    
    function privReadCentralFileHeader(&$p_header)
    {
        $v_result = 1;
        
        $v_binary_data = @fread($this->zip_fd, 4);
        $v_data        = unpack('Vid', $v_binary_data);
        
        if ($v_data['id'] != 0x02014b50) {
            
            PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, 'Invalid archive structure');
            
            return PclZip::errorCode();
        }
        
        $v_binary_data = fread($this->zip_fd, 42);
        
        if (strlen($v_binary_data) != 42) {
            $p_header['filename'] = "";
            $p_header['status']   = "invalid_header";
            
            PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, "Invalid block size : " . strlen($v_binary_data));
            
            return PclZip::errorCode();
        }
        
        $p_header = unpack('vversion/vversion_extracted/vflag/vcompression/vmtime/vmdate/Vcrc/Vcompressed_size/Vsize/vfilename_len/vextra_len/vcomment_len/vdisk/vinternal/Vexternal/Voffset', $v_binary_data);
        
        if ($p_header['filename_len'] != 0)
            $p_header['filename'] = fread($this->zip_fd, $p_header['filename_len']);
        else
            $p_header['filename'] = '';
        
        if ($p_header['extra_len'] != 0)
            $p_header['extra'] = fread($this->zip_fd, $p_header['extra_len']);
        else
            $p_header['extra'] = '';
        
        if ($p_header['comment_len'] != 0)
            $p_header['comment'] = fread($this->zip_fd, $p_header['comment_len']);
        else
            $p_header['comment'] = '';
        
        
        if (1) {
            $v_hour    = ($p_header['mtime'] & 0xF800) >> 11;
            $v_minute  = ($p_header['mtime'] & 0x07E0) >> 5;
            $v_seconde = ($p_header['mtime'] & 0x001F) * 2;
            
            $v_year  = (($p_header['mdate'] & 0xFE00) >> 9) + 1980;
            $v_month = ($p_header['mdate'] & 0x01E0) >> 5;
            $v_day   = $p_header['mdate'] & 0x001F;
            
            $p_header['mtime'] = @mktime($v_hour, $v_minute, $v_seconde, $v_month, $v_day, $v_year);
            
        } else {
            $p_header['mtime'] = time();
        }
        
        $p_header['stored_filename'] = $p_header['filename'];
        
        $p_header['status'] = 'ok';
        
        if (substr($p_header['filename'], -1) == '/') {
            $p_header['external'] = 0x00000010;
        }
        
        
        return $v_result;
    }
    
    function privCheckFileHeaders(&$p_local_header, &$p_central_header)
    {
        $v_result = 1;
        
        if ($p_local_header['filename'] != $p_central_header['filename']) {
        }
        if ($p_local_header['version_extracted'] != $p_central_header['version_extracted']) {
        }
        if ($p_local_header['flag'] != $p_central_header['flag']) {
        }
        if ($p_local_header['compression'] != $p_central_header['compression']) {
        }
        if ($p_local_header['mtime'] != $p_central_header['mtime']) {
        }
        if ($p_local_header['filename_len'] != $p_central_header['filename_len']) {
        }
        
        if (($p_local_header['flag'] & 8) == 8) {
            $p_local_header['size']            = $p_central_header['size'];
            $p_local_header['compressed_size'] = $p_central_header['compressed_size'];
            $p_local_header['crc']             = $p_central_header['crc'];
        }
        
        return $v_result;
    }
    
    function privReadEndCentralDir(&$p_central_dir)
    {
        $v_result = 1;
        
        $v_size = filesize($this->zipname);
        @fseek($this->zip_fd, $v_size);
        if (@ftell($this->zip_fd) != $v_size) {
            PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, 'Unable to go to the end of the archive \'' . $this->zipname . '\'');
            
            return PclZip::errorCode();
        }

        $v_found = 0;
        if ($v_size > 26) {
            @fseek($this->zip_fd, $v_size - 22);
            if (($v_pos = @ftell($this->zip_fd)) != ($v_size - 22)) {
                PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, 'Unable to seek back to the middle of the archive \'' . $this->zipname . '\'');
                
                return PclZip::errorCode();
            }
            
            $v_binary_data = @fread($this->zip_fd, 4);
            $v_data        = @unpack('Vid', $v_binary_data);
            
            if ($v_data['id'] == 0x06054b50) {
                $v_found = 1;
            }
            
            $v_pos = ftell($this->zip_fd);
        }
        
        if (!$v_found) {
            $v_maximum_size = 65557;
            if ($v_maximum_size > $v_size)
                $v_maximum_size = $v_size;
            @fseek($this->zip_fd, $v_size - $v_maximum_size);
            if (@ftell($this->zip_fd) != ($v_size - $v_maximum_size)) {
                PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, 'Unable to seek back to the middle of the archive \'' . $this->zipname . '\'');
                
                return PclZip::errorCode();
            }
            
            $v_pos   = ftell($this->zip_fd);

            $v_bytes = 0x00000000;
            while ($v_pos < $v_size) {
                $v_byte = @fread($this->zip_fd, 1);
                
                $v_bytes = (($v_bytes & 0xFFFFFF) << 8) | Ord($v_byte);
                
                if ($v_bytes == 0x504b0506) {
                    $v_pos++;
                    break;
                }
                
                $v_pos++;
            }
            
            if ($v_pos == $v_size) {
                
                PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, "Unable to find End of Central Dir Record signature");
                return PclZip::errorCode();
            }
        }
        
        $v_binary_data = fread($this->zip_fd, 18);
        
        if (strlen($v_binary_data) != 18) {
            
            PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, "Invalid End of Central Dir Record size : " . strlen($v_binary_data));
            
            return PclZip::errorCode();
        }
        
        $v_data = unpack('vdisk/vdisk_start/vdisk_entries/ventries/Vsize/Voffset/vcomment_size', $v_binary_data);
        
        if (($v_pos + $v_data['comment_size'] + 18) != $v_size) {
            
            if (0) {
                PclZip::privErrorLog(PCLZIP_ERR_BAD_FORMAT, 'The central dir is not at the end of the archive.' . ' Some trailing bytes exists after the archive.');
                
                return PclZip::errorCode();
            }
        }
        
        if ($v_data['comment_size'] != 0) {
            $p_central_dir['comment'] = fread($this->zip_fd, $v_data['comment_size']);
        } else
            $p_central_dir['comment'] = '';
        
        $p_central_dir['entries']      = $v_data['entries'];
        $p_central_dir['disk_entries'] = $v_data['disk_entries'];
        $p_central_dir['offset']       = $v_data['offset'];
        $p_central_dir['size']         = $v_data['size'];
        $p_central_dir['disk']         = $v_data['disk'];
        $p_central_dir['disk_start']   = $v_data['disk_start'];
        
        
        return $v_result;
    }
    
    
    
    function privDirCheck($p_dir, $p_is_dir = false)
    {
        $v_result = 1;
        
        
        if (($p_is_dir) && (substr($p_dir, -1) == '/')) {
            $p_dir = substr($p_dir, 0, strlen($p_dir) - 1);
        }
        
        if ((is_dir($p_dir)) || ($p_dir == "")) {
            return 1;
        }
        
        $p_parent_dir = dirname($p_dir);
        
        if ($p_parent_dir != $p_dir) {
            if ($p_parent_dir != "") {
                if (($v_result = $this->privDirCheck($p_parent_dir)) != 1) {
                    return $v_result;
                }
            }
        }
        
        if (!@mkdir($p_dir, 0777)) {
            PclZip::privErrorLog(PCLZIP_ERR_DIR_CREATE_FAIL, "Unable to create directory '$p_dir'");
            
            return PclZip::errorCode();
        }
        
        return $v_result;
    }
    

    function privErrorLog($p_error_code=0, $p_error_string='')
    {
        if (PCLZIP_ERROR_EXTERNAL == 1) {
            PclError($p_error_code, $p_error_string);
        } else {
            $this->error_code = $p_error_code;
            $this->error_string = $p_error_string;
        }
    }
    
    
    function privErrorReset()
    {
        if (PCLZIP_ERROR_EXTERNAL == 1) {
            PclErrorReset();
        } else {
            $this->error_code   = 0;
            $this->error_string = '';
        }
    }
    
    function privDisableMagicQuotes()
    {
        $v_result = 1;
        
        if ((!function_exists("get_magic_quotes_runtime")) || (!function_exists("set_magic_quotes_runtime"))) {
            return $v_result;
        }
        
        if ($this->magic_quotes_status != -1) {
            return $v_result;
        }
        
        $this->magic_quotes_status = @get_magic_quotes_runtime();
        
        if ($this->magic_quotes_status == 1) {
            @set_magic_quotes_runtime(0);
        }
        
        return $v_result;
    }
    
    function privSwapBackMagicQuotes()
    {
        $v_result = 1;
        
        if ((!function_exists("get_magic_quotes_runtime")) || (!function_exists("set_magic_quotes_runtime"))) {
            return $v_result;
        }
        
        if ($this->magic_quotes_status != -1) {
            return $v_result;
        }
        
        if ($this->magic_quotes_status == 1) {
            @set_magic_quotes_runtime($this->magic_quotes_status);
        }
        
        return $v_result;
    }
    
}

function PclZipUtilPathReduction($p_dir)
{
    $v_result = "";
    
    if ($p_dir != "") {
        $v_list = explode("/", $p_dir);
        
        $v_skip = 0;
        for ($i = sizeof($v_list) - 1; $i >= 0; $i--) {
            if ($v_list[$i] == ".") {
            } else if ($v_list[$i] == "..") {
                $v_skip++;
            } else if ($v_list[$i] == "") {
                if ($i == 0) {
                    $v_result = "/" . $v_result;
                    if ($v_skip > 0) {
                        $v_result = $p_dir;
                        $v_skip   = 0;
                    }
                } else if ($i == (sizeof($v_list) - 1)) {
                    $v_result = $v_list[$i];
                } else {
                }
            } else {
                if ($v_skip > 0) {
                    $v_skip--;
                } else {
                    $v_result = $v_list[$i] . ($i != (sizeof($v_list) - 1) ? "/" . $v_result : "");
                }
            }
        }
        
        if ($v_skip > 0) {
            while ($v_skip > 0) {
                $v_result = '../' . $v_result;
                $v_skip--;
            }
        }
    }
    
    return $v_result;
}

function PclZipUtilPathInclusion($p_dir, $p_path)
{
    $v_result = 1;
    
    if (($p_dir == '.') || ((strlen($p_dir) >= 2) && (substr($p_dir, 0, 2) == './'))) {
        $p_dir = PclZipUtilTranslateWinPath(getcwd(), FALSE) . '/' . substr($p_dir, 1);
    }
    if (($p_path == '.') || ((strlen($p_path) >= 2) && (substr($p_path, 0, 2) == './'))) {
        $p_path = PclZipUtilTranslateWinPath(getcwd(), FALSE) . '/' . substr($p_path, 1);
    }
    
    $v_list_dir       = explode("/", $p_dir);
    $v_list_dir_size  = sizeof($v_list_dir);
    $v_list_path      = explode("/", $p_path);
    $v_list_path_size = sizeof($v_list_path);
    
    $i = 0;
    $j = 0;
    while (($i < $v_list_dir_size) && ($j < $v_list_path_size) && ($v_result)) {
        
        if ($v_list_dir[$i] == '') {
            $i++;
            continue;
        }
        if ($v_list_path[$j] == '') {
            $j++;
            continue;
        }
        
        if (($v_list_dir[$i] != $v_list_path[$j]) && ($v_list_dir[$i] != '') && ($v_list_path[$j] != '')) {
            $v_result = 0;
        }
        
        $i++;
        $j++;
    }
    
    if ($v_result) {
        while (($j < $v_list_path_size) && ($v_list_path[$j] == ''))
            $j++;
        while (($i < $v_list_dir_size) && ($v_list_dir[$i] == ''))
            $i++;
        
        if (($i >= $v_list_dir_size) && ($j >= $v_list_path_size)) {
            $v_result = 2;
        } else if ($i < $v_list_dir_size) {
            $v_result = 0;
        }
    }
    
    return $v_result;
}



function PclZipUtilTranslateWinPath($p_path, $p_remove_disk_letter = true)
{
    if (stristr(php_uname(), 'windows')) {
        if (($p_remove_disk_letter) && (($v_position = strpos($p_path, ':')) != false)) {
            $p_path = substr($p_path, $v_position + 1);
        }
        if ((strpos($p_path, '\\') > 0) || (substr($p_path, 0, 1) == '\\')) {
            $p_path = strtr($p_path, '\\', '/');
        }
    }
    return $p_path;
}


?>

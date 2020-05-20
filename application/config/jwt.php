<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

$config['jwt_key'] = 'ingDLMRuGe9UKHRNjs7cYckS2yul4lc3';

/*Generated token will expire in 1 minute for sample code
* Increase this value as per requirement for production
*/
// $config['token_timeout'] = 1 * 60 * 24; // on minutes
$config['token_timeout'] = 1 * 60 * 3; // on minutes

/* End of file jwt.php */
/* Location: ./application/config/jwt.php */

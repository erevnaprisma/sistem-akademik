<?php

defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', true);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE') or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE') or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE') or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ') or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE') or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE') or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE') or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE') or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT') or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT') or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS') or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR') or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG') or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE') or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS') or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT') or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE') or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN') or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX') or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code


defined('PAGING') or define('PAGING', 10);


defined('SET_VERSION_MOBILE')         OR define('SET_VERSION_MOBILE', 'edu-v0.0.17.apk');

defined('SET_PUBLIC_ATTACH')         OR define('PUBLIC_ATTACH', FCPATH.'assets/public/attach/');
defined('PATH_PUBLIC_ATTACH')        OR define('PATH_PUBLIC_ATTACH', 'assets/public/attach/');

defined('SET_PUBLIC_IMAGE')         OR define('PUBLIC_IMAGE', FCPATH.'assets/public/img/');
defined('PATH_PUBLIC_IMAGE')        OR define('PATH_PUBLIC_IMAGE', 'assets/public/img/');

defined('STATUS_IS_NO_ACTIVE') or define('STATUS_IS_NO_ACTIVE', 0);
defined('STATUS_IS_ACTIVE') or define('STATUS_IS_ACTIVE', 1);
defined('STATUS_IS_DELETE') or define('STATUS_IS_DELETE', 9);

defined('USER_TYPE_SUPERADMIN') or define('USER_TYPE_SUPERADMIN', 1);
defined('USER_TYPE_ADMINISTRATOR') or define('USER_TYPE_ADMINISTRATOR', 2);
defined('USER_TYPE_GURU') or define('USER_TYPE_GURU', 3);
defined('USER_TYPE_SISWA') or define('USER_TYPE_SISWA', 4);
defined('USER_TYPE_ADMINSEKOLAH') or define('USER_TYPE_ADMINSEKOLAH', 5);
defined('USER_TYPE_PEDAGANG') or define('USER_TYPE_PEDAGANG', 6);



defined('INFO_SEKOLAH_GURU') or define('INFO_SEKOLAH_GURU', 0);
defined('INFO_SEKOLAH_SISWA') or define('INFO_SEKOLAH_SISWA', 1);

defined('DOKUMEN_DOK') or define('DOKUMEN_DOK', 0);
defined('DOKUMEN_IMG') or define('DOKUMEN_IMG', 1);
defined('DOKUMEN_VID') or define('DOKUMEN_VID', 2);
defined('DOKUMEN_KOMEN') or define('DOKUMEN_KOMEN', 7);

defined('CODE_KAS') or define('CODE_KAS', 1);
defined('CODE_KREDIT') or define('CODE_KREDIT', 2);
defined('CODE_DEBET') or define('CODE_DEBET', 3);

defined('GL_KAS') or define('GL_KAS', 1);
defined('GL_MASUK') or define('GL_MASUK', 2);
defined('GL_KELUAR') or define('GL_KELUAR', 3);


defined('JNS_TRANS_SPP') or define('JNS_TRANS_SPP', 3);

defined('TRANS_DEBET') or define('TRANS_DEBET', 0);
defined('TRANS_KREDIT') or define('TRANS_KREDIT', 1);

defined('FORUM_ORANGTUA') or define('FORUM_ORANGTUA', 1);
defined('FORUM_LABEL_ORANGTUA') or define('FORUM_LABEL_ORANGTUA', 'orangtua');
defined('FORUM_SISWA') or define('FORUM_SISWA', 2);
defined('FORUM_LABEL_SISWA') or define('FORUM_LABEL_SISWA', 'siswa');
defined('FORUM_GURU') or define('FORUM_GURU', 3);
defined('FORUM_LABEL_GURU') or define('FORUM_LABEL_GURU', 'guru');



defined('PUSH_NOTIFICATIONS_EXPO')        OR define('PUSH_NOTIFICATIONS_EXPO', 'https://exp.host/--/api/v2/push/send');

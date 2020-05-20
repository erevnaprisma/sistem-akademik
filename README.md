# CodeIgniter-JWT-Sample

Simple Codeigniter, REST Server, JWT implementation.

**Update**

As per multiple requests, I am adding logic for timeout.  
Please check ```application\controllers\Authtimeout.php``` for more details.

**Note:** I did not add logic for expired token replacement after timeout.


Setup using this repo
=====


Set up project on php server (XAMPP/Linux). 

* **.htaccess** file at project root

    This project contains .htaccess file for windows machine. Please update this file as per your requirements.  
[Sample htaccess code (Win/Linux)] (http://stackoverflow.com/questions/28525870/removing-index-php-from-url-in-codeigniter-on-mandriva)  
* `encryption_key` in `application\config\config.php`  
[Encryption key generator] (http://jeffreybarke.net/tools/codeigniter-encryption-key-generator/)  
```
$config['encryption_key'] = '';
```  

* `jwt_key` in `application\config\constants.php`

```
$config['jwt_key']	= '';
```

* **For Timeout** `token_timeout` in `application\config\constants.php`

```
$config['token_timeout']	= ;
```


Setup for existing projects
=====


You will need following files:

**/application/config/jwt.php** <= Add **jwt_key** here
**/application/helpers/authorization_helper.php
/application/helpers/jwt_helper.php**

In **/application/config/autoload.php** add 
```
$autoload['helper'] = array('url', 'form', 'jwt', "authorization");
$autoload['config'] = array('jwt');
```

That's it. You are ready. Add your logic to generate token, eg.

```
$tokenData = array();
$tokenData['id'] = 1; //TODO: Replace with data for token
$output['token'] = AUTHORIZATION::generateToken($tokenData);
```

Please reply, if you need additional details. Happy coding!


Run
=====

GET auth token

    URL: http://host/CodeIgniter-JWT-Sample/auth/token
    Method: GET

Check decoded token

    URL: http://host/CodeIgniter-JWT-Sample/auth/token
    Method: POST
    Header Key: Authorization
    Value: Auth token generated in GET call
    
GET auth token with **timeout**

    URL: http://host/CodeIgniter-JWT-Sample/authtimeout/token
    Method: GET

Check decoded token with **timeout**

    URL: http://host/CodeIgniter-JWT-Sample/authtimeout/token
    Method: POST
    Header Key: Authorization
    Value: Auth token generated in GET call of authtimeout controller

Project uses 
=======
[CodeIgniter] (https://www.codeigniter.com/)  
[REST Server] (https://github.com/chriskacerguis/codeigniter-restserver)  
[Reference for JWT implementation] (https://github.com/rmcdaniel/angular-codeigniter-seed)

Contact
=====
For any questions mail me paritoshvaidya@gmail.com
  
  
[![GitHub license](https://img.shields.io/badge/license-MIT-blue.svg?style=flat-square)](https://github.com/ParitoshVaidya/CodeIgniter-JWT-Sample/blob/master/license.txt)






ALTER TABLE `app_penilaian` ADD `tingkat` INT NOT NULL AFTER `id_skl`, ADD `id_jurusan` INT NOT NULL AFTER `tingkat`, ADD `id_tipe` INT NOT NULL AFTER `id_jurusan`, ADD `id_mapel` INT NOT NULL AFTER `id_tipe`, ADD `kode_ujian` VARCHAR(20) NOT NULL AFTER `id_mapel`, ADD `tanggal` DATE NOT NULL AFTER `kode_ujian`, ADD `id_rpp` INT NOT NULL AFTER `tanggal`, ADD `materi` VARCHAR(100) NOT NULL AFTER `id_rpp`;

ALTER TABLE `app_nilai_siswa` ADD `sms` TINYINT(1) NOT NULL AFTER `updated_dt`, ADD `id_user` INT NOT NULL AFTER `sms`, ADD `nilai` DECIMAL(2,2) NOT NULL AFTER `id_user`;

ALTER TABLE `app_nilai_siswa` CHANGE `nilai` `nilai` DECIMAL(3,2) NOT NULL;

ALTER TABLE `app_kkm` ADD `id_jurusan` INT NOT NULL AFTER `updated_dt`;

ALTER TABLE `app_kkm` ADD `id_semester` INT NOT NULL AFTER `id_jurusan`;

ALTER TABLE `app_kel_mapel` ADD `id_jurusan` INT NOT NULL AFTER `updated_dt`;

ALTER TABLE `app_kel_mapel` ADD `id_semester` INT NOT NULL AFTER `id_jurusan`;
ALTER TABLE `app_kel_mapel` ADD `id_kls` INT NOT NULL AFTER `id_semester`;
ALTER TABLE `app_kel_mapel` ADD `id_tahun_ajaran` INT NOT NULL AFTER `id_kls`;
ALTER TABLE `app_skl` ADD `alamat` TEXT NOT NULL AFTER `slug`;

CREATE TABLE `app_raport` (
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `id_kenaikan_kelas` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  `is_active` int(1) NOT NULL DEFAULT '1',
  `created_by` int(11) NOT NULL,
  `created_dt` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_dt` datetime DEFAULT NULL,
  `id_user` int(11) NOT NULL,
  `nilai` decimal(3,0) NOT NULL
)

ALTER TABLE `app_raport` ADD `id_mapel` INT NOT NULL AFTER `nilai`;



https://expo.io/builds/5200431a-36df-4efa-886a-8c00ff13b4d6
-- Adminer 4.2.4 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

INSERT INTO `users` (`id`, `email`, `email_canonical`, `username`, `username_canonical`, `firstname`, `lastname`, `locale`, `timezone`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `jwt_verifier`, `locked`, `expired`, `expires_at`, `roles`, `credentials_expired`, `credentials_expire_at`, `two_step_verification_code`, `facebook_uid`, `facebook_name`, `facebook_data`, `twitter_uid`, `twitter_name`, `twitter_data`, `gplus_uid`, `gplus_name`, `gplus_data`, `token`, `avatar`) VALUES
(1,	'668c9f3be283ccf4fc8d95d4eb8dc33bae524e1674fbdb12f8a2654720dde39db4f4b00b7179ffa497dc7d2a79243e4c',	'4dda578a381454f1ec8f141d0eca278523507b3e3cf10718802959cb9ec13e7f',	'VRinstallationsharepageSuperAdmin',	'vrinstallationsharepagesuperadmin',	NULL,	NULL,	NULL,	NULL,	1,	'mjfiwgkyisgg44w0ccc0s04kwsw8w8k',	'$2y$13$mjfiwgkyisgg44w0ccc0sunulhXIKTGDZmf93AWb8pz4vkgxAT/F.',	NULL,	NULL,	NULL,	NULL,	0,	0,	NULL,	'a:2:{i:0;s:16:\"ROLE_SUPER_ADMIN\";i:1;s:17:\"ROLE_SONATA_ADMIN\";}',	0,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'75346851861f12d36864dd4a6faa573ec1366168',	NULL),
(2,	'aab134289d093da313262f18e85789da504ae47436b563f6347ffc4fbdf9b8214db947e9b09eb4b8dab39fb638135235',	'7ae0faad09cefb52b010f9f2d5a6ef929cfc471e3b9701bd8060a30e7adfffa7',	'VRinstallationsharepageAdmin',	'vrinstallationsharepageadmin',	NULL,	NULL,	NULL,	NULL,	1,	'js8mgp01j34kg0088okwscksgk8kg8k',	'$2y$13$js8mgp01j34kg0088okwsOq6XGTx9Yb4sy2RmGVwX9f81xV4xT7eC',	NULL,	NULL,	NULL,	NULL,	0,	0,	NULL,	'a:2:{i:0;s:10:\"ROLE_ADMIN\";i:1;s:17:\"ROLE_SONATA_ADMIN\";}',	0,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	'337c3e19648aae9ba10f7b5a24b1236979203223',	NULL);

-- 2016-09-02 10:29:26
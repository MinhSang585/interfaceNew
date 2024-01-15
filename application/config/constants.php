<?php
defined('BASEPATH') OR exit('No direct script access allowed');

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
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

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
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

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
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

/*
|--------------------------------------------------------------------------
| System Language Codes
|--------------------------------------------------------------------------
|
| These code are used when working with system.
|
*/
defined('SYSTEM_LANG_EN')		OR define('SYSTEM_LANG_EN', 'en');
defined('SYSTEM_LANG_CHS') 		OR define('SYSTEM_LANG_CHS', 'chs');
defined('SYSTEM_LANG_CHT')  	OR define('SYSTEM_LANG_CHT', 'cht');
defined('SYSTEM_LANG_ID')  		OR define('SYSTEM_LANG_ID', 'id');
defined('SYSTEM_LANG_TH')  		OR define('SYSTEM_LANG_TH', 'th');
defined('SYSTEM_LANG_VI') 		OR define('SYSTEM_LANG_VI', 'vi');
defined('SYSTEM_LANG_KM')   	OR define('SYSTEM_LANG_KM', 'km');
defined('SYSTEM_LANG_MY')  		OR define('SYSTEM_LANG_MY', 'my');
defined('SYSTEM_LANG_MS')  		OR define('SYSTEM_LANG_MS', 'ms');
defined('SYSTEM_LANG_JA')  		OR define('SYSTEM_LANG_JA', 'ja');
defined('SYSTEM_LANG_KO')  		OR define('SYSTEM_LANG_KO', 'ko');
defined('SYSTEM_LANG_BN')  		OR define('SYSTEM_LANG_BN', 'bn');
defined('SYSTEM_LANG_HI')  		OR define('SYSTEM_LANG_HI', 'hi');
defined('SYSTEM_LANG_LO')  		OR define('SYSTEM_LANG_LO', 'lo');
defined('SYSTEM_LANG_TR')  		OR define('SYSTEM_LANG_TR', 'tr');

/*
|--------------------------------------------------------------------------
| Language Codes
|--------------------------------------------------------------------------
|
| These code are used when working with announcement and group.
|
*/
defined('LANG_EN')		OR define('LANG_EN', 1);
defined('LANG_ZH_CN') 	OR define('LANG_ZH_CN', 2);
defined('LANG_ZH_HK')  	OR define('LANG_ZH_HK', 3);
defined('LANG_ZH_TW')  	OR define('LANG_ZH_TW', 4);
defined('LANG_ID')  	OR define('LANG_ID', 5);
defined('LANG_TH')  	OR define('LANG_TH', 6);
defined('LANG_VI') 		OR define('LANG_VI', 7);
defined('LANG_KM')   	OR define('LANG_KM', 8);
defined('LANG_MY')  	OR define('LANG_MY', 9);
defined('LANG_MS')  	OR define('LANG_MS', 10);
defined('LANG_JA')  	OR define('LANG_JA', 11);
defined('LANG_KO')  	OR define('LANG_KO', 12);
defined('LANG_BN')  	OR define('LANG_BN', 13);
defined('LANG_HI')  	OR define('LANG_HI', 14);
defined('LANG_LO')  	OR define('LANG_LO', 15);
defined('LANG_TR')  	OR define('LANG_TR', 16);

/*
|--------------------------------------------------------------------------
| Status Codes
|--------------------------------------------------------------------------
|
| These code are used when working with whole system.
|
*/
defined('STATUS_UNSUSPEND')			OR define('STATUS_UNSUSPEND', 1);
defined('STATUS_INACTIVE')			OR define('STATUS_INACTIVE', 0);
defined('STATUS_ACTIVE')			OR define('STATUS_ACTIVE', 1);
defined('STATUS_SUSPEND')			OR define('STATUS_SUSPEND', 2);
defined('STATUS_PENDING')			OR define('STATUS_PENDING', 0);
defined('STATUS_APPROVE')			OR define('STATUS_APPROVE', 1);
defined('STATUS_ON_HOLD_PENDING')	OR define('STATUS_ON_HOLD_PENDING', 3);
defined('STATUS_COMPLETE')			OR define('STATUS_COMPLETE', 1);
defined('STATUS_CANCEL')			OR define('STATUS_CANCEL', 2);
defined('STATUS_NO')				OR define('STATUS_NO', 0);
defined('STATUS_YES')				OR define('STATUS_YES', 1);
defined('STATUS_FAIL')				OR define('STATUS_FAIL', 0);
defined('STATUS_SUCCESS')			OR define('STATUS_SUCCESS', 1);
defined('STATUS_LOGOUT')			OR define('STATUS_LOGOUT', 0);
defined('STATUS_LOGIN')				OR define('STATUS_LOGIN', 1);
defined('STATUS_DOUBLE_LOGIN')		OR define('STATUS_DOUBLE_LOGIN', 2);
defined('STATUS_ALL')				OR define('STATUS_ALL', 0);
defined('STATUS_ALLOW')				OR define('STATUS_ALLOW', 0);
defined('STATUS_UNVERIFY')			OR define('STATUS_UNVERIFY', 0);
defined('STATUS_VERIFY')			OR define('STATUS_VERIFY', 1);
defined('STATUS_ON_PENDING')		OR define('STATUS_ON_PENDING', 3);
defined('STATUS_SATTLEMENT')		OR define('STATUS_SATTLEMENT', 1);
defined('STATUS_ENTITLEMENT')		OR define('STATUS_ENTITLEMENT', 3);
defined('STATUS_VOID')				OR define('STATUS_VOID', 4);
defined('STATUS_ACCOMPLISH')		OR define('STATUS_ACCOMPLISH', 5);
defined('STATUS_SYSTEM_CANCEL')		OR define('STATUS_SYSTEM_CANCEL', 888);




/*
|--------------------------------------------------------------------------
| Gender Codes
|--------------------------------------------------------------------------
|
| These code are used when working with player.
|
*/
defined('GENDER_MALE')		OR define('GENDER_MALE', 1);
defined('GENDER_FEMALE')	OR define('GENDER_FEMALE', 2);

/*
|--------------------------------------------------------------------------
| Group Type Codes
|--------------------------------------------------------------------------
|
| These code are used when working with bank account and player.
|
*/
defined('GROUP_BANK')		OR define('GROUP_BANK', 1);
defined('GROUP_PLAYER')		OR define('GROUP_PLAYER', 2);

/*
|--------------------------------------------------------------------------
| Platform Codes
|--------------------------------------------------------------------------
|
| These code are used when working with platform.
|
*/
defined('PLATFORM_WEB')				OR define('PLATFORM_WEB', 1);
defined('PLATFORM_MOBILE_WEB')		OR define('PLATFORM_MOBILE_WEB', 2);
defined('PLATFORM_APP_ANDROID')		OR define('PLATFORM_APP_ANDROID', 3);
defined('PLATFORM_APP_IOS')			OR define('PLATFORM_APP_IOS', 4);

/*
|--------------------------------------------------------------------------
| Deposit Type Codes
|--------------------------------------------------------------------------
|
| These code are used when working with deposit.
|
*/
defined('DEPOSIT_OFFLINE_BANKING')	OR define('DEPOSIT_OFFLINE_BANKING', 1);
defined('DEPOSIT_ONLINE_BANKING')	OR define('DEPOSIT_ONLINE_BANKING', 2);
defined('DEPOSIT_CREDIT_CARD')	OR define('DEPOSIT_CREDIT_CARD', 3);
defined('DEPOSIT_HYPERMART')	OR define('DEPOSIT_HYPERMART', 4);
defined('WITHDRAWAL_OFFLINE')	OR define('WITHDRAWAL_OFFLINE', 10);
defined('WITHDRAWAL_ONLINE')	OR define('WITHDRAWAL_ONLINE', 11);

defined('DEPOSIT_PAD_0')	OR define('DEPOSIT_PAD_0', 6);
defined('WITHDRAWAL_PAD_0')	OR define('WITHDRAWAL_PAD_0', 6);
/*
|--------------------------------------------------------------------------
| Withdrawal Type Codes
|--------------------------------------------------------------------------
|
| These code are used when working with withdrawal.
|
*/
defined('WITHDRAWAL_OFFLINE_BANKING')	OR define('WITHDRAWAL_OFFLINE_BANKING', 1);
defined('WITHDRAWAL_ONLINE_BANKING')	OR define('WITHDRAWAL_ONLINE_BANKING', 2);

/*
|--------------------------------------------------------------------------
| Cash Transfer Codes
|--------------------------------------------------------------------------
|
| These code are used when working with report.
|
*/
defined('TRANSFER_POINT_IN')			OR define('TRANSFER_POINT_IN', 1);
defined('TRANSFER_POINT_OUT')			OR define('TRANSFER_POINT_OUT', 2);
defined('TRANSFER_ADJUST_IN')			OR define('TRANSFER_ADJUST_IN', 3);
defined('TRANSFER_ADJUST_OUT')			OR define('TRANSFER_ADJUST_OUT', 4);
defined('TRANSFER_OFFLINE_DEPOSIT')		OR define('TRANSFER_OFFLINE_DEPOSIT', 5);
defined('TRANSFER_PG_DEPOSIT')			OR define('TRANSFER_PG_DEPOSIT', 6);
defined('TRANSFER_WITHDRAWAL')			OR define('TRANSFER_WITHDRAWAL', 7);
defined('TRANSFER_WITHDRAWAL_REFUND')	OR define('TRANSFER_WITHDRAWAL_REFUND', 8);
defined('TRANSFER_PROMOTION')			OR define('TRANSFER_PROMOTION', 9);
defined('TRANSFER_BONUS')				OR define('TRANSFER_BONUS', 10);
defined('TRANSFER_COMMISSION')			OR define('TRANSFER_COMMISSION', 11);
defined('TRANSFER_TRANSACTION_IN')		OR define('TRANSFER_TRANSACTION_IN', 12);
defined('TRANSFER_TRANSACTION_OUT')		OR define('TRANSFER_TRANSACTION_OUT', 13);
defined('TRANSFER_REWARD_IN')			OR define('TRANSFER_REWARD_IN', 14);
defined('TRANSFER_REWARD_OUT')			OR define('TRANSFER_REWARD_OUT', 15);
defined('TRANSFER_CREDIT_CARD_DEPOSIT')	OR define('TRANSFER_CREDIT_CARD_DEPOSIT', 16);
defined('TRANSFER_HYPERMART_DEPOSIT')	OR define('TRANSFER_HYPERMART_DEPOSIT', 17);
defined('TRANSFER_AGENT_BONUS')			OR define('TRANSFER_AGENT_BONUS', 18);
defined('TRANSFER_AGENT_COMISSION')		OR define('TRANSFER_AGENT_COMISSION', 19);
defined('TRANSFER_PURCHASE_VOUCHER')	OR define('TRANSFER_PURCHASE_VOUCHER', 20);
defined('TRANSFER_4D_COMISSION')		OR define('TRANSFER_4D_COMISSION', 21);
defined('TRANSFER_WALLET_ADJUST')		OR define('TRANSFER_WALLET_ADJUST', 40);

/*
|--------------------------------------------------------------------------
| Game Type Codes
|--------------------------------------------------------------------------
|
| These code are used when working with game.
|
*/
defined('GAME_ALL')  			OR define('GAME_ALL', '0');
defined('GAME_ALL_ARRAY')  		OR define('GAME_ALL_ARRAY', json_encode(array('SB','SL','FH','ES','BG','LT','KN','VS','PK','CF','OT')));
defined('GAME_SPORTSBOOK')  	OR define('GAME_SPORTSBOOK', 'SB');
defined('GAME_LIVE_CASINO')		OR define('GAME_LIVE_CASINO', 'LC');
defined('GAME_SLOTS')  			OR define('GAME_SLOTS', 'SL');
defined('GAME_FISHING')  		OR define('GAME_FISHING', 'FH');
defined('GAME_ESPORTS')  		OR define('GAME_ESPORTS', "ES");
defined('GAME_BOARD_GAME')  	OR define('GAME_BOARD_GAME', 'BG');
defined('GAME_LOTTERY')  		OR define('GAME_LOTTERY', 'LT');
defined('GAME_KENO')  			OR define('GAME_KENO', 'KN');
defined('GAME_VIRTUAL_SPORTS')  OR define('GAME_VIRTUAL_SPORTS', 'VS');
defined('GAME_POKER')  			OR define('GAME_POKER', 'PK');
defined('GAME_COCKFIGHTING')  	OR define('GAME_COCKFIGHTING', 'CF');
defined('GAME_OTHERS')  		OR define('GAME_OTHERS', 'OT');



/*
|--------------------------------------------------------------------------
| Game Round Type Codes
|--------------------------------------------------------------------------
|
| These code are used when working with game.
|
*/
defined('GAME_ROUND_TYPE_GAME_ROUND')  		OR define('GAME_ROUND_TYPE_GAME_ROUND', 0);
defined('GAME_ROUND_TYPE_FREE_SPIN')		OR define('GAME_ROUND_TYPE_FREE_SPIN', 1);
defined('GAME_ROUND_TYPE_JACKPOT')  		OR define('GAME_ROUND_TYPE_JACKPOT', 2);
defined('GAME_ROUND_TYPE_TIP')  			OR define('GAME_ROUND_TYPE_TIP', 3);

/*
|--------------------------------------------------------------------------
| User Group Type Codes
|--------------------------------------------------------------------------
|
| These code are used when working with log.
|
*/
defined('USER_GROUP_USER')			OR define('USER_GROUP_USER', 1);
defined('USER_GROUP_SUB_ACCOUNT')	OR define('USER_GROUP_SUB_ACCOUNT', 2);
defined('USER_GROUP_PLAYER')		OR define('USER_GROUP_PLAYER', 3);


/*
|--------------------------------------------------------------------------
| Player Type
|--------------------------------------------------------------------------
|
| These code are used when working with user.
|
*/
defined('PLAYER_TYPE_CASH_MARKET')			OR define('PLAYER_TYPE_CASH_MARKET', 1);
defined('PLAYER_TYPE_CREDIT_MARKET')		OR define('PLAYER_TYPE_CREDIT_MARKET', 2);
defined('PLAYER_TYPE_MG_MARKET')		    OR define('PLAYER_TYPE_MG_MARKET', 3);
/*
|--------------------------------------------------------------------------
| User Type Codes
|--------------------------------------------------------------------------
|
| These code are used when working with user.
|
*/
defined('USER_SA')		OR define('USER_SA', 1);
defined('USER_SMA') 	OR define('USER_SMA', 2);
defined('USER_MA') 		OR define('USER_MA', 3);
defined('USER_AG') 		OR define('USER_AG', 4);

/*
|--------------------------------------------------------------------------
| Time Type Codes
|--------------------------------------------------------------------------
|
| These code are used when working with user.
|
*/
defined('TIME_TYPE_PAYOUT_TIME')		OR define('TIME_TYPE_PAYOUT_TIME', 1);
defined('TIME_TYPE_BET_TIME') 			OR define('TIME_TYPE_BET_TIME', 2);
defined('TIME_TYPE_GAME_TIME') 			OR define('TIME_TYPE_GAME_TIME', 3);
defined('TIME_TYPE_REPORT_TIME') 		OR define('TIME_TYPE_REPORT_TIME', 4);
defined('TIME_TYPE_SATTLE_TIME') 		OR define('TIME_TYPE_SATTLE_TIME', 5);
defined('TIME_TYPE_COMPARE_TIME') 		OR define('TIME_TYPE_COMPARE_TIME', 6);
defined('TIME_TYPE_INSERT_UPDATE_TIME') OR define('TIME_TYPE_INSERT_UPDATE_TIME', 7);

/*
|--------------------------------------------------------------------------
| Avatar Type
|--------------------------------------------------------------------------
|
| These code are used when working with user.
|
*/
defined('AVATAR_ALL')			OR define('AVATAR_ALL', 1);
defined('AVATAR_INDIVIDUAL')	OR define('AVATAR_INDIVIDUAL', 2);


/*
|--------------------------------------------------------------------------
| Message Type
|--------------------------------------------------------------------------
|
| These code are used when working with Message Type.
|
*/
defined('MESSAGE_SYSTEM')			OR define('MESSAGE_SYSTEM', 1);
defined('MESSAGE_CUSTOMER_SERVICE')	OR define('MESSAGE_CUSTOMER_SERVICE', 2);

/*
|--------------------------------------------------------------------------
| System Type
|--------------------------------------------------------------------------
|
| These code are used when working with Message Type.
|
*/
defined('SYSTEM_TYPE_SINGLE_WALLET')			OR define('SYSTEM_TYPE_SINGLE_WALLET', 1);
defined('SYSTEM_TYPE_TRANSFER_WALLET')			OR define('SYSTEM_TYPE_TRANSFER_WALLET', 2);


/*
|--------------------------------------------------------------------------
| System Type
|--------------------------------------------------------------------------
|
| These code are used when working with Message Type.
|
*/
defined('PROMOTION_TYPE_STRICT_BASED')			OR define('PROMOTION_TYPE_STRICT_BASED', 1);
defined('PROMOTION_TYPE_PLAYER_BASED')			OR define('PROMOTION_TYPE_PLAYER_BASED', 2);

/*
|--------------------------------------------------------------------------
| Message Read Type
|--------------------------------------------------------------------------
|
| These code are used when working with Message Read Type.
|
*/
defined('MESSAGE_UNREAD')			OR define('MESSAGE_UNREAD', 1);
defined('MESSAGE_READ')				OR define('MESSAGE_READ', 2);

/*
|--------------------------------------------------------------------------
| Message Genre
|--------------------------------------------------------------------------
|
| These code are used when working with Message Genre.
|
*/
defined('MESSAGE_GENRE_ALL')			OR define('MESSAGE_GENRE_ALL', 1);
defined('MESSAGE_GENRE_USER_LEVEL')		OR define('MESSAGE_GENRE_USER_LEVEL', 2);
defined('MESSAGE_GENRE_BANK_CHANNEL')	OR define('MESSAGE_GENRE_BANK_CHANNEL', 3);
defined('MESSAGE_GENRE_INDIVIDUAL')		OR define('MESSAGE_GENRE_INDIVIDUAL', 4);
defined('MESSAGE_GENRE_USER_ALL')		OR define('MESSAGE_GENRE_USER_ALL', 5);

defined('EXPORT_COLOR_BLUE')			OR define('EXPORT_COLOR_BLUE', 1);
defined('EXPORT_COLOR_RED')				OR define('EXPORT_COLOR_RED', 2);
defined('EXPORT_COLOR_BLACK')			OR define('EXPORT_COLOR_BLACK', 3);
/*
|--------------------------------------------------------------------------
| Fingerprint status
|--------------------------------------------------------------------------
|
| These code are used when working with Message Genre.
|
*/
defined('FINGERPRINT_STATUS_INACTIVE')			OR define('FINGERPRINT_STATUS_INACTIVE', 0);
defined('FINGERPRINT_STATUS_ACTIVE_NOT_FORCE')	OR define('FINGERPRINT_STATUS_ACTIVE_NOT_FORCE', 1);
defined('FINGERPRINT_STATUS_ACTIVE_FORCE')		OR define('FINGERPRINT_STATUS_ACTIVE_FORCE', 2);

/*
|--------------------------------------------------------------------------
| Promotion Setting
|--------------------------------------------------------------------------
|
| These code are used when working with Message Genre.
|
*/
//Promotion Calculate Type
defined('PROMOTION_SESSION_TIME_LIMIT')						OR define('PROMOTION_SESSION_TIME_LIMIT', 300);
defined('PROMOTION_CALCULATE_TYPE_VALID_BET_TOTAL')			OR define('PROMOTION_CALCULATE_TYPE_VALID_BET_TOTAL', 1);
defined('PROMOTION_CALCULATE_TYPE_VALID_BET_WIN_LOSS')		OR define('PROMOTION_CALCULATE_TYPE_VALID_BET_WIN_LOSS', 2);
defined('PROMOTION_CALCULATE_TYPE_VALID_BET_WIN')			OR define('PROMOTION_CALCULATE_TYPE_VALID_BET_WIN', 3);
defined('PROMOTION_CALCULATE_TYPE_VALID_BET_LOSS')			OR define('PROMOTION_CALCULATE_TYPE_VALID_BET_LOSS', 4);
defined('PROMOTION_CALCULATE_TYPE_WIN_LOSS_WIN')			OR define('PROMOTION_CALCULATE_TYPE_WIN_LOSS_WIN', 5);
defined('PROMOTION_CALCULATE_TYPE_WIN_LOSS_LOSS')			OR define('PROMOTION_CALCULATE_TYPE_WIN_LOSS_LOSS', 6);
defined('PROMOTION_CALCULATE_TYPE_PROMOTION_BET_TOTAL')		OR define('PROMOTION_CALCULATE_TYPE_PROMOTION_BET_TOTAL', 7);
defined('PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT')			OR define('PROMOTION_CALCULATE_TYPE_WALLET_AMOUNT', 8);
//Promotion Bonus Type
defined('PROMOTION_BONUS_TYPE_PERCENTAGE')					OR define('PROMOTION_BONUS_TYPE_PERCENTAGE', 1);
defined('PROMOTION_BONUS_TYPE_FIX_AMOUNT')					OR define('PROMOTION_BONUS_TYPE_FIX_AMOUNT', 2);
defined('PROMOTION_BONUS_TYPE_FIX_AMOUNT_FROM')				OR define('PROMOTION_BONUS_TYPE_FIX_AMOUNT_FROM', 3);
defined('PROMOTION_BONUS_TYPE_PERCENTAGE_TURNOVER')			OR define('PROMOTION_BONUS_TYPE_PERCENTAGE_TURNOVER', 4);
//Promotion Date Type
defined('PROMOTION_DATE_TYPE_START_TO_END')					OR define('PROMOTION_DATE_TYPE_START_TO_END', 1);
defined('PROMOTION_DATE_TYPE_START_NO_LIMIT')				OR define('PROMOTION_DATE_TYPE_START_NO_LIMIT', 2);
defined('PROMOTION_DATE_TYPE_SPECIFIC_DAY_WEEK')			OR define('PROMOTION_DATE_TYPE_SPECIFIC_DAY_WEEK', 3);
defined('PROMOTION_DATE_TYPE_SPECIFIC_DAY_DAY')				OR define('PROMOTION_DATE_TYPE_SPECIFIC_DAY_DAY', 4);

//APPLY TYPE
defined('PROMOTION_USER_TYPE_SYSTEM')						OR define('PROMOTION_USER_TYPE_SYSTEM', 1);
defined('PROMOTION_USER_TYPE_ADMIN')						OR define('PROMOTION_USER_TYPE_ADMIN', 2);
defined('PROMOTION_USER_TYPE_PLAYER')						OR define('PROMOTION_USER_TYPE_PLAYER', 3);

//APPLY TYPE
defined('PROMOTION_APPLY_TYPE_SYSTEM')						OR define('PROMOTION_APPLY_TYPE_SYSTEM', 1);
defined('PROMOTION_APPLY_TYPE_ADMIN')						OR define('PROMOTION_APPLY_TYPE_ADMIN', 2);
defined('PROMOTION_APPLY_TYPE_PLAYER')						OR define('PROMOTION_APPLY_TYPE_PLAYER', 3);

//Times Limit Type
defined('PROMOTION_TIMES_LIMIT_TYPE_NO_LIMIT')				OR define('PROMOTION_TIMES_LIMIT_TYPE_NO_LIMIT', 1);
defined('PROMOTION_TIMES_LIMIT_TYPE_EVERY_DAY_ONCE')		OR define('PROMOTION_TIMES_LIMIT_TYPE_EVERY_DAY_ONCE', 2);
defined('PROMOTION_TIMES_LIMIT_TYPE_EVERY_MONTH_ONCE')		OR define('PROMOTION_TIMES_LIMIT_TYPE_EVERY_MONTH_ONCE', 3);
defined('PROMOTION_TIMES_LIMIT_TYPE_EVERY_YEARS_ONCE')		OR define('PROMOTION_TIMES_LIMIT_TYPE_EVERY_YEARS_ONCE', 4);
defined('PROMOTION_TIMES_LIMIT_TYPE_ONCE')					OR define('PROMOTION_TIMES_LIMIT_TYPE_ONCE', 5);
defined('PROMOTION_TIMES_LIMIT_TYPE_EVERY_WEEK_ONCE')		OR define('PROMOTION_TIMES_LIMIT_TYPE_EVERY_WEEK_ONCE', 6);
//bonus Range Type
defined('PROMOTION_BONUS_RANGE_TYPE_GENERAL')				OR define('PROMOTION_BONUS_RANGE_TYPE_GENERAL', 1);
defined('PROMOTION_BONUS_RANGE_TYPE_LEVEL')					OR define('PROMOTION_BONUS_RANGE_TYPE_LEVEL', 2);

defined('LIVE_CASINO_BACCARAT')								OR define('LIVE_CASINO_BACCARAT', 1);
defined('LIVE_CASINO_NON_BACCARAT')							OR define('LIVE_CASINO_NON_BACCARAT', 2);

defined('PROMOTION_DAY_TYPE_MONDAY')						OR define('PROMOTION_DAY_TYPE_MONDAY', 1);
defined('PROMOTION_DAY_TYPE_TUEDAY')						OR define('PROMOTION_DAY_TYPE_TUEDAY', 2);
defined('PROMOTION_DAY_TYPE_WEDNESDAY')						OR define('PROMOTION_DAY_TYPE_WEDNESDAY', 3);
defined('PROMOTION_DAY_TYPE_THURSDAY')						OR define('PROMOTION_DAY_TYPE_THURSDAY', 4);
defined('PROMOTION_DAY_TYPE_FRIDAY')						OR define('PROMOTION_DAY_TYPE_FRIDAY', 5);
defined('PROMOTION_DAY_TYPE_SATURDAY')						OR define('PROMOTION_DAY_TYPE_SATURDAY', 6);
defined('PROMOTION_DAY_TYPE_SUNDAY')						OR define('PROMOTION_DAY_TYPE_SUNDAY', 7);
defined('PROMOTION_DAY_TYPE_EVERYDAY')						OR define('PROMOTION_DAY_TYPE_EVERYDAY', 8);
defined('PROMOTION_DAY_TYPE_EVERYTIME')						OR define('PROMOTION_DAY_TYPE_EVERYTIME', 9);

defined('PROMOTION_CRON_CALCULATE')							OR define('PROMOTION_CRON_CALCULATE', 1);

defined('PROMOTION_TYPE_DE')								OR define('PROMOTION_TYPE_DE', "DE");
defined('PROMOTION_TYPE_FD')								OR define('PROMOTION_TYPE_FD', "FD");
defined('PROMOTION_TYPE_SD')								OR define('PROMOTION_TYPE_SD', "SD");
defined('PROMOTION_TYPE_LE')								OR define('PROMOTION_TYPE_LE', "LE");
defined('PROMOTION_TYPE_CR')								OR define('PROMOTION_TYPE_CR', "CR");
defined('PROMOTION_TYPE_RP')								OR define('PROMOTION_TYPE_RP', "RP");
defined('PROMOTION_TYPE_BN')								OR define('PROMOTION_TYPE_BN', "BN");
defined('PROMOTION_TYPE_DPR')								OR define('PROMOTION_TYPE_DPR', "DPR");
defined('PROMOTION_TYPE_RF')								OR define('PROMOTION_TYPE_RF', "RF");
defined('PROMOTION_TYPE_DPRC')								OR define('PROMOTION_TYPE_DPRC', "DPRC");
defined('PROMOTION_TYPE_BIRTH')								OR define('PROMOTION_TYPE_BIRTH', "BIRTH");
defined('PROMOTION_TYPE_CRLV')								OR define('PROMOTION_TYPE_CRLV', "CRLV");
defined('PROMOTION_TYPE_BDRF')								OR define('PROMOTION_TYPE_BDRF', "BDRF");
defined('BONUS_RANGE_NUMBER')								OR define('BONUS_RANGE_NUMBER', 6);

defined('PROMOTION_TYPE_ALL_DEPO')							OR define('PROMOTION_TYPE_ALL_DEPO', json_encode(array(PROMOTION_TYPE_DE, PROMOTION_TYPE_FD, PROMOTION_TYPE_SD,PROMOTION_TYPE_DPR,PROMOTION_TYPE_DPRC)));

defined('PROMOTION_REMARK_REACH_TARGET')								OR define('PROMOTION_REMARK_REACH_TARGET', 1);
defined('PROMOTION_REMARK_LOSS_ALL')									OR define('PROMOTION_REMARK_LOSS_ALL', 2);


defined('DEPOSIT_PROMOTION_SUCCESSS')									OR define('DEPOSIT_PROMOTION_SUCCESSS', 1);
defined('DEPOSIT_PROMOTION_UNKNOWN_ERROR')								OR define('DEPOSIT_PROMOTION_UNKNOWN_ERROR', 2);
defined('DEPOSIT_PROMOTION_PROMOTION_NOT_AVAILABLE')					OR define('DEPOSIT_PROMOTION_PROMOTION_NOT_AVAILABLE', 3);
defined('DEPOSIT_PROMOTION_PROMOTION_NOT_REACH_EXPIRATE_DATE')			OR define('DEPOSIT_PROMOTION_PROMOTION_NOT_REACH_EXPIRATE_DATE', 4);
defined('DEPOSIT_PROMOTION_PROMOTION_REACH_CLAIM_LIMIT')				OR define('DEPOSIT_PROMOTION_PROMOTION_REACH_CLAIM_LIMIT', 5);
defined('DEPOSIT_PROMOTION_FIRST_DEPOSIT')								OR define('DEPOSIT_PROMOTION_FIRST_DEPOSIT', 6);
defined('DEPOSIT_PROMOTION_DAILY_FIRST_DEPOSIT')						OR define('DEPOSIT_PROMOTION_DAILY_FIRST_DEPOSIT', 7);
defined('DEPOSIT_PROMOTION_AMOUNT_NOT_REACH_MINIMUM')					OR define('DEPOSIT_PROMOTION_AMOUNT_NOT_REACH_MINIMUM', 8);
defined('DEPOSIT_PROMOTION_PROMOTION_PENDING_EXITS')					OR define('DEPOSIT_PROMOTION_PROMOTION_PENDING_EXITS', 9);
defined('DEPOSIT_PROMOTION_PROMOTION_PENDING_NOT_EXITS')				OR define('DEPOSIT_PROMOTION_PROMOTION_PENDING_NOT_EXITS', 3);

defined('MAINTAIN_MEMBERSHIP_TYPE_WEEKLY')								OR define('MAINTAIN_MEMBERSHIP_TYPE_WEEKLY', 1);
defined('MAINTAIN_MEMBERSHIP_TYPE_MONTHLY')								OR define('MAINTAIN_MEMBERSHIP_TYPE_MONTHLY', 2);

defined('LEVEL_MOVEMENT_UP')								OR define('LEVEL_MOVEMENT_UP', 1);
defined('LEVEL_MOVEMENT_DOWN')								OR define('LEVEL_MOVEMENT_DOWN', 2);
defined('LEVEL_MOVEMENT_NONE')								OR define('LEVEL_MOVEMENT_NONE', 3);

defined('ANNOUNCEMENT_DEPOSIT_OFFLINE')						OR define('ANNOUNCEMENT_DEPOSIT_OFFLINE', 1);
defined('ANNOUNCEMENT_DEPOSIT_ONLINE')						OR define('ANNOUNCEMENT_DEPOSIT_ONLINE', 2);
defined('ANNOUNCEMENT_DEPOSIT_CREDIT_CARD')					OR define('ANNOUNCEMENT_DEPOSIT_CREDIT_CARD', 3);
defined('ANNOUNCEMENT_DEPOSIT_HYPERMART')					OR define('ANNOUNCEMENT_DEPOSIT_HYPERMART', 4);
defined('ANNOUNCEMENT_WITHDRAWAL')							OR define('ANNOUNCEMENT_WITHDRAWAL', 5);
defined('ANNOUNCEMENT_PROMOTION')							OR define('ANNOUNCEMENT_PROMOTION', 6);
defined('ANNOUNCEMENT_RISK')								OR define('ANNOUNCEMENT_RISK', 7);
defined('ANNOUNCEMENT_RISK_FROZEN')							OR define('ANNOUNCEMENT_RISK_FROZEN', 8);
defined('ANNOUNCEMENT_BLACKLIST')							OR define('ANNOUNCEMENT_BLACKLIST', 9);
defined('ANNOUNCEMENT_PLAYER_BANK_IMAGE')					OR define('ANNOUNCEMENT_PLAYER_BANK_IMAGE', 10);

defined('ANNOUNCEMENT_ON')									OR define('ANNOUNCEMENT_ON', 1);
defined('ANNOUNCEMENT_OFF')									OR define('ANNOUNCEMENT_OFF', 2);

defined('RISK_DAILY')										OR define('RISK_DAILY', 1);
defined('RISK_MONTHLY')										OR define('RISK_MONTHLY', 2);
defined('RISK_YEARLY')										OR define('RISK_YEARLY', 3);

defined('LEVEL_UPGRADE_DEPOSIT')							OR define('LEVEL_UPGRADE_DEPOSIT', 1);
defined('LEVEL_UPGRADE_TARGET')								OR define('LEVEL_UPGRADE_TARGET', 2);
defined('LEVEL_UPGRADE_DEPOSIT_TARGET')						OR define('LEVEL_UPGRADE_DEPOSIT_TARGET', 3);

defined('LEVEL_DOWNGRADE_DEPOSIT')							OR define('LEVEL_DOWNGRADE_DEPOSIT', 1);
defined('LEVEL_DOWNGRADE_TARGET')							OR define('LEVEL_DOWNGRADE_TARGET', 2);
defined('LEVEL_DOWNGRADE_DEPOSIT_TARGET')					OR define('LEVEL_DOWNGRADE_DEPOSIT_TARGET', 3);

defined('LEVEL_TARGET_ALL')									OR define('LEVEL_TARGET_ALL', 1);
defined('LEVEL_TARGET_SAME_PROVIDER')						OR define('LEVEL_TARGET_SAME_PROVIDER', 2);
defined('LEVEL_TARGET_SAME_GAME')							OR define('LEVEL_TARGET_SAME_GAME', 3);
defined('LEVEL_TARGET_SAME_PROVIDER_SAME_GAME')				OR define('LEVEL_TARGET_SAME_PROVIDER_SAME_GAME', 4);


/*
|--------------------------------------------------------------------------
| Permission Codes
|--------------------------------------------------------------------------
|
| These code are used when working with permission.
|
*/
defined('PERMISSION_MISCELLANEOUS_UPDATE')			OR define('PERMISSION_MISCELLANEOUS_UPDATE', 1);
defined('PERMISSION_CONTACT_UPDATE')				OR define('PERMISSION_CONTACT_UPDATE', 2);
defined('PERMISSION_CONTACT_VIEW')					OR define('PERMISSION_CONTACT_VIEW', 3);
defined('PERMISSION_SEO_UPDATE')					OR define('PERMISSION_SEO_UPDATE', 4);
defined('PERMISSION_SEO_VIEW')						OR define('PERMISSION_SEO_VIEW', 5);
defined('PERMISSION_GAME_UPDATE')					OR define('PERMISSION_GAME_UPDATE', 6);
defined('PERMISSION_GAME_VIEW')						OR define('PERMISSION_GAME_VIEW', 7);
defined('PERMISSION_BANNER_ADD')					OR define('PERMISSION_BANNER_ADD', 8);
defined('PERMISSION_BANNER_UPDATE')					OR define('PERMISSION_BANNER_UPDATE', 9);
defined('PERMISSION_BANNER_DELETE')					OR define('PERMISSION_BANNER_DELETE', 10);
defined('PERMISSION_BANNER_VIEW')					OR define('PERMISSION_BANNER_VIEW', 11);
defined('PERMISSION_ANNOUNCEMENT_ADD')				OR define('PERMISSION_ANNOUNCEMENT_ADD', 12);
defined('PERMISSION_ANNOUNCEMENT_UPDATE')			OR define('PERMISSION_ANNOUNCEMENT_UPDATE', 13);
defined('PERMISSION_ANNOUNCEMENT_DELETE')			OR define('PERMISSION_ANNOUNCEMENT_DELETE', 14);
defined('PERMISSION_ANNOUNCEMENT_VIEW')				OR define('PERMISSION_ANNOUNCEMENT_VIEW', 15);
defined('PERMISSION_GROUP_ADD')						OR define('PERMISSION_GROUP_ADD', 16);
defined('PERMISSION_GROUP_UPDATE')					OR define('PERMISSION_GROUP_UPDATE', 17);
defined('PERMISSION_GROUP_DELETE')					OR define('PERMISSION_GROUP_DELETE', 18);
defined('PERMISSION_GROUP_VIEW')					OR define('PERMISSION_GROUP_VIEW', 19);
defined('PERMISSION_BANK_ADD')						OR define('PERMISSION_BANK_ADD', 20);
defined('PERMISSION_BANK_UPDATE')					OR define('PERMISSION_BANK_UPDATE', 21);
defined('PERMISSION_BANK_DELETE')					OR define('PERMISSION_BANK_DELETE', 22);
defined('PERMISSION_BANK_VIEW')						OR define('PERMISSION_BANK_VIEW', 23);
defined('PERMISSION_BANK_ACCOUNT_ADD')				OR define('PERMISSION_BANK_ACCOUNT_ADD', 24);
defined('PERMISSION_BANK_ACCOUNT_UPDATE')			OR define('PERMISSION_BANK_ACCOUNT_UPDATE', 25);
defined('PERMISSION_BANK_ACCOUNT_DELETE')			OR define('PERMISSION_BANK_ACCOUNT_DELETE', 26);
defined('PERMISSION_BANK_ACCOUNT_VIEW')				OR define('PERMISSION_BANK_ACCOUNT_VIEW', 27);
defined('PERMISSION_PROMOTION_ADD')					OR define('PERMISSION_PROMOTION_ADD', 28);
defined('PERMISSION_PROMOTION_UPDATE')				OR define('PERMISSION_PROMOTION_UPDATE', 29);
defined('PERMISSION_PROMOTION_DELETE')				OR define('PERMISSION_PROMOTION_DELETE', 30);
defined('PERMISSION_PROMOTION_VIEW')				OR define('PERMISSION_PROMOTION_VIEW', 31);
defined('PERMISSION_SUB_ACCOUNT_ADD')				OR define('PERMISSION_SUB_ACCOUNT_ADD', 32);
defined('PERMISSION_SUB_ACCOUNT_UPDATE')			OR define('PERMISSION_SUB_ACCOUNT_UPDATE', 33);
defined('PERMISSION_SUB_ACCOUNT_VIEW')				OR define('PERMISSION_SUB_ACCOUNT_VIEW', 34);
defined('PERMISSION_USER_ADD')						OR define('PERMISSION_USER_ADD', 35);
defined('PERMISSION_USER_UPDATE')					OR define('PERMISSION_USER_UPDATE', 36);
defined('PERMISSION_USER_VIEW')						OR define('PERMISSION_USER_VIEW', 37);
defined('PERMISSION_PLAYER_ADD')					OR define('PERMISSION_PLAYER_ADD', 38);
defined('PERMISSION_PLAYER_UPDATE')					OR define('PERMISSION_PLAYER_UPDATE', 39);
defined('PERMISSION_PLAYER_VIEW')					OR define('PERMISSION_PLAYER_VIEW', 40);
defined('PERMISSION_PERMISSION_SETUP')				OR define('PERMISSION_PERMISSION_SETUP', 41);
defined('PERMISSION_CHANGE_PASSWORD')				OR define('PERMISSION_CHANGE_PASSWORD', 42);
defined('PERMISSION_DEPOSIT_POINT_TO_DOWNLINE')		OR define('PERMISSION_DEPOSIT_POINT_TO_DOWNLINE', 43);
defined('PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE')	OR define('PERMISSION_WITHDRAW_POINT_FROM_DOWNLINE', 44);
defined('PERMISSION_VIEW_PLAYER_CONTACT')			OR define('PERMISSION_VIEW_PLAYER_CONTACT', 45);
defined('PERMISSION_VIEW_PLAYER_WALLET')			OR define('PERMISSION_VIEW_PLAYER_WALLET', 46);
defined('PERMISSION_PLAYER_WALLET_TRANSFER')		OR define('PERMISSION_PLAYER_WALLET_TRANSFER', 47);
defined('PERMISSION_PLAYER_POINT_ADJUSTMENT')		OR define('PERMISSION_PLAYER_POINT_ADJUSTMENT', 48);
defined('PERMISSION_KICK_PLAYER')					OR define('PERMISSION_KICK_PLAYER', 49);
defined('PERMISSION_DEPOSIT_UPDATE')				OR define('PERMISSION_DEPOSIT_UPDATE', 50);
defined('PERMISSION_DEPOSIT_VIEW')					OR define('PERMISSION_DEPOSIT_VIEW', 51);
defined('PERMISSION_WITHDRAWAL_UPDATE')				OR define('PERMISSION_WITHDRAWAL_UPDATE', 52);
defined('PERMISSION_WITHDRAWAL_VIEW')				OR define('PERMISSION_WITHDRAWAL_VIEW', 53);
defined('PERMISSION_PLAYER_PROMOTION_ADD')			OR define('PERMISSION_PLAYER_PROMOTION_ADD', 54);
defined('PERMISSION_PLAYER_PROMOTION_UPDATE')		OR define('PERMISSION_PLAYER_PROMOTION_UPDATE', 55);
defined('PERMISSION_PLAYER_PROMOTION_VIEW')			OR define('PERMISSION_PLAYER_PROMOTION_VIEW', 56);
defined('PERMISSION_PLAYER_BONUS_ADD')				OR define('PERMISSION_PLAYER_BONUS_ADD', 57);
defined('PERMISSION_PLAYER_BONUS_UPDATE')			OR define('PERMISSION_PLAYER_BONUS_UPDATE', 58);
defined('PERMISSION_PLAYER_BONUS_VIEW')				OR define('PERMISSION_PLAYER_BONUS_VIEW', 59);
defined('PERMISSION_WIN_LOSS_REPORT')				OR define('PERMISSION_WIN_LOSS_REPORT', 60);
defined('PERMISSION_TRANSACTION_REPORT')			OR define('PERMISSION_TRANSACTION_REPORT', 61);
defined('PERMISSION_POINT_TRANSACTION_REPORT')		OR define('PERMISSION_POINT_TRANSACTION_REPORT', 62);
defined('PERMISSION_CASH_TRANSACTION_REPORT')		OR define('PERMISSION_CASH_TRANSACTION_REPORT', 63);
defined('PERMISSION_WALLET_TRANSACTION_REPORT')		OR define('PERMISSION_WALLET_TRANSACTION_REPORT', 64);
defined('PERMISSION_LOGIN_REPORT')					OR define('PERMISSION_LOGIN_REPORT', 65);
defined('PERMISSION_BANK_CHANNEL_ADD')				OR define('PERMISSION_BANK_CHANNEL_ADD',66);
defined('PERMISSION_BANK_CHANNEL_UPDATE')			OR define('PERMISSION_BANK_CHANNEL_UPDATE',67);
defined('PERMISSION_BANK_CHANNEL_DELETE')			OR define('PERMISSION_BANK_CHANNEL_DELETE',68);
defined('PERMISSION_BANK_CHANNEL_VIEW')				OR define('PERMISSION_BANK_CHANNEL_VIEW',69);
defined('PERMISSION_SYSTEM_MESSAGE_ADD')			OR define('PERMISSION_SYSTEM_MESSAGE_ADD',70);
defined('PERMISSION_SYSTEM_MESSAGE_UPDATE')			OR define('PERMISSION_SYSTEM_MESSAGE_UPDATE',71);
defined('PERMISSION_SYSTEM_MESSAGE_DELETE')			OR define('PERMISSION_SYSTEM_MESSAGE_DELETE',72);
defined('PERMISSION_SYSTEM_MESSAGE_VIEW')			OR define('PERMISSION_SYSTEM_MESSAGE_VIEW',73);
defined('PERMISSION_SYSTEM_MESSAGE_USER_ADD')		OR define('PERMISSION_SYSTEM_MESSAGE_USER_ADD',74);
defined('PERMISSION_SYSTEM_MESSAGE_USER_UPDATE')	OR define('PERMISSION_SYSTEM_MESSAGE_USER_UPDATE',75);
defined('PERMISSION_SYSTEM_MESSAGE_USER_DELETE')	OR define('PERMISSION_SYSTEM_MESSAGE_USER_DELETE',76);
defined('PERMISSION_SYSTEM_MESSAGE_USER_VIEW')		OR define('PERMISSION_SYSTEM_MESSAGE_USER_VIEW',77);
defined('PERMISSION_BANK_PLAYER_ADD')				OR define('PERMISSION_BANK_PLAYER_ADD',78);
defined('PERMISSION_BANK_PLAYER_UPDATE')			OR define('PERMISSION_BANK_PLAYER_UPDATE',79);
defined('PERMISSION_BANK_PLAYER_DELETE')			OR define('PERMISSION_BANK_PLAYER_DELETE',80);
defined('PERMISSION_BANK_PLAYER_VIEW')				OR define('PERMISSION_BANK_PLAYER_VIEW',81);
defined('PERMISSION_BANK_PLAYER_USER_ADD')			OR define('PERMISSION_BANK_PLAYER_USER_ADD',82);
defined('PERMISSION_BANK_PLAYER_USER_UPDATE')		OR define('PERMISSION_BANK_PLAYER_USER_UPDATE',83);
defined('PERMISSION_BANK_PLAYER_USER_DELETE')		OR define('PERMISSION_BANK_PLAYER_USER_DELETE',84);
defined('PERMISSION_BANK_PLAYER_USER_VIEW')			OR define('PERMISSION_BANK_PLAYER_USER_VIEW',85);
defined('PERMISSION_LEVEL_ADD')						OR define('PERMISSION_LEVEL_ADD',86);
defined('PERMISSION_LEVEL_UPDATE')					OR define('PERMISSION_LEVEL_UPDATE',87);
defined('PERMISSION_LEVEL_DELETE')					OR define('PERMISSION_LEVEL_DELETE',88);
defined('PERMISSION_LEVEL_VIEW')					OR define('PERMISSION_LEVEL_VIEW',89);
defined('PERMISSION_DEPOSIT_ONLINE_VIEW')			OR define('PERMISSION_DEPOSIT_ONLINE_VIEW',90);
defined('PERMISSION_DEPOSIT_OFFLINE_VIEW')			OR define('PERMISSION_DEPOSIT_OFFLINE_VIEW',91);
defined('PERMISSION_DEPOSIT_PENDING_VIEW')			OR define('PERMISSION_DEPOSIT_PENDING_VIEW',92);
defined('PERMISSION_DEPOSIT_HOLDING_VIEW')			OR define('PERMISSION_DEPOSIT_HOLDING_VIEW',93);
defined('PERMISSION_DEPOSIT_REVIEWING_VIEW')		OR define('PERMISSION_DEPOSIT_REVIEWING_VIEW',94);
defined('PERMISSION_DEPOSIT_PENDING_DOC_VIEW')		OR define('PERMISSION_DEPOSIT_PENDING_DOC_VIEW',95);
defined('PERMISSION_DEPOSIT_APPROVE_VIEW')			OR define('PERMISSION_DEPOSIT_APPROVE_VIEW',96);
defined('PERMISSION_DEPOSIT_CANCEL_VIEW')			OR define('PERMISSION_DEPOSIT_CANCEL_VIEW',97);
defined('PERMISSION_DEPOSIT_PENDING_ACTION')		OR define('PERMISSION_DEPOSIT_PENDING_ACTION',98);
defined('PERMISSION_DEPOSIT_HOLDING_ACTION')		OR define('PERMISSION_DEPOSIT_HOLDING_ACTION',99);
defined('PERMISSION_DEPOSIT_REVIEWING_ACTION')		OR define('PERMISSION_DEPOSIT_REVIEWING_ACTION',100);
defined('PERMISSION_DEPOSIT_PENDING_DOC_ACTION')	OR define('PERMISSION_DEPOSIT_PENDING_DOC_ACTION',101);
defined('PERMISSION_DEPOSIT_APPROVE_ACTION')		OR define('PERMISSION_DEPOSIT_APPROVE_ACTION',102);
defined('PERMISSION_DEPOSIT_CANCEL_ACTION')			OR define('PERMISSION_DEPOSIT_CANCEL_ACTION',103);
defined('PERMISSION_WITHDRAW_PENDING_VIEW')			OR define('PERMISSION_WITHDRAW_PENDING_VIEW',104);
defined('PERMISSION_WITHDRAW_HOLDING_VIEW')			OR define('PERMISSION_WITHDRAW_HOLDING_VIEW',105);
defined('PERMISSION_WITHDRAW_REVIEWING_VIEW')		OR define('PERMISSION_WITHDRAW_REVIEWING_VIEW',106);
defined('PERMISSION_WITHDRAW_PENDING_DOC_VIEW')		OR define('PERMISSION_WITHDRAW_PENDING_DOC_VIEW',107);
defined('PERMISSION_WITHDRAW_APPROVE_VIEW')			OR define('PERMISSION_WITHDRAW_APPROVE_VIEW',108);
defined('PERMISSION_WITHDRAW_CANCEL_VIEW')			OR define('PERMISSION_WITHDRAW_CANCEL_VIEW',109);
defined('PERMISSION_WITHDRAW_PENDING_ACTION')		OR define('PERMISSION_WITHDRAW_PENDING_ACTION',110);
defined('PERMISSION_WITHDRAW_HOLDING_ACTION')		OR define('PERMISSION_WITHDRAW_HOLDING_ACTION',111);
defined('PERMISSION_WITHDRAW_REVIEWING_ACTION')		OR define('PERMISSION_WITHDRAW_REVIEWING_ACTION',112);
defined('PERMISSION_WITHDRAW_PENDING_DOC_ACTION')	OR define('PERMISSION_WITHDRAW_PENDING_DOC_ACTION',113);
defined('PERMISSION_WITHDRAW_APPROVE_ACTION')		OR define('PERMISSION_WITHDRAW_APPROVE_ACTION',114);
defined('PERMISSION_WITHDRAW_CANCEL_ACTION')		OR define('PERMISSION_WITHDRAW_CANCEL_ACTION',115);
defined('PERMISSION_DEPOSIT_ADD')					OR define('PERMISSION_DEPOSIT_ADD',116);
defined('PERMISSION_WITHDRAWAL_ADD')				OR define('PERMISSION_WITHDRAWAL_ADD',117);
defined('PERMISSION_AVATAR_ADD')					OR define('PERMISSION_AVATAR_ADD',118);
defined('PERMISSION_AVATAR_UPDATE')					OR define('PERMISSION_AVATAR_UPDATE',119);
defined('PERMISSION_AVATAR_DELETE')					OR define('PERMISSION_AVATAR_DELETE',120);
defined('PERMISSION_AVATAR_VIEW')					OR define('PERMISSION_AVATAR_VIEW',121);
defined('PERMISSION_FINGERPRINT_VIEW')				OR define('PERMISSION_FINGERPRINT_VIEW',122);
defined('PERMISSION_BONUS_ADD')						OR define('PERMISSION_BONUS_ADD', 123);
defined('PERMISSION_BONUS_UPDATE')					OR define('PERMISSION_BONUS_UPDATE', 124);
defined('PERMISSION_BONUS_VIEW')					OR define('PERMISSION_BONUS_VIEW', 125);
defined('PERMISSION_BONUS_DELETE')					OR define('PERMISSION_BONUS_DELETE', 126);
defined('PERMISSION_MATCH_ADD')						OR define('PERMISSION_MATCH_ADD', 127);
defined('PERMISSION_MATCH_UPDATE')					OR define('PERMISSION_MATCH_UPDATE', 128);
defined('PERMISSION_MATCH_VIEW')					OR define('PERMISSION_MATCH_VIEW', 129);
defined('PERMISSION_MATCH_DELETE')					OR define('PERMISSION_MATCH_DELETE', 130);
defined('PERMISSION_LEVEL_EXECUTE_ADD')				OR define('PERMISSION_LEVEL_EXECUTE_ADD',131);
defined('PERMISSION_LEVEL_EXECUTE_UPDATE')			OR define('PERMISSION_LEVEL_EXECUTE_UPDATE',132);
defined('PERMISSION_LEVEL_EXECUTE_DELETE')			OR define('PERMISSION_LEVEL_EXECUTE_DELETE',133);
defined('PERMISSION_LEVEL_EXECUTE_VIEW')			OR define('PERMISSION_LEVEL_EXECUTE_VIEW',134);
defined('PERMISSION_LEVEL_LOG_VIEW')				OR define('PERMISSION_LEVEL_LOG_VIEW',135);
defined('PERMISSION_LEVEL_LOG_UPDATE')				OR define('PERMISSION_LEVEL_LOG_UPDATE',136);
defined('PERMISSION_REWARD_TRANSACTION_REPORT')		OR define('PERMISSION_REWARD_TRANSACTION_REPORT',137);
defined('PERMISSION_REWARD_VIEW')					OR define('PERMISSION_REWARD_VIEW',138);
defined('PERMISSION_REWARD_UPDATE')					OR define('PERMISSION_REWARD_UPDATE',139);
defined('PERMISSION_REWARD_DEDUCT')					OR define('PERMISSION_REWARD_DEDUCT',140);
defined('PERMISSION_VERIFY_CODE_REPORT')			OR define('PERMISSION_VERIFY_CODE_REPORT',141);
defined('PERMISSION_PLAYER_DAILY_REPORT')			OR define('PERMISSION_PLAYER_DAILY_REPORT',142);
defined('PERMISSION_REPORT_EXPORT_EXCEL')			OR define('PERMISSION_REPORT_EXPORT_EXCEL',143);
defined('PERMISSION_PLAYER_RISK_REPORT')			OR define('PERMISSION_PLAYER_RISK_REPORT',144);
defined('PERMISSION_PAYMENT_GATEWAY_VIEW')			OR define('PERMISSION_PAYMENT_GATEWAY_VIEW',145);
defined('PERMISSION_PAYMENT_GATEWAY_UPDATE')		OR define('PERMISSION_PAYMENT_GATEWAY_UPDATE',146);
defined('PERMISSION_ADMIN_LOG_VIEW')				OR define('PERMISSION_ADMIN_LOG_VIEW',147);
defined('PERMISSION_ADMIN_PLAYER_LOG_VIEW')			OR define('PERMISSION_ADMIN_PLAYER_LOG_VIEW',148);
defined('PERMISSION_SUB_ACCOUNT_LOG_VIEW')			OR define('PERMISSION_SUB_ACCOUNT_LOG_VIEW',149);
defined('PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW')	OR define('PERMISSION_SUB_ACCOUNT_PLAYER_LOG_VIEW',150);
defined('PERMISSION_GAME_MAINTENANCE_VIEW')			OR define('PERMISSION_GAME_MAINTENANCE_VIEW',151);
defined('PERMISSION_GAME_MAINTENANCE_ADD')			OR define('PERMISSION_GAME_MAINTENANCE_ADD',152);
defined('PERMISSION_GAME_MAINTENANCE_UPDATE')		OR define('PERMISSION_GAME_MAINTENANCE_UPDATE',153);
defined('PERMISSION_POSSESS_ADJUSTMENT')			OR define('PERMISSION_POSSESS_ADJUSTMENT',154);
defined('PERMISSION_WALLET_TRANSACTION_PENDING_VIEW')	OR define('PERMISSION_WALLET_TRANSACTION_PENDING_VIEW',155);
defined('PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE')	OR define('PERMISSION_WALLET_TRANSACTION_PENDING_UPDATE',156);
defined('PERMISSION_PLAYER_PROMOTION_BET_DETAIL')	OR define('PERMISSION_PLAYER_PROMOTION_BET_DETAIL',157);
defined('PERMISSION_PLAYER_PROMOTION_ON_RUNING')	OR define('PERMISSION_PLAYER_PROMOTION_ON_RUNING',158);
defined('PERMISSION_DEPOSIT_OFFLINE_NOTICE')		OR define('PERMISSION_DEPOSIT_OFFLINE_NOTICE',159);
defined('PERMISSION_DEPOSIT_ONLINE_NOTICE')			OR define('PERMISSION_DEPOSIT_ONLINE_NOTICE',160);
defined('PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE')	OR define('PERMISSION_DEPOSIT_CREDIT_CARD_NOTICE',161);
defined('PERMISSION_DEPOSIT_HYPERMARKET_NOTICE')	OR define('PERMISSION_DEPOSIT_HYPERMARKET_NOTICE',162);
defined('PERMISSION_WITHDRAWAL_OFFLINE_NOTICE')		OR define('PERMISSION_WITHDRAWAL_OFFLINE_NOTICE',163);
defined('PERMISSION_RISK_MANAGEMENT')				OR define('PERMISSION_RISK_MANAGEMENT',164);
defined('PERMISSION_FINGERPRINT_MANAGEMENT')		OR define('PERMISSION_FINGERPRINT_MANAGEMENT',165);
defined('PERMISSION_LEVEL_MANAGEMENT')				OR define('PERMISSION_LEVEL_MANAGEMENT',166);
defined('PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT')		OR define('PERMISSION_DEPOSIT_OFFLINE_ANNOUNCEMENT',167);
defined('PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT')		OR define('PERMISSION_DEPOSIT_ONLINE_ANNOUNCEMENT',168);
defined('PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT')	OR define('PERMISSION_DEPOSIT_CREDIT_CARD_ANNOUNCEMENT',169);
defined('PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT')	OR define('PERMISSION_DEPOSIT_HYPERMARKET_ANNOUNCEMENT',170);
defined('PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT')	OR define('PERMISSION_WITHDRAWAL_OFFLINE_ANNOUNCEMENT',171);
defined('PERMISSION_CURRENCIES_ADD')					OR define('PERMISSION_CURRENCIES_ADD', 172);
defined('PERMISSION_CURRENCIES_UPDATE')					OR define('PERMISSION_CURRENCIES_UPDATE', 173);
defined('PERMISSION_CURRENCIES_VIEW')					OR define('PERMISSION_CURRENCIES_VIEW', 174);
defined('PERMISSION_CURRENCIES_DELETE')					OR define('PERMISSION_CURRENCIES_DELETE', 175);
defined('PERMISSION_DEPOSIT_APPROVE_ADD')				OR define('PERMISSION_DEPOSIT_APPROVE_ADD',176);
defined('PERMISSION_WITHDRAWAL_APPROVE_ADD')			OR define('PERMISSION_WITHDRAWAL_APPROVE_ADD',177);
defined('PERMISSION_SYSTEM_EMAIL')					    OR define('PERMISSION_SYSTEM_EMAIL', 178);
defined('PERMISSION_DEPOSIT_RECEIPT')					OR define('PERMISSION_DEPOSIT_RECEIPT',179);
defined('PERMISSION_ADJUST_PLAYER_TURNOVER')			OR define('PERMISSION_ADJUST_PLAYER_TURNOVER',180);
defined('PERMISSION_VIEW_PLAYER_TURNOVER')				OR define('PERMISSION_VIEW_PLAYER_TURNOVER',181);
defined('PERMISSION_VIEW_LUCKY_4D_ADD')					OR define('PERMISSION_VIEW_LUCKY_4D_ADD',182);
defined('PERMISSION_VIEW_LUCKY_4D_UPDATE')				OR define('PERMISSION_VIEW_LUCKY_4D_UPDATE',183);
defined('PERMISSION_VIEW_LUCKY_4D_VIEW')				OR define('PERMISSION_VIEW_LUCKY_4D_VIEW',184);
defined('PERMISSION_VIEW_LUCKY_4D_DELETE')				OR define('PERMISSION_VIEW_LUCKY_4D_DELETE',185);
defined('PERMISSION_VIEW_LUCKY_4D_TIME_ADD')			OR define('PERMISSION_VIEW_LUCKY_4D_TIME_ADD',186);
defined('PERMISSION_VIEW_LUCKY_4D_TIME_UPDATE')			OR define('PERMISSION_VIEW_LUCKY_4D_TIME_UPDATE',187);
defined('PERMISSION_VIEW_LUCKY_4D_TIME_VIEW')			OR define('PERMISSION_VIEW_LUCKY_4D_TIME_VIEW',188);
defined('PERMISSION_VIEW_LUCKY_4D_TIME_DELETE')			OR define('PERMISSION_VIEW_LUCKY_4D_TIME_DELETE',189);
defined('PERMISSION_VIEW_SCOREBOARD_ADD')				OR define('PERMISSION_VIEW_SCOREBOARD_ADD',190);
defined('PERMISSION_VIEW_SCOREBOARD_UPDATE')			OR define('PERMISSION_VIEW_SCOREBOARD_UPDATE',191);
defined('PERMISSION_VIEW_SCOREBOARD_VIEW')				OR define('PERMISSION_VIEW_SCOREBOARD_VIEW',192);
defined('PERMISSION_VIEW_SCOREBOARD_DELETE')			OR define('PERMISSION_VIEW_SCOREBOARD_DELETE',193);
defined('PERMISSION_PROMOTION_TURNOBER_REPORT')			OR define('PERMISSION_PROMOTION_TURNOBER_REPORT',194);
defined('PERMISSION_BLACKLIST_ADD')						OR define('PERMISSION_BLACKLIST_ADD',195);
defined('PERMISSION_BLACKLIST_UPDATE')					OR define('PERMISSION_BLACKLIST_UPDATE',196);
defined('PERMISSION_BLACKLIST_VIEW')					OR define('PERMISSION_BLACKLIST_VIEW',197);
defined('PERMISSION_BLACKLIST_DELETE')					OR define('PERMISSION_BLACKLIST_DELETE',198);
defined('PERMISSION_BLACKLIST_REPORT')					OR define('PERMISSION_BLACKLIST_REPORT',199);
defined('PERMISSION_PLAYER_WALLET_LOCK')				OR define('PERMISSION_PLAYER_WALLET_LOCK',200);
defined('PERMISSION_PLAYER_REMARK_VIEW')				OR define('PERMISSION_PLAYER_REMARK_VIEW',201);
defined('PERMISSION_PLAYER_REMARK_UPDATE')				OR define('PERMISSION_PLAYER_REMARK_UPDATE',202);
defined('PERMISSION_AFFILIATE_SUMMARY_VIEW')			OR define('PERMISSION_AFFILIATE_SUMMARY_VIEW',203);
defined('PERMISSION_AFFILIATE_SUMMARY_RECORD_VIEW')		OR define('PERMISSION_AFFILIATE_SUMMARY_RECORD_VIEW',204);
defined('PERMISSION_AFFILIATE_BONUS_VIEW')				OR define('PERMISSION_AFFILIATE_BONUS_VIEW',205);
defined('PERMISSION_AFFILIATE_BONUS_UPDATE')			OR define('PERMISSION_AFFILIATE_BONUS_UPDATE',206);
defined('PERMISSION_MISCELLANEOUS_REBATE_UPDATE')		OR define('PERMISSION_MISCELLANEOUS_REBATE_UPDATE',207);
defined('PERMISSION_AFFILIATE_SETTING_UPDATE')			OR define('PERMISSION_AFFILIATE_SETTING_UPDATE',208);
defined('PERMISSION_USER_ADD_PLAYER')					OR define('PERMISSION_USER_ADD_PLAYER', 209);
defined('PERMISSION_AGENT_SUMMARY_VIEW')				OR define('PERMISSION_AGENT_SUMMARY_VIEW',210);
defined('PERMISSION_AGENT_SUMMARY_RECORD_VIEW')			OR define('PERMISSION_AGENT_SUMMARY_RECORD_VIEW',211);
defined('PERMISSION_AGENT_BONUS_VIEW')					OR define('PERMISSION_AGENT_BONUS_VIEW',212);
defined('PERMISSION_AGENT_BONUS_UPDATE')				OR define('PERMISSION_AGENT_BONUS_UPDATE',213);
defined('PERMISSION_AGENT_SETTING_UPDATE')				OR define('PERMISSION_AGENT_SETTING_UPDATE',214);
defined('PERMISSION_GAME_TRANSACTION_REPORT')			OR define('PERMISSION_GAME_TRANSACTION_REPORT',215);
defined('PERMISSION_REBATE_TRANSACTION_REPORT')			OR define('PERMISSION_REBATE_TRANSACTION_REPORT',216);
defined('PERMISSION_REBATE_VIEW')						OR define('PERMISSION_REBATE_VIEW',217);
defined('PERMISSION_REBATE_UPDATE')						OR define('PERMISSION_REBATE_UPDATE',218);
defined('PERMISSION_PLAYER_VOUCHER_ADJUSTMENT')			OR define('PERMISSION_PLAYER_VOUCHER_ADJUSTMENT',219);
defined('PERMISSION_4D_SUMMARY_VIEW')			        OR define('PERMISSION_4D_SUMMARY_VIEW',220);
defined('PERMISSION_4D_SUMMARY_RECORD_VIEW')		    OR define('PERMISSION_4D_SUMMARY_RECORD_VIEW',221);
defined('PERMISSION_4D_BONUS_VIEW')			        	OR define('PERMISSION_4D_BONUS_VIEW',222);
defined('PERMISSION_4D_BONUS_UPDATE')                   OR define('PERMISSION_4D_BONUS_UPDATE',223);
defined('PERMISSION_4D_SETTING_UPDATE')			        OR define('PERMISSION_4D_SETTING_UPDATE',224);
defined('PERMISSION_4D_SETTING_UPDATE')			        OR define('PERMISSION_4D_SETTING_UPDATE',224);
defined('PERMISSION_4D_SETTING_UPDATE')			        OR define('PERMISSION_4D_SETTING_UPDATE',224);
defined('PERMISSION_PLAYER_GAME_POINT_ADJUSTMENT')		OR define('PERMISSION_PLAYER_GAME_POINT_ADJUSTMENT', 225);
defined('PERMISSION_BLACKLIST_IMPORT_VIEW')				OR define('PERMISSION_BLACKLIST_IMPORT_VIEW',226);
defined('PERMISSION_BLACKLIST_IMPORT_ADD')				OR define('PERMISSION_BLACKLIST_IMPORT_ADD',227);
defined('PERMISSION_BLACKLIST_IMPORT_UPDATE')			OR define('PERMISSION_BLACKLIST_IMPORT_UPDATE',228);
defined('PERMISSION_BLACKLIST_IMPORT_DELETE')			OR define('PERMISSION_BLACKLIST_IMPORT_DELETE',229);
defined('PERMISSION_DEPOSIT_UPDATE_REMARK')				OR define('PERMISSION_DEPOSIT_UPDATE_REMARK',230);
defined('PERMISSION_WITHDRAWAL_UPDATE_REMARK')			OR define('PERMISSION_WITHDRAWAL_UPDATE_REMARK',231);
defined('PERMISSION_WHITELIST_ADD')						OR define('PERMISSION_WHITELIST_ADD',232);
defined('PERMISSION_WHITELIST_UPDATE')					OR define('PERMISSION_WHITELIST_UPDATE',233);
defined('PERMISSION_WHITELIST_VIEW')					OR define('PERMISSION_WHITELIST_VIEW',234);
defined('PERMISSION_WHITELIST_DELETE')					OR define('PERMISSION_WHITELIST_DELETE',235);
defined('PERMISSION_TRANSACTION_PENDING_ANNOUNCEMENT')	OR define('PERMISSION_TRANSACTION_PENDING_ANNOUNCEMENT',236);
defined('PERMISSION_BLACKLIST_ANNOUNCEMENT')			OR define('PERMISSION_BLACKLIST_ANNOUNCEMENT',237);
defined('PERMISSION_BLOG_ADD')							OR define('PERMISSION_BLOG_ADD',238);
defined('PERMISSION_BLOG_UPDATE')						OR define('PERMISSION_BLOG_UPDATE',239);
defined('PERMISSION_BLOG_VIEW')							OR define('PERMISSION_BLOG_VIEW',240);
defined('PERMISSION_BLOG_DELETE')						OR define('PERMISSION_BLOG_DELETE',241);
defined('PERMISSION_USER_ROLE_ADD')						OR define('PERMISSION_USER_ROLE_ADD',242);
defined('PERMISSION_USER_ROLE_UPDATE')					OR define('PERMISSION_USER_ROLE_UPDATE',243);
defined('PERMISSION_USER_ROLE_VIEW')					OR define('PERMISSION_USER_ROLE_VIEW',244);
defined('PERMISSION_USER_ROLE_DELETE')					OR define('PERMISSION_USER_ROLE_DELETE',245);
defined('PERMISSION_BLOG_CATEGORY_ADD')					OR define('PERMISSION_BLOG_CATEGORY_ADD',246);
defined('PERMISSION_BLOG_CATEGORY_UPDATE')				OR define('PERMISSION_BLOG_CATEGORY_UPDATE',247);
defined('PERMISSION_BLOG_CATEGORY_VIEW')				OR define('PERMISSION_BLOG_CATEGORY_VIEW',248);
defined('PERMISSION_BLOG_CATEGORY_DELETE')				OR define('PERMISSION_BLOG_CATEGORY_DELETE',249);
defined('PERMISSION_BLOG_FRONTEND_VIEW')				OR define('PERMISSION_BLOG_FRONTEND_VIEW',250);
defined('PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO')		OR define('PERMISSION_PLAYER_UPDATE_ADDITIONAL_INFO',251);
defined('PERMISSION_PLAYER_BANK_IMAGE')					OR define('PERMISSION_PLAYER_BANK_IMAGE',252);
defined('PERMISSION_WITHDRAWAL_FEE_RATE_ADD')			OR define('PERMISSION_WITHDRAWAL_FEE_RATE_ADD',253);
defined('PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE')		OR define('PERMISSION_WITHDRAWAL_FEE_RATE_UPDATE',254);
defined('PERMISSION_WITHDRAWAL_FEE_RATE_DELETE')		OR define('PERMISSION_WITHDRAWAL_FEE_RATE_DELETE',255);
defined('PERMISSION_WITHDRAWAL_FEE_RATE_VIEW')			OR define('PERMISSION_WITHDRAWAL_FEE_RATE_VIEW',256);
defined('PERMISSION_BLACKLIST_REPORT_UPDATE')			OR define('PERMISSION_BLACKLIST_REPORT_UPDATE',257);
defined('PERMISSION_WIN_LOSS_REPORT_PLAYER')			OR define('PERMISSION_WIN_LOSS_REPORT_PLAYER',258);
defined('PERMISSION_YEARLY_REPORT')						OR define('PERMISSION_YEARLY_REPORT',259);
defined('PERMISSION_HOME')								OR define('PERMISSION_HOME',260);
defined('PERMISSION_PLAYER_MOBILE')						OR define('PERMISSION_PLAYER_MOBILE',261);
defined('PERMISSION_PLAYER_LINE_ID')					OR define('PERMISSION_PLAYER_LINE_ID',262);
defined('PERMISSION_PLAYER_NICKNAME')					OR define('PERMISSION_PLAYER_NICKNAME',263);
defined('PERMISSION_PLAYER_EMAIL')						OR define('PERMISSION_PLAYER_EMAIL',264);
defined('PERMISSION_VIEW_PLAYER_CONTACT_V2')			OR define('PERMISSION_VIEW_PLAYER_CONTACT_V2',265);
defined('PERMISSION_PLAYER_GAME_TRANSFER')				OR define('PERMISSION_PLAYER_GAME_TRANSFER',266);
defined('PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW')	OR define('PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_VIEW',267);
defined('PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD')	OR define('PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_ADD',268);
defined('PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE')OR define('PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_UPDATE',269);
defined('PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE')OR define('PERMISSION_PAYMENT_GATEWAY_MAINTENANCE_DELETE',270);
defined('PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE')OR define('PERMISSION_PLAYER_PROMOTION_TURNOVER_CALCULATE',271);
defined('PERMISSION_PLAYER_AGENT_VIEW')					OR define('PERMISSION_PLAYER_AGENT_VIEW',272);
defined('PERMISSION_PLAYER_AGENT_UPDATE')				OR define('PERMISSION_PLAYER_AGENT_UPDATE',273);
defined('PERMISSION_PLAYER_AGENT_ADD')					OR define('PERMISSION_PLAYER_AGENT_ADD',274);
defined('PERMISSION_GAME_MAINTENANCE_DELETE')			OR define('PERMISSION_GAME_MAINTENANCE_DELETE',275);
defined('PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT')	OR define('PERMISSION_SYSTEM_MESSAGE_USER_VIEW_CONTENT',276);
defined('PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO')		OR define('PERMISSION_PLAYER_UPDATE_ADDITIONAL_DETAIL_INFO',277);
defined('PERMISSION_PLAYER_ACCOUNT_NAME')				OR define('PERMISSION_PLAYER_ACCOUNT_NAME',278);
defined('PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT')	OR define('PERMISSION_PLAYER_WITHDRAWAL_VERIFY_REPORT',279);
defined('PERMISSION_REGISTER_DEPOSIT_RATE_REPORT')		OR define('PERMISSION_REGISTER_DEPOSIT_RATE_REPORT',280);
defined('PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT')	OR define('PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT',281);
defined('PERMISSION_TAG_ADD')							OR define('PERMISSION_TAG_ADD',282);
defined('PERMISSION_TAG_UPDATE')						OR define('PERMISSION_TAG_UPDATE',283);
defined('PERMISSION_TAG_VIEW')							OR define('PERMISSION_TAG_VIEW',284);
defined('PERMISSION_TAG_DELETE')						OR define('PERMISSION_TAG_DELETE',285);
defined('PERMISSION_TAG_PLAYER_ADD')					OR define('PERMISSION_TAG_PLAYER_ADD',286);
defined('PERMISSION_TAG_PLAYER_UPDATE')					OR define('PERMISSION_TAG_PLAYER_UPDATE',287);
defined('PERMISSION_TAG_PLAYER_VIEW')					OR define('PERMISSION_TAG_PLAYER_VIEW',288);
defined('PERMISSION_TAG_PLAYER_DELETE')					OR define('PERMISSION_TAG_PLAYER_DELETE',289);
defined('PERMISSION_TAG_PLAYER_MODIFY')					OR define('PERMISSION_TAG_PLAYER_MODIFY',290);
defined('PERMISSION_TAG_MODIFY')						OR define('PERMISSION_TAG_MODIFY',291);
defined('PERMISSION_TAG_PROCESS_REPORT')				OR define('PERMISSION_TAG_PROCESS_REPORT',292);
defined('PERMISSION_PLAYER_BANK_IMAGE_DELETE')			OR define('PERMISSION_PLAYER_BANK_IMAGE_DELETE',293);
defined('PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT')	OR define('PERMISSION_PLAYER_BANK_IMAGE_ANNOUNCEMENT',294);
defined('PERMISSION_BANK_AGENT_PLAYER_USER_VIEW')		OR define('PERMISSION_BANK_AGENT_PLAYER_USER_VIEW',295);
defined('PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW')			OR define('PERMISSION_AGENT_PLAYER_DEPOSIT_VIEW',296);
defined('PERMISSION_SEO_ADD')							OR define('PERMISSION_SEO_ADD',297);
defined('PERMISSION_SEO_DELETE')						OR define('PERMISSION_SEO_DELETE',298);
defined('PERMISSION_PLAYER_PROMOTION_BULK_ADD')			OR define('PERMISSION_PLAYER_PROMOTION_BULK_ADD', 299);
defined('PERMISSION_PLAYER_PROMOTION_BULK_UPDATE')		OR define('PERMISSION_PLAYER_PROMOTION_BULK_UPDATE', 300);
defined('PERMISSION_CONTENT_ADD')						OR define('PERMISSION_CONTENT_ADD',301);
defined('PERMISSION_CONTENT_UPDATE')					OR define('PERMISSION_CONTENT_UPDATE',302);
defined('PERMISSION_CONTENT_VIEW')						OR define('PERMISSION_CONTENT_VIEW',303);
defined('PERMISSION_CONTENT_DELETE')					OR define('PERMISSION_CONTENT_DELETE',304);
defined('PERMISSION_CONTENT_FRONTEND_VIEW')				OR define('PERMISSION_CONTENT_FRONTEND_VIEW',305);
defined('PERMISSION_DEPOSIT_VIEW_ALL')					OR define('PERMISSION_DEPOSIT_VIEW_ALL',306);
defined('PERMISSION_WITHDRAWAL_VIEW_ALL')				OR define('PERMISSION_WITHDRAWAL_VIEW_ALL',307);
defined('PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD')		OR define('PERMISSION_PAYMENT_GATEWAY_LIMITED_ADD',308);
defined('PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE')	OR define('PERMISSION_PAYMENT_GATEWAY_LIMITED_UPDATE',309);
defined('PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW')		OR define('PERMISSION_PAYMENT_GATEWAY_LIMITED_VIEW',310);
defined('PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE')	OR define('PERMISSION_PAYMENT_GATEWAY_LIMITED_DELETE',311);
defined('PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD')		OR define('PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD',312);
defined('PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE')		OR define('PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE',313);
defined('PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW')		OR define('PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_VIEW',314);
defined('PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE')		OR define('PERMISSION_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE',315);
defined('PERMISSION_TAG_PLAYER_BULK_MODIFY')					OR define('PERMISSION_TAG_PLAYER_BULK_MODIFY',316);
defined('PERMISSION_BANK_VERIFY_SUBMIT')						OR define('PERMISSION_BANK_VERIFY_SUBMIT',317);
defined('PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE')		OR define('PERMISSION_PLAYER_BANK_WITHDRAWAL_COUNT_UDPATE',318);


defined('PERMISSION_PLAYER_REPORT_EXPORT_EXCEL')			OR define('PERMISSION_PLAYER_REPORT_EXPORT_EXCEL',1001);
defined('PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL')			OR define('PERMISSION_DEPOSIT_REPORT_EXPORT_EXCEL',1002);
defined('PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL')		OR define('PERMISSION_WITHDRAWAL_REPORT_EXPORT_EXCEL',1003);
defined('PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL')	OR define('PERMISSION_WIN_LOSS_PLAYER_REPORT_EXPORT_EXCEL',1004);
defined('PERMISSION_YEARLY_REPORT_EXPORT_EXCEL')			OR define('PERMISSION_YEARLY_REPORT_EXPORT_EXCEL',1005);
defined('PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL')		OR define('PERMISSION_TRANSACTION_REPORT_EXPORT_EXCEL',1006);
defined('PERMISSION_POINT_REPORT_EXPORT_EXCEL')				OR define('PERMISSION_POINT_REPORT_EXPORT_EXCEL',1007);
defined('PERMISSION_CASH_REPORT_EXPORT_EXCEL')				OR define('PERMISSION_CASH_REPORT_EXPORT_EXCEL',1008);
defined('PERMISSION_REWARD_REPORT_EXPORT_EXCEL')			OR define('PERMISSION_REWARD_REPORT_EXPORT_EXCEL',1009);
defined('PERMISSION_VERIFY_REPORT_EXPORT_EXCEL')			OR define('PERMISSION_VERIFY_REPORT_EXPORT_EXCEL',1010);
defined('PERMISSION_WALLET_REPORT_EXPORT_EXCEL')			OR define('PERMISSION_WALLET_REPORT_EXPORT_EXCEL',1011);
defined('PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL')		OR define('PERMISSION_PLAYER_RISK_REPORT_EXPORT_EXCEL',1012);
defined('PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL')		OR define('PERMISSION_PLAYER_LOGIN_REPORT_EXPORT_EXCEL',1013);
defined('PERMISSION_PLAYER_LIST_EXPORT_EXCEL')				OR define('PERMISSION_PLAYER_LIST_EXPORT_EXCEL',1014);
defined('PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL')	OR define('PERMISSION_PLAYER_PROMOTION_LIST_EXPORT_EXCEL',1015);
defined('PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL')			OR define('PERMISSION_WIN_LOSS_REPORT_EXPORT_EXCEL',1016);
defined('PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL')	OR define('PERMISSION_WITHDRAWAL_VERIFY_REPORT_EXPORT_EXCEL',1017);
defined('PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL')	OR define('PERMISSION_REGISTER_DEPOSIT_RATE_REPORT_EXPORT_EXCEL',1018);
defined('PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL')	OR define('PERMISSION_REGISTER_DEPOSIT_RATE_YEARLY_REPORT_EXPORT_EXCEL',1019);
defined('PERMISSION_REPORT_ALL')				            OR define('PERMISSION_REPORT_ALL',9999);
defined('PERMISSION_WIN_LOSS_SUM_REPORT')				    OR define('PERMISSION_WIN_LOSS_SUM_REPORT',60);

/*
|--------------------------------------------------------------------------
| Log Codes
|--------------------------------------------------------------------------
|
| These code are used when working with log.
|
*/
defined('LOG_LOGIN')					OR define('LOG_LOGIN', 1);
defined('LOG_LOGOUT')					OR define('LOG_LOGOUT', 2);
defined('LOG_CHANGE_PASSWORD')			OR define('LOG_CHANGE_PASSWORD', 3);
defined('LOG_MISCELLANEOUS_UPDATE')		OR define('LOG_MISCELLANEOUS_UPDATE', 4);
defined('LOG_CONTACT_UPDATE')			OR define('LOG_CONTACT_UPDATE', 5);
defined('LOG_SEO_UPDATE')				OR define('LOG_SEO_UPDATE', 6);
defined('LOG_GAME_UPDATE')				OR define('LOG_GAME_UPDATE', 7);
defined('LOG_BANNER_ADD')				OR define('LOG_BANNER_ADD', 8);
defined('LOG_BANNER_UPDATE')			OR define('LOG_BANNER_UPDATE', 9);
defined('LOG_BANNER_DELETE')			OR define('LOG_BANNER_DELETE', 10);
defined('LOG_ANNOUNCEMENT_ADD')			OR define('LOG_ANNOUNCEMENT_ADD', 11);
defined('LOG_ANNOUNCEMENT_UPDATE')		OR define('LOG_ANNOUNCEMENT_UPDATE', 12);
defined('LOG_ANNOUNCEMENT_DELETE')		OR define('LOG_ANNOUNCEMENT_DELETE', 13);
defined('LOG_GROUP_ADD')				OR define('LOG_GROUP_ADD', 14);
defined('LOG_GROUP_UPDATE')				OR define('LOG_GROUP_UPDATE', 15);
defined('LOG_GROUP_DELETE')				OR define('LOG_GROUP_DELETE', 16);
defined('LOG_BANK_ADD')					OR define('LOG_BANK_ADD', 17);
defined('LOG_BANK_UPDATE')				OR define('LOG_BANK_UPDATE', 18);
defined('LOG_BANK_DELETE')				OR define('LOG_BANK_DELETE', 19);
defined('LOG_BANK_ACCOUNT_ADD')			OR define('LOG_BANK_ACCOUNT_ADD', 20);
defined('LOG_BANK_ACCOUNT_UPDATE')		OR define('LOG_BANK_ACCOUNT_UPDATE', 21);
defined('LOG_BANK_ACCOUNT_DELETE')		OR define('LOG_BANK_ACCOUNT_DELETE', 22);
defined('LOG_PROMOTION_ADD')			OR define('LOG_PROMOTION_ADD', 23);
defined('LOG_PROMOTION_UPDATE')			OR define('LOG_PROMOTION_UPDATE', 24);
defined('LOG_PROMOTION_DELETE')			OR define('LOG_PROMOTION_DELETE', 25);
defined('LOG_SUB_ACCOUNT_ADD')			OR define('LOG_SUB_ACCOUNT_ADD', 26);
defined('LOG_SUB_ACCOUNT_UPDATE')		OR define('LOG_SUB_ACCOUNT_UPDATE', 27);
defined('LOG_SUB_ACCOUNT_PERMISSION')	OR define('LOG_SUB_ACCOUNT_PERMISSION', 28);
defined('LOG_SUB_ACCOUNT_PASSWORD')		OR define('LOG_SUB_ACCOUNT_PASSWORD', 29);
defined('LOG_USER_ADD')					OR define('LOG_USER_ADD', 30);
defined('LOG_USER_UPDATE')				OR define('LOG_USER_UPDATE', 31);
defined('LOG_USER_PERMISSION')			OR define('LOG_USER_PERMISSION', 32);
defined('LOG_USER_PASSWORD')			OR define('LOG_USER_PASSWORD', 33);
defined('LOG_USER_DEPOSIT_POINT')		OR define('LOG_USER_DEPOSIT_POINT', 34);
defined('LOG_USER_WITHDRAW_POINT')		OR define('LOG_USER_WITHDRAW_POINT', 35);
defined('LOG_PLAYER_ADD')				OR define('LOG_PLAYER_ADD', 36);
defined('LOG_PLAYER_UPDATE')			OR define('LOG_PLAYER_UPDATE', 37);
defined('LOG_PLAYER_PASSWORD')			OR define('LOG_PLAYER_PASSWORD', 38);
defined('LOG_PLAYER_DEPOSIT_POINT')		OR define('LOG_PLAYER_DEPOSIT_POINT', 39);
defined('LOG_PLAYER_WITHDRAW_POINT')	OR define('LOG_PLAYER_WITHDRAW_POINT', 40);
defined('LOG_PLAYER_WALLET_TRANSFER')	OR define('LOG_PLAYER_WALLET_TRANSFER', 41);
defined('LOG_PLAYER_POINT_ADJUSTMENT')	OR define('LOG_PLAYER_POINT_ADJUSTMENT', 42);
defined('LOG_KICK_PLAYER')				OR define('LOG_KICK_PLAYER', 43);
defined('LOG_DEPOSIT_UPDATE')			OR define('LOG_DEPOSIT_UPDATE', 44);
defined('LOG_WITHDRAWAL_UPDATE')		OR define('LOG_WITHDRAWAL_UPDATE', 45);
defined('LOG_PLAYER_PROMOTION_ADD')		OR define('LOG_PLAYER_PROMOTION_ADD', 46);
defined('LOG_PLAYER_PROMOTION_UPDATE')	OR define('LOG_PLAYER_PROMOTION_UPDATE', 47);
defined('LOG_BANK_CHANNEL_ADD')			OR define('LOG_BANK_CHANNEL_ADD', 48);
defined('LOG_BANK_CHANNEL_UPDATE')		OR define('LOG_BANK_CHANNEL_UPDATE', 49);
defined('LOG_BANK_CHANNEL_DELETE')		OR define('LOG_BANK_CHANNEL_DELETE', 50);
defined('LOG_SYSTEM_MESSAGE_ADD')		OR define('LOG_SYSTEM_MESSAGE_ADD', 51);
defined('LOG_SYSTEM_MESSAGE_UPDATE')	OR define('LOG_SYSTEM_MESSAGE_UPDATE', 52);
defined('LOG_SYSTEM_MESSAGE_DELETE')	OR define('LOG_SYSTEM_MESSAGE_DELETE', 53);
defined('LOG_SYSTEM_MESSAGE_USER_ADD')	OR define('LOG_SYSTEM_MESSAGE_USER_ADD', 54);
defined('LOG_SYSTEM_MESSAGE_USER_UPDATE')	OR define('LOG_SYSTEM_MESSAGE_USER_UPDATE', 55);
defined('LOG_SYSTEM_MESSAGE_USER_DELETE')	OR define('LOG_SYSTEM_MESSAGE_USER_DELETE', 56);
defined('LOG_BANK_PLAYER_ADD')				OR define('LOG_BANK_PLAYER_ADD',57);
defined('LOG_BANK_PLAYER_UPDATE')			OR define('LOG_BANK_PLAYER_UPDATE',58);
defined('LOG_BANK_PLAYER_DELETE')			OR define('LOG_BANK_PLAYER_DELETE',59);
defined('LOG_BANK_PLAYER_USER_ADD')			OR define('LOG_BANK_PLAYER_USER_ADD',60);
defined('LOG_BANK_PLAYER_USER_UPDATE')		OR define('LOG_BANK_PLAYER_USER_UPDATE',61);
defined('LOG_BANK_PLAYER_USER_DELETE')		OR define('LOG_BANK_PLAYER_USER_DELETE',62);
defined('LOG_LEVEL_ADD')					OR define('LOG_LEVEL_ADD',63);
defined('LOG_LEVEL_UPDATE')					OR define('LOG_LEVEL_UPDATE',64);
defined('LOG_LEVEL_DELETE')					OR define('LOG_LEVEL_DELETE',65);
defined('LOG_AVATAR_ADD')					OR define('LOG_AVATAR_ADD',66);
defined('LOG_AVATAR_UPDATE')				OR define('LOG_AVATAR_UPDATE',67);
defined('LOG_AVATAR_DELETE')				OR define('LOG_AVATAR_DELETE',68);
defined('LOG_BONUS_ADD')					OR define('LOG_BONUS_ADD', 69);
defined('LOG_BONUS_UPDATE')					OR define('LOG_BONUS_UPDATE', 70);
defined('LOG_BONUS_DELETE')					OR define('LOG_BONUS_DELETE', 71);
defined('LOG_PLAYER_BONUS_ADD')				OR define('LOG_PLAYER_BONUS_ADD', 72);
defined('LOG_PLAYER_BONUS_UPDATE')			OR define('LOG_PLAYER_BONUS_UPDATE', 73);
defined('LOG_PLAYER_BONUS_DELETE')			OR define('LOG_PLAYER_BONUS_DELETE', 74);
defined('LOG_MATCH_ADD')					OR define('LOG_MATCH_ADD', 75);
defined('LOG_MATCH_UPDATE')					OR define('LOG_MATCH_UPDATE', 76);
defined('LOG_MATCH_DELETE')					OR define('LOG_MATCH_DELETE', 77);
defined('LOG_LEVEL_BATCH_APPROVE')			OR define('LOG_LEVEL_BATCH_APPROVE', 78);
defined('LOG_LEVEL_SINGLE_APPROVE')			OR define('LOG_LEVEL_SINGLE_APPROVE', 79);
defined('LOG_LEVEL_SINGLE_REJECT')			OR define('LOG_LEVEL_SINGLE_REJECT', 80);
defined('LOG_REWARD_ADD')					OR define('LOG_REWARD_ADD', 81);
defined('LOG_REWARD_UPDATE')				OR define('LOG_REWARD_UPDATE', 82);
defined('LOG_REWARD_DEDUCT')				OR define('LOG_REWARD_DEDUCT', 83);
defined('LOG_LEVEL_EXECUTE_ADD')			OR define('LOG_LEVEL_EXECUTE_ADD', 84);
defined('LOG_PAYMENT_GATEWAY_UPDATE')		OR define('LOG_PAYMENT_GATEWAY_UPDATE', 85);
defined('LOG_GAME_MAINTENANCE_ADD')			OR define('LOG_GAME_MAINTENANCE_ADD', 86);
defined('LOG_GAME_MAINTENANCE_UPDATE')		OR define('LOG_GAME_MAINTENANCE_UPDATE', 87);
defined('LOG_WALLET_TRANSFER')				OR define('LOG_WALLET_TRANSFER', 88);
defined('LOG_WALLET_TRANSFER_PENDING')		OR define('LOG_WALLET_TRANSFER_PENDING', 89);
defined('LOG_DEPOSIT_ADD')					OR define('LOG_DEPOSIT_ADD', 90);
defined('LOG_WITHDRAWAL_ADD')				OR define('LOG_WITHDRAWAL_ADD', 91);
defined('LOG_CURRENCIES_ADD')				OR define('LOG_CURRENCIES_ADD', 92);
defined('LOG_CURRENCIES_UPDATE')			OR define('LOG_CURRENCIES_UPDATE', 93);
defined('LOG_CURRENCIES_DELETE')			OR define('LOG_CURRENCIES_DELETE', 94);
defined('LOG_WITHDRAWAL_APPROVE_ADD')		OR define('LOG_WITHDRAWAL_APPROVE_ADD', 95);
defined('LOG_DEPOSIT_APPROVE_ADD')			OR define('LOG_DEPOSIT_APPROVE_ADD', 96);
defined('LOG_UPDATE_TURNOVER')				OR define('LOG_UPDATE_TURNOVER', 97);
defined('LOG_RESET_TURNOVER')				OR define('LOG_RESET_TURNOVER', 98);
defined('LOG_PLAYER_TURNOVER_ADJUSTMENT')	OR define('LOG_PLAYER_TURNOVER_ADJUSTMENT', 99);
defined('LOG_LUCKY_4D_ADD')				    OR define('LOG_LUCKY_4D_ADD', 100);
defined('LOG_LUCKY_4D_UPDATE')			    OR define('LOG_LUCKY_4D_UPDATE', 101);
defined('LOG_LUCKY_4D_DELETE')			    OR define('LOG_LUCKY_4D_DELETE', 102);
defined('LOG_LUCKY_4D_TIME_ADD')			OR define('LOG_LUCKY_4D_TIME_ADD', 103);
defined('LOG_LUCKY_4D_TIME_UPDATE')			OR define('LOG_LUCKY_4D_TIME_UPDATE', 104);
defined('LOG_LUCKY_4D_TIME_DELETE')			OR define('LOG_LUCKY_4D_TIME_DELETE', 105);
defined('LOG_SCOREBOARD_ADD')				OR define('LOG_SCOREBOARD_ADD', 106);
defined('LOG_SCOREBOARD_UPDATE')			OR define('LOG_SCOREBOARD_UPDATE', 107);
defined('LOG_SCOREBOARD_DELETE')			OR define('LOG_SCOREBOARD_DELETE', 108);
defined('LOG_BLACKLIST_ADD')				OR define('LOG_BLACKLIST_ADD', 109);
defined('LOG_BLACKLIST_UPDATE')				OR define('LOG_BLACKLIST_UPDATE', 110);
defined('LOG_BLACKLIST_DELETE')				OR define('LOG_BLACKLIST_DELETE', 111);
defined('LOG_AFFILIATE_BONUS_UPDATE')		OR define('LOG_AFFILIATE_BONUS_UPDATE', 112);
defined('LOG_AFFILIATE_BONUS_SETTING_UPDATE')		OR define('LOG_AFFILIATE_BONUS_SETTING_UPDATE', 113);
defined('LOG_AGENT_BONUS_UPDATE')					OR define('LOG_AGENT_BONUS_UPDATE', 114);
defined('LOG_AGENT_BONUS_SETTING_UPDATE')	OR define('LOG_AGENT_BONUS_SETTING_UPDATE', 115);
defined('LOG_PLAYER_VOUCHER_ADJUSTMENT')	OR define('LOG_PLAYER_VOUCHER_ADJUSTMENT', 116);
defined('LOG_BLACKLIST_IMPORT_ADD')			OR define('LOG_BLACKLIST_IMPORT_ADD', 117);
defined('LOG_BLACKLIST_IMPORT_UPDATE')		OR define('LOG_BLACKLIST_IMPORT_UPDATE', 118);
defined('LOG_BLACKLIST_IMPORT_DELETE')		OR define('LOG_BLACKLIST_IMPORT_DELETE', 119);
defined('LOG_DEPOSIT_UPDATE_REMARK')			OR define('LOG_DEPOSIT_UPDATE_REMARK',120);
defined('LOG_WITHDRAWAL_UPDATE_REMARK')			OR define('LOG_WITHDRAWAL_UPDATE_REMARK',121);
defined('LOG_PLAYER_GAME_POINT_ADJUSTMENT')	OR define('LOG_PLAYER_GAME_POINT_ADJUSTMENT', 122);
defined('LOG_WHITELIST_ADD')				OR define('LOG_WHITELIST_ADD', 123);
defined('LOG_WHITELIST_UPDATE')				OR define('LOG_WHITELIST_UPDATE', 124);
defined('LOG_WHITELIST_DELETE')				OR define('LOG_WHITELIST_DELETE', 125);
defined('LOG_BLOG_ADD')					OR define('LOG_BLOG_ADD', 126);
defined('LOG_BLOG_UPDATE')				OR define('LOG_BLOG_UPDATE', 127);
defined('LOG_BLOG_DELETE')				OR define('LOG_BLOG_DELETE', 128);
defined('LOG_BLOG_CATEGORY_ADD')		OR define('LOG_BLOG_CATEGORY_ADD', 129);
defined('LOG_BLOG_CATEGORY_UPDATE')		OR define('LOG_BLOG_CATEGORY_UPDATE', 130);
defined('LOG_BLOG_CATEGORY_DELETE')		OR define('LOG_BLOG_CATEGORY_DELETE', 131);
defined('LOG_PLAYER_UPDATE_ADDITIONAL_INFO')	OR define('LOG_PLAYER_UPDATE_ADDITIONAL_INFO', 132);
defined('LOG_WITHDRAWAL_FEE_RATE_ADD')		OR define('LOG_WITHDRAWAL_FEE_RATE_ADD', 133);
defined('LOG_WITHDRAWAL_FEE_RATE_UPDATE')	OR define('LOG_WITHDRAWAL_FEE_RATE_UPDATE', 134);
defined('LOG_WITHDRAWAL_FEE_RATE_DELETE')	OR define('LOG_WITHDRAWAL_FEE_RATE_DELETE', 135);
defined('LOG_BLACKLIST_REPORT_UPDATE')				OR define('LOG_BLACKLIST_REPORT_UPDATE', 136);
defined('LOG_PAYMENT_GATEWAY_MAINTENANCE_ADD')			OR define('LOG_PAYMENT_GATEWAY_MAINTENANCE_ADD', 137);
defined('LOG_PAYMENT_GATEWAY_MAINTENANCE_UPDATE')		OR define('LOG_PAYMENT_GATEWAY_MAINTENANCE_UPDATE', 138);
defined('LOG_PAYMENT_GATEWAY_MAINTENANCE_DELETE')		OR define('LOG_PAYMENT_GATEWAY_MAINTENANCE_DELETE', 139);
defined('LOG_GAME_MAINTENANCE_DELETE')					OR define('LOG_GAME_MAINTENANCE_DELETE', 140);
defined('LOG_USER_ROLE_ADD')							OR define('LOG_USER_ROLE_ADD', 141);
defined('LOG_USER_ROLE_UPDATE')							OR define('LOG_USER_ROLE_UPDATE', 142);
defined('LOG_USER_ROLE_DELETE')							OR define('LOG_USER_ROLE_DELETE', 143);
defined('LOG_TAG_ADD')									OR define('LOG_TAG_ADD', 144);
defined('LOG_TAG_UPDATE')								OR define('LOG_TAG_UPDATE', 145);
defined('LOG_TAG_DELETE')								OR define('LOG_TAG_DELETE', 146);
defined('LOG_TAG_PLAYER_ADD')							OR define('LOG_TAG_PLAYER_ADD', 147);
defined('LOG_TAG_PLAYER_UPDATE')						OR define('LOG_TAG_PLAYER_UPDATE', 148);
defined('LOG_TAG_PLAYER_DELETE')						OR define('LOG_TAG_PLAYER_DELETE', 149);
defined('LOG_TAG_PLAYER_MODIFY')						OR define('LOG_TAG_PLAYER_MODIFY', 150);
defined('LOG_TAG_MODIFY')								OR define('LOG_TAG_MODIFY', 151);
defined('LOG_PLAYER_BANK_IMAGE_ANNOUNCEMENT_UPDATE')	OR define('LOG_PLAYER_BANK_IMAGE_ANNOUNCEMENT_UPDATE', 152);
defined('LOG_SEO_ADD')									OR define('LOG_SEO_ADD', 153);
defined('LOG_SEO_DELETE')								OR define('LOG_SEO_DELETE', 154);
defined('LOG_CONTENT_ADD')								OR define('LOG_CONTENT_ADD', 155);
defined('LOG_CONTENT_UPDATE')							OR define('LOG_CONTENT_UPDATE', 156);
defined('LOG_CONTENT_DELETE')							OR define('LOG_CONTENT_DELETE', 157);
defined('LOG_PAYMENT_GATEWAY_LIMITED_ADD')				OR define('LOG_PAYMENT_GATEWAY_LIMITED_ADD', 158);
defined('LOG_PAYMENT_GATEWAY_LIMITED_UPDATE')			OR define('LOG_PAYMENT_GATEWAY_LIMITED_UPDATE', 159);
defined('LOG_PAYMENT_GATEWAY_LIMITED_DELETE')			OR define('LOG_PAYMENT_GATEWAY_LIMITED_DELETE', 160);
defined('LOG_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD')		OR define('LOG_PAYMENT_GATEWAY_PLAYER_LIMITED_ADD', 161);
defined('LOG_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE')	OR define('LOG_PAYMENT_GATEWAY_PLAYER_LIMITED_UPDATE', 162);
defined('LOG_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE')	OR define('LOG_PAYMENT_GATEWAY_PLAYER_LIMITED_DELETE', 163);
defined('LOG_TAG_PLAYER_BULK_MODIFY')					OR define('LOG_TAG_PLAYER_BULK_MODIFY', 164);
defined('LOG_PLAYER_BANK_WITHDRAWAL_COUNT_UPDATEY')		OR define('LOG_PLAYER_BANK_WITHDRAWAL_COUNT_UPDATEY', 165);

/*
|--------------------------------------------------------------------------
| Blacklist Codes
|--------------------------------------------------------------------------
|
| These code are used when working with permission.
|
*/
defined('BLACKLIST_BANK_ACCOUNT')			OR define('BLACKLIST_BANK_ACCOUNT', 1);
defined('BLACKLIST_BANK_NAME')				OR define('BLACKLIST_BANK_NAME', 2);
defined('BLACKLIST_IP')						OR define('BLACKLIST_IP', 3);
defined('BLACKLIST_PHONE_NUMBER')			OR define('BLACKLIST_PHONE_NUMBER', 4);
defined('BLACKLIST_LINE_NUMBER')			OR define('BLACKLIST_LINE_NUMBER', 5);

/*
|--------------------------------------------------------------------------
| Blacklist Codes
|--------------------------------------------------------------------------
|
| These code are used when working with permission.
|
*/
defined('AFFILIATE_BONUS_TYPE_LEADER_BONUS')	OR define('AFFILIATE_BONUS_TYPE_LEADER_BONUS', 1);
defined('AFFILIATE_BONUS_TYPE_INTRO_BONUS')		OR define('AFFILIATE_BONUS_TYPE_INTRO_BONUS', 2);
defined('AFFILIATE_BONUS_TYPE_DAILY_BONUS')		OR define('AFFILIATE_BONUS_TYPE_DAILY_BONUS', 3);
defined('AFFILIATE_BONUS_TYPE_AGENT_BONUS')		OR define('AFFILIATE_BONUS_TYPE_AGENT_BONUS', 4);

/*
|--------------------------------------------------------------------------
| Payment Gateway Type
|--------------------------------------------------------------------------
|
| These setting are used when working with system.
|
*/
defined('PAYMENT_GATEWAY_RATE_TYPE_AMOUNT')			OR define('PAYMENT_GATEWAY_RATE_TYPE_AMOUNT', 1);
defined('PAYMENT_GATEWAY_RATE_TYPE_AMOUNT_RATE')	OR define('PAYMENT_GATEWAY_RATE_TYPE_AMOUNT_RATE', 2);

/*
|--------------------------------------------------------------------------
| Payment Gateway Type
|--------------------------------------------------------------------------
|
| These setting are used when working with system.
|
*/
defined('BLOG_DISPLAY_BLOG')	OR define('BLOG_DISPLAY_BLOG', 1);
defined('BLOG_DISPLAY_PAGE')	OR define('BLOG_DISPLAY_PAGE', 2);
defined('BLOG_DISPLAY_PRODUCT')	OR define('BLOG_DISPLAY_PRODUCT', 3);

defined('PAGE_HOME')				OR define('PAGE_HOME', 1);
defined('PAGE_SPORTSBOOK')			OR define('PAGE_SPORTSBOOK', 2);
defined('PAGE_ESPORTS')				OR define('PAGE_ESPORTS', 3);
defined('PAGE_LIVE_CASINO')			OR define('PAGE_LIVE_CASINO', 4);
defined('PAGE_SLOTS')				OR define('PAGE_SLOTS', 5);
defined('PAGE_FISHING')				OR define('PAGE_FISHING', 6);
defined('PAGE_ARCADE')				OR define('PAGE_ARCADE', 7);
defined('PAGE_BOARD_GAME')			OR define('PAGE_BOARD_GAME', 8);
defined('PAGE_LOTTERY')				OR define('PAGE_LOTTERY', 9);
defined('PAGE_POKER')				OR define('PAGE_POKER', 10);
defined('PAGE_PROMOTION')			OR define('PAGE_PROMOTION', 11);
defined('PAGE_ABOUT_US')			OR define('PAGE_ABOUT_US', 12);
defined('PAGE_FAQ')					OR define('PAGE_FAQ', 13);
defined('PAGE_CONTACT_US')			OR define('PAGE_CONTACT_US', 14);
defined('PAGE_TNC')					OR define('PAGE_TNC', 15);
defined('PAGE_RG')					OR define('PAGE_RG', 16);
defined('PAGE_VIP')					OR define('PAGE_VIP', 17);
defined('PAGE_MOVIE')				OR define('PAGE_MOVIE', 18);
defined('PAGE_LOGIN')				OR define('PAGE_LOGIN', 19);
defined('PAGE_REGISTER')			OR define('PAGE_REGISTER', 20);
defined('PAGE_FORGOT_PASSWORD')		OR define('PAGE_FORGOT_PASSWORD', 21);
defined('PAGE_HORSE_RACE')			OR define('PAGE_HORSE_RACE', 22);
defined('PAGE_DEPOSIT')				OR define('PAGE_DEPOSIT', 23);
defined('PAGE_WITHDRAWAL')			OR define('PAGE_WITHDRAWAL', 24);

defined('PAGE_PRODUCT_HOME')				OR define('PAGE_PRODUCT_HOME', 9000001);
defined('PAGE_PRODUCT_BACARRAT')			OR define('PAGE_PRODUCT_BACARRAT', 9000002);
defined('PAGE_PRODUCT_SPORTSBOOK')			OR define('PAGE_PRODUCT_SPORTSBOOK', 9000003);
defined('PAGE_PRODUCT_LOTTERY')				OR define('PAGE_PRODUCT_LOTTERY', 9000004);
defined('PAGE_PRODUCT_BOARD_GAME')			OR define('PAGE_PRODUCT_BOARD_GAME', 9000005);
defined('PAGE_PRODUCT_SLOTS')				OR define('PAGE_PRODUCT_SLOTS', 9000006);
defined('PAGE_PRODUCT_FISHING')				OR define('PAGE_PRODUCT_FISHING', 9000007);
defined('PAGE_PRODUCT_KALI_BACARRAT')		OR define('PAGE_PRODUCT_KALI_BACARRAT', 1);
defined('PAGE_PRODUCT_AB_BACARRAT')			OR define('PAGE_PRODUCT_AB_BACARRAT', 2);
defined('PAGE_PRODUCT_DG_BACARRAT')			OR define('PAGE_PRODUCT_DG_BACARRAT', 3);
defined('PAGE_PRODUCT_WM_BACARRAT')			OR define('PAGE_PRODUCT_WM_BACARRAT', 4);
defined('PAGE_PRODUCT_SA_BACARRAT')			OR define('PAGE_PRODUCT_SA_BACARRAT', 5);
defined('PAGE_PRODUCT_OG_BACARRAT')			OR define('PAGE_PRODUCT_OG_BACARRAT', 6);
defined('PAGE_PRODUCT_OB_BACARRAT')			OR define('PAGE_PRODUCT_OB_BACARRAT', 7);
defined('PAGE_PRODUCT_BTT_SPORTBOOK')		OR define('PAGE_PRODUCT_BTT_SPORTBOOK', 8);
defined('PAGE_PRODUCT_SP_SPORTBOOK')		OR define('PAGE_PRODUCT_SP_SPORTBOOK', 9);
defined('PAGE_PRODUCT_9K_LOTTERY')			OR define('PAGE_PRODUCT_9K_LOTTERY', 10);
defined('PAGE_PRODUCT_SP_LOTTERY')			OR define('PAGE_PRODUCT_SP_LOTTERY', 11);
defined('PAGE_PRODUCT_RTG_SLOT')			OR define('PAGE_PRODUCT_RTG_SLOT', 12);
defined('PAGE_PRODUCT_DT_SLOT')				OR define('PAGE_PRODUCT_DT_SLOT', 13);
defined('PAGE_PRODUCT_SP_SLOT')				OR define('PAGE_PRODUCT_SP_SLOT', 14);
defined('PAGE_PRODUCT_ICG_SLOT')			OR define('PAGE_PRODUCT_ICG_SLOT', 15);
defined('PAGE_PRODUCT_BNG_SLOT')			OR define('PAGE_PRODUCT_BNG_SLOT', 16);
defined('PAGE_PRODUCT_SUPREME_MAHJONG')		OR define('PAGE_PRODUCT_SUPREME_MAHJONG', 17);
defined('PAGE_PRODUCT_SP_FISHING')			OR define('PAGE_PRODUCT_SP_FISHING', 18);
defined('PAGE_PRODUCT_RTG_FISHING')			OR define('PAGE_PRODUCT_RTG_FISHING', 19);
defined('PAGE_PRODUCT_GR_SLOT')				OR define('PAGE_PRODUCT_GR_SLOT', 20);
defined('PAGE_PRODUCT_RSG_SLOT')			OR define('PAGE_PRODUCT_RSG_SLOT', 21);
defined('PAGE_PRODUCT_BL_BOARD_GAME')   	OR define('PAGE_PRODUCT_BL_BOARD_GAME', 22);
defined('PAGE_PRODUCT_GR_BOARD_GAME')   	OR define('PAGE_PRODUCT_GR_BOARD_GAME', 23);
defined('PAGE_PRODUCT_ICG_FISHING')   		OR define('PAGE_PRODUCT_ICG_FISHING', 24);
defined('PAGE_PRODUCT_GR_FISHING')   		OR define('PAGE_PRODUCT_GR_FISHING', 25);
defined('PAGE_PRODUCT_PNG_SLOT')   			OR define('PAGE_PRODUCT_PNG_SLOT', 26);
defined('PAGE_PRODUCT_FOOTER')   			OR define('PAGE_PRODUCT_FOOTER', 100);

defined('PAGE_PRODUCT_HOME_LINK')				OR define('PAGE_PRODUCT_HOME_LINK', "/casino-news");
defined('PAGE_PRODUCT_BACARRAT_LINK')			OR define('PAGE_PRODUCT_BACARRAT_LINK', "/baccarat");
defined('PAGE_PRODUCT_SPORTSBOOK_LINK')			OR define('PAGE_PRODUCT_SPORTSBOOK_LINK', "/sports");
defined('PAGE_PRODUCT_LOTTERY_LINK')			OR define('PAGE_PRODUCT_LOTTERY_LINK', "/lottery");
defined('PAGE_PRODUCT_BOARD_GAME_LINK')			OR define('PAGE_PRODUCT_BOARD_GAME_LINK', "/card");
defined('PAGE_PRODUCT_SLOTS_LINK')				OR define('PAGE_PRODUCT_SLOTS_LINK', "/slot");
defined('PAGE_PRODUCT_FISHING_LINK')			OR define('PAGE_PRODUCT_FISHING_LINK', "/fish");
defined('PAGE_PRODUCT_KALI_BACARRAT_LINK')		OR define('PAGE_PRODUCT_KALI_BACARRAT_LINK', "/cali-baccarat");
defined('PAGE_PRODUCT_AB_BACARRAT_LINK')		OR define('PAGE_PRODUCT_AB_BACARRAT_LINK', "/allbet-baccarat");
defined('PAGE_PRODUCT_DG_BACARRAT_LINK')		OR define('PAGE_PRODUCT_DG_BACARRAT_LINK', "/dg-baccarat");
defined('PAGE_PRODUCT_WM_BACARRAT_LINK')		OR define('PAGE_PRODUCT_WM_BACARRAT_LINK', "/wm-baccarat");
defined('PAGE_PRODUCT_SA_BACARRAT_LINK')		OR define('PAGE_PRODUCT_SA_BACARRAT_LINK', "/sa-baccarat");
defined('PAGE_PRODUCT_OG_BACARRAT_LINK')		OR define('PAGE_PRODUCT_OG_BACARRAT_LINK', "/og-baccarat");
defined('PAGE_PRODUCT_OB_BACARRAT_LINK')		OR define('PAGE_PRODUCT_OB_BACARRAT_LINK', "/ob-baccarat");
defined('PAGE_PRODUCT_BTT_SPORTBOOK_LINK')		OR define('PAGE_PRODUCT_BTT_SPORTBOOK_LINK', "/918bet-sports");
defined('PAGE_PRODUCT_SP_SPORTBOOK_LINK')		OR define('PAGE_PRODUCT_SP_SPORTBOOK_LINK', "/super-sports");
defined('PAGE_PRODUCT_9K_LOTTERY_LINK')			OR define('PAGE_PRODUCT_9K_LOTTERY_LINK', "/9k-racecar");
defined('PAGE_PRODUCT_SP_LOTTERY_LINK')			OR define('PAGE_PRODUCT_SP_LOTTERY_LINK', "/super-lottery");
defined('PAGE_PRODUCT_RTG_SLOT_LINK')			OR define('PAGE_PRODUCT_RTG_SLOT_LINK', "/rtg-slotgame");
defined('PAGE_PRODUCT_DT_SLOT_LINK')			OR define('PAGE_PRODUCT_DT_SLOT_LINK', "/dtg-slotgame");
defined('PAGE_PRODUCT_SP_SLOT_LINK')			OR define('PAGE_PRODUCT_SP_SLOT_LINK', "/simple-play-slotgame");
defined('PAGE_PRODUCT_ICG_SLOT_LINK')			OR define('PAGE_PRODUCT_ICG_SLOT_LINK', "/bwin-slotgame");
defined('PAGE_PRODUCT_BNG_SLOT_LINK')			OR define('PAGE_PRODUCT_BNG_SLOT_LINK', "/bng-slotgame");
defined('PAGE_PRODUCT_SUPREME_MAHJONG_LINK')	OR define('PAGE_PRODUCT_SUPREME_MAHJONG_LINK', "/supreme-gaming");
defined('PAGE_PRODUCT_SP_FISHING_LINK')			OR define('PAGE_PRODUCT_SP_FISHING_LINK', "/sp-fishing");
defined('PAGE_PRODUCT_RTG_FISHING_LINK')		OR define('PAGE_PRODUCT_RTG_FISHING_LINK', "/rtg-fishing");
defined('PAGE_PRODUCT_GR_SLOT_LINK')			OR define('PAGE_PRODUCT_GR_SLOT_LINK', "/gr-slotgame");
defined('PAGE_PRODUCT_RSG_SLOT_LINK')			OR define('PAGE_PRODUCT_RSG_SLOT_LINK', "/rsg-slotgame");
defined('PAGE_PRODUCT_BL_BOARD_GAME_LINK')   	OR define('PAGE_PRODUCT_BL_BOARD_GAME_LINK', "/royalgaming");
defined('PAGE_PRODUCT_GR_BOARD_GAME_LINK')   	OR define('PAGE_PRODUCT_GR_BOARD_GAME_LINK', "/gr-gaming");
defined('PAGE_PRODUCT_ICG_FISHING_LINK')   		OR define('PAGE_PRODUCT_ICG_FISHING_LINK', "/bwin-fishing");
defined('PAGE_PRODUCT_GR_FISHING_LINK')   		OR define('PAGE_PRODUCT_GR_FISHING_LINK', "/gr-fishing");
defined('PAGE_PRODUCT_PNG_SLOT_LINK')   		OR define('PAGE_PRODUCT_PNG_SLOT_LINK', "/playngo-slotgame");
/*
|--------------------------------------------------------------------------
| Telegram setting
|--------------------------------------------------------------------------
|
| These setting are used when working with system.
|
*/
defined('TELEGRAM_STATUS') OR define('TELEGRAM_STATUS', 0);
defined('TELEGRAM_MONEY_FLOW') OR define('TELEGRAM_MONEY_FLOW', 'MFTELE');
defined('TELEGRAM_TOKEN_MONEY_FLOW') OR define('TELEGRAM_TOKEN_MONEY_FLOW', '5321381949:AAFlG8iMpeAZmAHn7PRAU6txIAvVHVj47dw');
defined('TELEGRAM_CHAT_ID_MONEY_FLOW') OR define('TELEGRAM_CHAT_ID_MONEY_FLOW', '-1001189519475');
defined('TELEGRAM_REGISTER') OR define('TELEGRAM_REGISTER', 'RETELE');
defined('TELEGRAM_TOKEN_REGISTER') OR define('TELEGRAM_TOKEN_REGISTER', '5321381949:AAFlG8iMpeAZmAHn7PRAU6txIAvVHVj47dw');
defined('TELEGRAM_CHAT_ID_REGISTER') OR define('TELEGRAM_CHAT_ID_REGISTER', '-1001452570303');
defined('TELEGRAM_REGISTER_FUNCTION') OR define('TELEGRAM_REGISTER_FUNCTION', 500);
defined('TELEGRAM_FEEDBACK') OR define('TELEGRAM_FEEDBACK', 'FEEDTELE');
defined('TELEGRAM_TOKEN_FEEDBACK') OR define('TELEGRAM_TOKEN_FEEDBACK', '5321381949:AAFlG8iMpeAZmAHn7PRAU6txIAvVHVj47dw');
defined('TELEGRAM_CHAT_ID_FEEDBACK') OR define('TELEGRAM_CHAT_ID_FEEDBACK', '-1001557602134');
defined('TELEGRAM_LOGS') OR define('TELEGRAM_LOGS', 'LOGSTELE');
defined('TELEGRAM_TOKEN_LOGS') OR define('TELEGRAM_TOKEN_LOGS', '5321381949:AAFlG8iMpeAZmAHn7PRAU6txIAvVHVj47dw');
defined('TELEGRAM_CHAT_ID_LOGS') 	OR define('TELEGRAM_CHAT_ID_LOGS', '-1001713458454');
defined('TELEGRAM_RISK') OR define('TELEGRAM_RISK', 'RISKTELE');
defined('TELEGRAM_TOKEN_RISK') OR define('TELEGRAM_TOKEN_RISK', '5321381949:AAFlG8iMpeAZmAHn7PRAU6txIAvVHVj47dw');
defined('TELEGRAM_CHAT_ID_RISK') 	OR define('TELEGRAM_CHAT_ID_RISK', '-1001840004084');

defined('TELEGRAM_FEEDBACK_TYPE_CUSTOMER_SUPPORT') OR define('TELEGRAM_FEEDBACK_TYPE_CUSTOMER_SUPPORT', 1);
defined('TELEGRAM_FEEDBACK_TYPE_DEPOSIT_WITHDRAWAL') OR define('TELEGRAM_FEEDBACK_TYPE_DEPOSIT_WITHDRAWAL', 2);
defined('TELEGRAM_FEEDBACK_TYPE_ACCOUNT') OR define('TELEGRAM_FEEDBACK_TYPE_ACCOUNT', 3);
defined('TELEGRAM_FEEDBACK_TYPE_ERROR_MESSAGE') OR define('TELEGRAM_FEEDBACK_TYPE_ERROR_MESSAGE', 4);
defined('TELEGRAM_FEEDBACK_TYPE_OTHERS') OR define('TELEGRAM_FEEDBACK_TYPE_OTHERS', 5);

defined('TELEGRAM_LOGS_TYPE_CREATE_USER_ACCOUNT') 			OR define('TELEGRAM_LOGS_TYPE_CREATE_USER_ACCOUNT', 1);
defined('TELEGRAM_LOGS_TYPE_CREATE_SUB_ACCOUNT') 			OR define('TELEGRAM_LOGS_TYPE_CREATE_SUB_ACCOUNT', 2);
defined('TELEGRAM_LOGS_TYPE_UPDATE_USER_CHARACTER') 		OR define('TELEGRAM_LOGS_TYPE_UPDATE_USER_CHARACTER', 3);
defined('TELEGRAM_LOGS_TYPE_UPDATE_SUB_ACCOUNT_CHARACTER') 	OR define('TELEGRAM_LOGS_TYPE_UPDATE_SUB_ACCOUNT_CHARACTER', 4);
defined('TELEGRAM_LOGS_TYPE_UPDATE_CHARACTER_PERMISSION') 	OR define('TELEGRAM_LOGS_TYPE_UPDATE_CHARACTER_PERMISSION', 5);
defined('TELEGRAM_LOGS_TYPE_PLAYER_LIST_EXPORT') 			OR define('TELEGRAM_LOGS_TYPE_PLAYER_LIST_EXPORT', 6);
defined('TELEGRAM_LOGS_TYPE_PLAYER_AGENT_LIST_EXPORT') 		OR define('TELEGRAM_LOGS_TYPE_PLAYER_AGENT_LIST_EXPORT', 7);

/*
|--------------------------------------------------------------------------
| Userfile setting
|--------------------------------------------------------------------------
|
| These setting are used when working with system.
|
*/
defined('BANKS_PLAYER_USER_BANK_TYPE_BANK')				OR define('BANKS_PLAYER_USER_BANK_TYPE_BANK', 'bank');
defined('BANKS_PLAYER_USER_BANK_TYPE_CREDIT_CARD')		OR define('BANKS_PLAYER_USER_BANK_TYPE_CREDIT_CARD', 'creditcard');

defined('BANKS_PLAYER_USER_IMAGE_BANK_TYPE_BANK')			OR define('BANKS_PLAYER_USER_IMAGE_BANK_TYPE_BANK', 1);
defined('BANKS_PLAYER_USER_IMAGE_BANK_TYPE_CREDIT_CARD')	OR define('BANKS_PLAYER_USER_IMAGE_BANK_TYPE_CREDIT_CARD', 2);

defined('WITHDRAWAL_RATE_TYPE_FIXED_AMOUNT')	OR define('WITHDRAWAL_RATE_TYPE_FIXED_AMOUNT', 1);
defined('WITHDRAWAL_RATE_TYPE_PERCENT')			OR define('WITHDRAWAL_RATE_TYPE_PERCENT', 2);

/*
|--------------------------------------------------------------------------
| Userfile setting
|--------------------------------------------------------------------------
|
| These setting are used when working with system.
|
*/
defined('YEARLY_REPORT_SETTING_DEPOSIT')		OR define('YEARLY_REPORT_SETTING_DEPOSIT', 1);
defined('YEARLY_REPORT_SETTING_WITHDRAWAL')		OR define('YEARLY_REPORT_SETTING_WITHDRAWAL', 2);
defined('YEARLY_REPORT_SETTING_PROMOTION')		OR define('YEARLY_REPORT_SETTING_PROMOTION', 3);
defined('YEARLY_REPORT_SETTING_TURNOVER')		OR define('YEARLY_REPORT_SETTING_TURNOVER', 4);
defined('YEARLY_REPORT_SETTING_WIN_LOSS')		OR define('YEARLY_REPORT_SETTING_WIN_LOSS', 5);

/*
|--------------------------------------------------------------------------
| Wallet Status
|--------------------------------------------------------------------------
|
| These code are used when working with user.
|
*/
defined('WALLET_UNLOCK')					OR define('WALLET_UNLOCK', 0);
defined('WALLET_LOCK')						OR define('WALLET_LOCK', 1);
/*
|--------------------------------------------------------------------------
| System Message setting
|--------------------------------------------------------------------------
|
| These setting are used when working with system.
|
*/
defined('SYSTEM_MESSAGE_PLATFORM_EN')		OR define('SYSTEM_MESSAGE_PLATFORM_EN', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_CHS') 		OR define('SYSTEM_MESSAGE_PLATFORM_CHS', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_CHT')  	OR define('SYSTEM_MESSAGE_PLATFORM_CHT', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_ID')  		OR define('SYSTEM_MESSAGE_PLATFORM_ID', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_TH')  		OR define('SYSTEM_MESSAGE_PLATFORM_TH', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_VI') 		OR define('SYSTEM_MESSAGE_PLATFORM_VI', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_KM')   	OR define('SYSTEM_MESSAGE_PLATFORM_KM', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_MY')  		OR define('SYSTEM_MESSAGE_PLATFORM_MY', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_MS')  		OR define('SYSTEM_MESSAGE_PLATFORM_MS', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_JA')  		OR define('SYSTEM_MESSAGE_PLATFORM_JA', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_KO')  		OR define('SYSTEM_MESSAGE_PLATFORM_KO', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_BN')  		OR define('SYSTEM_MESSAGE_PLATFORM_BN', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_HI')  		OR define('SYSTEM_MESSAGE_PLATFORM_HI', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_LO')  		OR define('SYSTEM_MESSAGE_PLATFORM_LO', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_TR')  		OR define('SYSTEM_MESSAGE_PLATFORM_TR', 'rrrbets');
defined('SYSTEM_MESSAGE_PLATFORM_NEW_REGISTRATION')  			OR define('SYSTEM_MESSAGE_PLATFORM_NEW_REGISTRATION', 1);
defined('SYSTEM_MESSAGE_PLATFORM_SUCCESS_DEPOSIT')  			OR define('SYSTEM_MESSAGE_PLATFORM_SUCCESS_DEPOSIT', 2);
defined('SYSTEM_MESSAGE_PLATFORM_SUCCESS_WITHDRAWAL')  			OR define('SYSTEM_MESSAGE_PLATFORM_SUCCESS_WITHDRAWAL', 3);
defined('SYSTEM_MESSAGE_PLATFORM_FAILED_WITHDRAWAL')  			OR define('SYSTEM_MESSAGE_PLATFORM_FAILED_WITHDRAWAL', 4);
defined('SYSTEM_MESSAGE_PLATFORM_SUCCESS_PROMOTION')  			OR define('SYSTEM_MESSAGE_PLATFORM_SUCCESS_PROMOTION', 5);
defined('SYSTEM_MESSAGE_PLATFORM_SUCCESS_VERIFY_PLAYER_BANK')  	OR define('SYSTEM_MESSAGE_PLATFORM_SUCCESS_VERIFY_PLAYER_BANK', 6);
defined('SYSTEM_MESSAGE_PLATFORM_FAILED_VERIFY_PLAYER_BANK')  	OR define('SYSTEM_MESSAGE_PLATFORM_FAILED_VERIFY_PLAYER_BANK', 7);
defined('SYSTEM_MESSAGE_PLATFORM_PROMOTION_REBATE')  			OR define('SYSTEM_MESSAGE_PLATFORM_PROMOTION_REBATE', 8);
defined('SYSTEM_MESSAGE_PLATFORM_PROMOTION_LEVEL')  			OR define('SYSTEM_MESSAGE_PLATFORM_PROMOTION_LEVEL', 9);
defined('SYSTEM_MESSAGE_PLATFORM_VIP_ACCOUNT_OPEN')  			OR define('SYSTEM_MESSAGE_PLATFORM_VIP_ACCOUNT_OPEN', 10);
defined('SYSTEM_MESSAGE_PLATFORM_VIP_ACCOUNT_CLOSE')  			OR define('SYSTEM_MESSAGE_PLATFORM_VIP_ACCOUNT_CLOSE', 11);
defined('SYSTEM_MESSAGE_PLATFORM_MAINTENANCE')  				OR define('SYSTEM_MESSAGE_PLATFORM_MAINTENANCE', 12);
defined('SYSTEM_MESSAGE_PLATFORM_PROMOTION')  					OR define('SYSTEM_MESSAGE_PLATFORM_PROMOTION', 13);
defined('SYSTEM_MESSAGE_PLATFORM_ADDITIONAL_DOCUMENT')  		OR define('SYSTEM_MESSAGE_PLATFORM_ADDITIONAL_DOCUMENT', 14);
defined('SYSTEM_MESSAGE_PLATFORM_WM_ACCOUNT')			  		OR define('SYSTEM_MESSAGE_PLATFORM_WM_ACCOUNT', 15);
defined('SYSTEM_MESSAGE_PLATFORM_SUCCESS_VERIFY_PLAYER_CREDIT_CARD')  	OR define('SYSTEM_MESSAGE_PLATFORM_SUCCESS_VERIFY_PLAYER_CREDIT_CARD', 16);
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_USERNAME')			  	OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_USERNAME', "####USERNAME####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_PLATFORM')			  	OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_PLATFORM', "####PLATFORM####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_AMOUNT')			  		OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_AMOUNT', "####AMOUNT####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_PROMOTION_NAME')		 	OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_PROMOTION_NAME', "####PROMOTION_NAME####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_PROMOTION_MULTIPLY')		OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_PROMOTION_MULTIPLY', "####PROMOTION_MULTIPLY####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_REWARD')			  		OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_REWARD', "####REWARD####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_REMARK')			  		OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_REMARK', "####REMARK####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_LEVEL')			  		OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_LEVEL', "####LEVEL####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_VIP_BANK_ACCOUNT')		OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_VIP_BANK_ACCOUNT', "####VIP_BANK_ACCOUNT####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_VIP_BANK_CODE')			OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_VIP_BANK_CODE', "####VIP_BANK_CODE####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_WM_ACCOUNT_USERNAME') 	OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_WM_ACCOUNT_USERNAME', "####WM_ACCOUNT_USERNAME####");
defined('SYSTEM_MESSAGE_PLATFORM_VALUE_WM_ACCOUNT_PASSWORD')	OR define('SYSTEM_MESSAGE_PLATFORM_VALUE_WM_ACCOUNT_PASSWORD', "####WM_ACCOUNT_PASSWORD####");

/*
|--------------------------------------------------------------------------
| Register Deposit Rate Setting
|--------------------------------------------------------------------------
|
| These setting are used when working with system.
|
*/
defined('REGISTER_DEPOSIT_RATE_SETTING_ALL_DEPOSIT')				OR define('REGISTER_DEPOSIT_RATE_SETTING_ALL_DEPOSIT', 1);
defined('REGISTER_DEPOSIT_RATE_SETTING_FIRST_DEPOSIT')				OR define('REGISTER_DEPOSIT_RATE_SETTING_FIRST_DEPOSIT', 2);
defined('REGISTER_DEPOSIT_RATE_SETTING_SECOND_OR_MORE_DEPOSIT')		OR define('REGISTER_DEPOSIT_RATE_SETTING_SECOND_OR_MORE_DEPOSIT', 3);
defined('REGISTER_DEPOSIT_RATE_SETTING_THIRD_OR_MORE_DEPOSIT')		OR define('REGISTER_DEPOSIT_RATE_SETTING_THIRD_OR_MORE_DEPOSIT', 4);

defined('SELECTION_TYPE_FIXED')				OR define('SELECTION_TYPE_FIXED', 1);
defined('SELECTION_TYPE_MORE')				OR define('SELECTION_TYPE_MORE', 2);

defined('GAME_CODE_TYPE_LIVE_CASINO_BACCARAT') 							OR define('GAME_CODE_TYPE_LIVE_CASINO_BACCARAT', 'BAC-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_BID_BACCARAT') 						OR define('GAME_CODE_TYPE_LIVE_CASINO_BID_BACCARAT', 'BAC-B');
defined('GAME_CODE_TYPE_LIVE_CASINO_INSURANCE_BACCARAT') 				OR define('GAME_CODE_TYPE_LIVE_CASINO_INSURANCE_BACCARAT', 'BAC-I');
defined('GAME_CODE_TYPE_LIVE_CASINO_NO_COMMISSION_BACCARAT') 			OR define('GAME_CODE_TYPE_LIVE_CASINO_NO_COMMISSION_BACCARAT', 'BAC-NC');
defined('GAME_CODE_TYPE_LIVE_CASINO_VIP_BACCARAT') 						OR define('GAME_CODE_TYPE_LIVE_CASINO_VIP_BACCARAT', 'BAC-V');
defined('GAME_CODE_TYPE_LIVE_CASINO_SPEED_BACCARAT') 					OR define('GAME_CODE_TYPE_LIVE_CASINO_SPEED_BACCARAT', 'BAC-S');
defined('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_BACCARAT') 				OR define('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_BACCARAT', 'BAC-BC');
defined('GAME_CODE_TYPE_LIVE_CASINO_LIVE_BACCARAT') 					OR define('GAME_CODE_TYPE_LIVE_CASINO_LIVE_BACCARAT', 'BAC-L');
defined('GAME_CODE_TYPE_LIVE_CASINO_DRAGON_TIGER') 						OR define('GAME_CODE_TYPE_LIVE_CASINO_DRAGON_TIGER', 'DT-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_NEW_DRAGON_TIGER') 					OR define('GAME_CODE_TYPE_LIVE_CASINO_NEW_DRAGON_TIGER', 'DT-N');
defined('GAME_CODE_TYPE_LIVE_CASINO_LIVE_DRAGON_TIGER') 				OR define('GAME_CODE_TYPE_LIVE_CASINO_LIVE_DRAGON_TIGER', 'DT-L');
defined('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_DRAGON_TIGER') 			OR define('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_DRAGON_TIGER', 'DT-BC');
defined('GAME_CODE_TYPE_LIVE_CASINO_BULL_BULL') 						OR define('GAME_CODE_TYPE_LIVE_CASINO_BULL_BULL', 'OX-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_BULL_BULL') 				OR define('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_BULL_BULL', 'OX-BC');
defined('GAME_CODE_TYPE_LIVE_CASINO_ZHA_JIN_HUA') 						OR define('GAME_CODE_TYPE_LIVE_CASINO_ZHA_JIN_HUA', 'ZJH-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_LUCKY_ZHA_JIN_HUA') 				OR define('GAME_CODE_TYPE_LIVE_CASINO_LUCKY_ZHA_JIN_HUA', 'ZJH-LCK');
defined('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_ZHA_JIN_HUA') 			OR define('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_ZHA_JIN_HUA', 'ZJH-BC');
defined('GAME_CODE_TYPE_LIVE_CASINO_THREE_FACE_POKER') 					OR define('GAME_CODE_TYPE_LIVE_CASINO_THREE_FACE_POKER', 'TFP-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_THREE_FACE_POKER') 		OR define('GAME_CODE_TYPE_LIVE_CASINO_BLOCKCHAIN_THREE_FACE_POKER', 'TFP-BC');
defined('GAME_CODE_TYPE_LIVE_CASINO_ROULETTE') 							OR define('GAME_CODE_TYPE_LIVE_CASINO_ROULETTE', 'RO-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_SICBO') 							OR define('GAME_CODE_TYPE_LIVE_CASINO_SICBO', 'DI-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_FAN_TAN') 							OR define('GAME_CODE_TYPE_LIVE_CASINO_FAN_TAN', 'FT-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_SEDIE') 							OR define('GAME_CODE_TYPE_LIVE_CASINO_SEDIE', 'SEDIE-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_POK_DENG') 							OR define('GAME_CODE_TYPE_LIVE_CASINO_POK_DENG', 'PD-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_ROCK_PAPER_SCISSORS') 				OR define('GAME_CODE_TYPE_LIVE_CASINO_ROCK_PAPER_SCISSORS', 'RPS-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_ANDAR_BAHAR') 						OR define('GAME_CODE_TYPE_LIVE_CASINO_ANDAR_BAHAR', 'ADBH-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_FISH_PRAWN_CRAB') 					OR define('GAME_CODE_TYPE_LIVE_CASINO_FISH_PRAWN_CRAB', 'FPC-C');
defined('GAME_CODE_TYPE_LIVE_CASINO_MONEYWHEEL') 						OR define('GAME_CODE_TYPE_LIVE_CASINO_MONEYWHEEL', 'MW-C');
defined('GAME_CODE_TYPE_MEMBER_SEND_GIFT') 								OR define('GAME_CODE_TYPE_MEMBER_SEND_GIFT', 'TIPS-MSG');
defined('GAME_CODE_TYPE_MEMBER_GET_GIFT') 								OR define('GAME_CODE_TYPE_MEMBER_GET_GIFT', 'TIPS-MGG');
defined('GAME_CODE_TYPE_ANCHOR_SEND_TIPS') 								OR define('GAME_CODE_TYPE_ANCHOR_SEND_TIPS', 'TIPS-AST');
defined('GAME_CODE_TYPE_COMPANY_SEND_GIFT') 							OR define('GAME_CODE_TYPE_COMPANY_SEND_GIFT', 'TIPS-CSG');
defined('GAME_CODE_TYPE_BO_BING') 										OR define('GAME_CODE_TYPE_BO_BING', 'TIPS-BB');
defined('GAME_CODE_TYPE_CROUPIER_SEND_TIPS') 							OR define('GAME_CODE_TYPE_CROUPIER_SEND_TIPS', 'TIPS-CST');

defined('GAME_CODE_TYPE_SPORTBOOK_BASEBALL') 							OR define('GAME_CODE_TYPE_SPORTBOOK_BASEBALL', 'BASEBALL-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_BASEBALL_MLB') 						OR define('GAME_CODE_TYPE_SPORTBOOK_BASEBALL_MLB', 'BASEBALL-MLB');
defined('GAME_CODE_TYPE_SPORTBOOK_BASEBALL_NPB') 						OR define('GAME_CODE_TYPE_SPORTBOOK_BASEBALL_NPB', 'BASEBALL-NPB');
defined('GAME_CODE_TYPE_SPORTBOOK_BASEBALL_CPBL') 						OR define('GAME_CODE_TYPE_SPORTBOOK_BASEBALL_CPBL', 'BASEBALL-CPBL');
defined('GAME_CODE_TYPE_SPORTBOOK_BASEBALL_KBO') 						OR define('GAME_CODE_TYPE_SPORTBOOK_BASEBALL_KBO', 'BASEBALL-KBO');
defined('GAME_CODE_TYPE_SPORTBOOK_SOCCER') 								OR define('GAME_CODE_TYPE_SPORTBOOK_SOCCER', 'SOCCER-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_SOCCER_TOP') 							OR define('GAME_CODE_TYPE_SPORTBOOK_SOCCER_TOP', 'SOCCER-TOP');
defined('GAME_CODE_TYPE_SPORTBOOK_SOCCER_UEFA') 						OR define('GAME_CODE_TYPE_SPORTBOOK_SOCCER_UEFA', 'SOCCER-UEFA');
defined('GAME_CODE_TYPE_SPORTBOOK_BASKETBALL') 							OR define('GAME_CODE_TYPE_SPORTBOOK_BASKETBALL', 'BASKETBALL-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_BASKETBALL_NBA') 						OR define('GAME_CODE_TYPE_SPORTBOOK_BASKETBALL_NBA', 'BASKETBALL-NBA');
defined('GAME_CODE_TYPE_SPORTBOOK_ICE_HOCKEY') 							OR define('GAME_CODE_TYPE_SPORTBOOK_ICE_HOCKEY', 'ICE_HOCKEY-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_ICE_HOCKEY_NHL') 						OR define('GAME_CODE_TYPE_SPORTBOOK_ICE_HOCKEY_NHL', 'ICE_HOCKEY-NHL');
defined('GAME_CODE_TYPE_SPORTBOOK_LOTTERY') 							OR define('GAME_CODE_TYPE_SPORTBOOK_LOTTERY', 'LOTTERY-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_FOOTBALL') 							OR define('GAME_CODE_TYPE_SPORTBOOK_FOOTBALL', 'FOOTBALL-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_INDEX') 								OR define('GAME_CODE_TYPE_SPORTBOOK_INDEX', 'INDEX-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_GREYHOUND_RACE') 						OR define('GAME_CODE_TYPE_SPORTBOOK_GREYHOUND_RACE', 'GREYHOUND_RACE-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_ESPORT') 								OR define('GAME_CODE_TYPE_SPORTBOOK_ESPORT', 'ESPORT-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_TENNIS') 								OR define('GAME_CODE_TYPE_SPORTBOOK_TENNIS', 'TENNIS-OT');
defined('GAME_CODE_TYPE_SPORTBOOK_OTHER') 								OR define('GAME_CODE_TYPE_SPORTBOOK_OTHER', 'OTHER-OT');
defined('GAME_CODE_TYPE_UNKNOWN') 										OR define('GAME_CODE_TYPE_UNKNOWN', 'UNKNOWN');

defined('SEO_PAGE_HOME') OR define('SEO_PAGE_HOME', 1);
defined('SEO_PAGE_SPORTSBOOK') OR define('SEO_PAGE_SPORTSBOOK', 2);
defined('SEO_PAGE_ESPORTS') OR define('SEO_PAGE_ESPORTS', 3);
defined('SEO_PAGE_LIVE_CASINO') OR define('SEO_PAGE_LIVE_CASINO', 4);
defined('SEO_PAGE_SLOTS') OR define('SEO_PAGE_SLOTS', 5);
defined('SEO_PAGE_FISHING') OR define('SEO_PAGE_FISHING', 6);
defined('SEO_PAGE_ARCADE') OR define('SEO_PAGE_ARCADE', 7);
defined('SEO_PAGE_BOARD_GAME') OR define('SEO_PAGE_BOARD_GAME', 8);
defined('SEO_PAGE_LOTTERY') OR define('SEO_PAGE_LOTTERY', 9);
defined('SEO_PAGE_POKER') OR define('SEO_PAGE_POKER', 10);
defined('SEO_PAGE_PROMOTION') OR define('SEO_PAGE_PROMOTION', 11);
defined('SEO_PAGE_ABOUT_US') OR define('SEO_PAGE_ABOUT_US', 12);
defined('SEO_PAGE_FAQ') OR define('SEO_PAGE_FAQ', 13);
defined('SEO_PAGE_CONTACT_US') OR define('SEO_PAGE_CONTACT_US', 14);
defined('SEO_PAGE_TNC') OR define('SEO_PAGE_TNC', 15);
defined('SEO_PAGE_RG') OR define('SEO_PAGE_RG', 16);
defined('SEO_PAGE_VIP') OR define('SEO_PAGE_VIP', 17);
defined('SEO_PAGE_MOVIE') OR define('SEO_PAGE_MOVIE', 18);
defined('SEO_PAGE_LOGIN') OR define('SEO_PAGE_LOGIN', 19);
defined('SEO_PAGE_REGISTER') OR define('SEO_PAGE_REGISTER', 20);
defined('SEO_PAGE_FORGOT_PASSWORD') OR define('SEO_PAGE_FORGOT_PASSWORD', 21);
defined('SEO_PAGE_PRODUCTS') OR define('SEO_PAGE_PRODUCTS', 22);
defined('SEO_PAGE_PRODUCTS_CALI_BACCARAT') OR define('SEO_PAGE_PRODUCTS_CALI_BACCARAT', 23);
defined('SEO_PAGE_PRODUCTS_ALLBET_BACCARAT') OR define('SEO_PAGE_PRODUCTS_ALLBET_BACCARAT', 24);
defined('SEO_PAGE_PRODUCTS_SA_BACCARAT') OR define('SEO_PAGE_PRODUCTS_SA_BACCARAT', 25);
defined('SEO_PAGE_PRODUCTS_DG_BACCARAT') OR define('SEO_PAGE_PRODUCTS_DG_BACCARAT', 26);
defined('SEO_PAGE_PRODUCTS_WM_BACCARAT') OR define('SEO_PAGE_PRODUCTS_WM_BACCARAT', 27);
defined('SEO_PAGE_PRODUCTS_CALI_SPORTS') OR define('SEO_PAGE_PRODUCTS_CALI_SPORTS', 28);
defined('SEO_PAGE_PRODUCTS_SUPER_SPORTS') OR define('SEO_PAGE_PRODUCTS_SUPER_SPORTS', 29);
defined('SEO_PAGE_PRODUCTS_9K_LOTTERY') OR define('SEO_PAGE_PRODUCTS_9K_LOTTERY', 30);
defined('SEO_PAGE_PRODUCTS_SUPER_LOTTERY') OR define('SEO_PAGE_PRODUCTS_SUPER_LOTTERY', 31);
defined('SEO_PAGE_PRODUCTS_RTG_ELECTRONICS') OR define('SEO_PAGE_PRODUCTS_RTG_ELECTRONICS', 32);
defined('SEO_PAGE_PRODUCTS_DREAMTECH_ELECTRONICS') OR define('SEO_PAGE_PRODUCTS_DREAMTECH_ELECTRONICS', 33);
defined('SEO_PAGE_PRODUCTS_SIMPLEPLAY_ELECTRONICS') OR define('SEO_PAGE_PRODUCTS_SIMPLEPLAY_ELECTRONICS', 34);
defined('SEO_PAGE_PRODUCTS_BWIN_ELECTRONICS') OR define('SEO_PAGE_PRODUCTS_BWIN_ELECTRONICS', 35);
defined('SEO_PAGE_PRODUCTS_BNG') OR define('SEO_PAGE_PRODUCTS_BNG', 36);
defined('SEO_PAGE_PRODUCTS_OG') OR define('SEO_PAGE_PRODUCTS_OG', 37);
defined('SEO_PAGE_PRODUCTS_SUPREME_GAMING') OR define('SEO_PAGE_PRODUCTS_SUPREME_GAMING', 38);
defined('SEO_PAGE_PRODUCTS_RTG_FISH') OR define('SEO_PAGE_PRODUCTS_RTG_FISH', 39);
defined('SEO_PAGE_PRODUCTS_SIMPLEPLAY_FISH') OR define('SEO_PAGE_PRODUCTS_SIMPLEPLAY_FISH', 40);
defined('SEO_PAGE_PRODUCTS_OB_BACCARAT') OR define('SEO_PAGE_PRODUCTS_OB_BACCARAT', 41);
defined('SEO_PAGE_BLOG') OR define('SEO_PAGE_BLOG', 42);
defined('SEO_PAGE_USER_EVALUATION') OR define('SEO_PAGE_USER_EVALUATION', 44);
defined('SEO_PAGE_ACCESS_PROCESS') OR define('SEO_PAGE_ACCESS_PROCESS', 45);
defined('SEO_PAGE_APP') OR define('SEO_PAGE_APP', 46);
defined('SEO_PAGE_FRANCHISE') OR define('SEO_PAGE_FRANCHISE', 47);
defined('SEO_PAGE_NEWS') OR define('SEO_PAGE_NEWS', 48);
defined('SEO_PAGE_GAME_MAINTENANCE') OR define('SEO_PAGE_GAME_MAINTENANCE', 49);
defined('SEO_PAGE_MESSAGE') OR define('SEO_PAGE_MESSAGE', 50);
defined('SEO_PAGE_ACCOUNT_TURNOVER') OR define('SEO_PAGE_ACCOUNT_TURNOVER', 51);
defined('SEO_PAGE_ACCOUNT_TRANSACTION_HISTORY') OR define('SEO_PAGE_ACCOUNT_TRANSACTION_HISTORY', 52);
defined('SEO_PAGE_ACCOUNT_CHANGE_PASSWORD') OR define('SEO_PAGE_ACCOUNT_CHANGE_PASSWORD', 53);
defined('SEO_PAGE_ACCOUNT') OR define('SEO_PAGE_ACCOUNT', 54);
defined('SEO_PAGE_DEPOSIT') OR define('SEO_PAGE_DEPOSIT', 55);
defined('SEO_PAGE_WITHDRAWAL') OR define('SEO_PAGE_WITHDRAWAL', 56);
defined('SEO_PAGE_BINDING_BANK') OR define('SEO_PAGE_BINDING_BANK', 57);
defined('SEO_PAGE_TRANSFER') OR define('SEO_PAGE_TRANSFER', 58);
defined('SEO_PAGE_BLOGS') OR define('SEO_PAGE_BLOGS', 59);
defined('SEO_PAGE_PRODUCTS_GR') OR define('SEO_PAGE_PRODUCTS_GR', 60);
defined('SEO_PAGE_PRODUCTS_RSG') OR define('SEO_PAGE_PRODUCTS_RSG', 61);
defined('SEO_PAGE_PRODUCTS_BL') OR define('SEO_PAGE_PRODUCTS_BL', 62);
defined('SEO_PAGE_PRODUCTS_GR_BOARD_GAME') OR define('SEO_PAGE_PRODUCTS_GR_BOARD_GAME', 63);
defined('SEO_PAGE_PRODUCTS_ICG_FISH') OR define('SEO_PAGE_PRODUCTS_ICG_FISH', 64);
defined('SEO_PAGE_PRODUCTS_GR_FISH') OR define('SEO_PAGE_PRODUCTS_GR_FISH', 65);
defined('SEO_PAGE_PRODUCTS_PNG') OR define('SEO_PAGE_PRODUCTS_PNG', 66);

defined('SEO_PAGE_HOME_LINK')								OR define('SEO_PAGE_HOME_LINK', "");
defined('SEO_PAGE_SPORTSBOOK_LINK')							OR define('SEO_PAGE_SPORTSBOOK_LINK', "/sports");
defined('SEO_PAGE_ESPORTS_LINK')							OR define('SEO_PAGE_ESPORTS_LINK', "/esports");
defined('SEO_PAGE_LIVE_CASINO_LINK')						OR define('SEO_PAGE_LIVE_CASINO_LINK', "/baccarat");
defined('SEO_PAGE_SLOTS_LINK')								OR define('SEO_PAGE_SLOTS_LINK', "/slots");
defined('SEO_PAGE_FISHING_LINK')							OR define('SEO_PAGE_FISHING_LINK', "/fishing");
defined('SEO_PAGE_ARCADE_LINK')								OR define('SEO_PAGE_ARCADE_LINK', "/arcade");
defined('SEO_PAGE_BOARD_GAME_LINK')							OR define('SEO_PAGE_BOARD_GAME_LINK', "/card");
defined('SEO_PAGE_LOTTERY_LINK')							OR define('SEO_PAGE_LOTTERY_LINK', "/lottery");
defined('SEO_PAGE_POKER_LINK')								OR define('SEO_PAGE_POKER_LINK', "/poker");
defined('SEO_PAGE_PROMOTION_LINK')							OR define('SEO_PAGE_PROMOTION_LINK', "/promotion");
defined('SEO_PAGE_ABOUT_US_LINK')							OR define('SEO_PAGE_ABOUT_US_LINK', "/about");
defined('SEO_PAGE_FAQ_LINK')								OR define('SEO_PAGE_FAQ_LINK', "/faq");
defined('SEO_PAGE_CONTACT_US_LINK')							OR define('SEO_PAGE_CONTACT_US_LINK', "/account/contact");
defined('SEO_PAGE_TNC_LINK')								OR define('SEO_PAGE_TNC_LINK', "/page/tnc");
defined('SEO_PAGE_RG_LINK')									OR define('SEO_PAGE_RG_LINK', "/page/rg");
defined('SEO_PAGE_VIP_LINK')								OR define('SEO_PAGE_VIP_LINK', "/account/vip");
defined('SEO_PAGE_MOVIE_LINK')								OR define('SEO_PAGE_MOVIE_LINK', "/videos");
defined('SEO_PAGE_LOGIN_LINK')								OR define('SEO_PAGE_LOGIN_LINK', "/login");
defined('SEO_PAGE_REGISTER_LINK')							OR define('SEO_PAGE_REGISTER_LINK', "/register");
defined('SEO_PAGE_FORGOT_PASSWORD_LINK')					OR define('SEO_PAGE_FORGOT_PASSWORD_LINK', "/account/forgot_password");
defined('SEO_PAGE_PRODUCTS_LINK')							OR define('SEO_PAGE_PRODUCTS_LINK', "/game/intro");
defined('SEO_PAGE_PRODUCTS_CALI_BACCARAT_LINK')				OR define('SEO_PAGE_PRODUCTS_CALI_BACCARAT_LINK', "/cali-baccarat");
defined('SEO_PAGE_PRODUCTS_ALLBET_BACCARAT_LINK') 			OR define('SEO_PAGE_PRODUCTS_ALLBET_BACCARAT_LINK', "/allbet-baccarat");
defined('SEO_PAGE_PRODUCTS_SA_BACCARAT_LINK')				OR define('SEO_PAGE_PRODUCTS_SA_BACCARAT_LINK', "/sa-baccarat");
defined('SEO_PAGE_PRODUCTS_DG_BACCARAT_LINK')				OR define('SEO_PAGE_PRODUCTS_DG_BACCARAT_LINK', "/dg-baccarat");
defined('SEO_PAGE_PRODUCTS_WM_BACCARAT_LINK')				OR define('SEO_PAGE_PRODUCTS_WM_BACCARAT_LINK', "/wm-baccarat");
defined('SEO_PAGE_PRODUCTS_CALI_SPORTS_LINK')				OR define('SEO_PAGE_PRODUCTS_CALI_SPORTS_LINK', "/918bet-sports");
defined('SEO_PAGE_PRODUCTS_SUPER_SPORTS_LINK')				OR define('SEO_PAGE_PRODUCTS_SUPER_SPORTS_LINK', "/super-sports");
defined('SEO_PAGE_PRODUCTS_9K_LOTTERY_LINK')				OR define('SEO_PAGE_PRODUCTS_9K_LOTTERY_LINK', "/9k-racecar");
defined('SEO_PAGE_PRODUCTS_SUPER_LOTTERY_LINK')				OR define('SEO_PAGE_PRODUCTS_SUPER_LOTTERY_LINK', "/super-lottery");
defined('SEO_PAGE_PRODUCTS_RTG_ELECTRONICS_LINK')			OR define('SEO_PAGE_PRODUCTS_RTG_ELECTRONICS_LINK', "/rtg-slotgame");
defined('SEO_PAGE_PRODUCTS_DREAMTECH_ELECTRONICS_LINK')		OR define('SEO_PAGE_PRODUCTS_DREAMTECH_ELECTRONICS_LINK', "/dtg-slotgame");
defined('SEO_PAGE_PRODUCTS_SIMPLEPLAY_ELECTRONICS_LINK')	OR define('SEO_PAGE_PRODUCTS_SIMPLEPLAY_ELECTRONICS_LINK', "/simple-play-slotgame");
defined('SEO_PAGE_PRODUCTS_BWIN_ELECTRONICS_LINK')			OR define('SEO_PAGE_PRODUCTS_BWIN_ELECTRONICS_LINK', "/bwin-slotgame");
defined('SEO_PAGE_PRODUCTS_BNG_LINK')						OR define('SEO_PAGE_PRODUCTS_BNG_LINK', "/bng-slotgame");
defined('SEO_PAGE_PRODUCTS_OG_LINK')						OR define('SEO_PAGE_PRODUCTS_OG_LINK', "/og-baccarat");
defined('SEO_PAGE_PRODUCTS_SUPREME_GAMING_LINK')			OR define('SEO_PAGE_PRODUCTS_SUPREME_GAMING_LINK', "/supreme-gaming");
defined('SEO_PAGE_PRODUCTS_RTG_FISH_LINK')					OR define('SEO_PAGE_PRODUCTS_RTG_FISH_LINK', "/rtg-fishing");
defined('SEO_PAGE_PRODUCTS_SIMPLEPLAY_FISH_LINK')			OR define('SEO_PAGE_PRODUCTS_SIMPLEPLAY_FISH_LINK', "/sp-fishing");
defined('SEO_PAGE_PRODUCTS_OB_BACCARAT_LINK')				OR define('SEO_PAGE_PRODUCTS_OB_BACCARAT_LINK', "/ob-baccarat");
defined('SEO_PAGE_BLOG_LINK')								OR define('SEO_PAGE_BLOG_LINK', "/blog-category/official-news");
defined('SEO_PAGE_USER_EVALUATION_LINK')					OR define('SEO_PAGE_USER_EVALUATION_LINK', "/page/evaluation");
defined('SEO_PAGE_ACCESS_PROCESS_LINK')						OR define('SEO_PAGE_ACCESS_PROCESS_LINK', "/page/access");
defined('SEO_PAGE_APP_LINK')								OR define('SEO_PAGE_APP_LINK', "/download");
defined('SEO_PAGE_FRANCHISE_LINK')							OR define('SEO_PAGE_FRANCHISE_LINK', "/cooperation");
defined('SEO_PAGE_NEWS_LINK')								OR define('SEO_PAGE_NEWS_LINK', "/announcement");
defined('SEO_PAGE_GAME_MAINTENANCE_LINK')					OR define('SEO_PAGE_GAME_MAINTENANCE_LINK', "/maintain");
defined('SEO_PAGE_MESSAGE_LINK')							OR define('SEO_PAGE_MESSAGE_LINK', "/message");
defined('SEO_PAGE_ACCOUNT_TURNOVER_LINK')					OR define('SEO_PAGE_ACCOUNT_TURNOVER_LINK', "/account/turnover_history");
defined('SEO_PAGE_ACCOUNT_TRANSACTION_HISTORY_LINK')		OR define('SEO_PAGE_ACCOUNT_TRANSACTION_HISTORY_LINK', "/account/transaction_history");
defined('SEO_PAGE_ACCOUNT_CHANGE_PASSWORD_LINK')			OR define('SEO_PAGE_ACCOUNT_CHANGE_PASSWORD_LINK', "/account/change_password");
defined('SEO_PAGE_ACCOUNT_LINK')							OR define('SEO_PAGE_ACCOUNT_LINK', "/account");
defined('SEO_PAGE_DEPOSIT_LINK')							OR define('SEO_PAGE_DEPOSIT_LINK', "/account/deposit");
defined('SEO_PAGE_WITHDRAWAL_LINK')							OR define('SEO_PAGE_WITHDRAWAL_LINK', "/account/withdrawal");
defined('SEO_PAGE_BINDING_BANK_LINK')						OR define('SEO_PAGE_BINDING_BANK_LINK', "/account/binding_portal");
defined('SEO_PAGE_TRANSFER_LINK')							OR define('SEO_PAGE_TRANSFER_LINK', "/transfer");
defined('SEO_PAGE_BLOGS_LINK')								OR define('SEO_PAGE_BLOGS_LINK', "/blog-category/official-news");
defined('SEO_PAGE_PRODUCTS_GR_LINK')						OR define('SEO_PAGE_PRODUCTS_GR_LINK', "/gr-slotgame");
defined('SEO_PAGE_PRODUCTS_RSG_LINK')						OR define('SEO_PAGE_PRODUCTS_RSG_LINK', "/rsg-slotgame");
defined('SEO_PAGE_PRODUCTS_BL_LINK')						OR define('SEO_PAGE_PRODUCTS_BL_LINK', "/royalgaming");
defined('SEO_PAGE_PRODUCTS_GR_BOARD_GAME_LINK')				OR define('SEO_PAGE_PRODUCTS_GR_BOARD_GAME_LINK', "/gr-gaming");
defined('SEO_PAGE_PRODUCTS_ICG_FISH_LINK')					OR define('SEO_PAGE_PRODUCTS_ICG_FISH_LINK', "/bwin-fishing");
defined('SEO_PAGE_PRODUCTS_GR_FISH_LINK')					OR define('SEO_PAGE_PRODUCTS_GR_FISH_LINK', "/gr-fishing");
defined('SEO_PAGE_PRODUCTS_PNG_LINK') 						OR define('SEO_PAGE_PRODUCTS_PNG_LINK', "/playngo-slotgame");

###############################################################################################################################

defined('SYSTEM_DEFAULT_NAME')		OR define('SYSTEM_DEFAULT_NAME', 'system');
defined('CONTENT_PATH')				OR define('CONTENT_PATH', './../application/views/content/');
defined('CONTENT_PATH_DATABASE')	OR define('CONTENT_PATH_DATABASE', 'content/');
defined('CONTENT_SOURCE_PATH')		OR define('CONTENT_SOURCE_PATH', './../application/views/');
defined('SOUND_PATH')				OR define('SOUND_PATH', './assets/sounds/');
defined('SOUND_SOURCE_PATH')		OR define('SOUND_SOURCE_PATH', 'assets/sounds/');
defined('SOUND_FILE_SIZE')			OR define('SOUND_FILE_SIZE', 10240);
defined('BANNER_PATH')				OR define('BANNER_PATH', './../uploads/banners/');
defined('BANNER_SOURCE_PATH')		OR define('BANNER_SOURCE_PATH', 'https://test-gxgame.com/uploads/banners/');
defined('BANNER_FILE_SIZE')			OR define('BANNER_FILE_SIZE', 10240);
defined('PROMOTION_PATH')			OR define('PROMOTION_PATH', './../uploads/promotions/');
defined('PROMOTION_SOURCE_PATH')	OR define('PROMOTION_SOURCE_PATH', 'https://test-gxgame.com/uploads/promotions/');
defined('PROMOTION_FILE_SIZE')		OR define('PROMOTION_FILE_SIZE', 10240);
defined('BANKS_PATH')				OR define('BANKS_PATH', './../uploads/banks/');
defined('BANKS_SOURCE_PATH')		OR define('BANKS_SOURCE_PATH', 'https://test-gxgame.com/uploads/banks/');
defined('BANKS_ACCOUNT_IMAGE')      OR define('BANKS_ACCOUNT_IMAGE', './../../uploads/files/');
defined('BANKS_FILE_SIZE')			OR define('BANKS_FILE_SIZE', 10240);
defined('BANKS_PLAYER_PATH')		OR define('BANKS_PLAYER_PATH', './../uploads/banksplayer/');
defined('BANKS_PLAYER_SOURCE_PATH')	OR define('BANKS_PLAYER_SOURCE_PATH', 'https://test-gxgame.com/uploads/banksplayer/');
defined('BANKS_PLAYER_FILE_SIZE')	OR define('BANKS_PLAYER_FILE_SIZE', 10240);
defined('BANKS_PLAYER_IDENTIACTION_CARD_PATH')		    OR define('BANKS_PLAYER_IDENTIACTION_CARD_PATH', './../uploads/verify_image/');
defined('BANKS_PLAYER_IDENTIACTION_CARD_SOURCE_PATH')	OR define('BANKS_PLAYER_IDENTIACTION_CARD_SOURCE_PATH', 'https://test-gxgame.com/uploads/verify_image/');
defined('BANKS_PLAYER_IDENTIACTION_CARD_FILE_SIZE')	    OR define('BANKS_PLAYER_IDENTIACTION_CARD_FILE_SIZE', 10240);
defined('BANKS_PLAYER_CREDIT_CARD_PATH')		OR define('BANKS_PLAYER_CREDIT_CARD_PATH', './../uploads/verify_credit_card/');
defined('BANKS_PLAYER_CREDIT_CARD_SOURCE_PATH')	OR define('BANKS_PLAYER_CREDIT_CARD_SOURCE_PATH', 'https://test-gxgame.com/uploads/verify_credit_card/');
defined('BANKS_PLAYER_CREDIT_CARD_FILE_SIZE')	OR define('BANKS_PLAYER_CREDIT_CARD_FILE_SIZE', 10240);
defined('BONUS_PATH')				OR define('BONUS_PATH', './../uploads/bonus/');
defined('BONUS_SOURCE_PATH')		OR define('BONUS_SOURCE_PATH', 'https://test-gxgame.com/uploads/bonus/');
defined('BONUS_FILE_SIZE')			OR define('BONUS_FILE_SIZE', 10240);
defined('AVATAR_PATH')				OR define('AVATAR_PATH', './../uploads/avatar/');
defined('AVATAR_SOURCE_PATH')		OR define('AVATAR_SOURCE_PATH', 'https://test-gxgame.com/uploads/avatar/');
defined('AVATAR_SOURCE_PATH_BASE')	OR define('AVATAR_SOURCE_PATH_BASE', './../uploads/avatar/');
defined('AVATAR_FILE_SIZE')			OR define('AVATAR_FILE_SIZE', 10240);
defined('MATCH_PATH')				OR define('MATCH_PATH', './../uploads/match/');
defined('MATCH_SOURCE_PATH')		OR define('MATCH_SOURCE_PATH', 'https://test-gxgame.com/uploads/match/');
defined('MATCH_FILE_SIZE')			OR define('MATCH_FILE_SIZE', 10240);
defined('LEVEL_PATH')				OR define('LEVEL_PATH', './../uploads/level/');
defined('LEVEL_SOURCE_PATH')		OR define('LEVEL_SOURCE_PATH', 'https://test-gxgame.com/uploads/level/');
defined('LEVEL_FILE_SIZE')			OR define('LEVEL_FILE_SIZE', 10240);
defined('BLACKLIST_PATH')			OR define('BLACKLIST_PATH', './../uploads/blacklist/');
defined('BLACKLIST_SOURCE_PATH')	OR define('BLACKLIST_SOURCE_PATH', 'https://test-gxgame.com/uploads/blacklist/');
defined('BLACKLIST_FILE_SIZE')		OR define('BLACKLIST_FILE_SIZE', 10240);
defined('BLOG_PATH')				OR define('BLOG_PATH', './../uploads/blog/');
defined('BLOG_SOURCE_PATH')			OR define('BLOG_SOURCE_PATH', 'https://test-gxgame.com/uploads/blog/');
defined('BLOG_FILE_SIZE')		    OR define('BLOG_FILE_SIZE', 10240);
defined('BANKS_PLAYER_USER_BANK_PATH')			        OR define('BANKS_PLAYER_USER_BANK_PATH', './../uploads/userbank/');
defined('BANKS_PLAYER_USER_BANK_SOURCE_PATH')	        OR define('BANKS_PLAYER_USER_BANK_SOURCE_PATH', 'https://test-gxgame.com/uploads/userbank/');
defined('BANKS_PLAYER_USER_BANK_SIZE')			        OR define('BANKS_PLAYER_USER_BANK_SIZE', 10240);
defined('BANKS_PLAYER_IDENTIACTION_CARD_PATH')			OR define('BANKS_PLAYER_IDENTIACTION_CARD_PATH', './../uploads/verify_image/');
defined('BANKS_PLAYER_IDENTIACTION_CARD_SOURCE_PATH')	OR define('BANKS_PLAYER_IDENTIACTION_CARD_SOURCE_PATH', 'https://test-gxgame.com/uploads/verify_image/');
defined('BANKS_PLAYER_IDENTIACTION_CARD_SIZE')			OR define('BANKS_PLAYER_IDENTIACTION_CARD_SIZE', 10240);
defined('BANKS_PLAYER_CREDIT_CARD_PATH')				OR define('BANKS_PLAYER_CREDIT_CARD_PATH', './../uploads/verify_credit_card/');
defined('BANKS_PLAYER_CREDIT_CARD_SOURCE_PATH')			OR define('BANKS_PLAYER_CREDIT_CARD_SOURCE_PATH', 'https://test-gxgame.com/uploads/verify_credit_card/');
defined('BANKS_PLAYER_CREDIT_CARD_SIZE')				OR define('BANKS_PLAYER_CREDIT_CARD_SIZE', 10240);
defined('SYSTEM_LANGUAGES')			OR define('SYSTEM_LANGUAGES', json_encode(array(SYSTEM_LANG_EN,SYSTEM_LANG_CHS,SYSTEM_LANG_CHT)));
defined('PLAYER_SITE_LANGUAGES')	OR define('PLAYER_SITE_LANGUAGES', json_encode(array(LANG_EN,LANG_ZH_HK)));
defined('MISCELLANEOUS_LANGUAGES')	OR define('MISCELLANEOUS_LANGUAGES', json_encode(array(TRANSFER_OFFLINE_DEPOSIT, TRANSFER_PG_DEPOSIT, TRANSFER_WITHDRAWAL, TRANSFER_CREDIT_CARD_DEPOSIT, TRANSFER_HYPERMART_DEPOSIT)));
defined('SYSTEM_API_URL')		    OR define('SYSTEM_API_URL', 'https://test-gxgame.com/gameapi/api');
defined('SYSTEM_API_AGENT_ID')		OR define('SYSTEM_API_AGENT_ID', 'newgxwlpt');
defined('SYSTEM_API_SECRET_KEY')	OR define('SYSTEM_API_SECRET_KEY', '1FPKdZdREkmkAKfrp1sWhBVau8MWcKqh');
defined('SYSTEM_API_AGENT_REFERRAL_LINK') OR define('SYSTEM_API_AGENT_REFERRAL_LINK', 'https://test-gxgame.com/join/index/');
defined('SYSTEM_API_MEMBER_REFERRAL_LINK') OR define('SYSTEM_API_MEMBER_REFERRAL_LINK', 'https://test-gxgame.com/join/index/');
defined('SYSTEM_API_MEMBER_SITE_LINK') OR define('SYSTEM_API_MEMBER_SITE_LINK', 'https://test-gxgame.com');
defined('SYSTEM_API_GAME_PLATFORM_KICK')	OR define('SYSTEM_API_GAME_PLATFORM_KICK', json_encode(array("AB","BL","BNG","DG","DT","ICG","OBSB","RTG","SA","SP","SPSB","SPLT","WM")));
defined('SYSTEM_DOMAIN_BANNED')		OR define('SYSTEM_DOMAIN_BANNED', json_encode(array("www","mail","api","bo","gxwlpt","gxwlptbctbo","gxwlptpos8")));
defined('SYSTEM_API_MEMBER_DOMAIN_LINK') OR define('SYSTEM_API_MEMBER_DOMAIN_LINK', 'new.test-gxgame.com');
defined('SYSTEM_ALL_DOMAIN') OR define('SYSTEM_ALL_DOMAIN', json_encode(array('new.test-gxgame.com')));
defined('SYSTEM_DEFAULT_DOMAIN') OR define('SYSTEM_DEFAULT_DOMAIN', 'test-gxgame.com');
defined('OLD_PASSWORD_HASH') OR define('OLD_PASSWORD_HASH', '#lDtp#4S$cVq9Ef2#bAAw)g1bR=DwC4jG');
defined('PLAYER_PROMOTION_SURRENDER') OR define('PLAYER_PROMOTION_SURRENDER', 100);
defined('PLAYER_WITHDRAWAL_RATE_WHITELIST') OR define('PLAYER_WITHDRAWAL_RATE_WHITELIST', json_encode(array()));
defined('BANK_VERIFY_SUBMIT') OR define('BANK_VERIFY_SUBMIT', 23);
defined('NEW_MEMBER_WITHDRAWAL_LIMIT') OR define('NEW_MEMBER_WITHDRAWAL_LIMIT', 5);

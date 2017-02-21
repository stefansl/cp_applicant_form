<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @package   cp_applicant_form
 * @author    Stefan Schulz-Lauterbach
 * @license   GNU/LGPL
 * @copyright CLICKPRESS Internetagentur 2015
 */

/**
 * FRONT END MODULES
 */

$GLOBALS['FE_MOD']['user']['applicant_form'] = 'ModuleApplicantForm';


/**
 * Hooks
 */

$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = array('ApplicantForm', 'checkIban');
$GLOBALS['TL_HOOKS']['addCustomRegexp'][] = array('ApplicantForm', 'checkBic');
$GLOBALS['TL_HOOKS']['activateAccount'][] = array('ApplicantForm', 'sendAdminNotification');
$GLOBALS['TL_HOOKS']['activateAccount'][] = array('ApplicantForm', 'completeUserData');
//$GLOBALS['TL_HOOKS']['createNewUser'][] = array('ApplicantForm', 'createNewUser');

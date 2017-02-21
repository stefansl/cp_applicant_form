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


$GLOBALS['TL_DCA']['tl_module']['palettes']['applicant_form'] = str_replace('reg_activate;', 'reg_activate,add_notification;', $GLOBALS['TL_DCA']['tl_module']['palettes']['registration']);
$GLOBALS['TL_DCA']['tl_module']['palettes']['__selector__'][] = 'add_notification';
$GLOBALS['TL_DCA']['tl_module']['subpalettes']['add_notification'] = 'notification_mail';


//dump($GLOBALS['TL_DCA']['tl_module']['subpalettes']);

$GLOBALS['TL_DCA']['tl_module']['fields']['add_notification'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['add_notification'],
    'exclude' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => array(
        'submitOnChange' => true,
        'tl_class' => 'm12',
    ),
    'sql' => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_module']['fields']['notification_mail'] = array
(
    'label' => &$GLOBALS['TL_LANG']['tl_module']['notification_mail'],
    'exclude' => true,
    'inputType' => 'text',
    'eval' => array(
        //'rgxp'  => 'email',
        'maxlength' => '255',
        'doNotCopy' => true,
        'tl_class' => 'm12',
    ),
    'sql' => "varchar(255) NOT NULL default ''"
);
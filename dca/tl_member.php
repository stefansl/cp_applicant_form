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

if (strpos($GLOBALS['TL_DCA']['tl_member']['palettes']['default'], 'language;') === false) {
    $GLOBALS['TL_DCA']['tl_member']['palettes']['default'] .= ',membership,membership_comments{bank},applicant_form_abg_accept,iban,bic,bank;';
} else {
    $GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace(
        'language;',
        'language;{member_ship_legend},applicant_member_ident,membership,applicant_mail_sent,applicant_exported,membership_comments,applicant_form_abg_accept;{bank_legend},iban,bic,bank;',
        $GLOBALS['TL_DCA']['tl_member']['palettes']['default']
    );
}

$GLOBALS['TL_DCA']['tl_member']['fields']['membership'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['membership'],
    'exclude'   => true,
    'filter'    => true,
    'sorting'   => true,
    'inputType' => 'select',
    'options'   => array('akt'     => 'Aktives Mitglied (EUR 30,00)',
                         'jug'     => 'Jugendmitglied (EUR 15,00)',
                         'fam'     => 'Familien (EUR 45,00)',
                         'foerder' => 'Förderndes Mitglied (mind. EUR 100,00)'
    ),
    'eval'      => array(
        'includeBlankOption' => false,
        'chosen'             => true,
        'feEditable'         => true,
        'feViewable'         => true,
        'feGroup'            => 'membership',
        'tl_class'           => 'w50',
        'doNotCopy'          => true
    ),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['applicant_form_abg_accept'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['applicant_form_abg_accept'],
    'exclude'   => true,
    'search'    => true,
    'inputType' => 'checkbox',
    'eval'      => array(
        'feEditable' => true,
        'feViewable' => true,
        'feGroup'    => 'membership',
        'tl_class'   => 'm12',
        'mandatory'  => true,
        'doNotCopy'  => true
    ),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['applicant_mail_sent'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['applicant_mail_sent'],
    'exclude'   => true,
    'search'    => true,
    'filter'    => true,
    'inputType' => 'checkbox',
    'eval'      => array(
        'tl_class'   => 'w50',
        'doNotCopy'  => true
    ),
    'sql'       => "char(1) NOT NULL default ''"
);



$GLOBALS['TL_DCA']['tl_member']['fields']['applicant_exported'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['applicant_exported'],
    'exclude'   => true,
    'search'    => true,
    'filter'    => true,
    'inputType' => 'checkbox',
    'eval'      => array(
        'tl_class'   => 'w50',
        'doNotCopy'  => true
    ),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['applicant_member_ident'] = array
(
    'label'     => &$GLOBALS['TL_LANG']['tl_member']['applicant_member_ident'],
    'exclude'   => true,
    'search'    => true,
    'inputType' => 'text',
    'eval'      => array(
        'tl_class'   => 'w50',
        'feEditable' => true,
        'feViewable' => true,
        'doNotCopy'  => true
    ),
    'sql'       => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['iban'] = array
(
    'label'       => array('IBAN', 'IBAN-Nummer der Mitglieds'),
    'explanation' => 'Hallo',
    'exclude'     => true,
    'search'      => true,
    'inputType'   => 'text',
    'eval'        => array(
        'feEditable' => true,
        'feViewable' => true,
        'feGroup'    => 'konto',
        'tl_class'   => 'w50',
        'rgxp'       => 'iban',
        'mandatory'  => true,
        'doNotCopy'  => true
    ),
    'sql'         => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['bic']  = array
(
    'label'     => array('BIC', 'BIC des Geldinstituts'),
    'exclude'   => true,
    'search'    => true,
    'inputType' => 'text',
    'eval'      => array(
        'feEditable' => true,
        'feViewable' => true,
        'feGroup'    => 'konto',
        'tl_class'   => 'w50',
        'rgxp'       => 'bic',
        'mandatory'  => true,
        'doNotCopy'  => true
    ),
    'sql'       => "varchar(255) NOT NULL default ''"
);
$GLOBALS['TL_DCA']['tl_member']['fields']['bank'] = array
(
    'label'     => array('Bank', 'Tragen Sie bitte hier das Geldinstitut ein'),
    'exclude'   => true,
    'search'    => true,
    'inputType' => 'text',
    'eval'      => array(
        'feEditable' => true,
        'feViewable' => true,
        'feGroup'    => 'konto',
        'tl_class'   => 'w50',
        'mandatory'  => true,
        'doNotCopy'  => true
    ),
    'sql'       => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_member']['fields']['membership_comments'] = array
(
    'label'     => array('ggf. Familienmitglieder, Förderbeitrag oder weitere Infos/Kommentare', 'Infos'),
    'exclude'   => true,
    'search'    => true,
    'inputType' => 'textarea',
    'eval'      => array(
        'feEditable'   => true,
        'feViewable'   => true,
        'feGroup'      => 'membership',
        'style'        => 'height:200px',
        'preserveTags' => true,
        'rte'          => 'ace|html',
        'tl_class'     => 'clr',
        'doNotCopy'    => true
    ),
    'sql'       => "text NULL"
);


// Edit fields
$GLOBALS['TL_DCA']['tl_member']['fields']['gender']['eval']['mandatory']      = true;
$GLOBALS['TL_DCA']['tl_member']['fields']['dateOfBirth']['eval']['mandatory'] = true;
$GLOBALS['TL_DCA']['tl_member']['fields']['country']['default']               = 'de';
$GLOBALS['TL_DCA']['tl_member']['fields']['street']['eval']['mandatory']      = true;
$GLOBALS['TL_DCA']['tl_member']['fields']['phone']['eval']['mandatory']       = true;
$GLOBALS['TL_DCA']['tl_member']['fields']['postal']['eval']['mandatory']      = true;
$GLOBALS['TL_DCA']['tl_member']['fields']['city']['eval']['mandatory']        = true;
$GLOBALS['TL_DCA']['tl_member']['fields']['country']['eval']['mandatory']     = true;
//$GLOBALS['TL_DCA']['tl_member']['fields']['']['eval']['mandatory'] = true;


/**
 * Provide miscellaneous methods that are used by the data configuration array.
 *
 * @author Stefan Schulz-Lauterbach <https://clickpress.de>
 */
class tl_member_applicant_form extends tl_member
{
}

?>

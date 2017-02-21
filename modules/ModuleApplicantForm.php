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


namespace CLICKPRESS;


/**
 * Front end module "applicant form".
 *
 * @author Leo Feyer <https://github.com/leofeyer>
 */
class ModuleApplicantForm extends \ModuleRegistration
{

    /**
     * Template
     *
     * @var string
     */
    protected $strTemplate = 'member_default';


    /**
     * Display a wildcard in the back end
     *
     * @return string
     */
    public function generate()
    {
        if (TL_MODE == 'BE')
        {
            /** @var \BackendTemplate|object $objTemplate */
            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ' . utf8_strtoupper($GLOBALS['TL_LANG']['FMD']['applicant_form'][0]) . ' ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }
        return parent::generate();
    }


    /**
     * Generate the module
     */
    protected function compile()
    {

        parent::compile();
        $this->Template->slabel = $GLOBALS['TL_LANG']['FMD']['register_applicant']['button'];

    }

}

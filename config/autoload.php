<?php

/**
 * Contao Open Source CMS
 *
 * Copyright (c) 2005-2016 Leo Feyer
 *
 * @license LGPL-3.0+
 */


/**
 * Register the namespaces
 */
ClassLoader::addNamespaces(array
(
	'CLICKPRESS',
));


/**
 * Register the classes
 */
ClassLoader::addClasses(array
(
	// Modules
	'CLICKPRESS\ModuleApplicantForm' => 'system/modules/cp_applicant_form/modules/ModuleApplicantForm.php',

	// Classes
	'CLICKPRESS\ApplicantForm'       => 'system/modules/cp_applicant_form/classes/ApplicantForm.php',
));

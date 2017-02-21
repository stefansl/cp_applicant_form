<?php

namespace CLICKPRESS;

use NotificationCenter;

class ApplicantForm extends \Frontend
{

    /**
     * Manipulate fields
     *
     * @param object $objMember
     */
    public function completeUserData($objMember, $modRegistration)
    {
        // Set date of membership start to now
        $objMember->membership_since = time();

        // Add membership fee
        switch ($objMember->membership) {
            case 'akt':
                $fee = 30;
                break;
            case 'jug':
                $fee = 15;
                break;
            case 'fam':
                $fee = 45;
                break;
            default:
                $fee = 0;
        }

        $objMember->membership_fee = $fee;
        $objMember->save();
    }


    /**
     * Send an admin notification e-mail
     *
     * @param object $objMember
     */
    public function sendAdminNotification($objMember, $objModule)
    {

        if ($objModule->add_notification == '') {
            return;
        }

        $objEmail = new \Email();

        $objEmail->from = $GLOBALS['TL_ADMIN_EMAIL'];
        $objEmail->fromName = $GLOBALS['TL_ADMIN_NAME'];
        $objEmail->subject = sprintf($GLOBALS['TL_LANG']['MSC']['adminNotificationSubject'], \Idna::decode(\Environment::get('host')));

        $strData = "\n\n";

        // Add user details
        $strData .= $GLOBALS['TL_LANG']['tl_member']['firstname'][0] . ': ' . $objMember->firstname . "\n";
        $strData .= $GLOBALS['TL_LANG']['tl_member']['lastname'][0] . ': ' . $objMember->lastname . "\n";
        $strData .= $GLOBALS['TL_LANG']['tl_member']['dateOfBirth'][0] . ': ' . \Date::parse(\Config::get('dateFormat'), $objMember->dateOfBirth) . "\n";
        $strData .= $GLOBALS['TL_LANG']['tl_member']['street'][0] . ': ' . $objMember->street . "\n";
        $strData .= $GLOBALS['TL_LANG']['tl_member']['postal'][0] . ': ' . $objMember->postal . "\n";
        $strData .= $GLOBALS['TL_LANG']['tl_member']['city'][0] . ': ' . $objMember->city . "\n";
        $strData .= $GLOBALS['TL_LANG']['tl_member']['email'][0] . ': ' . $objMember->email . "\n";


        $contaoLink = \Environment::get('url') . \Environment::get('path') . '/contao/main.php?do=member' . "\n";
        $objEmail->text = sprintf($GLOBALS['TL_LANG']['MSC']['adminNotificationText'], $objMember->id, $strData . "\n", $contaoLink) . "\n";

        $mailRecipient = ($objModule->notification_mail != '') ? $objModule->notification_mail : $GLOBALS['TL_ADMIN_EMAIL'];

        $mailRecipient = explode(',', $mailRecipient);
        if (is_array($mailRecipient)) {
            foreach ($mailRecipient as $mail) {
                $objEmail->sendTo($mail);
                \System::log('Admin notification was sent to ' . $mail . '!', __FUNCTION__, __CLASS__);
            }
        } else {
            $objEmail->sendTo($mailRecipient);
        }


    }

    /**
     * Send mail via Notification Center
     *
     * only for testing purposes
     */
    public function sendWelcomeMail()
    {
        /*$objNotification = NotificationCenter\Model\Notification::findByPk(1); // Todo: 1 = hardcoded
        if (null !== $objNotification) {
            $objNotification->send($arrTokens, $strLanguage); // Language is optional

            // Todo: in DB set sentMail flag to true
        }*/
    }


    /**
     * Check IBAN
     **/
    public function checkIban($strRegexp, $varValue, \Widget $objWidget)
    {

        if ($strRegexp == 'iban') {
            $varValue = trim(str_replace(' ', '', $varValue));
            if (!preg_match('/^[a-zA-Z]{2}[0-9]{2}[a-zA-Z0-9]{4}[0-9]{7}([a-zA-Z0-9]?){0,16}$/', $varValue)) {
                $objWidget->addError('Bitte eine gültige IBAN angeben');
            }

            return true;
        }

        return false;
    }

    /**
     * Check BIC
     **/
    public function checkBic($strRegexp, $varValue, \Widget $objWidget)
    {

        if ($strRegexp == 'bic') {
            if (!preg_match('/^[a-z]{6}[0-9a-z]{2}([0-9a-z]{3})?\z/i', $varValue)) {
                $objWidget->addError('Bitte eine gültige BIC angeben');
            }

            return true;
        }

        return false;
    }
}

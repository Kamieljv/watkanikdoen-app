<?php

/*
|--------------------------------------------------------------------------
| Emails Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used for emails and related
| strings.
|
*/

return [
    'announcements' => 'Mededelingen',
    'all'   => 'Alle Mededelingen',
    'view_all' => 'Bekijk Alle Mededelingen',
    'salutation' => 'Het Watkanikdoen-team',

    // Shared
    'greeting' => 'Beste',
    'greeting_admin' => 'Beste admin',

    // PasswordReset
    'password_reset' => [
        'subject' => 'Wachtwoord herstellen',
        'intro' => 'Je ontvangt deze e-mail omdat we een verzoek hebben ontvangen om het wachtwoord van je account te herstellen.',
        'action' => 'Wachtwoord herstellen',
        'outro' => 'Als je geen wachtwoordherstel hebt aangevraagd, hoef je verder niets te doen.',
    ],

    // VerifyEmail
    'verify_email' => [
        'subject' => 'Verifieer je e-mailadres',
        'intro' => 'Bedankt voor je registratie! Wil je je e-mailadres verifiëren door op de knop hieronder te klikken?',
        'expires' => 'Deze link verloopt over :count minuten.',
        'action' => 'Verifieer e-mailadres',
    ],

    // SubscriberVerifyEmail
    'newsletter_verify' => [
        'subject' => 'Bevestig je inschrijving voor de nieuwsbrief',
        'greeting' => 'Hallo!',
        'intro' => 'Je hebt je met dit e-mailadres ingeschreven voor onze nieuwsbrief.',
        'instruction' => 'Klik op de knop hieronder om je e-mailadres te verifiëren.',
        'action' => 'Verifieer e-mailadres',
        'outro' => 'Als je je niet hebt aangemeld voor onze nieuwsbrief, kun je deze e-mail negeren.',
    ],

    // ReportReceived (to admin)
    'report_received' => [
        'subject' => 'Nieuwe actie aangemeld',
        'message' => 'Er is een nieuwe actie aangemeld. Klik op de knop hieronder om de actie te bekijken.',
        'action' => 'Aangemelde actie bekijken',
    ],

    // ReportAccepted (to the user who reported the actie)
    'report_accepted' => [
        'subject' => 'Actie geaccepteerd',
        'message' => 'Je aangemelde actie met de titel \':title\' is geaccepteerd. Klik op de knop hieronder om de actie te bekijken.',
        'action' => 'Actie bekijken',
    ],

    // InboxMessageReceived (to admin, for new contact messages and feedback)
    'inbox' => [
        'contact_subject' => 'Nieuw contactbericht',
        'feedback_subject' => 'Nieuwe feedback',
        'contact_intro' => 'Er is een nieuw bericht binnengekomen via het contactformulier.',
        'feedback_intro' => 'Er is nieuwe feedback binnengekomen via het feedbackformulier.',
        'name' => 'Naam',
        'email' => 'E-mailadres',
        'subject' => 'Onderwerp',
        'message' => 'Bericht',
        'unknown' => '(niet ingevuld)',
        'action' => 'Bekijk in het admin-paneel',
    ],

    // ErrorAlert (to admin)
    'error_alert' => [
        'subject' => '[ALERT] Kritieke fout op :app',
        'intro' => 'Er is een kritieke fout opgetreden op de productieserver (app: :app).',
        'class' => 'Klasse',
        'message' => 'Melding',
        'file' => 'Bestand',
        'line' => 'regel',
        'trace' => 'Stack trace',
    ],
];

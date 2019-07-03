<?php

use Illuminate\Database\Seeder;

/**
 * Class EmailSettingsSeeder.
 */
class EmailSettingsSeeder extends Seeder
{
    protected $settings = [
        'mail.attach' => [
            'value' => true,
            'name' => 'Attach Invoice/Quote',
            'description' => 'Attach the invoice/quote to the outgoing mail',
        ],
        'mail.driver' => [
            'value' => 'none',
            'name' => 'Email Provider',
            'description' => 'The method by which to send outbound mail',
        ],
        'mail.from_address' => [
            'value' => 'noreply@example.com',
            'name' => 'Sender Address',
            'description' => 'The email address that the mail should appear to have been sent from',
        ],
        'mail.from_name' => [
            'value' => 'Invoice Singer',
            'name' => 'Sender Name',
            'description' => 'The name that emails should appear to have been sent from',
        ],
        'mail.encryption' => [
            'value' => 'tls',
            'name' => 'Encryption',
            'description' => 'The encryption protocol that should be used when the application send e-mail messages',
        ],
        'mail.username' => [
            'value' => '',
            'name' => 'Username for mail servers that require authentication',
            'description' => '',
        ],
        'mail.password' => [
            'value' => 'Password for mail servers that require authentication',
            'name' => '',
            'description' => '',
        ],
        'mail.sendmail' => [
            'value' => '/usr/sbin/sendmail -bs',
            'name' => 'Sendmail Path',
            'description' => 'The path to the sendmail binary',
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    }
}

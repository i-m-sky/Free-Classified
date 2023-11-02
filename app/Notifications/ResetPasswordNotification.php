<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\EmailTemplate;
use App\Models\User;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    /**
     * The password reset token.
     *
     * @var string
     */
    public $token;

    /**
     * The callback that should be used to create the reset password URL.
     *
     * @var \Closure|null
     */
    public static $createUrlCallback;

    /**
     * The callback that should be used to build the mail message.
     *
     * @var \Closure|null
     */
    public static $toMailCallback;

    /**
     * Create a notification instance.
     *
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's channels.
     *
     * @param  mixed  $notifiable
     * @return array|string
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Build the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if (static::$toMailCallback) {
            return call_user_func(static::$toMailCallback, $notifiable, $this->token);
        }

        if (static::$createUrlCallback) {
            $url = call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        } else {
            $url = url(route('password.reset', [
                'token' => $this->token,
                'email' => $notifiable->getEmailForPasswordReset(),
            ], false));
        }
        $emailTemplateRow = EmailTemplate::select(['subject', 'description', 'notes'])->where('slug', 'forget-password')->where('status', 'active')->first();
        if (empty($emailTemplateRow))
            return true;

        $email = $notifiable->getEmailForPasswordReset();
        $userRow = User::select(['name', 'email', 'email_verified_at', 'phone', 'isWhatsApp'])->where('email', $email)->first();
        if (empty($userRow))
            return true;
        $count =  config('auth.passwords.' . config('auth.defaults.passwords') . '.expire');
        $subject = $emailTemplateRow->subject;
        $description = $emailTemplateRow->description;
        $keysArr = ['@name', '@phone', '@email', '@url', '@expireTime'];
        $valuesArr = [
            !empty($userRow->name) ? $userRow->name : NULL,
            !empty($userRow->phone) ? $userRow->phone : NULL,
            !empty($userRow->email) ? $userRow->email : NULL,
            !empty($url) ? $url : NULL,
            !empty($count) ? $count : NULL
        ];
        $data = [];
        $data['description'] = str_replace($keysArr, $valuesArr, $description);
        $subject = str_replace($keysArr, $valuesArr, $subject);
        return (new MailMessage)
            ->subject($subject)
            ->view('mail.auth', $data);
    }

    /**
     * Set a callback that should be used when creating the reset password button URL.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function createUrlUsing($callback)
    {
        static::$createUrlCallback = $callback;
    }

    /**
     * Set a callback that should be used when building the notification mail message.
     *
     * @param  \Closure  $callback
     * @return void
     */
    public static function toMailUsing($callback)
    {
        static::$toMailCallback = $callback;
    }
}

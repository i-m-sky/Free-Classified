<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\EmailTemplate;

class UserDeleteNotification extends Notification
{
    use Queueable;
    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $emailTemplateRow = EmailTemplate::select(['subject', 'description', 'notes'])->where('slug', 'account-delete')->where('status', 'active')->first();
        if (empty($emailTemplateRow))
            return true;

        $subject = $emailTemplateRow->subject;
        $description = $emailTemplateRow->description;
        $keysArr = ['@name', '@phone', '@email'];
        $valuesArr = [
            !empty($this->user->name) ? $this->user->name : NULL,
            !empty($this->user->phone) ? $this->user->phone : NULL,
            !empty($this->user->email) ? $this->user->email : NULL
        ];
        $data = [];
        $data['description'] = str_replace($keysArr, $valuesArr, $description);
        $subject = str_replace($keysArr, $valuesArr, $subject);
        return (new MailMessage)
            ->subject($subject)
            ->view('mail.auth', $data);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}

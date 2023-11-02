<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\EmailTemplate;

class PostDetailUserNotification extends Notification
{
    use Queueable;
    public $emailRow;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($emailRow)
    {
        $this->emailRow = $emailRow;
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
        $emailTemplateRow = EmailTemplate::select(['subject', 'description', 'notes'])->where('slug', 'send-viewer-email-to-customer')->where('status', 'active')->first();
        if (empty($emailTemplateRow))
            return true;

        $subject = $emailTemplateRow->subject;
        $description = $emailTemplateRow->description;
        $keysArr = ['@userName', '@userPhone', '@userEmail', '@addId', '@addTitle', '@email', '@message'];
        $valuesArr = [
            !empty($this->emailRow->userName) ? $this->emailRow->userName : NULL,
            !empty($this->emailRow->userPhone) ? $this->emailRow->userPhone : NULL,
            !empty($this->emailRow->userEmail) ? $this->emailRow->userEmail : NULL,
            !empty($this->emailRow->id) ? $this->emailRow->id : NULL,
            !empty($this->adRow->name) ? $this->emailRow->name : NULL,
            !empty($this->emailRow->email) ? $this->emailRow->email : NULL,
            !empty($this->emailRow->message) ? $this->emailRow->message : NULL

        ];
        /*

        $keysArr = ['@userName', '@userPhone', '@userEmail', '@postId', '@postTitle', '@email', '@message'];

        */
        $data = [];
        $data['description'] = str_replace($keysArr, $valuesArr, $description);
        $subject = str_replace($keysArr, $valuesArr, $subject);
        return (new MailMessage)
            ->subject($subject)
            ->from($this->emailRow->email, 'KhrojBro')
            ->view('mail.post', $data);
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

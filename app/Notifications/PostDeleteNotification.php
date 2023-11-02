<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\EmailTemplate;

class PostDeleteNotification extends Notification
{
    use Queueable;

    public $userRow;
    public $addRow;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($userRow, $addRow)
    {
        $this->userRow = $userRow;
        $this->addRow = $addRow;
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
        $emailTemplateRow = EmailTemplate::select(['subject', 'description', 'notes'])->where('slug', 'delete-post')->where('status', 'active')->first();
        if (empty($emailTemplateRow))
            return true;

        $subject = $emailTemplateRow->subject;
        $description = $emailTemplateRow->description;

        $keysArr = ['@userName', '@userPhone', '@userEmail', '@adId', '@adTitle'];
        $valuesArr = [
            !empty($this->userRow->name) ? $this->userRow->name : NULL,
            !empty($this->userRow->phone) ? $this->userRow->phone : NULL,
            !empty($this->userRow->email) ? $this->userRow->email : NULL,
            !empty($this->addRow->id) ? $this->addRow->id : NULL,
            !empty($this->addRow->name) ? $this->addRow->name : NULL
        ];
        $data = [];
        $data['description'] = str_replace($keysArr, $valuesArr, $description);
        $subject = str_replace($keysArr, $valuesArr, $subject);
        return (new MailMessage)
            ->subject($subject)
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

<?php

namespace App\Notifications\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class accessPermission extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($notificationdata)
    {
        $this->details = $notificationdata;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        //dd($this->details['permission']);

        return (new MailMessage)
            ->subject('Access Request')
            //->greeting('Hi ' . $notifiable->name)
            ->markdown('mailTemplete.accessRequest', array(
                'useremail' => $this->details['useremail'],
                'message' => $this->details['message'],
                'username' => $notifiable->name,
                'companyName' => $this->details['companyName'],
                'permission' => $this->details['permission'],
            ));
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
            'data' => $this->details['message'],
        ];
    }
}

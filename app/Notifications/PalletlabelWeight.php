<?php

namespace App\Notifications;

use App\Article;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\PalletLabelResource;
use App\PalletLabel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PalletlabelWeight extends Notification
{
    use Queueable;
    protected $data;



    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
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
        $article = Article::find(PalletLabel::find($this->data->pallet_label_id)->article_id);
        return (new MailMessage)
            ->line('Verwachte gewicht: ' . $this->data->expected_weight)
            ->line('Het gewogen gewicht: ' . $this->data->actual_weight)
            ->line('Percentage: ' . $this->data->percentage . ' %')
            ->line('Acceptabel: ' . ($this->data->valid ? 'ja' : 'nee'))
            ->line('Palletlabel Id: ' . $this->data->pallet_label_id)
            ->line('Artikel: ' . $article->fullName($article));
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

<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitorEmail extends Mailable
{
    use SerializesModels;

    public $htmlContent;

    public function __construct($htmlContent)
    {
        $this->htmlContent = $htmlContent;
    }

    public function build()
    {
        return $this->subject('Visitor Details')
            ->html($this->htmlContent);
    }
}

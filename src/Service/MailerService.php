<?php

namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Psr\Log\LoggerInterface;

class MailerService {
    private MailerInterface $mailer;
    private LoggerInterface $logger;

    public function __construct(MailerInterface $mailer, LoggerInterface $logger) {
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * Send email  PDF attachment
     *
     * @param string      $to
     * @param string      $content HTML content
     * @param string      $subject
     * @param string|null $pdfContent Raw PDF data
     * @param string|null $pdfName    PDF file name
     */
    public function sendEmail(string $to, string $content, string $subject, ?string $pdfContent = null, ?string $pdfName = null): void {
        $email = (new Email())
            ->from('naeibinazari@gmail.com')
            ->to($to)
            ->subject($subject)
            ->html($content);

        if ($pdfContent && $pdfName) {
            $email->attach($pdfContent, $pdfName, 'application/pdf');
        }

        $this->logger->info('Sending email', ['to' => $to, 'subject' => $subject]);

        $this->mailer->send($email);
    }
}

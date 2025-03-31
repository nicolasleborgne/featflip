<?php

declare(strict_types=1);

namespace App\Infrastructure\Symfony\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: '/_email', name: 'debug_mail_template', condition: "'dev' === '%kernel.environment%'")]
#[AsController]
final class DebugMailTemplate extends AbstractController
{
    public function __construct(
        private readonly MailerInterface $mailer,
    ) {

    }
    public function __invoke(): Response
    {
        $this->mailer->send((new TemplatedEmail())
            ->from(new Address('someone@mailprovider.com', 'Featflip Mail Bot'))
            ->to('someoneelse@mailprovider.com')
            ->subject('Something')
            ->htmlTemplate('debug/email.html.twig')
        );

        return $this->render('debug/email.html.twig', []);
    }
}

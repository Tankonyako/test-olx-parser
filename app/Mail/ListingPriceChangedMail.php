<?php

namespace App\Mail;

use App\Models\OlxListing;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ListingPriceChangedMail extends Mailable
{
	use Queueable, SerializesModels;

	public int $newPrice;
	public int $oldPrice;
	public OlxListing $listing;

	/**
	 * Create a new message instance.
	 */
	public function __construct(OlxListing $listing, int $oldPrice, int $newPrice)
	{
		$this->listing = $listing;
		$this->oldPrice = $oldPrice;
		$this->newPrice = $newPrice;
	}

	/**
	 * Get the message envelope.
	 */
	public function envelope(): Envelope
	{
		return new Envelope(
			subject: __('mail.listing-price-changed-mail-subject', ['title' => $this->listing->title]),
		);
	}

	/**
	 * Get the message content definition.
	 */
	public function content(): Content
	{
		return new Content(
			markdown: 'mail.listing-price-changed-mail',
		);
	}

	/**
	 * Get the attachments for the message.
	 *
	 * @return array<int, Attachment>
	 */
	public function attachments(): array
	{
		return [];
	}
}

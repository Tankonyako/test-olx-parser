<x-mail::message>
    # @lang('mail.listing-price-changed-mail.subject', ['title' => $listing->title])

    @lang('mail.listing-price-changed-mail.description', ['old-price' => $oldPrice . ' ' . $listing->currency, 'new-price' => $newPrice. ' ' . $listing->currency])

    <x-mail::button :url="$listing->url">
        @lang('mail.listing-price-changed-mail.view-listing')
    </x-mail::button>
</x-mail::message>

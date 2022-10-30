@component('mail::message')

# @lang('Hello!')

@lang('You are receiving this email because someone invited you become their creator')

@component('mail::button', [ 'url' => route('accept', [$invite->token])])
    @lang('Accept invite')
@endcomponent


@endcomponent

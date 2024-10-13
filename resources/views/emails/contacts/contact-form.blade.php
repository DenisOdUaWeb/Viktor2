<x-mail::message>
# Thank you for your message

# bla bla bla 

<x-mail::button :url="''">
Button Text us
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}

then

<strong>Name</strong> {{$data['name']}}

<strong>Email</strong> {{$data['email']}}

<strong>the Message is:</strong> {{$data['message']}}


</x-mail::message>

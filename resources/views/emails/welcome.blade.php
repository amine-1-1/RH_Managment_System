@component('mail::message')
    Hello {!! $data['name_to'] !!},
    <p>all the <b>Discover</b> Family welcome you we hope to provide you with one of the best experience of your life
        To connect, here are your details:
        <br>
        <b> email : {!! $data['address_to'] !!}</b>
        <br>
        <b>password : {!! $data['password_to'] !!}</b>
        <br>
        Your account was created by Mr {!! $data['name_from'] !!}. for any technical problem contact him through this
        email:{!! $data['address_from'] !!}
        <br>
        click in this button to login
        <br>
        @component('mail::button', ['url' => 'http://rhmanagment.local/login']) Discover login @endcomponent
    </p>
    Thanks,
@endcomponent

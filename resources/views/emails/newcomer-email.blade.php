<!-- resources/views/emails/newcomer-email.blade.php -->

@component('mail::message')
<style>
    /* Define your styles here */
    .welcome-message {
        font-size: 18px;
        color: #333;
        margin-bottom: 20px;
    }
    
    .details {
        font-size: 14px;
        color: #666;
    }
</style>

<!-- Content of the email -->
<div class="welcome-message">
</div>

<div class="details">
    <p></p>

    <p>{{ $message }}</p>

   
</div>

{{-- Add any additional content or styling as needed --}}
@endcomponent

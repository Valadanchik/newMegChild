<div class="faccebook-logo" style="width:28px ; height:28px" >
    <a href='https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}' >
        <img src="{{ URL::to('images/svg/facebook-logo.svg') }}" alt="facebook logo" style="width:100%">
    </a>
</div>
<div class="twitter-logo" style="width:28px ; height:28px" >
    <a href="https://twitter.com/intent/tweet?text={{ $shareUrl }}">
        <img src="{{ URL::to('images/svg/twitter-logo.svg') }}" alt="twitter logo" style="width:100%">
    </a>
</div>
<div class="linkedin-logo" style="width:28px ; height:28px" >
    <a href="https://www.linkedin.com/sharing/share-offsite?mini=true&url={{ $shareUrl }}">
        <img src="{{ URL::to('images/svg/linkedin-logo.svg') }}" alt="linkedin logo" style="width:100%">
    </a>
</div>

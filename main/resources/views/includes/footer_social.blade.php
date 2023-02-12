@if ((string)$siteSetting->facebook_address !== '')
<a href="{{ $siteSetting->facebook_address }}" target="_blank"><i class="fa fa-facebook-square" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->twitter_address !== '')
<a href="{{ $siteSetting->twitter_address }}" target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->instagram_address !== '')
<a href="{{ $siteSetting->instagram_address }}" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
@endif
@if ((string)$siteSetting->youtube_address !== '')
<a href="{{ $siteSetting->youtube_address }}" target="_blank"><i class="fa fa-youtube-square" aria-hidden="true"></i></a>
@endif

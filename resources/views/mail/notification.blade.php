<h2>{{ $post->title }}</h2>
<div>
    {{ $post->content }}
</div>

<h6>This mail was meant to be sent to {{ $subscription->email }}. Not for you? <a href="#hehe">Unsubscribe here</a></h6>

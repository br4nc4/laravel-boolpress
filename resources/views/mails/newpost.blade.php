@component('mail::message')
<p>Gentile {{ $user->name }},</p>
<p>siamo felici di informarla che il suo post, <strong>{{$post->title}}</strong> è statto creato correttamente</p>

<img src="{{Storage::url($post->cover_img)}}" alt="">
@component('mail::button', ['url' => route('admin.posts.show', $post->slug)])
il tuo post
@endcomponent

Cordialmente,<br>
Classe #65
@endcomponent
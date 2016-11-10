@foreach($galleries as $gallery)
<article class="row">
  <h1>{!!$gallery->title!!}</h1>
  <p>
    {!! str_limit($gallery->content, 250) !!}
    {!! link_to(route('galleries.show', $gallery->id), 'Read More') !!}
  </p>
</article>
@endforeach
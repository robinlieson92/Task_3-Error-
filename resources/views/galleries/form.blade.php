<div class="form-group">
  {!! Form::label('title', 'Title', array('class' => 'col-lg-3 control-label')) !!}
  <div class="col-lg-9">
    {!! Form::text('title', null, array('class' => 'form-control', 
    'placeholder'=>"Enter Title",'autofocus' => 'true')) !!}
    <div class="text-danger">{!! $errors->first('title') !!}</div>
  </div>
  <div class="clear"></div>
</div>

<div class="form-group">
  {!! Form::label('image', 'Image', array('class' => 'col-lg-3 control-label')) !!}
  <div class="col-lg-9">
    {!! Form::file('url', null, array('multiple'=>"")) !!}
    {!! Form::text(null, null, array('class' => 'form-control', 'placeholder'=>"Browse ...",
    'readonly'=>"")) !!}
    <div class="text-danger">{!! $errors->first('url') !!}</div>
  </div>
  <div class="clear"></div>
</div>

<div class="form-group">
  <div class="col-lg-3"></div>
  <div class="col-lg-9">
    {!! Form::submit('Upload', array('class' => 'btn btn-raised btn-primary')) !!}
    {!! link_to(route('galleries.index'), "Back", ['class' => 'btn btn-raised btn-info']) !!}
  </div>
  <div class="clear"></div>
</div>
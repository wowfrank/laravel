<div class="form-group">
	<label for="name" class="col-md-3 control-label"> {{ trans('messages.Name') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="name" id="name" value="{{ $name }}">
	</div>
</div>


<div class="form-group">
	<label for="title" class="col-md-3 control-label"> {{ trans('messages.Title') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="title" id="title" value="{{ $title }}">
	</div>
</div>

<div class="form-group">
	<label for="subtitle" class="col-md-3 control-label"> {{ trans('messages.Subtitle') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $subtitle }}">
	</div>
</div>

<div class="form-group">
	<label for="linktitle" class="col-md-3 control-label"> {{ trans('messages.Link') }} {{ trans('messages.Title') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="linktitle" id="linktitle" value="{{ $linktitle }}">
	</div>
</div>

<div class="form-group">
	<label for="link" class="col-md-3 control-label"> {{ trans('messages.Link') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="link" id="link" value="{{ $link }}">
	</div>
</div>

<div class="form-group">
	<label for="active" class="col-md-3 control-label"> {{ trans('messages.Status') }} </label>
	<div class="col-md-8">
		<input type="checkbox" name="active" id="active" value= "{{ true }}" @if($active) checked='chekced' @endif>
	</div>
</div>
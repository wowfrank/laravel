<div class="form-group">
	<label for="title" class="col-md-3 control-label"> {{ trans('messages.Title') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="title" id="title" value="{{ $title }}">
	</div>
</div>


<div class="form-group">
	<label for="description" class="col-md-3 control-label"> {{ trans('messages.Description') }} </label>
	<div class="col-md-8">
		<textarea class="form-control" id="description" name="description" rows="3">{{ $description }}</textarea>
  	</div>
</div>

<div class="form-group">
	<label for="status" class="col-md-3 control-label"> {{ trans('messages.Status') }} </label>
	<div class="col-md-7">
		<label class="radio-inline">
			<input type="radio" name="status" id="status"
			@if (! $status)
				checked="checked"
			@endif
 			value="0"> {{ trans('messages.ONGOING') }}
		</label>
		<label class="radio-inline">
			<input type="radio" name="status"
			@if ($status)
				checked="checked"
			@endif
			value="1"> {{ trans('messages.COMPLETED') }}
		</label>
	</div>
</div>
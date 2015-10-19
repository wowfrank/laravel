<div class="form-group">
	<label for="name" class="col-md-3 control-label"> {{ trans('messages.Name') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="name" id="name" value="{{ $name }}">
	</div>
</div>

<div class="form-group">
	<label for="nickname" class="col-md-3 control-label"> {{ trans('messages.Nickname') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="nickname" id="nickname" value="{{ $nickname }}">
	</div>
</div>

<div class="form-group">
	<label for="imgname" class="col-md-3 control-label"> {{ trans('messages.Image Name') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="imgname" id="imgname" value="{{ $imgname }}">
	</div>
</div>

<div class="form-group">
	<label for="phone" class="col-md-3 control-label"> {{ trans('messages.Phone') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="phone" id="phone" value="{{ $phone }}">
	</div>
</div>

<div class="form-group">
	<label for="duty" class="col-md-3 control-label"> {{ trans('messages.Duty') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="duty" id="duty" value="{{ $duty }}">
	</div>
</div>

<div class="form-group">
	<label for="dob" class="col-md-3 control-label"> {{ trans('messages.Date of Birth') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="dob" id="dob" value="{{ $dob }}">
	</div>
</div>

<div class="form-group">
	<label for="gender" class="col-md-3 control-label"> {{ trans('messages.Gender') }} </label>
	<div class="col-md-8">
		<select name="gender" id="gender" class="form-control">
			<option @if ($gender == 1) selected @endif
				value="1">
				{{ trans('messages.Male') }}
			</option>

			<option @if ($gender == 0) selected @endif
				value="0">
				{{ trans('messages.Female') }}
			</option>
		</select>
	</div>
</div>

<div class="form-group">
	<label for="weibo" class="col-md-3 control-label"> {{ trans('messages.Weibo') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="weibo" id="weibo" value="{{ $weibo }}">
	</div>
</div>

<div class="form-group">
	<label for="qq" class="col-md-3 control-label"> QQ </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="qq" id="qq" value="{{ $qq }}">
	</div>
</div>

<div class="form-group">
	<label for="wechat" class="col-md-3 control-label"> {{ trans('messages.Wechat') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="wechat" id="wechat" value="{{ $wechat }}">
	</div>
</div>

<div class="form-group">
	<label for="education" class="col-md-3 control-label"> {{ trans('messages.Education') }} </label>
	<div class="col-md-8">
		<input type="text" class="form-control" name="education" id="education" value="{{ $education }}">
	</div>
</div>

<div class="form-group">
	<label for="status" class="col-md-3 control-label"> {{ trans('messages.Status') }} </label>
	<div class="col-md-8">
		<input type="checkbox" name="status" id="status" value= "{{ true }}" @if($status) checked='chekced' @endif>
	</div>
</div>
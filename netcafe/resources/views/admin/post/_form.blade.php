<script type="text/javascript" src="{{ asset('/js/vendor/tinymce/tinymce.min.js') }}"></script>
<script type="text/javascript">
	tinymce.init({
	    selector : "textarea#content",
		plugins : ["advlist autolink lists textcolor link image charmap print preview anchor", "searchreplace visualblocks code fullscreen", "insertdatetime media table contextmenu paste jbimages"],
		toolbar : "insertfile forecolor backcolor | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist | link jbimages | fontselect fontsizeselect",
		image_class_list: [
        	{title: 'Image Responsive', value: 'img-responsive'},
        	{title: 'Image Rounded', value: 'img-rounded'},
        	{title: 'Image Circle', value: 'img-circle'},
        	{title: 'Image Thumbnail', value: 'img-thumbnail'},
        ],
	});
</script>
<div class="row">
	<div class="col-md-8">
		<div class="form-group">
			<label for="title" class="col-md-2 control-label"> {{ trans('messages.Title') }} </label>
			<div class="col-md-10">
				<input type="text" class="form-control" name="title" autofocus id="title" value="{{ $title }}">
			</div>
		</div>
		<div class="form-group">
			<label for="subtitle" class="col-md-2 control-label">  {{ trans('messages.Subtitle') }} </label>
			<div class="col-md-10">
				<input type="text" class="form-control" name="subtitle" id="subtitle" value="{{ $subtitle }}">
 			</div>
		</div>
		<div class="form-group">
			<label for="page_image" class="col-md-2 control-label"> {{ trans('messages.Page Image') }} </label>
			<div class="col-md-10">
				<input type="text" class="form-control" name="page_image" id="page_image" onchange="handle_image_change()" alt="Image thumbnail" value="{{ $page_image }}">
			</div>
		</div>
		<div class="form-group">
			<label for="content" class="col-md-2 control-label">  {{ trans('messages.Content') }} </label>
			<div class="col-md-10">
				<textarea class="form-control ckeditor" name="content" rows="14" id="content">{{ $content }}</textarea>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="publish_date" class="col-md-3 control-label"> {{ trans('messages.Pub Date') }} </label>
			<div class="col-md-8">
				<input class="form-control" name="publish_date" id="publish_date" type="text" value="{{ $publish_date }}">
			</div>
		</div>
		<div class="form-group">
			<label for="publish_time" class="col-md-3 control-label">  {{ trans('messages.Pub Time') }} </label>
			<div class="col-md-8">
				<input class="form-control" name="publish_time" id="publish_time" type="text" value="{{ $publish_time }}">
			</div>
		</div>
		<div class="form-group">
			<div class="col-md-8 col-md-offset-3">
				<div class="checkbox">
					<label>
						<input {{ checked($is_draft) }} type="checkbox" name="is_draft"> {{ trans('messages.Draft?') }}
					</label>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label for="tags" class="col-md-3 control-label">  {{ trans('messages.Tags') }} </label>
			<div class="col-md-8">
				<select name="tags[]" id="tags" class="form-control" multiple>
					@foreach ($allTags as $tag)
						<option @if (in_array($tag, $tags)) selected @endif
							value="{{ $tag }}">
							{{ $tag }}
						</option>
					@endforeach
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="layout" class="col-md-3 control-label"> {{ trans('messages.Layout') }} </label>
			<div class="col-md-8">
				<input type="text" class="form-control" name="layout" id="layout" value="{{ $layout }}">
			</div>
		</div>
		<div class="form-group">
			<label for="meta_description" class="col-md-3 control-label"> {{ trans('messages.Meta') }} </label>
			<div class="col-md-8">
				<textarea class="form-control" name="meta_description" id="meta_description" rows="6">{{ $meta_description }}</textarea>
			</div>
		</div>

	</div>
</div>
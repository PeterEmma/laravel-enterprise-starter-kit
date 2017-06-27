@if((sizeof($files) > 0) || (sizeof($directories) > 0))

<div class="row">
    @foreach($folders as $folder)
        <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 img-row">

        <a href="{{ $folder->fold_name }}"><img src="{{ asset('/img/folder.png') }}" width="150"></a>
            <div class="caption text-center">
            <div class="btn-group">
                <button type="button" id='fold_name' data-id="{{ $folder->fold_name }}" class="item_name btn btn-default btn-xs -item">
                {{ $folder->fold_name }}
                </button>
                <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-expanded="false">
                <span class="caret"></span>
                <span class="sr-only">Toggle Dropdown</span>
                </button>
            </div>
            </div>
            </div>
    @endforeach
</div>

@else
<p>{{ Lang::get('laravel-filemanager::lfm.message-empty') }}</p>
@endif

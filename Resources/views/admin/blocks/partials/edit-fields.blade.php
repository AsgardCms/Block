<div class="box-body">
    <?php $old = $block->hasTranslation($lang) ? $block->translate($lang)->body : '' ?>
    @if(config('asgard.block.config.use-wysiwyg'))
        @editor('body', trans('block::blocks.body'), old("$lang.body", $old), $lang)
    @else
        {!! Form::i18nTextarea('body', trans('block::blocks.body'), $errors, $lang, $block, ['class' => 'form-control']) !!}
    @endif

    {!! Form::i18nCheckbox('online', trans('block::blocks.online'), $errors, $lang, $block) !!}

    @if(config('asgard.block.config.partials.translatable.edit') !== [])
        @foreach(config('asgard.block.config.partials.translatable.edit') as $partial)
            @include($partial)
        @endforeach
    @endif
</div>

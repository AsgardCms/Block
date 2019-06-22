<div class="box-body">
    @if (config('asgard.block.config.use-wysiwyg'))
        @editor('body', trans('block::blocks.body'), old("{$lang}.body"), $lang)
    @else
        {!! Form::i18nTextarea('body', trans('block::blocks.body'), $errors, $lang, null, ['class' => 'form-control']) !!}
    @endif

    {!! Form::i18nCheckbox('online', trans('block::blocks.online'), $errors, $lang) !!}

    <?php if (config('asgard.block.config.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.block.config.partials.translatable.create') as $partial): ?>
            @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>

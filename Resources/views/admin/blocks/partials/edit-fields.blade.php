<div class="box-body">
    {!! Form::i18nTextarea('body', trans('block::blocks.body'), $errors, $lang, $block) !!}

    {!! Form::i18nCheckbox('online', trans('block::blocks.online'), $errors, $lang, $block) !!}

    <?php if (config('asgard.block.config.partials.translatable.edit') !== []): ?>
        <?php foreach (config('asgard.block.config.partials.translatable.edit') as $partial): ?>
            @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="box-body">
    @editor('body', trans('block::blocks.body'), old("{$lang}.body"), $lang)

    {!! Form::i18nCheckbox('online', trans('block::blocks.online'), $errors, $lang) !!}

    <?php if (config('asgard.block.config.partials.translatable.create') !== []): ?>
        <?php foreach (config('asgard.block.config.partials.translatable.create') as $partial): ?>
            @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<div class="box-body">
    <?php $old = $block->hasTranslation($lang) ? $block->translate($lang)->body : '' ?>
    @editor('body', trans('page::pages.form.body'), old("$lang.body", $old), $lang)

    {!! Form::i18nCheckbox('online', trans('block::blocks.online'), $errors, $lang, $block) !!}

    <?php if (config('asgard.block.config.partials.translatable.edit') !== []): ?>
        <?php foreach (config('asgard.block.config.partials.translatable.edit') as $partial): ?>
            @include($partial)
        <?php endforeach; ?>
    <?php endif; ?>
</div>

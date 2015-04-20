<div class="box-body">
    {!! Form::i18nTextarea('body', trans('block::blocks.body'), $errors, $lang, $block) !!}

    {!! Form::i18nCheckbox('online', trans('block::blocks.online'), $errors, $lang, $block) !!}
</div>

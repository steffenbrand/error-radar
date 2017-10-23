<?php

return [
    'inputContainer' => '<div class="form-group pmd-textfield">{{content}}</div>',
    'inputContainerError' => '<div class="form-group pmd-textfield {{type}}{{required}} has-error">{{content}}{{error}}</div>',
    'error' => '<p class="help-block">{{content}}</p>',
    'label' => '<label class="control-label" {{attrs}}>{{text}}</label>',
    'select' => '<div class="form-group pmd-textfield pmd-textfield-floating-label"><select class="select-simple form-control pmd-select2" name="{{name}}"{{attrs}}>{{content}}</select></div>',
];
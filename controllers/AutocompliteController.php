<?php

class AutocompliteController
{
    public function actionIndex()
    {
        return Tag::getTagsListForAutocomplite();
    }
}
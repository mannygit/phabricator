<?php

final class ExampleCustomField extends DifferentialCustomField {

    public function getFieldKey() {
        return 'example:test';
    }

    public function shouldAppearInPropertyView() {
        return true;
    }

    public function shouldAppearInDiffPropertyView() {
        return true;
    }

    public function renderPropertyViewLabel() {
        return pht('Example Custom Field');
    }

    public function renderDiffPropertyViewLabel(DifferentialDiff $diff)
    {
        return pht('Example Custom Field');
    }

    public function renderDiffPropertyViewValue(DifferentialDiff $diff)
    {
        return phutil_tag(
            'h1',
            array(
                'style' => 'color: #ff00ff',
            ),
            phutil_tag(
                'a',
                array('href' => "https://www.affirm.com"),
                pht('It worked!'))
            );
    }


    public function renderPropertyViewValue(array $handles) {
        return phutil_tag(
            'h1',
            array(
                'style' => 'color: #ff00ff',
            ),
            pht('It worked!'));
    }

}
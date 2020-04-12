<?php

use \ion\WordPress\WordPressHelper as WP;

global $columns;

$groups = 4;

$groupDescriptions = [
    "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque vestibulum nunc elit, non dignissim eros sagittis nec. Vivamus ut urna metus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam vel pulvinar elit, quis interdum purus. Integer consequat tortor ut risus finibus, et facilisis felis hendrerit. Aenean ut magna sem. Etiam eget dictum orci. Phasellus in hendrerit eros. Mauris varius dapibus eros, et semper libero ultrices at. Vivamus ut erat eget erat blandit pulvinar. Integer varius eget magna ut pharetra.",
    "Duis sem nunc, aliquet ac tristique vitae, vulputate non orci. Pellentesque turpis mi, sagittis eget ex id, pretium scelerisque ligula. Nulla scelerisque risus eu neque gravida porttitor. Fusce in eleifend massa, nec lobortis dolor. Praesent laoreet diam at magna scelerisque ultrices. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Suspendisse et neque a elit cursus egestas non eu justo. Morbi ullamcorper pellentesque mauris sit amet volutpat. Suspendisse in congue est, nec vehicula sapien. Ut maximus erat vel orci lobortis facilisis eget eget metus. Quisque consectetur, est non luctus consectetur, lorem ligula elementum eros, non ultrices lectus nunc nec enim. Donec pulvinar nec erat ac fringilla. Donec vel efficitur risus, sed consectetur nulla. Duis euismod leo quis dui consequat ultricies. Nam interdum posuere nibh, vel scelerisque massa tempus in.",
    "Donec sodales dui eget ultricies iaculis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nunc non interdum lorem. Phasellus id hendrerit quam. Fusce imperdiet nisl eget dolor ultricies, quis interdum ligula euismod. Vivamus molestie vel leo vel venenatis. Cras a tellus metus. Aenean facilisis leo eget urna iaculis, eget pharetra diam pellentesque. Sed tempus ante nec dictum mattis.",
    "In hac habitasse platea dictumst. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut consectetur imperdiet dignissim. Sed semper dui ac interdum sollicitudin. Duis a justo suscipit, ultrices enim ac, viverra dolor. Sed finibus, ligula in lobortis ultrices, magna tellus tincidunt lacus, non congue mi diam at velit. Cras congue pharetra fermentum. Nullam facilisis accumsan suscipit.",
    "Nunc in augue massa. In aliquet auctor sodales. Vivamus volutpat egestas ultrices. Donec id massa vulputate, volutpat justo vel, sodales velit. Proin ultrices tellus orci, nec pulvinar neque rhoncus eu. Sed mattis sodales eleifend. Duis semper facilisis dolor sed vestibulum."
];

shuffle($groupDescriptions);

$form = WP::backEndForm("Edit Form", null, null, $columns);

for ($g = 1; $g < $groups + 1; $g++) {
    $fields = [];

    $form->addGroup("Group " . $g, $groupDescriptions[0], null, $columns);

    $groupDescriptions = array_values(array_slice($groupDescriptions, 1));
    shuffle($groupDescriptions);

    if ($g >= 1) {

        $fields[] = WP::textInputField("Single-line input", "wp-helper-singleline-text-$g", null, null, "An example single-line text input field.", false, false, false);
        $fields[] = WP::DropDownListInputField("Theme template list", WP::GetTemplates(false, false, true), "wp-helper-template-$g", null, null, "An example drop-down list (displaying available templates in the current theme / plug-in).", "No values.");
        $fields[] = WP::ColourPickerInputField("Colour-picker input", "wp-helper-colour-$g", null, null, "An example colour-picker field.");
        $fields[] = WP::CheckBoxInputField("Check-box input", "wp-helper-checkbox-$g", null, null, "An example check-box text input field.");
    }

    if ($g >= 2) {

        $fields[] = WP::CheckBoxInputField("Spanned check-box input", "wp-helper-spanned-checkbox-$g", null, null, "An example check-box text input field (spanned).", true);
        $fields[] = WP::TextInputField("Spanned single-line input", "wp-helper-spanned-singleline-text-$g", null, null, "An example single-line text input field (spanned).", false, false, true);
        $fields[] = WP::DropDownListInputField("Spanned theme template list", WP::GetTemplates(false, false, true), "wp-helper-spanned-template-$g", null, null, "An example drop-down list (displaying available templates in the current theme / plug-in - spanned).", "No values.", true);
        $fields[] = WP::ColourPickerInputField("Spanned colour-picker input", "wp-helper-spanned-colour-$g", null, null, "An example colour-picker field (spanned).", true);
    }

    if ($g >= 3) {

        $fields[] = WP::TextInputField("Multi-line input", "wp-helper-multiline-text-$g", null, null, "An example multi-line text input field.", true, false, false);
        $fields[] = WP::TextInputField("Multi-line input with editor", "wp-helper-multiline-text-editor-$g", null, null, "An example multi-line text input field with editor.", true, true, false);
    }

    if ($g >= 4) {

        $fields[] = WP::TextInputField("Spanned multi-line input", "wp-helper-spanned-multiline-text-$g", null, null, "An example multi-line text input field (spanned).", true, false, false);
        $fields[] = WP::TextInputField("Spanned Multi-line input with editor", "wp-helper-spanned-multiline-text-editor-$g", null, null, "An example multi-line text input field with editor (spanned).", true, true, true);
    }


    shuffle($fields);

    foreach ($fields as $field) {
        $form->AddField($field);
    }
}


$form->render();



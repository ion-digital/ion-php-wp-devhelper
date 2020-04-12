<?php

use \ion\WordPress\WordPressHelper as WP;

WP::BackEndForm("Edit Form")
        ->AddGroup("All Field Types")
            ->AddField(WP::DropDownListInputField("Drop-down list input", WP::GetTemplates(false, false, true), "wp-helper-template-1", null, null, "An example drop-down list (displaying available templates - Flat = <em>false</em>, ThemeOnly = <em>false</em>, Labels = <strong>true</strong>)."))
            ->AddField(WP::ColourPickerInputField("Colour-picker input", "wp-helper-colour-1", null, null, "An example colour-picker field."))
            ->AddField(WP::CheckBoxInputField("Check-box input", "wp-helper-checkbox-1", null, null, "An example check-box text input field."))
            ->AddField(WP::TextInputField("Single-line input", "wp-helper-singleline-text-1", null, null, "An example single-line text input field.", false, false, false))
            ->AddField(WP::TextInputField("Multi-line input", "wp-helper-multiline-text-1", null, null, "An example multi-line text input field.", true, false, false))
            ->AddField(WP::TextInputField("Multi-line input with editor", "wp-helper-multiline-text-editor-1", null, null, "An example multi-line text input field with editor.", true, true, false))            
        
        ->AddGroup("Theme Template Lists")        
            ->AddField(WP::DropDownListInputField("Theme template list", WP::GetTemplates(false, false, false), "wp-helper-template-2", null, null, "An example drop-down list (displaying available templates - Flat = <em>false</em>, ThemeOnly = <em>false</em>, Labels = <em>false</em>).", "No templates detected!"))
            ->AddField(WP::DropDownListInputField("Theme template list", WP::GetTemplates(true, false, false), "wp-helper-template-3", null, null, "An example drop-down list (displaying available templates - Flat = <strong>true</strong>, ThemeOnly = <em>false</em>, Labels = <em>false</em>).", "No templates detected!"))
            ->AddField(WP::DropDownListInputField("Theme template list", WP::GetTemplates(true, true, false), "wp-helper-template-4", null, null, "An example drop-down list (displaying available templates - Flat = <strong>true</strong>, ThemeOnly = <strong>true</strong>, Labels = <em>false</em>).", "No templates detected!"))
            ->AddField(WP::DropDownListInputField("Theme template list", WP::GetTemplates(true, true, true), "wp-helper-template-5", null, null, "An example drop-down list (displaying available templates - Flat = <strong>true</strong>, ThemeOnly = <strong>true</strong>, Labels = <strong>true</strong>).", "No templates detected!"))
            ->AddField(WP::DropDownListInputField("Theme template list", WP::GetTemplates(false, true, true), "wp-helper-template-6", null, null, "An example drop-down list (displaying available templates - Flat = <em>false</em>, ThemeOnly = <strong>true</strong>, Labels = <strong>true</strong>).", "No templates detected!"))
            ->AddField(WP::DropDownListInputField("Theme template list", WP::GetTemplates(false, false, true), "wp-helper-template-7", null, null, "An example drop-down list (displaying available templates - Flat = <em>false</em>, ThemeOnly = <em>false</em>, Labels = <strong>true</strong>).", "No templates detected!"))

    ->render();



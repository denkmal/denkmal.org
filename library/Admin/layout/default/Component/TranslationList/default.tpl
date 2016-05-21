<ul class="languageList menu-pills">
  {foreach $languageList as $language}
    <li class="{if $language->getId() == $activeLanguage->getId()} active{/if}">
      <a href="{linkUrl page='Admin_Page_Translations' language=$language->getId() translated=$translated}">{$language->getName()}</a>
    </li>
  {/foreach}
</ul>

<ul class="typeList menu-pills">
  <li class="{if null === $translated} active{/if}">
    <a href="{linkUrl page='Admin_Page_Translations' language=$activeLanguage->getId()}">All</a>
  </li>
  <li class="{if true === $translated} active{/if}">
    <a href="{linkUrl page='Admin_Page_Translations' language=$activeLanguage->getId() translated=true}">Translated</a>
  </li>
  <li class="{if false === $translated} active{/if}">
    <a href="{linkUrl page='Admin_Page_Translations' language=$activeLanguage->getId() translated=false}">Untranslated</a>
  </li>
</ul>

{paging paging=$translationList}
<ul class="translationList dataTable">
  <li class="header clearfix">
    <div class="keyWrapper">Key</div>
    <div class="valueWrapper">Value</div>
  </li>
  {foreach $translationList as $translation}
    <li>
      {form name="Admin_Form_Translation" language=$activeLanguage key=$translation.key value=$translation.value}
        <div class="clipSlide">
          <div class="clearfix">
            <div class="keyWrapper">
              {if !isset($backupLanguage)}
                {button_link class='copy copyKeyToValue' icon='arrow-right' iconPosition='right' label='Copy key'}
              {/if}
              <div class="key">{$translation.key|escape}</div>
              <div class="variables">
                {foreach $translation.variables as $variable}
                  {literal}{${/literal}{$variable}{literal}}{/literal}
                {/foreach}
              </div>
              {if isset($backupLanguage)}
                <div class="backupValue">{$backupTranslationList[$translation.key].value|escape}</div>
                <span class="wordCount">{$backupTranslationList[$translation.key].wordCount} word(s)</span>
              {/if}
            </div>
            <div class="valueWrapper {if $translation.value === null}isUnset{/if}">
              {formField name="value" class="autosize"}
              {button action="Unset" label="Unset Translation"}
              {button_link label="Cancel" class="resetValue"}
              {button_link label="Save" class="saveForm"}
            </div>
          </div>
        </div>
      {/form}
    </li>
  {/foreach}
</ul>{paging paging=$translationList}

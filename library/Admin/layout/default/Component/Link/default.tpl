<div class="link-content toggleNext">
  {$link->getLabel()|escape}
  <a target="_blank" href="{$link->getUrl()|escape}">{$link->getUrl()|escape}</a>
  {if !$link->getAutomatic()}[manual]{/if}
</div>
<div class="link-edit toggleNext-content">
  {form name='Admin_Form_Link' link=$link}
  {formField name='label' label={translate 'Name'}}
  {formField name='url' label={translate 'URL'}}
  {formField name='automatic' label={translate 'automatic'}}

  {formAction action='Save' label={translate 'Save'} alternatives="
    {button_link label={translate 'Delete'} icon='trash' iconConfirm='trash-open' class='warning deleteLink' data=['click-confirmed' => true]}
  "}
  {/form}
</div>

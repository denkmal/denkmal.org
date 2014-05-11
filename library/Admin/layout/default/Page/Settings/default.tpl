{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {form name='Admin_Form_Settings'}
  {formAction action='Save' label={translate 'Speichern'}}
  {/form}
{/block}

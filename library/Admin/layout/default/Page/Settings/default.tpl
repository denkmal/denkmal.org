{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {form name='Admin_Form_Settings'}
  {formField name='suspensionUntil' label={translate 'Break'} append="<small>({translate 'Reactivation date'})</small>"}
  {formField name='anonymousMessagingDisabled' label={translate 'Disallow anonymous messages'}}
  {formAction action='Save' label={translate 'Save'}}
  {/form}
{/block}

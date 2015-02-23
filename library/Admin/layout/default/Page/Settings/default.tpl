{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {form name='Admin_Form_Settings'}
  {formField name='suspensionUntil' label={translate 'Unterbruch'} append="<small>({translate 'Datum der Reaktivierung'})</small>"}
  {formField name='anonymousMessagingDisabled' label={translate 'Anonyme Nachrichten verbieten'}}
  {formAction action='Save' label={translate 'Speichern'}}
  {/form}
{/block}

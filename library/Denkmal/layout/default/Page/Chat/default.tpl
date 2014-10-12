{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {form name='Denkmal_Form_Message'}
    {formField name='venue' label={translate 'Ort'}}
    {formField name='text' label={translate 'Nachricht'}}
    {formAction action='Create' label={translate 'Abschicken'}}
  {/form}
{/block}

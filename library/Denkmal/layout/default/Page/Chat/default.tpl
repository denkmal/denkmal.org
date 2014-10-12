{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {component name='Denkmal_Component_MessageList_All'}

  {form name='Denkmal_Form_Message'}
    {formField name='venue' label={translate 'Ort'}}
    {formField name='text' label={translate 'Text'}}
    {formAction action='Create' label={translate 'Abschicken'}}
  {/form}
{/block}

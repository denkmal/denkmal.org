{form name='Denkmal_Form_Message'}
  <ul class="stateList">
    <li class="stateList-item state-1">
      {button_link label={translate 'Wasloift?'} icon='chat' class='startMessage'}
    </li>
    <li class="stateList-item state-2">
      {formField name='venue' class='noLabel'}
      {formField name='text' class='noLabel'}
      {formAction action='Create' icon='chat' label={translate 'Los!'}}
    </li>
  </ul>
{/form}

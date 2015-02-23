{form name='Denkmal_Form_Message'}
  <ul class="stateList">
    <li class="stateList-item state-1">
      <div class="formField noLabel">
        {button_link label={translate 'Wasloift?'} icon='chat' class='startMessage'}
      </div>
    </li>
    <li class="stateList-item state-2">
      {formField name='venue' class='noLabel' labelPrefix={translate 'Ort'}}
      {formField name='tags' class='noLabel'}
      {formField name='text' class='noLabel' placeholder={translate 'Deine Nachricht'}}
      {formAction action='Create' icon='chat' label={translate 'Los!'}}
    </li>
  </ul>
{/form}

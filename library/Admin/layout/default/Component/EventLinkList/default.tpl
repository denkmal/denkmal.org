<ul class="eventLinkList">
  {foreach $eventLinkList as $eventLink}
    <li class="eventLink" data-id="{$eventLink->getId()}">
      <span class="label">{$eventLink->getLabel()|escape}</span>
      <span class="url">{$eventLink->getUrl()|escape}</span>
      {link icon='pop-out' href=$eventLink->getUrl() target='_blank'}
      {button_link icon='trash' iconConfirm='trash-open' class='deleteEventLink warning' data=['click-confirmed' => true, 'click-spinner' => true]}
    </li>
  {/foreach}
</ul>

<div class="toggleNext">{translate 'Add'}<span class="icon-plus"></span></div>
<div class="toggleNext-content">
  {form name='Admin_Form_EventLink' event=$event}
  {formField name='label' label={translate 'Label'}}
  {formField name='url' label={translate 'URL'}}
  {formAction action='Add' label={translate 'Add'}}
  {/form}
</div>
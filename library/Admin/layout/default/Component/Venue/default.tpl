<div class="venue {if $venue->getIgnore()}ignored{/if} {if $venue->getSuspended()}suspended{/if}">
  <div class="venue-content toggleNext">
    <a href="{linkUrl page="Admin_Page_Venue" venue=$venue->getId()}" class="venue-name nowrap toggleNext-excluded">{$venue->getName()|escape}</a>
    {if $venue->getUrl()}
      <a href="{$venue->getUrl()|escape}" class="toggleNext-excluded"><span class="icon icon-pop-out"></span></a>
    {/if}
  </div>
  <div class="venue-edit toggleNext-content">
    {form name='Admin_Form_Venue' venue=$venue}
    {formField name='name' label={translate 'Name'}}
    {formField name='url' label={translate 'URL'}}
    {formField name='address' label={translate 'Adresse'}}
    {formField name='email' label={translate 'E-Mail'}}
    {formField name='twitterUsername' label={translate 'Twitter'}}
    {formField name='coordinates' label={translate 'Koordinaten'}}
    {formField name='ignore' text={translate 'Scraper ignorieren'}}
    {formField name='suspended' text={translate 'Suspendiert'}}
    {formAction action='Save' label={translate 'Speichern'} alternatives="
      	{button action='Delete' label={translate 'Löschen'} icon='trash' iconConfirm='trash-open' class='warning deleteAffiliate' data=['click-confirmed' => true]}
			"}
    {/form}
    {component name='Admin_Component_VenueAliasList' venue=$venue}
    {component name='Admin_Component_VenueMerge' venue=$venue}
  </div>
</div>

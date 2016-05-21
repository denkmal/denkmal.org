<h2>Alias</h2>
<ul class="venueAliasList">
  {foreach $venueAliasList as $venueAlias}
    <li class="venueAlias" data-id="{$venueAlias->getId()}">
      {$venueAlias->getName()|escape}
      {link icon="trash" class="deleteAlias"}
    </li>
  {/foreach}
</ul>{form name='Admin_Form_VenueAlias' venue=$venue}
{formField name='name' label={translate 'Name'}}
{formAction action='Add' label={translate 'Add'}}
{/form}


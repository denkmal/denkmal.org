<div class="bar">
  <div class="logoWrapper">
    {link icon="baslerstab" label="denkmal.org" page="Denkmal_Page_Events" class="logo"}
    <p class="slogan">{translate 'Was loift in Basel?!'}</p>
  </div>
  {if $viewer}
    {component name='Denkmal_Component_Logout'}
  {else}
    {link icon="signin" title="{translate 'Amelden'}" label="{translate 'Amelden'}" page="Denkmal_Page_Login" class="addButton navButton"}
  {/if}
  {link icon="plus" title="{translate 'Event hinzufügen'}" label="{translate 'Event hinzufügen'}" page="Denkmal_Page_Add" class="addButton navButton"}
  {menu name='dates' template='weekdays'}
  {link icon="calendar" class="showWeek navButton"}
</div>

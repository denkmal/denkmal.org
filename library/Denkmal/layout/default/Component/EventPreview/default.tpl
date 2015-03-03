<div class="preview">
  <h2>{translate 'Vorschau'}:</h2>
  {if isset($fromDateDisplay)}
    <div class="info info-time">
			<span class="icon icon-error"></span>
      {translate 'Der Event wird am {$date} angezeigt (wegen frühmorgendlichem Anfang)!' date="<span class=\"day\">{date_weekday date=$fromDateDisplay} {date time=$fromDateDisplay->getTimestamp()}</span>"}
		</div>
  {/if}
  {if isset($eventDuplicates) && $eventDuplicates->getCount()}
    <div class="info info-duplicate">
      <span class="icon icon-error"></span>
      {translate 'Es sind bereits {$count} Event(s) an diesem Tag für {$venue} eingetragen.' count=$eventDuplicates->getCount() venue="<span class=\"venue\">{$venue->getName()|escape}</span>"}
    </div>
  {/if}
</div>

{component name='Denkmal_Component_Event' event=$event venue=$venue}

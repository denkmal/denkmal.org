<div class="preview">
  <h2>{translate 'Preview'}:</h2>
  {if isset($fromDateDisplay)}
    <div class="info info-time">
			<span class="icon icon-error"></span>
      {translate 'Event will be shown on {$date} (because it starts early in the morning)!' date="<span class=\"day\">{date_weekday date=$fromDateDisplay} {date time=$fromDateDisplay->getTimestamp()}</span>"}
		</div>
  {/if}
  {if isset($eventDuplicates) && $eventDuplicates->getCount()}
    <div class="info info-duplicate">
      <span class="icon icon-error"></span>
      {translate 'Selected day already contains {$count} event(s) for {$venue}.' count=$eventDuplicates->getCount() venue="<span class=\"venue\">{$venue->getName()|escape}</span>"}
    </div>
  {/if}
</div>

{component name='Denkmal_Component_Event' event=$event venue=$venue}

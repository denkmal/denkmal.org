<div class="preview">
  <h2>{translate 'Vorschau'}:</h2>
  {if isset($fromDateDisplay)}
    <span class="timeInfo">
			<span class="icon icon-info"></span>
      {translate 'Dieses Event wird am {$date} angezeigt (wegen frühmorgendlichem Anfang)!' date="<span class=\"day\">{date_weekday date=$fromDateDisplay} {date time=$fromDateDisplay->getTimestamp()}</span>"}
		</span>
  {/if}
</div>

{component name='Denkmal_Component_Event' event=$event venue=$venue}

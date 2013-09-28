<div class="venue-merge toggleNext">
	{translate 'Ersetzen mit'}
</div>
<div class="venue-search toggleNext-content">
	{form name='Admin_Form_VenueMerge' venue=$venue}
		{formField name='newVenue' label={translate 'Ort'}}
		{formAction action='Merge' label={translate 'Speichern'}}
	{/form}
</div>

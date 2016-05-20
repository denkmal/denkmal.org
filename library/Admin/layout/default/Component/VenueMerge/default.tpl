<div class="venue-merge toggleNext">
  {translate 'Replace with'}
</div>
<div class="venue-search toggleNext-content">
  {form name='Admin_Form_VenueMerge' venue=$venue}
  {formField name='newVenue' label={translate 'Venue'}}
  {formAction action='Merge' label={translate 'Save'}}
  {/form}
</div>

{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-main'}
  {if $region}
    <h2>{translate 'Region {$name}' name=$region->getName()|escape}</h2>
    {form name='Admin_Form_Region' region=$region}
    {formField name='emailAddress' label={translate 'Email Address'}}
    {formField name='facebookAccount' label={translate 'Facebook Account'}}
    {formField name='facebookAccessToken' label={translate 'Facebook Page Access Token'}}
    {formField name='twitterAccount' label={translate 'Twitter Account'}}
    {formField name='twitterCredentials' label={translate 'Twitter API Credentials'}}
    {formField name='suspensionUntil' label={translate 'Suspension until'}}
    {formAction action='Save' label={translate 'Save'}}
    {/form}
  {/if}
  <h2>{translate 'Global Settings'}</h2>
  {form name='Admin_Form_Settings'}
  {formField name='anonymousMessagingDisabled' label={translate 'Disallow anonymous messages'}}
  {formAction action='Save' label={translate 'Save'}}
  {/form}
{/block}

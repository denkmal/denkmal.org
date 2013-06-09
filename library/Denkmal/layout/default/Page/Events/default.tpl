{extends file=$render->getLayoutPath('Page/Abstract/default.tpl')}

{block name='content-title'}{/block}
{block name='content-main'}
	<time class="currentDate">{date time=$date->getTimestamp()}</time>
	{component name='Denkmal_Component_EventList' date=$date}
{/block}

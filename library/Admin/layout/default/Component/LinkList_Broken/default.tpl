{extends file=$render->getLayoutPath('Component/LinkList_Abstract/default.tpl')}

{block name='headline'}
  <h2>{translate 'Defekte Links'}</h2>
{/block}

{block name='noContent'}
  {translate 'Keine defekten Links vorhanden.'}
{/block}

{extends file=$render->getLayoutPath('Component/LinkList_Abstract/default.tpl')}

{block name='headline'}
  <h2>{translate 'Broken Links'}</h2>
{/block}

{block name='noContent'}
  {translate 'No broken links.'}
{/block}

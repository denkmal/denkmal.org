<ul class="roleList">
  {foreach Denkmal_Role::getRoles() as $role}
    <li class="roleList-item" data-role="{$role|escape}">
      {checkbox checked=$user->getRoles()->contains($role) isSwitch=true label={translate ".internals.role.{$role}"} class='toggleRole'}
    </li>
  {/foreach}
</ul>

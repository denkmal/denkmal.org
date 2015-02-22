<ul class="roleList">
  {foreach Denkmal_Role::getRoles() as $role}
    <li class="roleList-item">
      {checkbox checked=$user->getRoles()->contains($role) isSwitch=true label={translate ".internals.role.{$role}"}}
    </li>
  {/foreach}
</ul>

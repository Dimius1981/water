{foreach $userlist_arr as $item}
<tr>
  <td>{$item.id}</td>
  <td>{$item.name}</td>
  <td>{$item.login}</td>
  <td>{$item.date_login}</td>
  <td>{$item.email}</td>
  <td>
    <div class="form-check form-switch">
      {if $item.enabled == 1}
      <input class="form-check-input" type="checkbox" id="mySwitch" name="darkmode" value="yes" checked disabled>
      {else}
      <input class="form-check-input" type="checkbox" id="mySwitch" name="darkmode" value="yes" disabled>
      {/if}
  </td>
  <td>
    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#edituserModal" data-user-id="{$item.id}"><img src="templates/images/pen.png"></button>
    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#deluserModal" data-user-id="{$item.id}" data-user-name="{$item.name}"><img src="templates/images/del.png"></button>
  </td>
</tr>
{/foreach}

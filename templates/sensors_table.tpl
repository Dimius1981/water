{foreach $sensors_list as $item}
<tr class="{$item.row_style}">
  <td align="center">{$item.factorynumber}</td>
  <td><a href="?page=datatable">{$item.name}</a></td>
  <td>{$item.last_level}</td>
  <td>{$item.last_rashod}</td>
  <td>7777777</td>
  <td>{$item.last_bat}</td>
  <td>{$item.last_date}</td>
  <td>{$item.sensor_date_live}</td>
  <td>
    {if $func_access[2]}
      <button class="btn" data-bs-toggle="modal" data-bs-target="#setSensorsModal" data-sensor-num="{$item.factorynumber}"><img src="templates/images/settingtrue.png"></button>
    {else}
      <button class="btn"><img src="templates/images/settingtrue.png"></button>
    {/if}
    {if $func_access[1]}
      <button class="btn" data-bs-toggle="modal" data-bs-target="#delSensorsModal" data-sensor-num="{$item.factorynumber}" data-sensor-name="{$item.name}"><img src="templates/images/deltrue.png"></button>
    {else}
      <button class="btn"><img src="templates/images/deltrue.png"></button>
    {/if}
  </td>
</tr>
{/foreach}
